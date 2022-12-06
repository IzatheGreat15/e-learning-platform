<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: ../index.php");

    foreach($db->query("SELECT subject_id FROM subject_group WHERE id = ".$_SESSION['sg_id']) as $subject){
        $subject_id = $subject['subject_id'];
    }
      
    $course_name_query = "SELECT * FROM subject_group WHERE id = ".$_SESSION['sg_id'];

    $module_query = "SELECT id, module_title FROM modules WHERE subject_id = ".$subject_id;

    $page_query = "SELECT id, page_title  FROM pages WHERE module_id = ";
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
                        <button class="blue add" style="margin-top: 25px;">
                            <div class="flex">
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
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
                    <div class="full-width flex-col">
                        <!-- ONE MODULE -->
                        <?php foreach($db->query($module_query) as $module): ?>
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <img src="../images/down-white.png" class="down" alt="">
                                    <?= $module["module_title"] ?>
                                </div>
                                <!-- FOR TEACHERS ONLY - EDIT BUTTON -->
                                <div class="centered-align">
                                <?php if($_SESSION['role'] == "TEACHER")
                                    echo'
                                    <div class="btn">
                                        <img src="../images/draw-white.png" class="small" alt="edit" style="width: 20px;">
                                    </div>
                                    '
                                ?>
                                </div>
                            </div>

                            <?php foreach($db->query($page_query.$module['id']) as $lesson): ?>
                            <div class="lesson">
                                <div class="white p-5" style="margin-top: -2px;">
                                    <a href="lesson.php?id=<?= $lesson['id'] ?>" class="link text p-5"><?= $lesson['page_title'] ?></a>
                                </div>
                            </div>
                            <?php endforeach ?>
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
    <script>
        $(".add").click((e) => {
            location.replace("admin-modules.php?mode=add");
        });
        $(".edit").click((e) => {
            location.replace("admin-modules.php?mode=edit&id=?");
        });
    </script>
</body>
</html>