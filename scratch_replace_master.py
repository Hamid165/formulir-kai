import os
import re

files_to_update = [
    r"d:\MAGANG-KAI\formulir\resources\views\form-cctv\index.blade.php",
    r"d:\MAGANG-KAI\formulir\app\Http\Controllers\MasterCctvController.php"
]

for filepath in files_to_update:
    if os.path.exists(filepath):
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Replace occurrences of Master CCTV
        content = re.sub(r'Master CCTV', 'ID-CCTV', content, flags=re.IGNORECASE)
        
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Updated {os.path.basename(filepath)}")
