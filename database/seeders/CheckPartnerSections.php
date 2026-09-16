<?php
$p = \App\Models\Partner::first();
echo 'display_sections: ';
var_dump($p->display_sections);
echo 'Section 1 count: ' . \App\Models\Partner::whereJsonContains('display_sections', 1)->count() . "\n";
echo 'Section 2 count: ' . \App\Models\Partner::whereJsonContains('display_sections', 2)->count() . "\n";
echo 'Section 3 count: ' . \App\Models\Partner::whereJsonContains('display_sections', 3)->count() . "\n";
echo "Done!\n";
