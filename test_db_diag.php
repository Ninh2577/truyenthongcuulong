<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '123456');
    $dbs = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
    echo "3306 Databases:\n" . implode("\n", $dbs) . "\n\n";
} catch (Exception $e) {
    echo "3306 error: " . $e->getMessage() . "\n";
}

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307', 'root', '');
    $dbs = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
    echo "3307 Databases:\n" . implode("\n", $dbs) . "\n\n";
} catch (Exception $e) {
    echo "3307 error: " . $e->getMessage() . "\n";
}
