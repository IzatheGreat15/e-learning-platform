<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.html");

    if($_SESSION["role"] != "TEACHER")
      header("location: home.php");

    $student_query = "
        SELECT *
        FROM users AS u
        LEFT JOIN enrollments AS e ON u.id = e.student_id
        LEFT JOIN sections AS s ON e.section_id = s.id
        LEFT JOIN subject_group AS sg ON sg.section_id = s.id
        WHERE sg.id = ".$_SESSION['sg_id'];

        $_SESSION['test'] = mysqli_fetch_assoc($db->query($student_query));

  
    $course_name_query = "SELECT subject_group_name FROM subject_group WHERE id = ".$_SESSION['sg_id'];

    date_default_timezone_set("Asia/Manila");
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
                </div>

                <hr>

                <br>

                <!-- CONTENT -->
                <div class="flex mobile">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col p-5 mx-20">
                        <h1>Students</h1>
                        <?php foreach($db->query($student_query) as $student): ?>
                        <a class="flex white space-between p-5" href="grades.php?s_id=<?= $student["id"] ?>">
                            <div class="flex p-5 space-between">
                                <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                    <!-- PROFILE PICTURE -->
                                    <img src="../files/profile/<?= $student["pp_location"] ?>" class="logo" alt="logo">
                                </div>
                                <div style="margin: 0px 10px;">
                                    <b><h3><?= $student["fname"] ?> <?= $student["lname"] ?></h3></b>
                                    <p>Student No#<?= $student["id"] ?></p>
                                </div>
                            </div>
                            <div class="flex p-5 space-between vertical-center">
                                <p>Grade <?= $student["year_level"] ?> - Section <?= $student["section_name"] ?></p>
                            </div>
                            <div class="flex p-5 space-between vertical-center">
                                <b><h3>88%</h3></b>
                            </div>
                        </a>
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