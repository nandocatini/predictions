<?php
require_once __DIR__ . '/config.php';

try {
    // Connect to MySQL without specifying a database
    $pdo = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);

    // Now connect to the specific database
    $pdo = db();

    // Create the tables
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($sql);
    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}