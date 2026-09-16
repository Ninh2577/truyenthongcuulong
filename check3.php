<?php
require 'vendor/autoload.php';
$html = '<p>[CTA] <a>hi</a></p>';
$dom = new DOMDocument();
$dom->loadHTML('<meta charset="utf-8"><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
$xpath = new DOMXPath($dom);
foreach($xpath->query('//p') as $p) { 
    var_dump($p->parentNode->nodeName, get_class($p->parentNode->parentNode)); 
}
