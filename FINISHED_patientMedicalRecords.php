<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Records</title>
 <script>



function highlightActiveTab() {
    const currentPage = window.location.pathname.split('/').pop();
    const buttonIds = {
      'PatientDoctorReports.php': 'DoctorReports',
      'FINISHED_patientMedicalRecords.php': 'MedicalRecords',
       'patientCalendar.php': 'calendarBtn',
    };




    Object.keys(buttonIds).forEach((page) => {
      const buttonId = buttonIds[page];
      const button = document.getElementById(buttonId);
      if (currentPage === page) {
        button.style.fontWeight = 'bold';
    button.style.border = '3px solid black';
      } else {
        button.style.fontWeight = 'normal';
        button.style.border = 'none';
      }
    });
  }

</script>

<script>

window.onload = function() {


           highlightActiveTab(); 
      document.getElementById("DoctorReports").addEventListener("click", function() {
                window.location.href = "PatientDoctorReports.php";
            });
            document.getElementById("MedicalRecords").addEventListener("click", function() {
                window.location.href = "FINISHED_patientMedicalRecords.php";
            });
                document.getElementById("calendarBtn").addEventListener("click", function() {
        window.location.href = "patientCalendar.php";
      });
        }












    </script>




<script>
        // JavaScript function to trigger the print dialog
        function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            }
        }
    </script>
</head>







<body style="background-color: indianred;">

<style>
  		
	    .top-text {
	    	position: fixed;
	      	height: fit-content;
	      	width: fit-content;
	    }
	    table {
	    	width: 100%;
	    	height: 100%;
	    	border-collapse: collapse;
	    }
	    th, td {
	    	border: 2px solid black;
	    	text-align: left;
	    	padding: 8px;
	    }
	    td {
	    	vertical-align: top;
	    }
	    .my-box {
	      	margin-top: 0px;
	        position: fixed;
	        top: 50;
	        left: 5;

	        width: 99%;
	        height: 80%;
	        box-sizing: border-box;
	        padding: 20px;

	        background-color: #f2f2f2;
	        border: 1px solid #ccc;
	        border-color: black;
	    }
	    .baymaxLogoSmall {
	        position: absolute;
	        top: 0px;
	        right: 0px; 
	    }
	    button {
	    	height: 50px;
	    	width: 220px;
	    	margin-left: 110px;

	    }
   .view-btn, .print-btn {
    padding: 6px 12px; /* Updated padding values for both buttons */
    background-color: #E62F31;
    color: #fff;
    font-size: 14px; /* Decreased font size */
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-left: 5px;
    width: 80px; /* Decreased width for both buttons */
  }
  	</style>


<?php

session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php"); // Redirect to the login page if the user is not logged in
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

$sql = "SELECT * FROM demographics WHERE email = '" . $_SESSION["email"] . "'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}

$conn->close();
?>

<!-- Add your CSS and JavaScript code here -->

<body>

    <img src="baymaxLogoSmall.png" class="baymaxLogoSmall">

    <div class="top-text">

        <p style="color: white; font-size: 40px; margin-left: 20px;">

    <b><?php echo isset($row["firstname"]) ? $row["firstname"] : "N/A"; ?> <?php echo isset($row["lastname"]) ? $row["lastname"] : "N/A"; ?></b>


            
      <button id = "MedicalRecords">My Medical Records</button>
            <button id = "DoctorReports">Previous Doctor Reports</button>
    <button id="calendarBtn">My Calendar</button>

        </p>

        <div class="my-box"> 

            <table>

                <tr>
                    <th>Medical Report</th>
                    <th>Demographics</th>
                </tr>

                <tr>
                    <td>
                <div class="vertical-links">
<?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $reports_sql = "SELECT report_name, html_content FROM patient_visits WHERE email = '" . $_SESSION["email"] . "'";
    $reports_result = $conn->query($reports_sql);
    
    if ($reports_result === false) {
        echo "Error: " . $conn->error;
        exit;
    }

     if ($reports_result->num_rows > 0) {
                        while($report = $reports_result->fetch_assoc()) {
                          echo '<div style="display: inline-block; width: 100%;">'; // Add a container div with display: inline-block and width: 100%
                          echo '<a href="' . $report["html_content"] . '">' . $report["report_name"] . '</a>';
                          echo '<div style="float: right;">'; // Add a container div with float: right
                          echo '<a class="view-btn" href="' . $report["html_content"] . '">View</a>';
                          echo '<button class="print-btn" onclick="printPage(\'' . $report["html_content"] . '\')">Print</button>';
                          echo '</div>'; // Close the float: right container div
                          echo '</div>'; // Close the display: inline-block container div
                          echo '<br>';
                        }
                      } else {
                        echo "No medical reports available.";
                      }
                      $conn->close();
?>

</div>

            </td>




                <td>


<?php
    if (isset($row["dobM"]) && isset($row["dobD"]) && isset($row["dobY"])) {
        $dob = new DateTime($row["dobY"] . '-' . $row["dobM"] . '-' . $row["dobD"]);
        $now = new DateTime();
        $age = $now->diff($dob);
        $calculated_age = $age->y;
    } else {
        $calculated_age = "N/A";
    }
?>
Age: <?php echo $calculated_age; ?> <br>











    Gender: <?php echo isset($row["gender"]) ? $row["gender"] : "N/A"; ?> <br>
    D.O.B: <?php echo isset($row["dobM"]) && isset($row["dobD"]) && isset($row["dobY"]) ? $row["dobM"] . '/' . $row["dobD"] . '/' . $row["dobY"] : "N/A"; ?> <br>
    Height: <?php echo isset($row["heightft"]) && isset($row["heightin"]) ? $row["heightft"] . 'ft ' . $row["heightin"] . 'in' : "N/A"; ?> <br>
    Weight: <?php echo isset($row["weight"]) ? $row["weight"] : "N/A"; ?>lbs <br>
    Address: <?php echo isset($row["addressSt"]) ? $row["addressSt"] : "N/A"; ?><?php echo isset($row["aptNum"]) ? ', Apt ' . $row["aptNum"] : ''; ?><?php echo isset($row["city"]) && isset($row["state"]) && isset($row["zipCode"]) ? ', ' . $row["city"] . ', ' . $row["state"] . ' ' . $row["zipCode"] : ""; ?> <br>
    Phone Number: <?php echo isset($row["phonenumber"]) ? $row["phonenumber"] : "N/A"; ?> <br>
    Email: <?php echo isset($row["email"]) ? $row["email"] : "N/A"; ?> <br>

</td>
                </tr>

                <tr>
                    <th>Allergies</th>
                    <th>Medications</th>
                </tr>

                <tr>
                    <td>
<?php echo isset($row["allergies"]) && !empty($row["allergies"]) ? str_replace(',', '<br>', $row["allergies"]) : "No allergies listed"; ?>
                    </td>

                    <td>
<?php echo isset($row["medications"]) && !empty($row["medications"]) ? str_replace(',', '<br>', $row["medications"]) : "No medications listed"; ?>

                    </td>
                </tr>

            </table>

        </div>

    </div>

</body>
</html>
