<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "student_db";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // optional for testing
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
?>