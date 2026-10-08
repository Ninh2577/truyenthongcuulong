<?php
$file = 'public/images/blog/blog-hero-design.png';
if (!file_exists($file)) {
    echo "File not found\n";
    exit;
}
$info = getimagesize($file);
echo "Width: {$info[0]}, Height: {$info[1]}, Mime: {$info['mime']}\n";
