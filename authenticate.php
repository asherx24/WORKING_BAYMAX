<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$email = $_POST['email'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE email = ?"; // Assuming you have a 'users' table with an 'email' column
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION["email"] = $email;
    
    // Check if the email contains "baymax"
    if (strpos($email, "jane@baymax.com") !== false) {
        header("Location: DoctorPatientListView.php"); // Redirect to the doctor's initial view page
    } 

   else if (strpos($email, "bob@baymax.com") !== false) {
        header("Location: DoctorPatientListView2.php"); // Redirect to the doctor's initial view page
    } 

  else if (strpos($email, "baymax") !== false) {
        header("Location: DoctorPatientListView.html"); // Redirect to the doctor's initial view page
    } 

    else {
        header("Location: FINISHED_patientMedicalRecords.php"); // Redirect to the medical records page
    }
} else {
    echo "Email not found.";
}

$conn->close();
?>

