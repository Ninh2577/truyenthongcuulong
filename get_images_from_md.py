import re

files = [
    (r"C:\Users\hoang\.gemini\antigravity-ide\brain\299149d8-5542-4fa4-92d0-1ed7744cf26f\.system_generated\steps\1583\content.md", "cuulongcamping.vn"),
    (r"C:\Users\hoang\.gemini\antigravity-ide\brain\299149d8-5542-4fa4-92d0-1ed7744cf26f\.system_generated\steps\1584\content.md", "cungchoi.com")
]

for path, site in files:
    try:
        with open(path, "r", encoding="utf-8") as f:
            content = f.read()
            imgs = re.findall(r'src=[\'"]([^\'"]+\.jpg)[\'"]', content, re.I)
            print(f"{site}: {imgs[:3]}")
    except Exception as e:
        print(f"Error reading {site}: {e}")
