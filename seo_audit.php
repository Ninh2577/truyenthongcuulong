<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
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

echo "Parsing XML...\n";
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
            $postName = (string)$wp->post_name;
            $title = (string)$node->title;
            
            if (empty($oldUrl)) continue;

            $wpData[] = [
                'old_url' => $oldUrl,
                'post_type' => $postType,
                'status' => $status,
                'post_name' => $postName,
                'title' => $title,
                'id' => (string)$wp->post_id
            ];
        }
    }
}
$reader->close();

echo "Fetching Laravel Data...\n";
$laravelPosts = Post::all()->keyBy('slug')->toArray();
$laravelRoutes = collect(Route::getRoutes()->getRoutesByName())
    ->map(fn($route) => '/' . ltrim($route->uri(), '/'))
    ->toArray();
// Add plain URIs as well
foreach (Route::getRoutes() as $route) {
    if (in_array('GET', $route->methods())) {
        $laravelRoutes[] = '/' . ltrim($route->uri(), '/');
    }
}
$laravelRoutes = array_unique($laravelRoutes);

echo "Analyzing and Mapping...\n";
$csvData = [];
$csvHeader = [
    'old_url', 'normalized_old_url', 'content_type', 'wp_post_id', 'wp_status', 'wp_title',
    'new_url', 'destination_exists', 'mapping_status', 'confidence', 'reason',
    'collision', 'duplicate_source', 'duplicate_destination', 'query_string_present'
];
$csvData[] = $csvHeader;

$seenOldUrls = [];
$seenDestinations = [];
$auditStats = [
    'published_posts' => 0,
    'published_pages' => 0,
    'MAPPED' => 0,
    'NEEDS_REVIEW' => 0,
    'NO_DESTINATION' => 0,
    'URL_COLLISION' => 0,
    'DUPLICATE_SOURCE' => 0,
    'DUPLICATE_DESTINATION' => 0,
    'INVALID' => 0,
    'NO_REDIRECT_REQUIRED' => 0,
];

// Page mapping candidates
$pageMapping = [
    'truyen-thong-cuu-long-tuyen-dung' => '/tuyen-dung',
    'gioi-thieu-cong-ty-truyen-thong-cuu-long' => '/ve-chung-toi',
    'lien-he' => '/lien-he',
    've-chung-toi' => '/ve-chung-toi',
    'doi-tac' => '/doi-tac',
    'khach-hang' => '/khach-hang',
    'bang-gia' => '/bang-gia',
    'chinh-sach-bao-mat' => '/chinh-sach-bao-mat',
    'dieu-khoan-dich-vu' => '/dieu-khoan-dich-vu',
    'ho-so-nang-luc' => '/ho-so-nang-luc'
];

