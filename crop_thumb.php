<?php
$srcPath = __DIR__ . '/public/images/quay-chup-flycam/yt_thumb_sd.jpg';
$dstPath = __DIR__ . '/public/images/quay-chup-flycam/video_flycam_thumb.jpg';

if (!file_exists($srcPath)) {
    die("Source file does not exist\n");
}

$src = imagecreatefromjpeg($srcPath);
$width = imagesx($src);
$height = imagesy($src);

// sddefault is 640x480 with 60px black bars top and bottom
$cropY = 60;
$cropHeight = 360;

$dst = imagecreatetruecolor(640, 360);
imagecopy($dst, $src, 0, 0, 0, $cropY, 640, $cropHeight);

imagejpeg($dst, $dstPath, 92);
imagedestroy($src);
imagedestroy($dst);

echo "Success: Created " . $dstPath . " (" . filesize($dstPath) . " bytes)\n";
