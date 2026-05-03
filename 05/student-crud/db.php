<?php
$conn = new mysqli("localhost", "root", "Kunal@1975", "student_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>