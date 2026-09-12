<?php
$file = __DIR__ . '/truynthngculongculongmedia.WordPress.2026-09-12.xml';

$reader = new XMLReader();
$reader->open($file);

$postTypes = [];
$urls = [];
$siteUrl = '';

while ($reader->read()) {
    if ($reader->nodeType == XMLReader::ELEMENT) {
        if ($reader->name === 'wp:base_site_url' && empty($siteUrl)) {
            $siteUrl = $reader->readString();
        }
        
        if ($reader->name === 'item') {
            $node = new SimpleXMLElement($reader->readOuterXml());
            $namespaces = $node->getNamespaces(true);
            $wp = $node->children($namespaces['wp']);
            
            $postType = (string)$wp->post_type;
            $status = (string)$wp->status;
            $link = (string)$node->link;
            
            if ($status === 'publish') {
                if (!isset($postTypes[$postType])) {
                    $postTypes[$postType] = 0;
                }
                $postTypes[$postType]++;
                
                if (count($urls) < 10 && $postType === 'post') {
                    $urls[] = $link;
                }
            }
        }
    }
}
$reader->close();

echo "Site URL: " . $siteUrl . "\n";
echo "Published Post Types Count:\n";
print_r($postTypes);
echo "\nSample Post URLs:\n";
print_r($urls);
