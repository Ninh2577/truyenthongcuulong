# Coordinates on 1024 x 341 image:
# Search Bar: X approx 737 to 975, Y approx 218 to 250
# Category 1 (All): X 60 to 200, Y 256 to 300
# Category 2 (Kinh Nghiem): X 215 to 376, Y 256 to 300
# Category 3 (Kien Thuc): X 392 to 530, Y 256 to 300
# Category 4 (Media): X 548 to 695, Y 256 to 300
# Category 5 (Marketing): X 710 to 850, Y 256 to 300
# Category 6 (Tin Tuc): X 865 to 975, Y 256 to 300

$w = 1024.0
$h = 341.0

Write-Output "Search Bar: left=$([math]::Round((737/$w)*100, 2))%, top=$([math]::Round((218/$h)*100, 2))%, width=$([math]::Round(((975-737)/$w)*100, 2))%, height=$([math]::Round(((250-218)/$h)*100, 2))%"
Write-Output "Cat 1: left=$([math]::Round((60/$w)*100, 2))%, top=$([math]::Round((256/$h)*100, 2))%, width=$([math]::Round(((200-60)/$w)*100, 2))%, height=$([math]::Round(((300-256)/$h)*100, 2))%"
Write-Output "Cat 2: left=$([math]::Round((215/$w)*100, 2))%, top=$([math]::Round((256/$h)*100, 2))%, width=$([math]::Round(((376-215)/$w)*100, 2))%, height=$([math]::Round(((300-256)/$h)*100, 2))%"
Write-Output "Cat 3: left=$([math]::Round((392/$w)*100, 2))%, top=$([math]::Round((256/$h)*100, 2))%, width=$([math]::Round(((530-392)/$w)*100, 2))%, height=$([math]::Round(((300-256)/$h)*100, 2))%"
Write-Output "Cat 4: left=$([math]::Round((548/$w)*100, 2))%, top=$([math]::Round((256/$h)*100, 2))%, width=$([math]::Round(((695-548)/$w)*100, 2))%, height=$([math]::Round(((300-256)/$h)*100, 2))%"
Write-Output "Cat 5: left=$([math]::Round((710/$w)*100, 2))%, top=$([math]::Round((256/$h)*100, 2))%, width=$([math]::Round(((850-710)/$w)*100, 2))%, height=$([math]::Round(((300-256)/$h)*100, 2))%"
Write-Output "Cat 6: left=$([math]::Round((865/$w)*100, 2))%, top=$([math]::Round((256/$h)*100, 2))%, width=$([math]::Round(((975-865)/$w)*100, 2))%, height=$([math]::Round(((300-256)/$h)*100, 2))%"
