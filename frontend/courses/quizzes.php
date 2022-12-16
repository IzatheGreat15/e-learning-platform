<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");

    $item_num_query = "SELECT COUNT(id) AS count FROM quiz_items WHERE quiz_id = ";
    $quiz_score_query = "SELECT SUM(max_score) AS max_score FROM quiz_items WHERE quiz_id = ";

    $quiz_query = "SELECT * FROM quizzes WHERE sg_id = ".$_SESSION['sg_id'];
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
                        
                        <div class="flex-col mx-20">
                            <!-- ONE QUIZ -->
                            <?php $quizzes = $db->query($quiz_query) ?>
                            <?php if($quizzes->num_rows > 0): ?>
                            <?php foreach($quizzes as $quiz): ?>
                            <div class="white p-5 text-justify content" style="position: relative; margin-bottom: 15px">
                                <div class="left-align">
                                    <div class="centered-align p-5">
                                        <a href="quiz.php?id=<?= $quiz["id"] ?>" class="link text"><h3><?= $quiz["quiz_title"] ?></h3></a>
                                    </div>
                                    <div class="centered-align">
                                        <div class="centered-align">
                                        <?php foreach($db->query($quiz_score_query.$quiz["id"]) as $s): ?>
                                            <h3><?= $s["max_score"] ?> pts</h3>
                                        <?php endforeach ?> 
                                        </div>
                                        <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                        <?php if($_SESSION['role'] == "TEACHER")
                                        echo'
                                        <div class="btn" style="margin-top: -10px; margin-right: -10px;">
                                            <img src="../images/dot-blue.png" class="small" style="width: 8px;" alt="logo">
                                        </div>
                                        '?>
                                    </div>
                                </div>

                                <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                <?php if($_SESSION['role'] == "TEACHER"){
                                    echo'
                                    <div class="white quiz-option p-5 flex-col t-end" style="width: 200px;">
                                        <a href="view-responses-quizzes.php?id='.$quiz["id"].'" class="link text">View Responses</a> <br>
                                        <!-- ONLY IF IT HASNT BEEN PUBLISHED YET -->';
                                        echo '
                                        <a class="link text dlt-btn" id="'.$quiz["id"].'">Delete</a>
                                    </div>
                                    ';
                                }?>

                                <div class="left-align description">
                                    <div class="centered-align p-5 description">
                                        <p>Due <?= date("F d, Y h:i A", strtotime($quiz["close_datetime"])) ?></p>
                                        <p style="margin: 0px 20px;"> | </p>
                                        <p><?= date("H", strtotime($quiz["time_limit"])) ?> hr and <?= date("i", strtotime($quiz["time_limit"])) ?> mins</p>
                                    </div>
                                    <div class="centered-align">
                                    <?php foreach($db->query($item_num_query.$quiz["id"]) as $s): ?>
                                        <p><?= $s["count"] ?> Questions</p>
                                    <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                            <?php else: ?>
                                <div class="centered-align">
                                <h3>No Quiz Yet</h3>
                                </div>
                            <?php endif ?>
                        </div>
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
    <script>
        $(".btn").click((e) => {
            $(e.currentTarget).parent("div").parent("div").parent("div").find(".quiz-option").toggle();
        });

        $(".add").click((e) => {
            location.replace("admin-quizzes.php?mode=add");
        });
    </script>
</body>
</html>