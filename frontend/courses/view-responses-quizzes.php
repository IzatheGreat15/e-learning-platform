<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../index.php");

    if($_SESSION["role"] != "TEACHER")
        header("location: quizzes.php");
    
    if(!isset($_GET['id']))
        header("location: quizzes.php");  

    $quiz_id = $_GET['id'];  
    
    $quiz_title = mysqli_fetch_assoc($db->query("SELECT quiz_title FROM quizzes WHERE id = ".$quiz_id))['quiz_title'];
    $max_score = mysqli_fetch_assoc($db->query("SELECT SUM(max_score) AS max_score FROM quiz_items WHERE quiz_id = ".$quiz_id))['max_score'];
    $course_name = mysqli_fetch_assoc($db->query("SELECT subject_group_name FROM subject_group WHERE id = ".$_SESSION['sg_id']))['subject_group_name'];

    $quiz_responses = $db->query("SELECT users.* FROM users WHERE id IN (SELECT student_id FROM quiz_responses LEFT JOIN quiz_items ON quiz_responses.qi_id = quiz_items.id LEFT JOIN quizzes ON quizzes.id = quiz_items.quiz_id WHERE quiz_id = ".$quiz_id.")");

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
                <!-- header -->
                <div class="flex">
                    <div class="column full-width">
                        <h1><?= $course_name ?></h1>
                    </div>
                    <div class="column t-end more">
                        <img src="../../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
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
                        <!-- ONE STUDENT -->
                        <div class="flex-col mx-20">
                            <h2><?= $quiz_title ?></h2>
                            <?php if($quiz_responses->num_rows > 0): ?>
                            <?php foreach($quiz_responses as $response): ?>
                            
                            <a href="done-quiz.php?id=<?= $quiz_id ?>&sid=<?= $response['id'] ?>">
                                <div class="white flex" style="padding: 10px">
                                    <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                        <!-- PROFILE PICTURE -->
                                        <img src="../images/<?= $response['pp_location'] ?>" class="logo" alt="logo">
                                    </div>

                                    <div class="flex space-between full-width" style="margin: 0px 10px;">
                                        <div>
                                            <h4><?= $response['fname'] ?> <?= $response['lname'] ?></h4>
                                            <?php $response_dt = mysqli_fetch_assoc($db->query("SELECT qr.created_on FROM quiz_responses AS qr LEFT JOIN quiz_items AS qi ON qr.qi_id = qi.id WHERE qi.quiz_id = ".$quiz_id." AND qr.student_id = ".$response['id']))['created_on'] ?>
                                            <p><?= date("F d, Y h:i A", strtotime($response_dt)) ?></p>
                                        </div>
                                        <div class="t-end">
                                            <?php $quiz = mysqli_fetch_assoc($db->query("SELECT SUM(response_score) AS score, COUNT(qi.id) AS q_count FROM quiz_responses AS qr LEFT JOIN quiz_items AS qi ON qr.qi_id = qi.id WHERE quiz_id = ".$quiz_id." AND student_id = ".$response['id'])) ?>
                                            <h4><?= $quiz['score'] ?> / <?= $max_score ?></h4>
                                            <p><?= $quiz['q_count'] ?> <?= $quiz['q_count'] > 1 ? 'Questions' : 'Question' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                                <?php else: ?>
                                    <div class="centered-align">
                                    <h3>No Response Recorded Yet</h3>
                                    </div>
                                <?php endif ?>
                            </a>
                        </div>
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
</body>

</html>