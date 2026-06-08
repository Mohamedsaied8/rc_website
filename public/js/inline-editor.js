document.addEventListener('DOMContentLoaded', () => {
    // Inject the floating toolbar CSS
    const style = document.createElement('style');
    style.innerHTML = `
        #cms-toolbar {
            position: absolute;
            z-index: 10000;
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 5px;
            display: none;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
            gap: 5px;
        }
        #cms-toolbar.active {
            display: flex;
        }
        .cms-toolbar-btn {
            background: transparent;
            border: none;
            color: #cbd5e1;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }
        .cms-toolbar-btn:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        .cms-editable:focus, .cms-editable-page:focus {
            outline: 2px solid #22d3ee !important;
            background: rgba(34, 211, 238, 0.05);
        }
        /* Hidden file input */
        #cms-image-upload { display: none; }
    `;
    document.head.appendChild(style);

    // Create the toolbar HTML
    const toolbar = document.createElement('div');
    toolbar.id = 'cms-toolbar';
    toolbar.innerHTML = `
        <button class="cms-toolbar-btn" data-command="formatBlock" data-value="H1">H1</button>
        <button class="cms-toolbar-btn" data-command="formatBlock" data-value="H2">H2</button>
        <button class="cms-toolbar-btn" data-command="formatBlock" data-value="H3">H3</button>
        <button class="cms-toolbar-btn" data-command="formatBlock" data-value="P">P</button>
        <div style="width: 1px; background: rgba(255,255,255,0.1); margin: 0 5px;"></div>
        <button class="cms-toolbar-btn" data-command="bold"><i class="fa-solid fa-bold"></i></button>
        <button class="cms-toolbar-btn" data-command="italic"><i class="fa-solid fa-italic"></i></button>
        <button class="cms-toolbar-btn" data-command="underline"><i class="fa-solid fa-underline"></i></button>
        <div style="width: 1px; background: rgba(255,255,255,0.1); margin: 0 5px;"></div>
        <button class="cms-toolbar-btn" data-command="insertUnorderedList"><i class="fa-solid fa-list-ul"></i></button>
        <button class="cms-toolbar-btn" data-command="insertOrderedList"><i class="fa-solid fa-list-ol"></i></button>
        <div style="width: 1px; background: rgba(255,255,255,0.1); margin: 0 5px;"></div>
        <button class="cms-toolbar-btn" id="cms-btn-image"><i class="fa-solid fa-image"></i></button>
        <input type="file" id="cms-image-upload" accept="image/*">
    `;
    document.body.appendChild(toolbar);

    // Make elements editable
    const editableElements = document.querySelectorAll('cms-editable');
    editableElements.forEach(el => {
        el.setAttribute('contenteditable', 'true');
    });

    let currentEditable = null;

    // Show toolbar on selection
    document.addEventListener('mouseup', () => {
        const selection = window.getSelection();
        
        // Find if we are inside an editable area
        let node = selection.anchorNode;
        let isEditable = false;
        while (node && node !== document.documentElement) {
            if (node.nodeType === 1 && (node.hasAttribute('contenteditable') && node.getAttribute('contenteditable') === 'true')) {
                isEditable = true;
                currentEditable = node;
                break;
            }
            node = node.parentNode;
        }

        if (isEditable && selection.toString().length > 0) {
            const range = selection.getRangeAt(0);
            const rect = range.getBoundingClientRect();
            
            toolbar.style.top = `${rect.top + window.scrollY - toolbar.offsetHeight - 10}px`;
            toolbar.style.left = `${rect.left + window.scrollX + (rect.width / 2) - (toolbar.offsetWidth / 2)}px`;
            toolbar.classList.add('active');
        } else {
            toolbar.classList.remove('active');
        }
    });

    // Prevent navigation on ALL links while in edit mode
    document.addEventListener('click', (e) => {
        let node = e.target;
        while (node && node !== document.documentElement) {
            if (node.tagName === 'A') {
                e.preventDefault();
                break;
            }
            node = node.parentNode;
        }
    });

    // Formatting buttons
    const buttons = toolbar.querySelectorAll('[data-command]');
    buttons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const command = btn.getAttribute('data-command');
            const value = btn.getAttribute('data-value') || null;
            document.execCommand(command, false, value);
        });
    });

    // Image Upload (Toolbar)
    const imageBtn = document.getElementById('cms-btn-image');
    const imageInput = document.getElementById('cms-image-upload');
    let currentImageTarget = null;
    
    imageBtn.addEventListener('click', (e) => {
        e.preventDefault();
        currentImageTarget = null; // means we insert at cursor
        imageInput.click();
    });

    // Image Upload (Direct Click on Image)
    document.addEventListener('click', (e) => {
        if (e.target.tagName === 'IMG' && e.target.hasAttribute('data-cms-image')) {
            e.preventDefault();
            e.stopPropagation();
            currentImageTarget = e.target;
            imageInput.click();
        }
    });

    imageInput.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);

        try {
            const response = await fetch('/admin/api/cms/upload', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                },
                body: formData
            });
            const data = await response.json();
            
            if (data.url) {
                if (currentImageTarget) {
                    // Replace existing image src
                    currentImageTarget.src = data.url;
                } else {
                    // Insert at cursor
                    document.execCommand('insertImage', false, data.url);
                }
            } else {
                alert('Image upload failed.');
            }
        } catch (error) {
            console.error('Upload Error:', error);
            alert('Error uploading image.');
        } finally {
            imageInput.value = ''; // reset
        }
    });

    // Save functionality
    const saveBtn = document.getElementById('cms-save-btn');
    if (saveBtn) {
        saveBtn.addEventListener('click', async () => {
            const originalText = saveBtn.innerText;
            saveBtn.innerText = 'Saving...';
            
            const payload = {
                blocks: {},
                custom_pages: {}
            };

            // Collect inline text blocks
            const blocks = document.querySelectorAll('cms-editable');
            blocks.forEach(block => {
                const key = block.getAttribute('data-cms-key');
                payload.blocks[key] = block.innerHTML;
            });

            // Collect replaced images
            const images = document.querySelectorAll('img[data-cms-image]');
            images.forEach(img => {
                const key = img.getAttribute('data-cms-image');
                payload.blocks[key] = img.getAttribute('src');
            });

            // Collect custom pages
            const customPages = document.querySelectorAll('.cms-editable-page');
            customPages.forEach(page => {
                const slug = page.getAttribute('data-page-slug');
                payload.custom_pages[slug] = page.innerHTML;
            });

            try {
                const response = await fetch('/admin/api/cms/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                
                const data = await response.json();
                if (data.success) {
                    saveBtn.innerText = 'Saved!';
                    setTimeout(() => saveBtn.innerText = originalText, 2000);
                } else {
                    alert('Failed to save changes.');
                    saveBtn.innerText = originalText;
                }
            } catch (error) {
                console.error(error);
                alert('Network error while saving.');
                saveBtn.innerText = originalText;
            }
        });
    }
});
