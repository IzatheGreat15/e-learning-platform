<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../index.php");

    if($_SESSION["role"] != "ADMIN" && $_SESSION["role"] != "REGISTRAR")
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
                                Total No. of Students: &nbsp; <b><?= mysqli_fetch_assoc($db->query("SELECT COUNT(id) AS count FROM users WHERE role = 'STUDENT'"))['count'] ?></b>
                            </div>
                            <a class="flex" style="margin: 15px 0px;" href="people.php">
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
                                Total No. of Faculty: &nbsp; <b><?= mysqli_fetch_assoc($db->query("SELECT COUNT(id) AS count FROM users WHERE role = 'TEACHER'"))['count'] ?></b>
                            </div>
                            <a class="flex" style="margin: 15px 0px;" href="people.php?query=">
                                See more...
                            </a>
                        </div>
                    </div>

                    <!-- GRADE LEVEL AND SECTIONS -->
                    <div class="flex">
                        <div class="column full-width">                           
                        </div>
                        <div class="column t-end" style="margin-top: 25px;">
                            <select name="filter" id="filter" class="white rounded-corners px-10 full-width">
                                <option value="0">All</option>
                                <?php foreach($db->query("SELECT year_level FROM sections GROUP BY year_level") AS $years): ?>
                                <option value="<?= $years['year_level'] ?>">Grade <?= $years['year_level'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <?php foreach($db->query("SELECT year_level FROM sections GROUP BY year_level") AS $years): ?>
                        <div id="y-<?= $years['year_level'] ?>" class="year-group">
                            <h2>Grade <?= $years['year_level'] ?></h2>
                            <p class="text"><?= mysqli_fetch_assoc($db->query("SELECT count(enrollments.id) as count FROM enrollments JOIN sections ON enrollments.section_id = sections.id WHERE year_level = ".$years['year_level']." GROUP BY year_level")) == NULL ? 0 : mysqli_fetch_assoc($db->query("SELECT count(enrollments.id) as count FROM enrollments JOIN sections ON enrollments.section_id = sections.id WHERE year_level = ".$years['year_level']." GROUP BY year_level"))['count'] ?> students - <?= mysqli_fetch_assoc($db->query("SELECT count(sections.id) as count FROM sections WHERE year_level = ".$years['year_level']." GROUP BY year_level"))['count'] ?> sections</p>
                            <div class="flex-wrap">
                                <!-- INDIVIDUAL SECTIONS -->
                                <?php foreach($db->query("SELECT * FROM sections WHERE year_level = ".$years['year_level']) AS $section): ?>
                                <div class="card white" id="s-<?= $section['id'] ?>">
                                    <div class="flex fullest-width">
                                        <div class="column bigger-text">
                                            <p><?= $section['section_name'] ?></p>
                                        </div>
                                    </div>
                                    <hr style="margin-top: -20px;">
                                    <div class="flex text" style="margin: 15px 0px;">
                                        Student Population: &nbsp; <b><?= mysqli_fetch_assoc($db->query("SELECT count(enrollments.id) as count FROM enrollments JOIN sections ON enrollments.section_id = sections.id WHERE section_id = ".$section['id'])) == NULL ? 0 : mysqli_fetch_assoc($db->query("SELECT count(enrollments.id) as count FROM enrollments JOIN sections ON enrollments.section_id = sections.id WHERE section_id = ".$section['id']))['count'] ?></b>
                                    </div>
                                    <a class="flex" style="margin: 15px 0px;" href="people.php">
                                        See more...
                                    </a>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endforeach ?>
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

        // filter grade level
        $("#filter").change((e) => {
            var grade = $(e.currentTarget).find(":selected").val();
            $(".year-group").hide();
            
            if(grade == 0){
                $(".year-group").show();
            }else{
                $("#y-"+grade).show();
            }
        });
    </script>
</body>
</html>