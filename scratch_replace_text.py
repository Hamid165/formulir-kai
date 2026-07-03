import os

files_to_update = [
    r"d:\MAGANG-KAI\formulir\routes\web.php",
    r"d:\MAGANG-KAI\formulir\resources\views\form-cctv\index.blade.php",
    r"d:\MAGANG-KAI\formulir\resources\views\form-cctv\edit.blade.php",
    r"d:\MAGANG-KAI\formulir\resources\views\form-cctv\form.blade.php",
    r"d:\MAGANG-KAI\formulir\resources\views\form-cctv\create.blade.php",
    r"d:\MAGANG-KAI\formulir\resources\views\form-cctv\create-v2.blade.php"
]

for filepath in files_to_update:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Replace normal case
    content = content.replace("Formulir CCTV", "Formulir Pemeliharaan CCTV")
    # Replace uppercase
    content = content.replace("FORMULIR CCTV", "FORMULIR PEMELIHARAAN CCTV")
    # Just in case, replace lowercase too (though none found)
    content = content.replace("formulir cctv", "formulir pemeliharaan cctv")
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print(f"Updated {os.path.basename(filepath)}")
