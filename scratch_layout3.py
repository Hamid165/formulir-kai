import re

with open('resources/views/form-cctv/index.blade.php', 'r') as f:
    content = f.read()

# Remove the outer wrapper that I added: 
# <div class="bg-slate-50 rounded-3xl p-6 md:p-8 mb-6 border border-gray-200">
# ...
# </div> at the end.
# Then change the inner boxes back to their original state.

wrapper_start = '<div class="bg-slate-50 rounded-3xl p-6 md:p-8 mb-6 border border-gray-200">\n'
content = content.replace(wrapper_start, '')

# Change back the first box (Formulir CCTV)
# From:
#     <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col h-full min-h-[500px] mb-8">
# To:
#     <!-- Content Wrapper -->
# <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col h-full min-h-[500px] mb-6">
box1_old = '<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col h-full min-h-[500px] mb-8">'
box1_new = '<!-- Content Wrapper -->\n<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col h-full min-h-[500px] mb-6">'
content = content.replace(box1_old, box1_new)

# Remove the stray </div></div>
# Actually, the first box ends with </div>.
# Let's just do a clean replace using regex or string splits to remove the extra </div> that wrapped the whole thing.
content = content.replace('</div>\n\n</div>\n\n    \n\n    <!-- Master Data Section -->', '</div>\n\n<!-- Master Data Section -->')

content = content.replace('</div>\n@endsection', '@endsection')

# Now the Breadcrumb needs to be moved outside and the indent fixed.
# Currently:
#     <!-- Breadcrumb -->
#     <div class="mb-8">
#         <a href="{{ route('formulir.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
#             <svg ...>
#             Kembali ke Katalog
#         </a>
#     </div>
# Let's change it back to mb-4
breadcrumb_old = '''    <!-- Breadcrumb -->
    <div class="mb-8">
        <a href="{{ route('formulir.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Katalog
        </a>
    </div>'''

breadcrumb_new = '''<!-- Breadcrumb -->
<div class="mb-4">
    <a href="{{ route('formulir.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Katalog
    </a>
</div>'''
content = content.replace(breadcrumb_old, breadcrumb_new)


with open('resources/views/form-cctv/index.blade.php', 'w') as f:
    f.write(content)
