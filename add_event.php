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

// Get the event data from the request
$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];
$start = $data['start'];
$end = $data['end'];
$description = $data['description'];

// Insert the event into the database
$sql = "INSERT INTO events (title, start, end, description) VALUES ('$title', '$start', '$end', '$description')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
