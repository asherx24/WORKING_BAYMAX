<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events WHERE title = 'Bob' OR title = 'John'";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start'],
            'end' => $row['end'],
            'description' => $row['description'],
        );
    }
} else {
    echo "0 results";
}

header('Content-Type: application/json');
echo json_encode($events);

$conn->close();
?>
