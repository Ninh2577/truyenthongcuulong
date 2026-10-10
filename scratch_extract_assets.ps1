Add-Type -AssemblyName System.Drawing

$mockupPath = "C:\Users\hoang\.gemini\antigravity-ide\brain\4866d19a-3443-4b03-ad93-ce8e0b61de9f\.user_uploaded\media_1791540385161.png"
$img = [System.Drawing.Image]::FromFile($mockupPath)
$W = $img.Width
$H = $img.Height
$outDir = "C:\xampp\htdocs\truyenthongcuulong-laravel\public\images\profile"

function Crop-Image($x, $y, $w, $h, $destFile) {
    global $img
    $rect = New-Object System.Drawing.Rectangle([int]$x, [int]$y, [int]$w, [int]$h)
    $bmp = New-Object System.Drawing.Bitmap($rect.Width, $rect.Height)
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $g.DrawImage($img, (New-Object System.Drawing.Rectangle(0, 0, $rect.Width, $rect.Height)), $rect, [System.Drawing.GraphicsUnit]::Pixel)
    $bmp.Save($destFile, [System.Drawing.Imaging.ImageFormat]::Png)
    $g.Dispose()
    $bmp.Dispose()
    Write-Output "Extracted: $destFile"
}

# 1. Hero Banner Background (top without navbar)
# Navbar ends around y=42, hero continues down to y=190
Crop-Image 0 ($H * 0.04) $W ($H * 0.14) "$outDir\hero_banner.png"

# 2. Text decor slogan "Sáng tạo Kết nối Lan tỏa"
# Roughly x: 74% to 96%, y: 9.5% to 15%
Crop-Image ($W * 0.74) ($H * 0.095) ($W * 0.22) ($H * 0.065) "$outDir\text_decor_slogan.png"

# 3. 5 Solutions Cards Images
# Solutions section is y: 36.8% to 41.5%
# Card width is around 17% each with gap
$cardTop = $H * 0.366
$cardH = $H * 0.051
$cards = @(
    @{ Name = "solution_film_production.png"; X = $W * 0.048; W = $W * 0.165 },
    @{ Name = "solution_webapp_design.png"; X = $W * 0.233; W = $W * 0.165 },
    @{ Name = "solution_digital_ads.png"; X = $W * 0.418; W = $W * 0.165 },
    @{ Name = "solution_3d_ai_motion.png"; X = $W * 0.603; W = $W * 0.165 },
    @{ Name = "solution_booking_media.png"; X = $W * 0.787; W = $W * 0.165 }
)
foreach ($c in $cards) {
    Crop-Image $c.X $cardTop $c.W $cardH "$outDir\$($c.Name)"
}

# 4. Strength & Stats Banner background
Crop-Image 0 ($H * 0.485) $W ($H * 0.088) "$outDir\stats_banner_bg.png"

# 5. 6 Projects Images
# Row 1: y: 59.8% to 64.6%
# Row 2: y: 67.2% to 72.0%
$pRow1Top = $H * 0.598
$pRow2Top = $H * 0.672
$pH = $H * 0.048
$pCols = @(
    @{ X = $W * 0.058; W = $W * 0.28 },
    @{ X = $W * 0.360; W = $W * 0.28 },
    @{ X = $W * 0.662; W = $W * 0.28 }
)

Crop-Image $pCols[0].X $pRow1Top $pCols[0].W $pH "$outDir\project_nong_nghiep.png"
Crop-Image $pCols[1].X $pRow1Top $pCols[1].W $pH "$outDir\project_can_duoc_can_gio.png"
Crop-Image $pCols[2].X $pRow1Top $pCols[2].W $pH "$outDir\project_du_lich_cuu_long.png"

Crop-Image $pCols[0].X $pRow2Top $pCols[0].W $pH "$outDir\project_unesco_di_san.png"
Crop-Image $pCols[1].X $pRow2Top $pCols[1].W $pH "$outDir\project_hoi_nghi_elearning.png"
Crop-Image $pCols[2].X $pRow2Top $pCols[2].W $pH "$outDir\project_teambuilding.png"

$img.Dispose()
Write-Output "All assets extracted successfully."
