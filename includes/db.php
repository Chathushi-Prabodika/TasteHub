<?php
$host = '127.0.0.1';
$port = '3306'; // Match your phpMyAdmin port
$dbname = 'tastehub_db';
$username = 'root';
$password = ''; // If you set a password during MySQL setup, put it here

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>