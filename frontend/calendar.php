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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <!-- EXTERNAL CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <title>E-Learning Management System</title>
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
                    <div id="calendar"></div>
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
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    start: 'prev,next today',
                    end: 'dayGridMonth, dayGridWeek, list',
                    center: 'title',
                },
                initialView: 'dayGridMonth'
            });
            
            calendar.render();
        });

        // hello, i honestly don't understand the reference
        // feel free to use this link
        // https://www.nicesnippets.com/blog/how-to-use-full-calendar-with-mysql-in-php

    </script>
</body>

</html>