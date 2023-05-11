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

if ($_FILES) {
  // Get the file's content
  $pdf_file = file_get_contents($_FILES['pdf_file']['tmp_name']);
  $file_name = $_FILES['pdf_file']['name'];

  // Escape the binary data
  $pdf_file = mysqli_real_escape_string($conn, $pdf_file);

  // Insert the data into the table
  $sql = "INSERT INTO demographics (file_name, pdf_data) VALUES ('$file_name', '$pdf_file')";

  if ($conn->query($sql) === TRUE) {
    echo "The PDF file was uploaded and saved successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload PDF</title>
</head>
<body>
  <h1>Upload a PDF file</h1>
  <form action="upload_pdf.php" method="post" enctype="multipart/form-data">
    Select PDF file to upload:
    <input type="file" name="pdf_file" accept="application/pdf">
    <input type="submit" value="Upload">
  </form>
</body>
</html>
