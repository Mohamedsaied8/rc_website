import os

file_path = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\services\automotive.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

replacements = {
    'bg-[#0A0A0A]': 'bg-white',
    'from-[#0A0A0A]': 'from-slate-50',
    'to-[#0A0A0A]': 'to-slate-50',
    'bg-[#0A192F]/90': 'bg-white/90',
    
    # SVG Diagram colors
    'fill="#1e1b4b"': 'fill="#f3e8ff"',
    'fill="#f3e8ff"': 'fill="#4c1d95"',
    'fill="#c084fc"': 'fill="#7e22ce"',
    'fill="#94a3b8"': 'fill="#475569"',
    'fill="#0f172a"': 'fill="#f8fafc"',
    'fill="#f8fafc"': 'fill="#0f172a"',
    'fill="#020617"': 'fill="#f1f5f9"',
    
    # Buttons
    'text-slate-900 font-bold hover:scale-105 transition-transform duration-300 shadow-[0_0_20px_rgba(168,85,247,0.3)]': 'text-white font-bold hover:scale-105 transition-transform duration-300 shadow-lg shadow-purple-500/30',
    
    # Other hardcoded styles
    'background-color: #0A0A0A;': 'background-color: #ffffff;',
    'border-white/[0.06]': 'border-slate-200',
    'bg-white/[0.02]': 'bg-white',
}

for old, new in replacements.items():
    content = content.replace(old, new)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print('Fixed remaining dark theme colors and SVG diagram!')
