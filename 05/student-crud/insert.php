<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";

if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $conn->error;
}
?>