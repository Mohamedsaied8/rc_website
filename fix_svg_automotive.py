import os
import re

file_path = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\services\automotive.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# First, change all broken text which is currently #0f172a back to #f8fafc (only text elements)
content = content.replace('fill="#0f172a"\n                                        font-family="system-ui, sans-serif"', 'fill="#f8fafc"\n                                        font-family="system-ui, sans-serif"')

# Fix Central Compute text
content = re.sub(r'<text (.*?) fill=".*?" (.*?)>Central Compute</text>', r'<text \1 fill="#4c1d95" \2>Central Compute</text>', content)
content = re.sub(r'<text (.*?) fill=".*?" (.*?)>QNX RTOS / AGL</text>', r'<text \1 fill="#7e22ce" \2>QNX RTOS / AGL</text>', content)
content = re.sub(r'<text (.*?) fill=".*?" (.*?)>Adaptive AUTOSAR &amp; CUDA</text>', r'<text \1 fill="#475569" \2>Adaptive AUTOSAR &amp; CUDA</text>', content)

# Fix Zone texts
for zone in ['Front Left Zone', 'Front Right Zone', 'Rear Left Zone', 'Rear Right Zone']:
    content = re.sub(r'<text (.*?) fill=".*?" (.*?)>' + zone + '</text>', r'<text \1 fill="#0f172a" \2>' + zone + '</text>', content)
content = content.replace('fill="#0f172a"\n                                        font-family="monospace" font-size="9" text-anchor="middle">Classic AUTOSAR</text>', 'fill="#475569"\n                                        font-family="monospace" font-size="9" text-anchor="middle">Classic AUTOSAR</text>')
content = re.sub(r'<text (.*?) fill=".*?" (.*?)>Classic AUTOSAR</text>', r'<text \1 fill="#475569" \2>Classic AUTOSAR</text>', content)

# Fix the boxes (rects)
content = re.sub(r'<rect x="300" y="175" width="200" height="100" rx="12" fill=".*?"', r'<rect x="300" y="175" width="200" height="100" rx="12" fill="#f3e8ff"', content)
content = re.sub(r'<rect x="110" y="85" width="140" height="70" rx="8" fill=".*?"', r'<rect x="110" y="85" width="140" height="70" rx="8" fill="#f8fafc"', content)
content = re.sub(r'<rect x="110" y="295" width="140" height="70" rx="8" fill=".*?"', r'<rect x="110" y="295" width="140" height="70" rx="8" fill="#f8fafc"', content)
content = re.sub(r'<rect x="550" y="85" width="140" height="70" rx="8" fill=".*?"', r'<rect x="550" y="85" width="140" height="70" rx="8" fill="#f8fafc"', content)
content = re.sub(r'<rect x="550" y="295" width="140" height="70" rx="8" fill=".*?"', r'<rect x="550" y="295" width="140" height="70" rx="8" fill="#f8fafc"', content)

# Fix circles
content = re.sub(r'<circle cx="60" cy="120" r="20" fill=".*?"', r'<circle cx="60" cy="120" r="20" fill="#f1f5f9"', content)
content = re.sub(r'<circle cx="60" cy="330" r="20" fill=".*?"', r'<circle cx="60" cy="330" r="20" fill="#f1f5f9"', content)
content = re.sub(r'<circle cx="740" cy="120" r="20" fill=".*?"', r'<circle cx="740" cy="120" r="20" fill="#f1f5f9"', content)
content = re.sub(r'<circle cx="740" cy="330" r=\"20\" fill=".*?"', r'<circle cx="740" cy="330" r="20" fill="#f1f5f9"', content)

# Fix circle texts
for c_text in ['CAM', 'RADAR', 'HUD', 'ACT']:
    content = re.sub(r'<text (.*?) fill=".*?" (.*?)>' + c_text + '</text>', r'<text \1 fill="#7e22ce" \2>' + c_text + '</text>', content)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print('SVG diagram fixed!')
