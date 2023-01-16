<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../index.php");

    if($_SESSION["role"] != "ADMIN")
      header("location: ../courses.php");

    $yl_sql = "SELECT year_level FROM subjects GROUP BY year_level";
    $subjects_sql = "SELECT * FROM subjects WHERE year_level = ";
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

        <p id="current" class="hidden">document</p>

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
                        <h1>Courses</h1>
                    </div>
                    <!-- FOR ADMINS ONLY - ADD BUTTON -->
                    <div class="column t-end">
                        <a href="admin-courses.php?mode=add">
                        <button class="blue add" style="margin-top: 25px;">
                            <div class="flex">
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                <div>
                                    Add
                                </div>
                            </div>
                        </button>
                        </a>
                    </div>
                </div>

                <hr>

                <!-- CONTENT -->
                <?php if($db->query("SELECT id FROM subjects")->num_rows > 0): ?>
                <?php foreach($db->query($yl_sql) as $yl): ?>
                <h3>Grade <?= $yl['year_level'] ?></h3>    
                <div class="flex-wrap">
                    <?php foreach($db->query($subjects_sql.$yl['year_level']) as $subject): ?>
                    <div class="card white" id="<?= $subject['id'] ?>">
                        <div class="flex full-width">
                            <div class="column">
                                <p>Course No. <?= $subject['id'] ?></p>
                            </div>
                            <div class="column t-end big-text">
                                <!-- IF ADMIN -->
                                <img src="../images/draw-blue.png" alt="draw" class="small-icon edit">
                            </div>
                        </div>
                        <div class="flex fullest-width" style="margin-top: -30px;">
                            <div class="column bigger-text">
                                <p><?= $subject['subject_name']." - ".$subject['year_level'] ?></p>
                            </div>
                        </div>
                        <div class="flex" style="margin: -30px 0px -10px;">
                            <?php $teacher = mysqli_fetch_assoc($db->query("SELECT fname, lname FROM users WHERE id = ".$subject['teacher_id'])) ?>
                            <p><?= $teacher['fname']." ".$teacher['lname'] ?></p>
                        </div>
                        <hr>
                        <?php foreach($db->query("SELECT fname, lname FROM users RIGHT JOIN subject_group AS sg ON sg.teacher_id = users.id WHERE sg.subject_id = ".$subject['id']." GROUP BY users.id") as $teacher): ?>
                        <div class="flex" style="margin: -5px 0px;">
                            <?= $teacher['fname']." ".$teacher['lname'] ?>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php endforeach ?>
                </div>
                <?php endforeach ?>
                <?php else: ?>
                    <h2 class="centered-align">No Subject Created Yet. Please make some.</h2>
                <?php endif ?>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "navbar.php" ?>
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
            $(e.currentTarget).find("img").attr("src", "../images/" + img + "-white.png");
        });
        $(".card").mouseleave((e) => {
            $(e.currentTarget).find("hr").css("background-color", "#0D4C92");

            var img = $(e.currentTarget).find("img").attr("alt");
            $(e.currentTarget).find("img").attr("src", "../images/" + img + "-blue.png");
        });
        $(".card").click((e) => {
            var id = $(e.currentTarget).attr('id');
            location.href = "admin-courses.php?id="+id;
        });
    </script>
</body>

</html>