<?php
require 'vendor/autoload.php';
$html = '<p>[CTA] <a>hi</a></p>';
$dom = new DOMDocument();
$dom->loadHTML('<meta charset="utf-8"><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
$xpath = new DOMXPath($dom);
echo "1: " . $xpath->query('//div/p')->length . "\n";
echo "2: " . $xpath->query('/div/p')->length . "\n";
echo "3: " . $xpath->query('//p')->length . "\n";
echo $dom->saveHTML();
