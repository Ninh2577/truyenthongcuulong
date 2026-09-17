import urllib.request
import ssl

ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

req1 = urllib.request.Request("https://cuulongcamping.vn/wp-content/uploads/2026/01/2952ca4a-aa3e-4546-9c57-52f789045c04.jpg", headers={'User-Agent': 'Mozilla/5.0'})
with urllib.request.urlopen(req1, context=ctx) as response, open('public/images/team-building-cover.jpg', 'wb') as out_file:
    out_file.write(response.read())

req2 = urllib.request.Request("https://img.youtube.com/vi/pwPRwTicUhI/maxresdefault.jpg", headers={'User-Agent': 'Mozilla/5.0'})
with urllib.request.urlopen(req2, context=ctx) as response, open('public/images/mega-livestream-cover.jpg', 'wb') as out_file:
    out_file.write(response.read())

print("Images downloaded successfully.")
