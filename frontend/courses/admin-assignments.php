<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");

    if($_SESSION["role"] != "TEACHER")
      header("location: assignments.php");
 
    $course_name_query = "SELECT * FROM subject_group WHERE id = ".$_SESSION['sg_id'];
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
    <link rel="stylesheet" type="text/css" href="../css/modal.css">
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
                        <!-- ONE ASSIGNMENT -->
                        <form action="../../backend/teacher/create_assignment.php" class="flex-col mx-20" method="POST">
                            <input type="text" class="border-bottom" name="title" placeholder="Title" required>
                            <br>
                            <div class="flex flex-mobile">
                                <div class="flex-col half-width half-to-full" style="margin-right: 10px;">
                                    <label for="due">Due Date:</label>
                                    <input type="datetime-local" class="white" name="due" placeholder="Due Date" required>
                                </div>
                                <div class="flex-col half-width half-to-full" style="margin-right: 10px;">
                                    <label for="due">Total Score:</label>
                                    <input type="number" min="1" class="white" name="total_score" placeholder="Score" required>
                                </div>
                                <div class="flex-col half-width half-to-full">
                                    <label for="due">Submission type:</label>
                                    <select name="type" id="" class="white" style="height: 35px; line-height: 19px;" required>
                                        <option value="TEXTBOX">Textbox</option>
                                        <option value="FILE_UPLOAD">File upload</option>
                                    </select>
                                </div>
                            </div>
                            
                            <br>
                            <label for="instructions">Instructions:</label>
                            <textarea name="instructions" id="instructions" class="white p-5" placeholder="Write here.." cols="30" rows="10" required></textarea>
                            <br>
                            <label for="isNotif">Do you want to notify your students about this assignment?</label>
                            <input type="checkbox" name="isNotif">
                            
                            <button class="blue" type="submit">Save</button>
                        </form>
                        <br>

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
    <script type="text/javascript" src="../js/modal.js"></script>
    <script>
    </script>
</body>
</html>