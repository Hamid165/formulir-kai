import re

with open('resources/views/form-cctv/index.blade.php', 'r') as f:
    content = f.read()

breadcrumb = '''<!-- Breadcrumb -->
<div class="mb-4">
    <a href="{{ route('formulir.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Katalog
    </a>
</div>'''

content = content.replace(breadcrumb, '')

old_wrapper_start = '<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col h-full min-h-[500px] mb-6">'
new_wrapper_start = '''<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 mb-6">
    <!-- Breadcrumb -->
    <div class="mb-8">
        <a href="{{ route('formulir.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Katalog
        </a>
    </div>

    <div class="flex flex-col h-full min-h-[500px] mb-8">'''

content = content.replace(old_wrapper_start, new_wrapper_start)

# The end of the first wrapper has </div>. We replace `<!-- Master Data Section -->` 
# with closing the inner flex-col, adding HR, then the Master Data section
content = content.replace('<!-- Master Data Section -->', '</div>\n\n    <hr class="border-gray-200 mb-8">\n\n    <!-- Master Data Section -->')

# Inner boxes: change bg-white to bg-slate-50 to have some separation
content = content.replace('<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col h-full">', '<div class="bg-slate-50 rounded-2xl border border-gray-200 p-6 flex flex-col h-full">')

content = content.replace('@endsection', '</div>\n@endsection')

with open('resources/views/form-cctv/index.blade.php', 'w') as f:
    f.write(content)
