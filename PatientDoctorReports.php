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
         'patientCalendar.php': 'calendar',
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
     document.getElementById("calendar").addEventListener("click", function() {
                window.location.href = "patientCalendar.php";
            });



        }












    </script>
</head>

	<title>PatientDoctorReports.php</title>

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
    .view-btn {
        padding: 1px 6px;
        background-color: #E62F31;
        color: #fff;
        font-size: 12px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
    }

  	</style>

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

$sql = "SELECT * FROM demographics WHERE email = '" . $_SESSION["email"] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}

// Fetch patient visit records
// Fetch visit records
$sql_visits = "SELECT * FROM patient_visits WHERE email = '" . $_SESSION["email"] . "'";
$result_visits = $conn->query($sql_visits);


$sql_visits = "SELECT *, html_content FROM patient_visits WHERE email = '" . $_SESSION["email"] . "'";


$conn->close();
?>

</head>
<body>

	<img src="baymaxLogoSmall.png" class="baymaxLogoSmall">

	<div class="top-text">
		
		<p style="color: white; font-size: 40px; margin-left: 20px;">

			<b><?php echo isset($row["firstname"]) ? $row["firstname"] : "N/A"; ?> <?php echo isset($row["lastname"]) ? $row["lastname"] : "N/A"; ?></b>


            <button id = "MedicalRecords">My Medical Records</button>
            <button id = "DoctorReports">Previous Doctor Reports</button>
            <button id = "calendar">My Calendar</button> 

		</p>

		        </p>

        <div class="my-box">

            <table>
                 
                
                <tr>
                    <th>Visit Date</th>
                    <th>Status</th>
                    <th>Doctor</th>
                    <th>Vitals</th>
                    
                </tr>

             <?php
            if ($result_visits->num_rows > 0) {
                while($row_visits = $result_visits->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_visits["visit_date"] . "</td>";
                    echo "<td>" . $row_visits["status"] . " <a class='view-btn' href='" . $row_visits["html_content"] . "'>View</a></td>";
                    echo "<td>" . $row_visits["doctor"] . "</td>";
                    echo "<td>" . $row_visits["vitals"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No visit records found.</td></tr>";
            }
            ?>

            </table>

        </div>

    </div>

</body>
</html>
