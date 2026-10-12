Add-Type -AssemblyName System.Drawing
$img = [System.Drawing.Image]::FromFile('c:\xampp\htdocs\truyenthongcuulong-laravel\public\images\webapp\webapp_hero_showcase.png')
Write-Host "Width: $($img.Width), Height: $($img.Height)"
$img.Dispose()