foreach ($wpData as $item) {
    $isPublished = $item['status'] === 'publish';
    if ($isPublished && $item['post_type'] === 'post') $auditStats['published_posts']++;
    if ($isPublished && $item['post_type'] === 'page') $auditStats['published_pages']++;

    // Normalize Old URL
    $oldUrl = $item['old_url'];
    $parsed = parse_url($oldUrl);
    $normalized = ($parsed['path'] ?? '/');
    $hasQuery = isset($parsed['query']);
    
    // Check duplicates
    $isDupSource = isset($seenOldUrls[$normalized]);
    $seenOldUrls[$normalized] = true;
    if ($isDupSource) {
        $auditStats['DUPLICATE_SOURCE']++;
    }

    $newUrl = '';
    $destExists = 'false';
    $mappingStatus = '';
    $confidence = '';
    $reason = '';
    $collision = 'false';
    $isDupDest = 'false';

    // 1. Skip Draft/Trash/Private
    if (!$isPublished) {
        $mappingStatus = 'NO_REDIRECT_REQUIRED';
        $reason = 'Not published';
        $confidence = 'HIGH';
    } 
    // 2. Map Posts
    elseif ($item['post_type'] === 'post') {
        $slug = $item['post_name'];
        if (isset($laravelPosts[$slug])) {
            $newUrl = '/bai-viet/' . $slug;
            $destExists = 'true';
            $mappingStatus = 'MAPPED';
            $confidence = 'HIGH';
            $reason = 'Exact slug match in DB';
        } else {
            $newUrl = '';
            $mappingStatus = 'NO_DESTINATION';
            $confidence = 'HIGH';
            $reason = 'Post slug not found in Laravel DB';
        }
    } 
    // 3. Map Pages
    elseif ($item['post_type'] === 'page') {
        $slug = $item['post_name'];
        if (isset($pageMapping[$slug])) {
            $newUrl = $pageMapping[$slug];
            // Check if route actually exists
            $routeExists = false;
            foreach ($laravelRoutes as $r) {
                if (str_replace('/', '', $r) === str_replace('/', '', $newUrl)) {
                    $routeExists = true; break;
                }
            }
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
    // 4. Other CPTs
    else {
        $mappingStatus = 'NO_REDIRECT_REQUIRED';
        $reason = 'Irrelevant post type: ' . $item['post_type'];
        $confidence = 'HIGH';
    }

    // Collision Check
    // If the normalized old URL matches exactly an EXISTING Laravel route, it's a collision
    if ($mappingStatus === 'MAPPED' || $mappingStatus === 'NEEDS_REVIEW' || $mappingStatus === 'NO_DESTINATION') {
        foreach ($laravelRoutes as $r) {
            // Check if normalized old url matches laravel route (ignoring trailing slash differences)
            if (trim($normalized, '/') === trim($r, '/')) {
                $collision = 'true';
                $mappingStatus = 'URL_COLLISION';
                $reason = 'Old URL matches an existing Laravel system route: ' . $r;
                $auditStats['URL_COLLISION']++;
                break;
            }
        }
    }

    // Duplicate Destination Check
    if ($newUrl !== '' && $mappingStatus === 'MAPPED') {
        if (isset($seenDestinations[$newUrl])) {
            $isDupDest = 'true';
            $auditStats['DUPLICATE_DESTINATION']++;
        }
        $seenDestinations[$newUrl] = true;
    }

    // Self redirect check
    if (trim($normalized, '/') === trim($newUrl, '/')) {
        $mappingStatus = 'INVALID';
        $reason = 'Self redirect';
        $auditStats['INVALID']++;
    }

    // Count primary statuses
    if (!isset($auditStats[$mappingStatus])) {
        $auditStats[$mappingStatus] = 0;
    }
    $auditStats[$mappingStatus]++;

    $csvData[] = [
        $oldUrl, $normalized, $item['post_type'], $item['id'], $item['status'], $item['title'],
        $newUrl, $destExists, $mappingStatus, $confidence, $reason,
        $collision, ($isDupSource ? 'true' : 'false'), $isDupDest, ($hasQuery ? 'true' : 'false')
    ];
}

echo "Generating CSV...\n";
$fp = fopen(__DIR__ . '/wp-url-mapping.csv', 'w');
foreach ($csvData as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);

echo "Generating Markdown Report...\n";
$md = "# WP_URL_MIGRATION_AUDIT\n\n";
$md .= "## 1. Executive Summary\n";
$md .= "- WordPress records: " . $stats['records'] . "\n";
$md .= "- Published posts: " . $auditStats['published_posts'] . "\n";
$md .= "- Published pages: " . $auditStats['published_pages'] . "\n";
$md .= "- Candidate MAPPED: " . $auditStats['MAPPED'] . "\n";
$md .= "- NEEDS_REVIEW: " . $auditStats['NEEDS_REVIEW'] . "\n";
$md .= "- NO_DESTINATION: " . $auditStats['NO_DESTINATION'] . "\n";
$md .= "- URL_COLLISION: " . $auditStats['URL_COLLISION'] . "\n";
$md .= "- DUPLICATE_SOURCE: " . $auditStats['DUPLICATE_SOURCE'] . "\n";
$md .= "- DUPLICATE_DESTINATION: " . $auditStats['DUPLICATE_DESTINATION'] . "\n";
$md .= "- INVALID (Self-redirect): " . $auditStats['INVALID'] . "\n\n";

$md .= "## 2. WordPress Content Inventory\n";
$md .= "### Post Types\n";
foreach ($stats['post_types'] as $type => $count) {
    $md .= "- $type: $count\n";
}
$md .= "\n### Post Statuses\n";
foreach ($stats['post_statuses'] as $status => $count) {
    $md .= "- $status: $count\n";
}
$md .= "\n\n";

$md .= "## 3. Post Mapping\n";
$md .= "| Old URL | Title | WP Type | WP Status | New URL | Mapping Status | Confidence |\n";
$md .= "|---------|-------|----------|-----------|---------|----------------|------------|\n";
$postCount = 0;
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[2] === 'post' && $row[4] === 'publish') {
        $md .= "| {$row[0]} | {$row[5]} | {$row[2]} | {$row[4]} | {$row[6]} | {$row[8]} | {$row[9]} |\n";
        $postCount++;
        if ($postCount >= 20) {
            $md .= "| ... | ... | ... | ... | ... | ... | ... |\n";
            break;
        }
    }
}
$md .= "\n*(Showing first 20 post mappings. See CSV for full list.)*\n\n";

