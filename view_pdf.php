<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = new mysqli($servername, $username, $password, $dbname);

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
        $pdf_data = $row['pdf_data'];

        // Send the PDF data to the browser
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file_name . '"');
        header('Content-Length: ' . strlen($pdf_data));
        echo $pdf_data;
    } else {
        echo "No PDF found with the provided ID.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
