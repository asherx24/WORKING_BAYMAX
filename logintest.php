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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $inputUsername = $_POST["username"];
  $inputPassword = $_POST["password"];

  $sql = "SELECT id, password FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $inputUsername);
  $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $storedPassword);
    $stmt->fetch();

    if ($inputPassword === $storedPassword) {
      // Login successful
      if ($inputUsername === "john doe") {
        header("Location: FINISHED_patientMedicalRecords.php");
        exit();
      } else if ($inputUsername === "kathy mary") {
        header("Location: FINISHED_patientMedicalRecords_2.php");
        exit();
      } else if ($inputUsername === "Syed Hassan") {
        header("Location: FINISHED_patientMedicalRecords_3.php");
        exit();
      } else if ($inputUsername === "jane doe") {
       header("Location: DoctorInitialView.html");
        exit();
      } else {
        // Display an error message if the username is not recognized
        echo "Unknown user.";
      }
    } else {
      // Display an error message if the password is not valid
      echo "The password you entered was not valid.";
    }
  } else {
    // Display an error message if the username doesn't exist
    echo "No account found with that username.";
  }
  $stmt->close();
}
$conn->close();
?>
