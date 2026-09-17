<?php
$lines = file('C:/Users/hoang/.gemini/antigravity-ide/brain/299149d8-5542-4fa4-92d0-1ed7744cf26f/.system_generated/logs/transcript.jsonl');
foreach ($lines as $line) {
    if (strpos($line, 'bg-gradient-cta') !== false) {
        $json = json_decode($line, true);
        if (isset($json['content'])) {
            echo substr($json['content'], 0, 1000) . "\n---\n";
        } else {
            echo substr($line, 0, 1000) . "\n---\n";
        }
    }
}
