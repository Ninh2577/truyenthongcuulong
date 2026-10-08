Add-Type -AssemblyName System.Drawing

$file = "C:\Users\hoang\.gemini\antigravity-ide\brain\39b3c873-a931-4a12-9f64-34121ac877f6\.user_uploaded\media_1791423488269.png"
$img = [System.Drawing.Image]::FromFile($file)
Write-Output "Size: $($img.Width) x $($img.Height)"
$img.Dispose()
