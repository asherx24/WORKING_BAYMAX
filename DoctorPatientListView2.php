<!DOCTYPE html>
<html>
<head>
<title>Doctor Initial View</title>
<script>
     function highlightActiveTab() {
    const currentPage = window.location.pathname.split('/').pop();
    const buttonIds = {
      'exampleInitialDoctorViewcal.html': 'Appointments',
      'doctorpatientreport.html': 'Reports',
      'DoctorPatientListView2.php': 'patientList',
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



   window.onload = function() {
    highlightActiveTab(); 
   
            document.getElementById('patientList').addEventListener('click', function() {
                window.location.href = 'DoctorPatientListView2.php';
            });

            document.getElementById('Reports').addEventListener('click', function() {
                window.location.href = 'doctorpatientreport.html';
            });

            document.getElementById('Appointments').addEventListener('click', function() {
                // Add the respective link for View Appointments
                window.location.href = 'exampleInitialDoctorViewcal.html';
            });
        }
    </script>




</head>
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
    }
    .view-button {
        height: 30px;
        width: 60px;
    }
    #button-container {
        display: flex;
        justify-content: space-around;
        position: absolute;
        top: 30px;
        width: 100%;
    }
</style>
<body style="background-color: indianred;">

<div id = "Doctor">
    <p style="color: white; font-size: 30px;"><b>DR. Max</b></p>

    <div id="button-container">
        <button id="patientList">Patient List</button>
         <a href="doctorpatientreport.html"><button id="Reports">Reports</button></a>
        <button id="Appointments">View Appointments</button>
    </div>
</div>






<?php
// Replace the following lines with your own database connection details
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

// Fetch data from the patient_records table
$sql = "SELECT Patient_Name, provider, last_visit, vitals FROM drpatient_records";
$result = $conn->query($sql);
?>





















<div class="my-box">
    <table>
            <tr>
            <th>Patient Name</th>
            <th>View Patient</th>
            <th>Provider</th>
            <th>Last Visit</th>
            <th>Vitals</th>
        </tr>


<?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Patient_Name"] . "</td>";
                echo "<td><button class='view-button'>View</button></td>";
                echo "<td>" . $row["provider"] . "</td>";
                echo "<td>" . $row["last_visit"] . "</td>";
                echo "<td>" . $row["vitals"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>









        </table>
</div>

<?php
$conn->close();
?>

</body>
</html>