<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

if (!isset($_SESSION["sg_id"]))
    header("location: ../courses.php");

$clause = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "deleted_on IS NOT NULL" : "deleted_on IS NULL";
$item_num_query = "SELECT COUNT(id) AS count FROM quiz_items WHERE quiz_id = ";
$quiz_score_query = "SELECT SUM(max_score) AS max_score FROM quiz_items WHERE quiz_id = ";

$quiz_query = "SELECT * FROM quizzes WHERE " . $clause . " AND sg_id = " . $_SESSION['sg_id'];
$course_name_query = "SELECT subject_group_name FROM subject_group WHERE id = " . $_SESSION['sg_id'];

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
                        <?php foreach ($db->query($course_name_query) as $course_name) : ?>
                            <h1><?= $course_name["subject_group_name"] ?></h1>
                        <?php endforeach ?>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <?php if ($_SESSION['role'] == "TEACHER")
                        echo '
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
                    ' ?>
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
                            <div class="t-end">
                                <?php
                                $url = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "quizzes.php" : "quizzes.php?type=archived";
                                $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "Active" : "Archived";
                                ?>
                                <a href="<?= $url ?>"><button class="blue" type="button"><?= $btn ?></button></a>
                            </div>
                            <br>
                            <!-- ONE QUIZ -->
                            <?php $quizzes = $db->query($quiz_query) ?>
                            <?php if ($quizzes->num_rows > 0) : ?>
                                <?php foreach ($quizzes as $quiz) : ?>
                                    <div class="white p-5 text-justify content" style="position: relative; margin-bottom: 15px">
                                        <div class="left-align">
                                            <div class="centered-align p-5">
                                                <a href="admin-quizzes.php?mode=edit&id=<?= $quiz["id"] ?>" class="link text">
                                                    <h3 class="title"><?= $quiz["quiz_title"] ?></h3>
                                                </a>
                                            </div>
                                            <div class="centered-align">
                                                <div class="centered-align">
                                                    <?php foreach ($db->query($quiz_score_query . $quiz["id"]) as $s) : ?>
                                                        <h3><?= $s["max_score"] ?> pts</h3>
                                                    <?php endforeach ?>
                                                </div>
                                                <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                                <?php if ($_SESSION['role'] == "TEACHER")
                                                    echo '
                                        <div class="btn" style="margin-top: -10px; margin-right: -10px;">
                                            <img src="../images/dot-blue.png" class="small" style="width: 8px; height: 50px;" alt="logo">
                                        </div>
                                        ' ?>
                                            </div>
                                        </div>

                                        <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                        <?php if ($_SESSION['role'] == "TEACHER") : ?>
                                            <div class="white quiz-option p-5 flex-col t-end" style="width: 200px;">
                                                <a href="view-responses-quizzes.php?id=<?= $quiz["id"] ?>" class="link text">View Responses</a> <br>
                                                <!-- ONLY IF IT HASNT BEEN PUBLISHED YET -->
                                                <?php $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "Restore" : "Archive";
                                                $class = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "res-btn" : "dlt-btn" ?>
                                                <a class="link text <?= $class ?>" id="<?= $quiz["id"] ?>"><?= $btn ?></a>
                                            </div>
                                        <?php endif ?>

                                        <div class="left-align description">
                                            <div class="centered-align p-5 description">
                                                <p>Due <?= date("F d, Y h:i A", strtotime($quiz["close_datetime"])) ?></p>
                                                <p style="margin: 0px 20px;"> | </p>
                                                <p><?= date("H", strtotime($quiz["time_limit"])) ?> hr and <?= date("i", strtotime($quiz["time_limit"])) ?> mins</p>
                                            </div>
                                            <div class="centered-align">
                                                <?php foreach ($db->query($item_num_query . $quiz["id"]) as $s) : ?>
                                                    <p><?= $s["count"] ?> Questions</p>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else : ?>
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

    <!-- MODAL FOR DELETE QUIZ -->
    <div id="modal-delete" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to archive <span class="name"></span>?</h3>
                <form action="../../backend/teacher/delete_quiz.php" method="POST">
                    <input type="hidden" name="id" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL FOR RESTORE QUIZ -->
    <div id="modal-restore" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to restore <span class="name"></span>?</h3>
                <form action="../../backend/teacher/restore_quiz.php" method="POST">
                    <input type="hidden" name="id" id="del-val" value="">
                    <a href="#" id="restore"><button type="button" name="submit" class="blue">YES</button></a>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="navbar.js"></script>
    <script type="text/javascript" src="../js/modal.js"></script>
    <script>
        $(".btn").click((e) => {
            $(e.currentTarget).parent("div").parent("div").parent("div").find(".quiz-option").toggle();
        });

        $(".dlt-btn").click((e) => {
            $("#modal-delete").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            var id = $(e.currentTarget).attr("id");

            $(".name").text(title);
            $("input[name='id']").val(id);
        });

        $(".res-btn").click((e) => {
            $("#modal-restore").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            var id = $(e.currentTarget).attr("id");

            $(".name").text(title);
            $("#restore").attr("href", "../../backend/teacher/restore_quiz.php?id=" + $(e.currentTarget).attr("id"));
        });

        $(".add").click((e) => {
            location.href = "admin-quizzes.php?mode=add";
        });
    </script>
</body>

</html>