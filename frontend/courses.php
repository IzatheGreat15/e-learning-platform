<?php
    include("../backend/config.php");
    session_start();

    // if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
    //   header("location: index.html");

    $courses_query = "SELECT id, subject_group_name, schedule FROM subject_group";
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
                <h1>Your Courses</h1>
                <hr>

                <p id="current" class="hidden">document</p>

                <?php foreach($db->query($courses_query) as $course): ?>
                <div class="flex-wrap">
                    <div class="card white" id="<?= $course["id"] ?>">
                        <div class="flex full-width">
                            <div class="column">
                                <p>Course No. <?= $course["id"] ?></p>
                            </div>
                            <div class="column t-end big-text">
                                <img src="images/right-arrow-blue.png" alt="next" class="small-icon">
                            </div>
                        </div>
                        <div class="flex fullest-width" style="margin-top: -30px;">
                            <div class="column bigger-text">
                                <p><?= $course["subject_group_name"] ?></p>
                            </div>
                        </div>
                        <div class="flex" style="margin: -30px 0px -10px;">
                            <p>Grade 1 - Section Siopao</p>
                        </div>
                        <hr>
                        <div class="flex" style="margin: -5px 0px;">
                            <p><?= $course["schedule"] ?></p>
                        </div>
                    </div>
                    <?php endforeach ?>
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
            $(e.currentTarget).find("img").attr("src", "images/right-arrow-white.png");
        });
        $(".card").mouseleave((e) => {
            $(e.currentTarget).find("hr").css("background-color", "#0D4C92");
            $(e.currentTarget).find("img").attr("src", "images/right-arrow-blue.png");
        });
        $(".card").click((e) => {
            var id = $(e.currentTarget).attr('id');
            console.log(id);
            window.location.replace("courses/home.php?id="+id);
        });
    </script>
</body>
</html>