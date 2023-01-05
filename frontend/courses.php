<?php
    include("../backend/config.php");
    session_start();

    unset($_SESSION['sg_id']);

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: index.php");

    $courses_query = match($_SESSION['role']){
        "STUDENT" => "SELECT subject_group.id, subject_group.subject_group_name, subject_group.schedule, sections.section_name, sections.year_level FROM subject_group JOIN sections ON subject_group.section_id = sections.id WHERE section_id = ".$_SESSION['section_id'],
        "TEACHER" => "SELECT subject_group.id, subject_group.subject_group_name, subject_group.schedule, sections.section_name, sections.year_level FROM subject_group JOIN subjects ON subject_group.subject_id = subjects.id JOIN sections ON subject_group.section_id = sections.id WHERE subject_group.teacher_id = ".$_SESSION['user_id'],
        "ADMIN" => "SELECT subject_group.id, subject_group.subject_group_name, subject_group.schedule, sections.section_name, sections.year_level FROM subject_group JOIN subjects ON subject_group.subject_id = subjects.id JOIN sections ON subject_group.section_id = sections.id",
    };
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
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>Courses</h1>
                    </div>
                </div>

                <hr>

                <p id="current" class="hidden">document</p>

                <!-- CONTENT -->
                    <div class="flex-wrap">
                        <?php $courses = $db->query($courses_query) ?>
                        <?php if($courses != FALSE && $courses->num_rows > 0): ?>
                        <?php foreach($courses as $course): ?>
                        <div class="card white" id="<?= $course["id"] ?>">
                            <div class="flex full-width">
                                <div class="column">
                                    <p>Course No. <?= $course["id"] ?></p>
                                </div>
                                <div class="column t-end big-text">
                                    <img src="images/right-arrow-blue.png" alt="right-arrow" class="small-icon">
                                </div>
                            </div>
                            <div class="flex fullest-width" style="margin-top: -30px;">
                                <div class="column bigger-text">
                                    <p><?= $course["subject_group_name"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin: -30px 0px -10px;">
                                <p>Grade <?= $course["year_level"] ?> - Section <?= $course["section_name"] ?></p>
                            </div>
                            <hr>
                            <div class="flex" style="margin: -5px 0px;">
                                <p><?= $course["schedule"] ?></p>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php else: ?>
                            <h3 class="centered-align">No Subject Assigned Yet</h3>
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
        // CARD ANIMATIONS
        $(".card").mouseenter((e) => {
            $(e.currentTarget).find("hr").css("background-color", "white");

            var img = $(e.currentTarget).find("img").attr("alt");
            $(e.currentTarget).find("img").attr("src", "images/"+ img +"-white.png");
        });
        $(".card").mouseleave((e) => {
            $(e.currentTarget).find("hr").css("background-color", "#0D4C92");

            var img = $(e.currentTarget).find("img").attr("alt");
            $(e.currentTarget).find("img").attr("src", "images/"+ img +"-blue.png");
        });
        $(".card").click((e) => {
            var id = $(e.currentTarget).attr('id');
            console.log(id);
            window.location.replace("courses/home.php?id="+id);
        });
    </script>
</body>
</html>