import os
import glob

base_dir = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views'
blade_files = glob.glob(os.path.join(base_dir, '**', '*.blade.php'), recursive=True)

for file_path in blade_files:
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    original = content
    
    # 1. Spacing Fixes
    content = content.replace('py-32', 'py-16 md:py-32')
    content = content.replace('py-24', 'py-12 md:py-24')
    content = content.replace('mb-24', 'mb-12 md:mb-24')
    content = content.replace('gap-16', 'gap-8 md:gap-16')
    content = content.replace('gap-12', 'gap-6 md:gap-12')
    
    # 2. Typography Fixes (careful not to double replace if it already has md:text-5xl)
    content = content.replace('text-6xl', 'text-5xl md:text-6xl')
    content = content.replace('md:text-5xl md:text-6xl', 'md:text-6xl') # Fix accidental double replacement
    
    content = content.replace('text-5xl', 'text-4xl md:text-5xl')
    content = content.replace('md:text-4xl md:text-5xl', 'md:text-5xl') # Fix accidental double replacement
    
    content = content.replace('text-7xl', 'text-5xl lg:text-7xl')
    content = content.replace('lg:text-5xl lg:text-7xl', 'lg:text-7xl')
    
    # 3. Automotive SVG SVG fix
    if 'automotive.blade.php' in file_path:
        content = content.replace('class="w-full min-w-[700px]"', 'class="w-full"')
    
    # 4. About page timeline alternate layout fix
    if 'about.blade.php' in file_path:
        # Instead of `md:odd:flex-row-reverse group`, make sure mobile wraps cleanly if needed
        # About page already stacks vertically because of `flex-col md:flex-row` implicitly? Wait, it has `flex items-center`
        # Let's change `flex items-center` to `flex flex-col md:flex-row md:items-center` for the timeline items!
        content = content.replace('relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active', 'relative flex flex-col md:flex-row items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active')
    
    if content != original:
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Updated {file_path}")

print("Global typography, spacing, and grid fixes applied!")
