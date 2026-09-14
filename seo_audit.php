<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use App\Models\Redirect;
use Illuminate\Support\Facades\Route;

$xmlFile = __DIR__ . '/truynthngculongculongmedia.WordPress.2026-09-12.xml';
if (!file_exists($xmlFile)) {
    die("Error: WordPress XML file not found at $xmlFile\n");
}

$reader = new XMLReader();
$reader->open($xmlFile);

$wpData = [];
$siteUrl = '';
$stats = [
    'records' => 0,
    'post_types' => [],
    'post_statuses' => [],
];

while ($reader->read()) {
    if ($reader->nodeType == XMLReader::ELEMENT) {
        if ($reader->name === 'wp:base_site_url' && empty($siteUrl)) {
            $siteUrl = rtrim($reader->readString(), '/');
        }
        
        if ($reader->name === 'item') {
            $stats['records']++;
            $node = new SimpleXMLElement($reader->readOuterXml());
            $namespaces = $node->getNamespaces(true);
            $wp = $node->children($namespaces['wp']);
            
            $postType = (string)$wp->post_type;
            $status = (string)$wp->status;
            
            $stats['post_types'][$postType] = ($stats['post_types'][$postType] ?? 0) + 1;
            $stats['post_statuses'][$status] = ($stats['post_statuses'][$status] ?? 0) + 1;
            
            $oldUrl = (string)$node->link;
            
            if (empty($oldUrl)) continue;

            $wpData[] = [
                'old_url' => $oldUrl,
                'post_type' => $postType,
                'status' => $status,
                'post_name' => (string)$wp->post_name,
                'title' => (string)$node->title,
                'id' => (string)$wp->post_id
            ];
        }
    }
}
$reader->close();

$laravelPosts = Post::all()->keyBy('slug')->toArray();
$laravelRedirects = class_exists(Redirect::class) ? Redirect::all()->toArray() : [];

$laravelRoutes = [];
foreach (Route::getRoutes() as $route) {
    if (in_array('GET', $route->methods())) {
        $laravelRoutes[] = '/' . ltrim($route->uri(), '/');
    }
}
$laravelRoutes = array_unique($laravelRoutes);

// Known page mappings
$pageMapping = [
    'truyen-thong-cuu-long-tuyen-dung' => '/tuyen-dung',
    'gioi-thieu-cong-ty-truyen-thong-cuu-long' => '/ve-chung-toi',
    'lien-he' => '/lien-he',
    'doi-tac' => '/doi-tac',
    'khach-hang' => '/khach-hang',
    'bang-gia' => '/bang-gia',
    'chinh-sach-bao-mat' => '/chinh-sach-bao-mat',
    'dieu-khoan-dich-vu' => '/dieu-khoan-dich-vu',
    'ho-so-nang-luc' => '/ho-so-nang-luc'
];

$csvData = [];
$csvHeader = [
    'old_url', 'normalized_old_url', 'content_type', 'wp_post_id', 'wp_status', 'wp_title',
    'new_url', 'destination_exists', 'mapping_status', 'confidence', 'reason',
    'collision_type', 'duplicate_type', 'duplicate_source', 'duplicate_destination', 
    'query_string_present', 'trailing_slash_difference', 'redirect_chain_risk', 'redirect_loop_risk'
];

$seenOldUrls = [];
$seenDestinations = [];

$auditStats = [
    'published_posts' => 0,
    'published_pages' => 0,
    'MAPPED' => 0,
    'NEEDS_REVIEW' => 0,
    'NO_DESTINATION' => 0,
    'URL_COLLISION' => 0,
    'NO_REDIRECT_REQUIRED' => 0,
    'INVALID' => 0,
    'DUPLICATE_SOURCE' => 0,
    'DUPLICATE_DESTINATION' => 0,
    'chains' => 0,
    'loops' => 0,
    'query_strings' => 0,
    'trailing_slash_diffs' => 0,
    'dup_seo' => 0,
    'dup_attachment' => 0,
    'dup_system' => 0
];

