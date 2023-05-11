<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $allergies_list = json_encode($_POST['allergies']);
    $medications_list = json_encode($_POST['medications']);
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO demographics (firstname, lastname, heightft, heightin, weight, dobM, dobD, dobY, gender, phonenumber, addressSt, aptNum, state, city, zipCode, email, allergies, medications)
    VALUES (:firstname, :lastname, :heightft, :heightin, :weight, :dobM, :dobD, :dobY, :gender, :phonenumber, :addressSt, :aptNum, :state, :city, :zipCode, :email, :allergies, :medications)");

    // Bind the form values to the SQL statement
    $stmt->bindParam(':firstname', $_POST['firstname']);
    $stmt->bindParam(':lastname', $_POST['lastname']);
    $stmt->bindParam(':heightft', $_POST['heightft']);
    $stmt->bindParam(':heightin', $_POST['heightin']);
    $stmt->bindParam(':weight', $_POST['weight']);
    $stmt->bindParam(':dobM', $_POST['dobM']);
    $stmt->bindParam(':dobD', $_POST['dobD']);
    $stmt->bindParam(':dobY', $_POST['dobY']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':phonenumber', $_POST['phonenumber']);
    $stmt->bindParam(':addressSt', $_POST['addressSt']);
    $stmt->bindParam(':aptNum', $_POST['aptNum']);
    $stmt->bindParam(':state', $_POST['state']);
    $stmt->bindParam(':city', $_POST['city']);
    $stmt->bindParam(':zipCode', $_POST['zipCode']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':allergies', $allergies_list);
    $stmt->bindParam(':medications', $medications_list); // Add this line

    // Execute the SQL statement
    $stmt->execute();

    // Redirect to a success page or display a success message
    header("Location: login.html");
    exit();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the PDO connection
$conn = null;

?>