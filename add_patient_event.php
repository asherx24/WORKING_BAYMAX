<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get event data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];
$start = $data['start'];
$end = $data['end'];
$description = $data['description'];

// Insert event into the database
$sql = "INSERT INTO events (title, start, end, description) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $title, $start, $end, $description);
$stmt->execute();

// Close the database connection
$stmt->close();
$conn->close();
?>