// Helper for existing redirects
function checkRedirectChain($oldUrl, $laravelRedirects) {
    $visited = [];
    $current = $oldUrl;
    while (true) {
        if (in_array($current, $visited)) return 'LOOP';
        $visited[] = $current;
        $found = null;
        foreach ($laravelRedirects as $r) {
            if ($r['old_url'] === $current || $r['old_url'] === $current . '/') {
                $found = $r['new_url'];
                break;
            }
        }
        if (!$found) break;
        $current = $found;
    }
    return count($visited) > 2 ? 'CHAIN' : 'NONE';
}

// First pass to find duplicates
foreach ($wpData as $item) {
    $parsed = parse_url($item['old_url']);
    $normalized = $parsed['path'] ?? '/';
    if (!isset($seenOldUrls[$normalized])) {
        $seenOldUrls[$normalized] = 1;
    } else {
        $seenOldUrls[$normalized]++;
    }
}

foreach ($wpData as $item) {
    $isPublished = $item['status'] === 'publish';
    if ($isPublished && $item['post_type'] === 'post') $auditStats['published_posts']++;
    if ($isPublished && $item['post_type'] === 'page') $auditStats['published_pages']++;

    $oldUrl = $item['old_url'];
    $parsed = parse_url($oldUrl);
    $normalized = $parsed['path'] ?? '/';
    $hasQuery = isset($parsed['query']);
    if ($hasQuery) $auditStats['query_strings']++;
    
    $isDupSource = $seenOldUrls[$normalized] > 1;
    
    $newUrl = '';
    $destExists = 'false';
    $mappingStatus = '';
    $confidence = '';
    $reason = '';
    $collisionType = 'NONE';
    $duplicateType = 'NONE';
    $isDupDest = 'false';
    $tsDiff = 'false';
    
    if ($isDupSource) {
        $auditStats['DUPLICATE_SOURCE']++;
        if ($item['post_type'] === 'post' || $item['post_type'] === 'page') {
            $duplicateType = 'SEO_CONTENT_DUPLICATE';
            $auditStats['dup_seo']++;
        } elseif ($item['post_type'] === 'attachment') {
            $duplicateType = 'ATTACHMENT_DUPLICATE';
            $auditStats['dup_attachment']++;
        } else {
            $duplicateType = 'WORDPRESS_SYSTEM_DUPLICATE';
            $auditStats['dup_system']++;
        }
    }

    if (!$isPublished) {
        $mappingStatus = 'NO_REDIRECT_REQUIRED';
        $reason = 'Not published (' . $item['status'] . ')';
        $confidence = 'HIGH';
    } 
    elseif (!in_array($item['post_type'], ['post', 'page'])) {
        $mappingStatus = 'NO_REDIRECT_REQUIRED';
        $reason = 'System/Attachment post type: ' . $item['post_type'];
        $confidence = 'HIGH';
    }
    elseif ($item['post_type'] === 'post') {
        $slug = $item['post_name'];
        if (isset($laravelPosts[$slug])) {
            $newUrl = '/bai-viet/' . $slug;
            $destExists = 'true';
            $mappingStatus = 'MAPPED';
            $confidence = 'HIGH';
            $reason = 'Exact slug match in DB';
        } else {
            $mappingStatus = 'NEEDS_REVIEW';
            $confidence = 'MEDIUM';
            $reason = 'Post slug not found in Laravel DB';
        }
    } 
    elseif ($item['post_type'] === 'page') {
        $slug = $item['post_name'];
        if (isset($pageMapping[$slug])) {
            $newUrl = $pageMapping[$slug];
            $routeExists = in_array($newUrl, $laravelRoutes);
            $destExists = $routeExists ? 'true' : 'false';
            $mappingStatus = $routeExists ? 'MAPPED' : 'NO_DESTINATION';
            $confidence = 'HIGH';
            $reason = 'Explicit page mapping';
        } else {
            $mappingStatus = 'NEEDS_REVIEW';
            $confidence = 'LOW';
            $reason = 'No known mapping for page slug';
        }
    }

    // Trailing slash difference check
    if ($newUrl !== '') {
        $oldTs = str_ends_with($normalized, '/');
        $newTs = str_ends_with($newUrl, '/');
        if ($oldTs !== $newTs) {
            $tsDiff = 'true';
            $auditStats['trailing_slash_diffs']++;
        }
        
        // Self redirect check
        if (trim($normalized, '/') === trim($newUrl, '/')) {
            $mappingStatus = 'INVALID';
            $reason = 'Self redirect';
            $collisionType = 'SAME_CANONICAL_DESTINATION';
        }
    }

    // True Route Collision Check (only if not mapped to itself)
    if ($mappingStatus === 'MAPPED' || $mappingStatus === 'NEEDS_REVIEW') {
        $normalizedNoTs = '/' . trim($normalized, '/');
        if (in_array($normalizedNoTs, $laravelRoutes) && $normalizedNoTs !== trim($newUrl, '/')) {
            $collisionType = 'TRUE_ROUTE_COLLISION';
            $mappingStatus = 'URL_COLLISION';
            $reason = "Old URL conflicts with existing Laravel route: $normalizedNoTs";
            $confidence = 'HIGH';
        }
    }
    
    // Existing DB redirect chains check
    $chainRisk = 'NONE';
    $loopRisk = 'NONE';
    if ($newUrl !== '') {
        $chainRes = checkRedirectChain($normalized, $laravelRedirects);
        if ($chainRes === 'LOOP') {
            $loopRisk = 'TRUE';
            $auditStats['loops']++;
        } elseif ($chainRes === 'CHAIN') {
            $chainRisk = 'TRUE';
            $auditStats['chains']++;
        }
    }

    // Count primary statuses
    $auditStats[$mappingStatus] = ($auditStats[$mappingStatus] ?? 0) + 1;
    if ($mappingStatus === 'URL_COLLISION') $auditStats['URL_COLLISION']++;

    if ($newUrl !== '' && $mappingStatus === 'MAPPED') {
        if (!isset($seenDestinations[$newUrl])) {
            $seenDestinations[$newUrl] = 1;
        } else {
            $seenDestinations[$newUrl]++;
            $isDupDest = 'true';
            $auditStats['DUPLICATE_DESTINATION']++;
        }
    }

    $csvData[] = [
        $oldUrl, $normalized, $item['post_type'], $item['id'], $item['status'], $item['title'],
        $newUrl, $destExists, $mappingStatus, $confidence, $reason,
        $collisionType, $duplicateType, ($isDupSource ? 'true' : 'false'), $isDupDest, 
        ($hasQuery ? 'true' : 'false'), $tsDiff, $chainRisk, $loopRisk
    ];
}

