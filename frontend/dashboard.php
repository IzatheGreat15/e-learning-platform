<?php
    include("../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: index.php");

    $curr_query = "SELECT id, max_score, assignment_title, close_datetime FROM assignments";
    $announcement_query = "SELECT * FROM subject_announcements";
    $future_query = "SELECT id, max_score, assignment_title, close_datetime FROM assignments";
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
    <!-- EXTERNAL CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
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
                <h1>Dashboard</h1>

                <a href="../backend/logout.php"><p id="current" class="">Logout</p></a>

                <div class="flex column-container">
                    <div class="column">
                        <h3>Today</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <?php foreach($db->query($curr_query) as $activity): ?>
                        <div class="curve-container blue flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p><?= $activity["max_score"] ?> pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p><?= $activity["assignment_title"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: <?= date("F d, Y - h:i A", strtotime($activity["close_datetime"])) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <div class="column">
                        <!-- ANNOUNCEMENTS - LIMIT TO 3 -->
                        <h3>Announcements</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <?php foreach($db->query($announcement_query) as $announcement): ?>
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p>100 pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p>Lab Activitiy 1.0 - Create a key</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: November 28, 2022 - 11:59 PM</p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>

                        <a href="#">
                            <p class="t-center">See more...</p>
                        </a>

                        <!-- UPCOMING ASSIGNMENTS - LIMIT TO 3 -->
                        <h3>Upcoming Assignments</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <?php foreach($db->query($future_query) as $activity): ?>
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p><?= $activity["max_score"] ?> pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p><?= $activity["assignment_title"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: <?= date("F d, Y - h:i A", strtotime($activity["close_datetime"])) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
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
</body>
</html>