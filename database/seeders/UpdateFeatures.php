<?php
use App\Models\Service;

$s = Service::where('slug', 'thiet-ke-website')->first(); 
if($s) {
    $s->features = ['WordPress & Laravel', 'Flutter Mobile Apps', 'Microservices Architecture']; 
    $s->save();
} 

$m = Service::where('slug', 'san-xuat-phim-doanh-nghiep')->first(); 
if($m) {
    $m->features = ['TVC Doanh Nghiệp 4K', '3D Motion & VFX', 'DaVinci HDR Grading']; 
    $m->save();
} 

$a = Service::where('slug', 'marketing-tong-the')->first(); 
if($a) {
    $a->features = ['Booking PR Báo Chí', 'Performance Ads Omnichannel', 'MarTech Automation']; 
    $a->save();
} 
echo "Updated features\n";
