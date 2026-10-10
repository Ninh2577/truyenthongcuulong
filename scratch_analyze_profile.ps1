Add-Type -AssemblyName System.Drawing
$filePath = "C:\Users\hoang\.gemini\antigravity-ide\brain\4866d19a-3443-4b03-ad93-ce8e0b61de9f\.user_uploaded\media_1791540385161.png"
$img = [System.Drawing.Image]::FromFile($filePath)
Write-Output "Size: $($img.Width)x$($img.Height)"

# Crop vertical slices to inspect each section
$sections = @(
    @{ Name = "hero"; Top = 0; Height = [int]($img.Height * 0.18) },
    @{ Name = "about"; Top = [int]($img.Height * 0.18); Height = [int]($img.Height * 0.14) },
    @{ Name = "solutions"; Top = [int]($img.Height * 0.32); Height = [int]($img.Height * 0.16) },
    @{ Name = "strength_stats"; Top = [int]($img.Height * 0.48); Height = [int]($img.Height * 0.09) },
    @{ Name = "projects"; Top = [int]($img.Height * 0.57); Height = [int]($img.Height * 0.17) },
    @{ Name = "testimonials"; Top = [int]($img.Height * 0.74); Height = [int]($img.Height * 0.08) },
    @{ Name = "partners"; Top = [int]($img.Height * 0.82); Height = [int]($img.Height * 0.06) },
    @{ Name = "cta_footer"; Top = [int]($img.Height * 0.88); Height = [int]($img.Height * 0.12) }
)

$outDir = "C:\Users\hoang\.gemini\antigravity-ide\brain\4866d19a-3443-4b03-ad93-ce8e0b61de9f\scratch"
foreach ($s in $sections) {
    $rect = New-Object System.Drawing.Rectangle(0, $s.Top, $img.Width, $s.Height)
    $bmp = New-Object System.Drawing.Bitmap($rect.Width, $rect.Height)
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.DrawImage($img, (New-Object System.Drawing.Rectangle(0, 0, $rect.Width, $rect.Height)), $rect, [System.Drawing.GraphicsUnit]::Pixel)
    $bmp.Save("$outDir\profile_$($s.Name).png", [System.Drawing.Imaging.ImageFormat]::Png)
    $g.Dispose()
    $bmp.Dispose()
    Write-Output "Saved profile_$($s.Name).png"
}
$img.Dispose()
