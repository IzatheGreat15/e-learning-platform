<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: index.php");

    if($_SESSION["role"] != "ADMIN")
      header("location: ../dashboard.php");
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
                        <h1>Dashboard</h1>
                    </div>
                    <a href="../../backend/logout.php"><p id="current" class="">Logout</p></a>
                </div>
                <hr>
                <br>

                <!-- CONTENT -->
                <div class="flex flex-col">
                    <!-- PEOPLE -->
                    <h2>People</h2>
                    <div class="flex-wrap">
                        <!-- STUDENTS -->
                        <div class="card white" id="">
                            <div class="flex fullest-width">
                                <div class="column bigger-text">
                                    <p>Students</p>
                                </div>
                            </div>
                            <hr style="margin-top: -20px;">
                            <div class="flex text" style="margin: 15px 0px;">
                                Total No. of Students: &nbsp; <b>34</b>
                            </div>
                            <a class="flex" style="margin: 15px 0px;" href="people.php?query=">
                                See more...
                            </a>
                        </div>

                        <!-- FACULTY -->
                        <div class="card white" id="">
                            <div class="flex fullest-width">
                                <div class="column bigger-text">
                                    <p>Faculty</p>
                                </div>
                            </div>
                            <hr style="margin-top: -20px;">
                            <div class="flex text" style="margin: 15px 0px;">
                                Total No. of Faculty: &nbsp; <b>34</b>
                            </div>
                            <a class="flex" style="margin: 15px 0px;" href="people.php?query=">
                                See more...
                            </a>
                        </div>
                    </div>

                    <!-- GRADE LEVEL AND SECTIONS -->
                    <div class="flex">
                        <div class="column full-width">
                            <h2>Grade 1</h2> 
                        </div>
                        <div class="column t-end" style="margin-top: 25px;">
                            <select name="filter" id="" class="white rounded-corners px-10 full-width">
                                <option value="1">Grade 1</option>
                            </select>
                        </div>
                    </div>
                    <p class="text">115 students - 34 sections</p>
                    <div class="flex-wrap">
                        <!-- INDIVIDUAL SECTIONS -->
                        <div class="card white" id="">
                            <div class="flex fullest-width">
                                <div class="column bigger-text">
                                    <p>Siopao</p>
                                </div>
                            </div>
                            <hr style="margin-top: -20px;">
                            <div class="flex text" style="margin: 15px 0px;">
                                Total No. of Faculty: &nbsp; <b>34</b>
                            </div>
                            <a class="flex" style="margin: 15px 0px;" href="people.php?query=">
                                See more...
                            </a>
                        </div>
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

    <script type="text/javascript" src="../courses/navbar.js"></script>
    <script>
        // CARD ANIMATIONS
        $(".card").mouseenter((e) => {
            $(e.currentTarget).find("hr").css("background-color", "white");
            $(e.currentTarget).find("a").css("color", "white");

            var img = $(e.currentTarget).find("img").attr("alt");
            $(e.currentTarget).find("img").attr("src", "../images/" + img + "-white.png");
        });
        $(".card").mouseleave((e) => {
            $(e.currentTarget).find("hr").css("background-color", "#0D4C92");
            $(e.currentTarget).find("a").css("color", "#0D4C92");

            var img = $(e.currentTarget).find("img").attr("alt");
            $(e.currentTarget).find("img").attr("src", "../images/" + img + "-blue.png");
        });
    </script>
</body>
</html>