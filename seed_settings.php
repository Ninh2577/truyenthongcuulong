<?php
use App\Models\Setting;
$keys = [
    'company_phone' => '0939363262',
    'phone' => '0939363262',
    'company_email' => 'info@truyenthongcuulong.com',
    'email' => 'info@truyenthongcuulong.com'
];
foreach($keys as $k => $v) {
    Setting::updateOrCreate(['key' => $k], ['value' => $v, 'group' => 'general']);
}
echo "Seeded!";
