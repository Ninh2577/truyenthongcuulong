<?php
// Xóa cache cũ
\Illuminate\Support\Facades\Cache::forget('partners.top');
\Illuminate\Support\Facades\Cache::forget('partners.gold');
\Illuminate\Support\Facades\Cache::forget('partners.strategic_filtered');
\Illuminate\Support\Facades\Cache::forget('partners.section1');
\Illuminate\Support\Facades\Cache::forget('partners.section2');
\Illuminate\Support\Facades\Cache::forget('partners.section3');

// Migrate: top -> section 1, gold -> section 2, strategic+show -> section 3
\DB::statement("UPDATE partners SET display_section = 1 WHERE tier = 'top'");
\DB::statement("UPDATE partners SET display_section = 2 WHERE tier = 'gold'");
\DB::statement("UPDATE partners SET display_section = 3 WHERE tier = 'strategic' AND show_on_partner_page = 1");

$counts = \DB::select('SELECT display_section, count(*) as cnt FROM partners GROUP BY display_section ORDER BY display_section');
foreach ($counts as $row) {
    $section = $row->display_section ?? 'NULL';
    echo "Section {$section}: {$row->cnt} partners\n";
}
echo "Done!\n";