$md .= "## 4. Page Mapping\n";
$md .= "| Old URL | Title | New URL | Status | Confidence | Notes |\n";
$md .= "|---------|-------|----------|--------|------------|-------|\n";
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[2] === 'page' && $row[4] === 'publish') {
        $md .= "| {$row[0]} | {$row[5]} | {$row[6]} | {$row[8]} | {$row[9]} | {$row[10]} |\n";
    }
}
$md .= "\n\n";

$md .= "## 5. Collision Report\n";
$md .= "| Old URL | Candidate Destination | Reason |\n";
$md .= "|---------|------------------------|--------|\n";
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[11] === 'true') {
        $md .= "| {$row[0]} | {$row[6]} | {$row[10]} |\n";
    }
}
$md .= "\n\n";

$md .= "## 6. No Destination\n";
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[8] === 'NO_DESTINATION') {
        $md .= "- {$row[0]}\n";
    }
}
$md .= "\n\n";

$md .= "## 7. Duplicate Report\n";
$md .= "### Duplicate Sources\n";
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[12] === 'true') $md .= "- {$row[0]}\n";
}
$md .= "### Duplicate Destinations\n";
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[13] === 'true') $md .= "- Target: {$row[6]} (from {$row[0]})\n";
}
$md .= "\n\n";

$md .= "## 8. Redirect Chain / Loop Risk\n";
$md .= "Currently, no runtime redirect changes were made. Found " . $auditStats['INVALID'] . " self-redirect risks.\n\n";

$md .= "## 9. Query String / Trailing Slash Findings\n";
$qsCount = 0;
foreach ($csvData as $row) {
    if ($row === $csvHeader) continue;
    if ($row[14] === 'true') $qsCount++;
}
$md .= "- URLs with Query Strings: $qsCount\n";
$md .= "- WordPress URLs generally use trailing slashes. Laravel URLs in mapping do not. The redirect runtime will need to handle this discrepancy gracefully.\n\n";

$md .= "## 10. Recommended Redirect Import\n";
$md .= "Recommend importing the `MAPPED` records from `wp-url-mapping.csv` into the `redirects` table after manual review of `NEEDS_REVIEW` and `URL_COLLISION` records.\n";

file_put_contents(__DIR__ . '/WP_URL_MIGRATION_AUDIT.md', $md);

echo "Audit completed. Files generated.\n";
