<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}



// Get raw data
$json = file_get_contents("php://input");

// Convert to object
$data = json_decode($json);

// DEBUG (optional)
if (!$data) {
    echo "No data received";
    exit();
}

$conn = new mysqli("localhost", "root", "", "result_db");

if ($conn->connect_error) {
    die("Connection failed");
}

// Get values safely
$name = $data->name ?? '';
$course = $data->course ?? '';
$total = $data->total ?? 0;
$status = $data->status ?? '';

// Insert query
$sql = "INSERT INTO results (name, course, total, status)
VALUES ('$name','$course',$total,'$status')";

if ($conn->query($sql)) {
    echo "Saved Successfully";
} else {
    echo "Error: " . $conn->error;
}
?>