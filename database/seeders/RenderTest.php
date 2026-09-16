<?php
$topPartners = \App\Models\Partner::whereJsonContains('display_sections', 1)->orderBy('order')->get();
$goldPartners = \App\Models\Partner::whereJsonContains('display_sections', 2)->orderBy('order')->get();
$strategicPartners = \App\Models\Partner::whereJsonContains('display_sections', 3)->orderBy('order')->get();
$partnerIcons = [
    'lang-sen' => 'eco',
    'nam-tay-nguyen' => 'forest',
    'long-trekking' => 'hiking',
    'mtc-travel' => 'flight_takeoff',
    'gonatour' => 'flight_takeoff',
    'apollo-travel-events' => 'campaign',
    'hoang-anh-event' => 'campaign',
];
$html = view('pages.partners', compact('topPartners', 'goldPartners', 'strategicPartners', 'partnerIcons'))->render();
file_put_contents('rendered_test.html', $html);
echo "Rendered successfully.\n";
