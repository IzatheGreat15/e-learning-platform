<?php
    include("../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: index.php");

    $query = match($_SESSION['role']){
        'STUDENT' => "SELECT id FROM enrollments WHERE student_id = ".$_SESSION['user_id'],
        'TEACHER' => "SELECT id FROM subject_group WHERE teacher_id = ".$_SESSION['user_id']
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- FULLCALENDAR.IO -->
    <script src="../node_modules/fullcalendar/main.js"></script>
    <!-- EXTERNAL CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="../node_modules/fullcalendar/main.css">

    <link rel="stylesheet" type="text/css" href="../css/modal.css">
    <title>E-Learning Management System</title>
    <style>
        .past div.fc-time, .past div.fc-title {
            text-decoration: line-through;
        }
    </style>
    <script>
        // CALENDAR SCRIPT
        document.addEventListener('DOMContentLoaded', function() {
            var result = [];
            var event = [];
            var url = ("<?= $_SESSION["role"] ?>" === "STUDENT") ? "student" : "teacher";

            // fetch data from database
            $.ajax({
                type: "GET",
                url: "../backend/"+ url +"/fill_calendar.php",
                success: function (res) {
                    console.clear();
                    result = JSON.parse(res);

                    // push data to events array
                    Object.keys(result).map(x => {
                        var r = result[x];
                        event.push({
                            id: r.id,
                            title: r.activity_name,
                            start: r.activity_open,
                            end: r.activity_due,
                            color: (r.activity_type == "quiz") ? '#BA94D1' : '#BCE29E',
                            url: 'courses/'+ r.activity_type +'.php?id='+ r.id,
                        });
                    });

                    var calendarEl = document.getElementById('layout');
                    
                    // render calendar
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            start: 'prev,next,today',
                            end: 'dayGridMonth,timeGridWeek,timeGridDay',
                            center: 'title',
                        },
                        events: event,
                        eventClassNames: function(arg) {
                            return 'blue';
                        },
                        initialView: 'dayGridMonth',
                    });
                    
                    calendar.render();
                }
            });
        });
    </script>
</head>

<body>
    <div class="body-container flex-col">
        <!-- TOP NAVIGATION BAR -->
        <?php include "pages/topnavbar.php" ?>

        <p id="current" class="hidden">document</p>

        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <?php include "pages/navbar.php" ?>
            </div>

            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>Calendar</h1>
                    </div>
                </div>

                <hr>
                <br>

                <!-- CONTENT OF PAGE -->
                <div class="full-width flex-col">
                <?php if($db->query($query)->num_rows > 0): ?>

                    <!-- CALENDAR -->
                    <div id="layout"></div>

                    <br>
                    <br>
                <?php else: ?>
                    <h3 class="centered-align"><?= $_SESSION['role'] == "STUDENT" ? "Not Enrolled Yet" : "Not Assigned To A Subject Yet" ?></h3>
                <?php endif ?>
                </div>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "pages/navbar.php" ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/navbar.js"></script>
    <script>
    </script>
<?php include_once 'css/unverified.php' ?>
</body>

</html>