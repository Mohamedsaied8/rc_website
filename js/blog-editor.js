/**
 * Blog Editor JavaScript
 * Handles TinyMCE initialization, image uploads, and form submission
 */

let editor;
let currentCoverImageUrl = null;

/**
 * Initialize TinyMCE Editor
 */
function initTinyMCE() {
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | image link | code | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        images_upload_handler: handleContentImageUpload,
        automatic_uploads: true,
        file_picker_types: 'image',
        setup: function (ed) {
            editor = ed;
        }
    });
}

/**
 * Handle image upload within content
 */
async function handleContentImageUpload(blobInfo, progress) {
    return new Promise(async (resolve, reject) => {
        const formData = new FormData();
        formData.append('image', blobInfo.blob(), blobInfo.filename());
        formData.append('type', 'content');

        try {
            const response = await fetch('database_image.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                resolve(result.url);
            } else {
                reject(result.error || 'Upload failed');
            }
        } catch (error) {
            reject('Upload failed: ' + error.message);
        }
    });
}

/**
 * Handle cover image selection
 */
document.addEventListener('DOMContentLoaded', () => {
    const coverInput = document.getElementById('coverImage');
    const coverPreview = document.getElementById('coverPreview');
    const coverImageName = document.getElementById('coverImageName');
    const removeCoverBtn = document.getElementById('removeCoverBtn');

    if (coverInput) {
        coverInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (!file) return;

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                coverPreview.innerHTML = `<img src="${e.target.result}" alt="Cover preview">`;
                coverPreview.classList.add('active');
            };
            reader.readAsDataURL(file);

            coverImageName.textContent = file.name;

            // Upload image
            const formData = new FormData();
            formData.append('image', file);
            formData.append('type', 'cover');

            try {
                const response = await fetch('database_image.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    currentCoverImageUrl = result.url;
                    document.getElementById('coverImageUrl').value = result.url;

                    if (removeCoverBtn) {
                        removeCoverBtn.style.display = 'inline-block';
                    }
                } else {
                    alert('Error uploading image: ' + result.error);
                    coverPreview.innerHTML = '';
                    coverPreview.classList.remove('active');
                    coverImageName.textContent = '';
                }
            } catch (error) {
                alert('Error uploading image: ' + error.message);
                coverPreview.innerHTML = '';
                coverPreview.classList.remove('active');
                coverImageName.textContent = '';
            }
        });
    }

    // Remove cover image
    if (removeCoverBtn) {
        removeCoverBtn.addEventListener('click', () => {
            currentCoverImageUrl = null;
            document.getElementById('coverImageUrl').value = '';
            coverPreview.innerHTML = '';
            coverPreview.classList.remove('active');
            coverImageName.textContent = '';
            coverInput.value = '';
            removeCoverBtn.style.display = 'none';
        });
    }
});

/**
 * Initialize editor for create or edit mode
 */
async function initEditor(mode, postId = null) {
    initTinyMCE();

    if (mode === 'edit' && postId) {
        await loadPost(postId);
    }

    // Handle form submission
    const form = document.getElementById('postForm');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (mode === 'create') {
            await createPost();
        } else {
            await updatePost(postId);
        }
    });
}

/**
 * Load post data for editing
 */
async function loadPost(postId) {
    try {
        const response = await fetch(`database_post.php?id=${postId}`);
        const post = await response.json();

        if (post.error) {
            alert('Error loading post: ' + post.error);
            window.location.href = 'blog_admin.php';
            return;
        }

        // Populate form
        document.getElementById('title').value = post.title;
        document.getElementById('excerpt').value = post.excerpt || '';
        document.getElementById('status').value = post.status;

        // Set cover image if exists
        if (post.cover_image) {
            currentCoverImageUrl = post.cover_image;
            document.getElementById('coverImageUrl').value = post.cover_image;
            document.getElementById('coverPreview').innerHTML = `<img src="${post.cover_image}" alt="Cover">`;
            document.getElementById('coverPreview').classList.add('active');
            document.getElementById('coverImageName').textContent = 'Current cover image';

            const removeCoverBtn = document.getElementById('removeCoverBtn');
            if (removeCoverBtn) {
                removeCoverBtn.style.display = 'inline-block';
            }
        }

        // Wait for TinyMCE to initialize, then set content
        const checkEditor = setInterval(() => {
            if (tinymce.get('content')) {
                tinymce.get('content').setContent(post.content);
                clearInterval(checkEditor);

                // Show form, hide loading
                document.getElementById('loadingState').style.display = 'none';
                document.getElementById('postForm').style.display = 'block';
            }
        }, 100);

    } catch (error) {
        alert('Error loading post: ' + error.message);
        window.location.href = 'blog_admin.php';
    }
}

/**
 * Create new post
 */
async function createPost() {
    const formMessage = document.getElementById('formMessage');
    formMessage.className = 'form-message';
    formMessage.textContent = '';

    const postData = {
        title: document.getElementById('title').value,
        content: tinymce.get('content').getContent(),
        excerpt: document.getElementById('excerpt').value,
        cover_image: currentCoverImageUrl,
        status: document.getElementById('status').value
    };

    try {
        const response = await fetch('database_post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        });

        const result = await response.json();

        if (result.success) {
            formMessage.className = 'form-message success';
            formMessage.textContent = 'Post created successfully! Redirecting...';

            setTimeout(() => {
                window.location.href = 'blog_admin.php';
            }, 1500);
        } else {
            formMessage.className = 'form-message error';
            formMessage.textContent = 'Error: ' + result.error;
        }
    } catch (error) {
        formMessage.className = 'form-message error';
        formMessage.textContent = 'Error creating post: ' + error.message;
    }
}

/**
 * Update existing post
 */
async function updatePost(postId) {
    const formMessage = document.getElementById('formMessage');
    formMessage.className = 'form-message';
    formMessage.textContent = '';

    const postData = {
        id: postId,
        title: document.getElementById('title').value,
        content: tinymce.get('content').getContent(),
        excerpt: document.getElementById('excerpt').value,
        cover_image: currentCoverImageUrl,
        status: document.getElementById('status').value
    };

    try {
        const response = await fetch('database_post.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        });

        const result = await response.json();

        if (result.success) {
            formMessage.className = 'form-message success';
            formMessage.textContent = 'Post updated successfully!';

            setTimeout(() => {
                window.location.href = 'blog_admin.php';
            }, 1500);
        } else {
            formMessage.className = 'form-message error';
            formMessage.textContent = 'Error: ' + result.error;
        }
    } catch (error) {
        formMessage.className = 'form-message error';
        formMessage.textContent = 'Error updating post: ' + error.message;
    }
}
