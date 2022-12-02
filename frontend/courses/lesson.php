<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: ../index.html");

      $_SESSION['subject_id'] = 1;
    
    $lesson_name_query = "SELECT page_title FROM pages WHERE id = ".$_GET['id'];

    $course_name_query = "SELECT subject_group_name FROM subject_group WHERE id = ".$_SESSION['sg_id'];

    $lesson_file_query = "SELECT file_location FROM page_files WHERE page_id = ".$_GET['id'];
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
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 5px; margin-top: 2px;">
                                <div>
                                    Add
                                </div>
                            </div>
                        </button>
                    </div>
                    '?>
                </div>

                <hr>

                <br>

                <!-- CONTENT -->
                <div class="flex mobile">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col p-5">

                        <?php foreach($db->query($lesson_name_query) as $lesson_name): ?>
                            <h1><?= $lesson_name["page_title"] ?></h1>
                        <?php endforeach ?>

                        <!-- use loop for all the materials needed for the lesson -->
                        
                        <?php foreach($db->query($lesson_file_query) as $lesson_file): ?>
                            <a href="../files/<?= $lesson_file["file_location"] ?>"><?= $lesson_file["file_location"] ?> (Download)</a>
                            <iframe src="../files/<?= $lesson_file["file_location"] ?>" frameborder="0" width="100%" height="600px"></iframe>
                            <br><br>
                        <?php endforeach ?>
                    </div>
                </div>

                <br>
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