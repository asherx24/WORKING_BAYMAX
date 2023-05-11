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

// Process the submitted form data
$allergies_list = isset($_POST['allergies']) ? implode(",", $_POST['allergies']) : "";


  $stmt = $conn->prepare("INSERT INTO demographics ( phonenumber, addressSt, aptNum, state, city, zipCode, email, allergies, )
    VALUES ( :phonenumber, :addressSt, :aptNum, :state, :city, :zipCode, :email, :allergies)");


    $stmt->bindParam(':phonenumber', $_POST['phonenumber']);
    $stmt->bindParam(':addressSt', $_POST['addressSt']);
    $stmt->bindParam(':aptNum', $_POST['aptNum']);
    $stmt->bindParam(':state', $_POST['state']);
    $stmt->bindParam(':city', $_POST['city']);
    $stmt->bindParam(':zipCode', $_POST['zipCode']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':allergies', $allergies_list);
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
