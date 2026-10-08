Add-Type -AssemblyName System.Drawing

$src = "c:\xampp\htdocs\truyenthongcuulong-laravel\public\images\blog\blog-hero-design.png"
$bmp = [System.Drawing.Bitmap]::FromFile($src)

# 1. Crop right showcase area
$rectShowcase = New-Object System.Drawing.Rectangle(510, 0, 514, 220)
$cropShowcase = $bmp.Clone($rectShowcase, $bmp.PixelFormat)
$cropShowcase.Save("c:\xampp\htdocs\truyenthongcuulong-laravel\public\images\blog\showcase_cluster.png", [System.Drawing.Imaging.ImageFormat]::Png)
$cropShowcase.Dispose()

# 2. Crop camera card (approx X=540, Y=50, W=110, H=110)
$rectCamera = New-Object System.Drawing.Rectangle(540, 50, 110, 110)
$cropCamera = $bmp.Clone($rectCamera, $bmp.PixelFormat)
$cropCamera.Save("c:\xampp\htdocs\truyenthongcuulong-laravel\public\images\blog\card_camera.png", [System.Drawing.Imaging.ImageFormat]::Png)
$cropCamera.Dispose()

# 3. Crop video edit card (approx X=640, Y=30, W=180, H=130)
$rectEdit = New-Object System.Drawing.Rectangle(640, 30, 180, 130)
$cropEdit = $bmp.Clone($rectEdit, $bmp.PixelFormat)
$cropEdit.Save("c:\xampp\htdocs\truyenthongcuulong-laravel\public\images\blog\card_video.png", [System.Drawing.Imaging.ImageFormat]::Png)
$cropEdit.Dispose()

# 4. Crop code card (approx X=810, Y=45, W=170, H=115)
$rectCode = New-Object System.Drawing.Rectangle(810, 45, 170, 115)
$cropCode = $bmp.Clone($rectCode, $bmp.PixelFormat)
$cropCode.Save("c:\xampp\htdocs\truyenthongcuulong-laravel\public\images\blog\card_code.png", [System.Drawing.Imaging.ImageFormat]::Png)
$cropCode.Dispose()

$bmp.Dispose()
Write-Output "Successfully cropped regions!"
