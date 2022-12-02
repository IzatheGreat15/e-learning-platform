<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: ../index.html");
      
    $course_name_query = "SELECT * FROM subject_group WHERE id = ".$_SESSION['sg_id'];

    $announcement_query = "SELECT * FROM subject_announcements WHERE announcer_id = ".$_SESSION['sg_id'];
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
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <title>E-Learning Management System</title>
</head>
<body>
    <div class="body-container flex-col">
        <!-- TOP NAVIGATION BAR -->
        <?php include "topnavbar.php" ?>

        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <?php include "navbar.php" ?>
            </div>

            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <?php foreach($db->query($course_name_query) as $course_name): ?>
                        <h1><?= $course_name["subject_group_name"] ?></h1>
                        <?php endforeach ?>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <?php if($_SESSION['role'] == "TEACHER")
                    echo'
                    <div class="column t-end">
                        <button class="blue" style="margin-top: 25px;">
                            <div class="flex">
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                <div>
                                    Add
                                </div>
                            </div>
                        </button>
                    </div>
                    ' ?>
                </div>

                <hr>

                <br>

                <!-- CONTENT -->
                <div class="flex mobile">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        <!-- ONE ANNOUNCEMENT -->
                        <?php foreach($db->query($announcement_query) as $announcement): ?>
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <?= $announcement["announcement_title"] ?>
                                </div>
                                <!-- FOR TEACHERS ONLY - DELETE BUTTON -->
                                <?php if($_SESSION['role'] === "TEACHER")
                                echo '
                                <div class="centered-align">
                                    <div class="btn">
                                        <img src="../images/x-white.png" class="small" alt="delete" style="width: 20px;">
                                    </div>
                                </div>
                                ' ?>
                            </div>

                            <div class="white p-5 text-justify content">
                                <!-- SHOW ENTIRE TEXT -->
                                <p><?= $announcement["announcement_body"] ?></p>
                                <p class="t-end bold">Posted on:</p>
                                <p class="t-end"><?= date("F d, Y h:mA", strtotime($announcement["created_on"])) ?></p>
                            </div>
                        </div>
                        <br>
                        <?php endforeach ?>

                    </div>
                </div>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "navbar.php" ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="navbar.js"></script>
</body>
</html>