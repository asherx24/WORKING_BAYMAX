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

$sql_visits = "SELECT * FROM patient_visits WHERE email = '" . $_SESSION["email"] . "'";
$result_visits = $conn->query($sql_visits);

$sql_visits = "SELECT *, html_content FROM patient_visits WHERE email = '" . $_SESSION["email"] . "'";

$conn->close();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>patient cal View</title>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
     <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'>

</script>

    <script>



function highlightActiveTab() {
    const currentPage = window.location.pathname.split('/').pop();
    const buttonIds = {
      'PatientDoctorReports.php': 'DoctorReports',
      'FINISHED_patientMedicalRecords.php': 'MedicalRecords',
         'patientcal.html': 'calendar',
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
                window.location.href = "patientcal.html";
            });



        }












    </script>







<script>

  document.addEventListener('DOMContentLoaded', function() {
    fetch('exampleGetEvents.php')
      .then(response => response.json())
      .then(events => {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          editable: true,
          selectable: true,
          select: function(selectionInfo) {
            var eventForm = document.getElementById('eventForm');
            document.getElementById('start').value = selectionInfo.startStr.substr(0, 16);
            document.getElementById('end').value = selectionInfo.endStr.substr(0, 16);
            eventForm.style.display = 'block';
          },
          events: events,
          eventClick: function(info) {
            if (info.event.title === "John Doe") {
    window.location.href = "johndoe.html";
  } else {
    window.location.href = "DoctorMedicalRecordView.html" + info.event.id;
  }
}




        });
        calendar.render();
      })
      .catch(error => {
        console.error('Error fetching events:', error);
      });

    document.getElementById('addEventForm').addEventListener('submit', function(event) {
      event.preventDefault();

      var eventData = {
        title: document.getElementById('title').value,
        start: document.getElementById('start').value,
        end: document.getElementById('end').value,
        description: document.getElementById('description').value,
      };

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'add_event.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          calendar.refetchEvents(); // Refresh the calendar
        }
      };
      xhr.send(JSON.stringify(eventData));

      // Reset the form
      document.getElementById('addEventForm').reset();
      document.getElementById('eventForm').style.display = 'none';
    });
  });
</script>



</head>
<style>
  .Top-Text {
    position: fixed;
    height: fit-content;
    width: fit-content;
  }

  .my-box {
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

  button {
    height: 50px;
    width: 220px;
  
  }
  .baymaxLogoSmall {
    position: absolute;
    top: 0px;
    right: 0px;
    height: 75px;
    width: 500;
  }

  #calendar {
    max-width: 100%;
    max-height: 100%;
  }

  #eventForm {
    display: none;
    position: fixed;
    z-index: 100;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border: 1px solid black;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
  <img src="baymaxCorner.png" class="baymaxLogoSmall">

 <div class="top-text">
        
        <p style="color: white; font-size: 40px; margin-left: 20px;">

            <b><?php echo isset($row["firstname"]) ? $row["firstname"] : "N/A"; ?> <?php echo isset($row["lastname"]) ? $row["lastname"] : "N/A"; ?></b>


    <div id="button-container">
        <button id = "MedicalRecords">My Medical Records</button>
            <button id = "DoctorReports">Previous Doctor Reports</button>
            <button id = "calendar">My Calendar</button> 
    </div>
    
    <div class="my-box">
        <div id = "calendar"></div>
              </div>

    <div id="eventForm">
      <form id="addEventForm">
        <label for="title">Patient Name:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="start">Start Time:</label>
        <input type="datetime-local" id="start" name="start" required><br>
        <label for="end">End Time:</label>
        <input type="datetime-local" id="end" name="end" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        <button type="submit">Add Event</button>
        <button type="button" onclick="document.getElementById('eventForm').style.display='none'">Close</button>
      </form>
    </div>
  </div>
    
</body>

</html>
