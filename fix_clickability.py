import os
import re

# 1. Fix Product Cards in home.blade.php
f1 = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\home.blade.php'
with open(f1, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the inner relative so image doesn't block the click overlay
content = content.replace('<div class="h-48 relative overflow-hidden">', '<div class="h-48 overflow-hidden">')

# Instead of using before:absolute on the button, let's insert an absolute link at the top of the card
def inject_link(match):
    # This match is for the product card opening tag
    return match.group(0) + '\n                    <a href="{{ route(\'products.index\') }}" class="absolute inset-0 z-20"><span class="sr-only">View Product</span></a>'

content = re.sub(r'<div class="relative bg-white border border-slate-200 shadow-md rounded-3xl overflow-hidden group hover:border-\w+ transition-all duration-500">', inject_link, content)

# Remove the before:absolute from the button so it doesn't conflict, and just make it relative z-30
content = re.sub(r'class="before:absolute before:inset-0 before:z-10 inline-flex', r'class="relative z-30 inline-flex', content)

with open(f1, 'w', encoding='utf-8') as f:
    f.write(content)


# 2. Fix services/index.blade.php
f2 = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\services\index.blade.php'
with open(f2, 'r', encoding='utf-8') as f:
    content2 = f.read()

# Remove inner relative
content2 = content2.replace('<div class="h-56 relative overflow-hidden">', '<div class="h-56 overflow-hidden">')

# Inject absolute link
def inject_link_services(match):
    # Route changes per card so we must be careful. We can just use the link that is already in the card!
    # Instead, let's just make sure the image wrapper is no longer relative. 
    # With the image wrapper not being relative, the `before:inset-0` on the `<a>` tag will cover it!
    return match.group(0)

# The before:inset-0 approach works perfectly IF the intermediate elements aren't relative!
# I just removed `relative` from `h-56 relative overflow-hidden`.
with open(f2, 'w', encoding='utf-8') as f:
    f.write(content2)


# 3. Fix programs/index.blade.php
f3 = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\programs\index.blade.php'
with open(f3, 'r', encoding='utf-8') as f:
    content3 = f.read()

content3 = content3.replace('<div class="h-56 relative overflow-hidden">', '<div class="h-56 overflow-hidden">')

with open(f3, 'w', encoding='utf-8') as f:
    f.write(content3)

print("Product and Service cards fully fixed for clickability!")
