<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

if (!isset($_GET['id']))
    header("location: quizzes.php");

if (!isset($_GET['sid']) && $_SESSION['role'] == "TEACHER")
    header("location: quizzes.php");

$quiz_id = $_GET['id'];
$student_id = ($_SESSION['role'] == "TEACHER") ? $_GET['sid'] : $_SESSION['user_id'];

if ($db->query("SELECT qr.id FROM quiz_responses AS qr JOIN quiz_items AS qi ON qr.qi_id = qi.id JOIN quizzes AS q ON q.id = qi.quiz_id WHERE student_id = " . $student_id . " AND quiz_id = " . $quiz_id)->num_rows < 1)
    header("location: quiz.php?id=" . $quiz_id);

$quiz = mysqli_fetch_assoc($db->query("SELECT quizzes.*, SUM(max_score) AS max_score FROM quizzes LEFT JOIN quiz_items ON quizzes.id = quiz_items.quiz_id WHERE quizzes.id = " . $quiz_id));

$quiz_item_query = "
        SELECT *
        FROM quiz_items AS qi
        WHERE qi.quiz_id = " . $quiz_id;
$course_name = mysqli_fetch_assoc($db->query("SELECT subject_group_name FROM subject_group WHERE id = " . $_SESSION['sg_id']))['subject_group_name'];
$score = mysqli_fetch_assoc($db->query("SELECT SUM(response_score) AS score FROM quizzes AS q LEFT JOIN quiz_items AS qi ON q.id = qi.quiz_id LEFT JOIN quiz_responses AS qr ON qi.id = qr.qi_id WHERE q.id = " . $quiz_id . " AND qr.student_id = " . $student_id))['score'];

date_default_timezone_set("Asia/Manila");
$x = 1;
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
                        <h1><?= $course_name ?></h1>
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

                        <div class="flex-col mx-20">
                            <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                <!-- QUIZ HEADER -->
                                <div class="left-align quiz-header">
                                    <div class="flex-col full-width" style="padding-right: 15px">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h3><?= $quiz['quiz_title'] ?></h3>
                                                </th>
                                                <th style="width: 30%;">
                                                    <h3 class="t-end"><?= $quiz['max_score'] ?> pts</h3>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Due: <?= date("F d, Y h:i A", strtotime($quiz['close_datetime'])) ?> &nbsp; | &nbsp; <?= date("h", strtotime($quiz['time_limit'])) ?>hr and <?= date("G", strtotime($quiz['time_limit'])) ?> mins</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="left-align white submission-deets" style="width: 300px;">
                                        <div class="flex-col" style="margin: 0px 10px;">
                                            <p class="bold">Submission Details:</p>
                                            <p style="margin-top: -10px;">Your Score:
                                                <!-- AUTOMATIC SUBMIT GRADE UPON ENTER KEY -->
                                                <!-- READONLY IF STUDENT ACCOUNT -->
                                                <?= $score ?>
                                                pts
                                            </p>
                                            <!--<p style="margin-top: -10px;">Time Spent: 41 mins</p>-->
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <!-- INSTRUCTIONS -->
                                <p><?= $quiz['quiz_instruction'] ?></p>
                            </div>
                        </div>
                        <br>

                        <div id="questions">
                            <!-- ONE QUESTION -->
                            <?php foreach ($db->query($quiz_item_query) as $question) : ?>
                                <?php $response = $db->query("SELECT * FROM quiz_responses WHERE student_id = " . $student_id . " AND qi_id = " . $question['id'])->num_rows > 0 ? mysqli_fetch_assoc($db->query("SELECT * FROM quiz_responses WHERE student_id = " . $student_id . " AND qi_id = " . $question['id'])) : NULL ?>
                                <div class="flex-col mx-20 white content rounded-corners">
                                    <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                        <div class="left-align quiz-header">
                                            <div class="flex-col full-width" style="padding-right: 15px">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            <h2>Question <?= $x++ ?></h2>
                                                        </th>
                                                        <th>
                                                            <h2 class="t-end">
                                                                <?php if ($_SESSION['role'] == 'STUDENT') : ?>
                                                                    <?= $response == NULL ? 0 : $response['response_score'] ?>
                                                                <?php else : ?>
                                                                    <input type="text" class="white" style="width: 15px;" value="<?= $response == NULL ? 0 : $response['response_score'] ?>" id="<?= $response == NULL ? 0 : $response['id'] ?>">
                                                                <?php endif ?>
                                                                /
                                                                <?= $question['max_score'] ?> pts
                                                            </h2>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <br>

                                        <!-- QUESTION -->
                                        <p><?= $question['item_question'] ?></p>

                                        <!-- ANSWER FIELD -->
                                        <div class="full-width flex">
                                            <p>Your Answer: </p>
                                            <input type="text" class="white" style="margin: 10px 15px; width: 30%;" value="<?= $response == NULL ? '' : $response['response_answer'] ?>" readonly>
                                        </div>
                                        <p>Correct Answer: <?= $question['item_answer'] == NULL ? 'No correct answer provided.' : $question['item_answer'] ?></p>
                                    </div>
                                </div>
                                <br>
                            <?php endforeach ?>
                        </div>
                        <br>

                        <?php if($_SESSION["role"] == "TEACHER"): ?>
                        <!-- FOR THEACHERS ONLY -->
                        <div class="mx-20 t-end">
                            <button class="blue" type="submit">Submit</button>
                        </div>
                        <?php endif ?>
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
    <script>
    </script>
</body>

</html>