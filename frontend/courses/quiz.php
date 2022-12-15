<?php

use LDAP\Result;

include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

if ($_SESSION["role"] == "TEACHER")
    header("location: view-responses-quizzes.php?id=".$_GET['id']);

$quiz_id = $_GET['id'];

$quiz_response_query = "SELECT * FROM quiz_responses AS qr LEFT JOIN quiz_items AS qi ON qr.qi_id = qi.id LEFT JOIN quizzes AS q ON q.id = qi.quiz_id WHERE quiz_id = ".$quiz_id." AND student_id = ".$_SESSION['user_id'];

$item_num_query = "SELECT COUNT(id) AS count FROM quiz_items WHERE quiz_id = " . $quiz_id;
$quiz_score_query = "SELECT SUM(max_score) AS max_score FROM quiz_items WHERE quiz_id = " . $quiz_id;

$quiz_query = "SELECT * FROM quizzes WHERE id = " . $quiz_id;
$course_name_query = "SELECT subject_group_name FROM subject_group WHERE id = " . $_SESSION['sg_id'];

$s = $db->query($quiz_response_query);
    if($s->num_rows > 0)
        header("location: done-quiz.php?id=".$quiz_id);

date_default_timezone_set("Asia/Manila");

// CHECK IF CURRENT TIME EXCEEDS SESSION END TIME => REDIRECT TO DONE QUIZ PAGE
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
                        <?php foreach ($db->query($course_name_query) as $course_name) : ?>
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
                <div class="flex mobile" style="margin-bottom: 20px;">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        <?php foreach ($db->query($quiz_query) as $quiz) : ?>
                            <div class="flex-col mx-20">
                                <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                    <!-- QUIZ HEADER -->
                                    <div class="left-align quiz-header">
                                        <div class="flex-col full-width" style="padding-right: 15px">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <h3><?= $quiz["quiz_title"] ?></h3>
                                                    </th>
                                                    <th style="width: 30%;">
                                                        <h3 class="t-end">100 pts</h3>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>Due: <?= date("F d, Y h:i A", strtotime($quiz['close_datetime'])) ?> &nbsp; | &nbsp; <?= date("h", strtotime($quiz['time_limit'])) ?>hr and <?= date("i", strtotime($quiz['time_limit'])) ?> mins</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="left-align white submission-deets" style="width: 300px;">
                                            <div class="flex-col" style="margin: 0px 10px;">
                                                <p class="bold">Submission Details:</p>
                                                <p style="margin-top: -10px;">Your Score: 50pts</p>
                                                <p style="margin-top: -10px;">Time Left: <span id="time_remaining"></span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- INSTRUCTIONS -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                    <!-- START BUTTON -->
                                    <div class="t-center full-width">
                                        <button class="blue" id="start"><?= (!isset($_SESSION["end_time"])) ? "Start" : "Resume" ?></button>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div id="questions" style="display: none;">
                                <!-- ONE QUESTION -->
                                <div class="flex-col mx-20 white content rounded-corners">
                                    <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                        <div class="left-align quiz-header">
                                            <div class="flex-col full-width" style="padding-right: 15px">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            <h2>Question 1</h2>
                                                        </th>
                                                        <th>
                                                            <h2 class="t-end">5 pts</h2>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <br>

                                        <!-- QUESTION -->
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                        <!-- ANSWER FIELD -->
                                        <div class="full-width flex">
                                            <p>Your Answer: </p>
                                            <input type="text" class="white" style="margin: 10px 15px; width: 30%;">
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <!-- ONE QUESTION -->
                                <div class="flex-col mx-20 white content rounded-corners">
                                    <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                        <div class="left-align quiz-header">
                                            <div class="flex-col full-width" style="padding-right: 15px">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            <h2>Question 1</h2>
                                                        </th>
                                                        <th>
                                                            <h2 class="t-end">5 pts</h2>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <br>

                                        <!-- QUESTION -->
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                        <!-- ANSWER FIELD -->
                                        <div class="full-width flex">
                                            <p>Your Answer: </p>
                                            <input type="text" class="white" style="margin: 10px 15px; width: 30%;">
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="mx-20 t-end">
                                    <a href="done-quiz.php?id=?"><button class="blue">Submit</button></a>
                                </div>
                            </div>
                    </div>
                <?php endforeach ?>
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
        var start = 0;
        $("#start").click((e) => {
            var mode = $(e.currentTarget).text();

            if(mode === "Start"){
                $.ajax({
                    type: "POST",
                    url: "../../backend/student/start_quiz.php",
                    data: {
                        id : <?=  $_GET["id"] ?>
                    },
                    success: function(res) {
                        console.clear();
                        alert(res);
                    }
                });
            }

            $("#questions").show();
            $(e.currentTarget).hide();

            start = 1;
        });

        var time_remaining = setInterval(()=> {
            if(start == 1){
                $.ajax({
                    type: "GET",
                    url: "../../backend/student/get_time_remaining.php",
                    success: function(res) {
                        console.clear();

                        $("#time_remaining").text(res);
                    }
                });
            }
        }, 1000);
    </script>
</body>

</html>