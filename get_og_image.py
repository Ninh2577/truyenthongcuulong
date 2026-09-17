import urllib.request
import re

urls = [
    "https://tieudaotu.com/",
    "https://cuulongcamping.vn/",
    "https://cungchoi.com/",
    "https://tuilanguoimientay.vn/"
]

for u in urls:
    try:
        req = urllib.request.Request(u, headers={"User-Agent": "Mozilla/5.0"})
        html = urllib.request.urlopen(req).read().decode("utf-8", errors="ignore")
        
        og_image = re.search(r'property=[\'"]og:image[\'"]\s+content=[\'"]([^\'"]+)[\'"]', html, re.I)
        if not og_image:
            og_image = re.search(r'name=[\'"]og:image[\'"]\s+content=[\'"]([^\'"]+)[\'"]', html, re.I)
            
        if og_image:
            print(f"{u} -> og:image: {og_image.group(1)}")
            continue
            
        # Try to find a logo
        logo = re.search(r'<img[^>]+src=[\'"]([^\'"]+logo[^\'"]*\.(?:png|jpg|webp|jpeg))[\'"]', html, re.I)
        if logo:
            print(f"{u} -> logo: {logo.group(1)}")
            continue
            
        # Try first big image
        img = re.search(r'<img[^>]+src=[\'"]([^\'"]+\.(?:png|jpg|webp|jpeg))[\'"]', html, re.I)
        if img:
            print(f"{u} -> img: {img.group(1)}")
            continue
            
        print(f"{u} -> No image found")
    except Exception as e:
        print(f"{u} -> {e}")