$fp = fopen(__DIR__ . '/wp-url-mapping.csv', 'w');
foreach ($csvData as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);

// Generate Markdown
$md = "# WP_URL_MIGRATION_AUDIT\n\n";
$md .= "## 1. Executive Summary\n";
$md .= "- Total XML records: {$stats['records']}\n";
$md .= "- Published posts: {$auditStats['published_posts']}\n";
$md .= "- Published pages: {$auditStats['published_pages']}\n";
$md .= "- Candidate MAPPED: {$auditStats['MAPPED']}\n";
$md .= "- NEEDS_REVIEW: {$auditStats['NEEDS_REVIEW']}\n";
$md .= "- NO_DESTINATION: {$auditStats['NO_DESTINATION']}\n";
$md .= "- URL_COLLISION: " . ($auditStats['URL_COLLISION'] / 2) . "\n"; // Quick fix for double count
$md .= "- NO_REDIRECT_REQUIRED: {$auditStats['NO_REDIRECT_REQUIRED']}\n";
$md .= "- INVALID (Self-redirect): {$auditStats['INVALID']}\n\n";

$md .= "## 2. Source XML Inventory\n";
foreach ($stats['post_types'] as $type => $count) $md .= "- $type: $count\n";
$md .= "\n";

$md .= "## 3. Published Posts (Summary)\n";
$md .= "Total published posts: {$auditStats['published_posts']}. Mapped successfully to existing DB routes where possible.\n\n";

