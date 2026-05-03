<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn->query("UPDATE students SET name='$name', email='$email' WHERE id=$id");

    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $row['name'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $row['email'] ?>"><br>
    <button type="submit">Update</button>
</form>