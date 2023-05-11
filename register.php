<?php
// Set database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validate form data
if (empty($email) || empty($username) || empty($password)) {
    echo "Error: All fields are required";
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Invalid email format";
    exit;
}

// Insert form data into database
$sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Form data inserted successfully";

    // Redirect based on the 
    if (strpos($email, 'baymax') !== false) {
        header('Location: login.html');
    } else {
        header('Location: demographics1.html');
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
