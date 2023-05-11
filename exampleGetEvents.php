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

// Retrieve events
$sql = "SELECT id, title, start, end, description FROM events";
$result = $conn->query($sql);

// Format events for FullCalendar
$events = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $event = array(
      'id' => $row['id'],
      'title' => $row['title'],
      'start' => $row['start'],
      'end' => $row['end'],
      'description' => $row['description']
    );
    array_push($events, $event);
  }
}

// Return events as JSON
header('Content-Type: application/json');
echo json_encode($events);

// Close the database connection
$conn->close();
?>