$md .= "## 4. Published Pages\n";
$md .= "| Old URL | Title | Candidate Destination | Mapping Status | Reason |\n";
$md .= "|---------|-------|------------------------|----------------|--------|\n";
foreach ($csvData as $r) {
    if ($r === $csvHeader) continue;
    if ($r[2] === 'page' && $r[4] === 'publish') {
        $md .= "| {$r[0]} | {$r[5]} | {$r[6]} | {$r[8]} | {$r[10]} |\n";
    }
}
$md .= "\n";

$md .= "## 5. Post Mapping Summary\n";
$md .= "Most posts were automatically assigned `MAPPED` status if their exact slug exists in Laravel `posts` table.\n\n";

$md .= "## 6. Page Mapping Summary\n";
$md .= "Explicit pages were mapped manually. Unknown pages were assigned `NEEDS_REVIEW`.\n\n";

$md .= "## 7. URL Collision Report\n";
$md .= "| Old URL | Collision Type | Existing Route/Destination |\n";
$md .= "|---------|----------------|----------------------------|\n";
foreach ($csvData as $r) {
    if ($r === $csvHeader) continue;
    if ($r[11] === 'TRUE_ROUTE_COLLISION') {
        $md .= "| {$r[0]} | {$r[11]} | {$r[6]} |\n";
    }
}
$md .= "\n";

$md .= "## 8. Self Redirect / No Redirect Required\n";
$md .= "Total `INVALID` (Self Redirect): {$auditStats['INVALID']}.\n";
$md .= "Total `NO_REDIRECT_REQUIRED` (Attachments, Drafts, System): {$auditStats['NO_REDIRECT_REQUIRED']}.\n\n";

$md .= "## 9. Duplicate Classification\n";
$md .= "- SEO Content Duplicates: {$auditStats['dup_seo']}\n";
$md .= "- Attachment Duplicates: {$auditStats['dup_attachment']}\n";
$md .= "- System Duplicates: {$auditStats['dup_system']}\n\n";

$md .= "## 10. No Destination\n";
$md .= "Total missing destination explicitly mapped: {$auditStats['NO_DESTINATION']}.\n\n";

$md .= "## 11. Redirect Chain Analysis\n";
$md .= "Detected chains based on existing Laravel DB: {$auditStats['chains']}.\n\n";

$md .= "## 12. Redirect Loop Analysis\n";
$md .= "Detected loops based on existing Laravel DB: {$auditStats['loops']}.\n\n";

$md .= "## 13. Query String Analysis\n";
$md .= "URLs containing query strings: {$auditStats['query_strings']}.\n\n";

$md .= "## 14. Trailing Slash Analysis\n";
$md .= "Candidate mappings with trailing slash differences: {$auditStats['trailing_slash_diffs']}.\n\n";

$md .= "## 15. Manual Review Queue\n";
$md .= "### Pages Needing Review\n";
foreach ($csvData as $r) {
    if ($r === $csvHeader) continue;
    if ($r[2] === 'page' && $r[4] === 'publish' && $r[8] === 'NEEDS_REVIEW') {
        $md .= "- {$r[0]}\n";
    }
}
$md .= "### Slug Mismatch / Unknown Posts\n";
foreach ($csvData as $r) {
    if ($r === $csvHeader) continue;
    if ($r[2] === 'post' && $r[4] === 'publish' && $r[8] === 'NEEDS_REVIEW') {
        $md .= "- {$r[0]}\n";
    }
}
$md .= "\n";

$md .= "## 16. Import Readiness\n";
$md .= "**NOT READY**. Requires manual review of the queue above before production import.\n";

file_put_contents(__DIR__ . '/WP_URL_MIGRATION_AUDIT.md', $md);

echo "Audit 01.1 Complete.\n";
