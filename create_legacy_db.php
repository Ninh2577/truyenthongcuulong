<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '123456');
$pdo->exec('CREATE DATABASE IF NOT EXISTS truyenthongcuulong_legacy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
echo "Database truyenthongcuulong_legacy created or already exists.\n";
