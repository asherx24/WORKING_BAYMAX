<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['email'])) {
  $email = intval($_GET['email']);

  // Fetch the PDF data from the table
  $sql = "SELECT file_name, pdf_data FROM demographics WHERE email = $email";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $file_name = $row['file_name'];
