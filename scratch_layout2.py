import re

with open('resources/views/form-cctv/index.blade.php', 'r') as f:
    content = f.read()

# I will first remove the big white wrapper I added and restore the 3 white boxes, then wrap them in one big white box.
# But it's easier to just modify the classes since the structure is almost there.

# 1. Modify the first inner section (Formulir CCTV) to have its own box styling.
# Currently it is: <div class="flex flex-col h-full min-h-[500px] mb-8">
# Let's change it to: <div class="bg-slate-50 rounded-2xl border border-gray-200 p-6 md:p-8 flex flex-col h-full min-h-[500px] mb-8">
content = content.replace('<div class="flex flex-col h-full min-h-[500px] mb-8">', '<div class="bg-slate-50 rounded-2xl border border-gray-200 p-6 md:p-8 flex flex-col h-full min-h-[500px] mb-8">')

# 2. Remove the <hr> between Formulir CCTV and Master Data
content = content.replace('<hr class="border-gray-200 mb-8">', '')

# 3. Outer wrapper: it is currently <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 mb-6">
# Let's make it more distinct as the "kotak paling belakang": 
content = content.replace('<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 mb-6">', '<div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6 md:p-8 mb-6">')

# Wait, another option: The outer box is bg-slate-50, inner boxes are bg-white!
# Let's try that, it usually looks better (like a nested canvas).
content = content.replace('<div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6 md:p-8 mb-6">', '<div class="bg-slate-50 rounded-3xl p-6 md:p-8 mb-6 border border-gray-200">')
content = content.replace('<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 mb-6">', '<div class="bg-slate-50/50 rounded-3xl p-6 md:p-8 mb-6 border border-gray-200">')

# Change the 3 inner boxes to pure white with shadow
content = content.replace('<div class="bg-slate-50 rounded-2xl border border-gray-200 p-6 md:p-8 flex flex-col h-full min-h-[500px] mb-8">', '<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col h-full min-h-[500px] mb-8">')
content = content.replace('<div class="bg-slate-50 rounded-2xl border border-gray-200 p-6 flex flex-col h-full">', '<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col h-full">')


with open('resources/views/form-cctv/index.blade.php', 'w') as f:
    f.write(content)
