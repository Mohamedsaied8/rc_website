import os
import re

# 1. services/index.blade.php
f1 = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\services\index.blade.php'
with open(f1, 'r', encoding='utf-8') as f:
    content = f.read()

content = content.replace('<div class="bg-white border border-slate-200 shadow-sm hover:border-', '<div class="relative bg-white border border-slate-200 shadow-sm hover:border-')
content = content.replace('p-8 pt-0 relative flex flex-col flex-grow', 'p-8 pt-0 flex flex-col flex-grow')
content = content.replace('class="inline-flex items-center gap-2 text-cyan-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-cyan-600')
content = content.replace('class="inline-flex items-center gap-2 text-blue-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-blue-600')
content = content.replace('class="inline-flex items-center gap-2 text-purple-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-purple-600')
content = content.replace('class="inline-flex items-center gap-2 text-emerald-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-emerald-600')

with open(f1, 'w', encoding='utf-8') as f:
    f.write(content)


# 2. programs/index.blade.php
f2 = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\programs\index.blade.php'
with open(f2, 'r', encoding='utf-8') as f:
    content = f.read()

content = content.replace('<div class="bg-white border border-slate-200 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl', '<div class="relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl')
content = content.replace('p-8 relative', 'p-8')
content = content.replace('class="inline-flex items-center gap-2 text-cyan-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-cyan-600')
content = content.replace('class="inline-flex items-center gap-2 text-emerald-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-emerald-600')
content = content.replace('class="inline-flex items-center gap-2 text-purple-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-purple-600')
content = content.replace('class="inline-flex items-center gap-2 text-blue-600', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-blue-600')
# Note: Ensure we didn't break things. The button has relative z-20.
content = content.replace('<button @click="openModal', '<button class="relative z-20" @click="openModal')

with open(f2, 'w', encoding='utf-8') as f:
    f.write(content)


# 3. home.blade.php
f3 = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\home.blade.php'
with open(f3, 'r', encoding='utf-8') as f:
    content = f.read()

# Services cards in home.blade.php
content = content.replace('<div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:border-', '<div class="relative bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:border-')
content = content.replace('class="text-sm font-bold text-cyan-600', 'class="before:absolute before:inset-0 before:z-10 text-sm font-bold text-cyan-600')
content = content.replace('class="text-sm font-bold text-blue-600', 'class="before:absolute before:inset-0 before:z-10 text-sm font-bold text-blue-600')
content = content.replace('class="text-sm font-bold text-emerald-600', 'class="before:absolute before:inset-0 before:z-10 text-sm font-bold text-emerald-600')
content = content.replace('class="text-sm font-bold text-purple-600', 'class="before:absolute before:inset-0 before:z-10 text-sm font-bold text-purple-600')

# Product cards in home.blade.php
content = content.replace('<div class="bg-white border border-slate-200 shadow-md rounded-3xl overflow-hidden group hover:border-', '<div class="relative bg-white border border-slate-200 shadow-md rounded-3xl overflow-hidden group hover:border-')
content = content.replace('<div class="p-8 relative z-20">', '<div class="p-8 z-20">')
content = content.replace('class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-cyan-50', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-cyan-50')
content = content.replace('class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-emerald-50', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-emerald-50')
content = content.replace('class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-purple-50', 'class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-purple-50')

with open(f3, 'w', encoding='utf-8') as f:
    f.write(content)

print("Card links updated!")
