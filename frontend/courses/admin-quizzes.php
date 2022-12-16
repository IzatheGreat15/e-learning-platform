<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");

    if($_SESSION["role"] != "TEACHER")
      header("location: home.php");
 
    $course_name_query = "SELECT * FROM subject_group WHERE id = ".$_SESSION['sg_id'];
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
                        <h1>English</h1>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
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
                        <!-- ONE ASSIGNMENT -->
                        <form action="../../backend/teacher/create_quiz.php" class="flex-col mx-20" method="POST">
                            <input type="text" class="border-bottom" name="title" placeholder="Title" required>
                            <br>
                            <label for="due">Due Date:</label>
                            <input type="datetime-local" class="white" name="due" placeholder="Due Date" required>
                            <br>
                            <label for="due">Time Limit:</label>
                            <input type="time" class="white" name="time_limit" placeholder="Time Limit" required>
                            <br>
                            <!--
                            <label for="due">Time Closed:</label>
                            <input type="time" class="white" name="time_limiy" placeholder="Time Limit">
                            <br>
                            -->
                            <label for="instructions">Instructions:</label>
                            <textarea name="instructions" id="instructions" class="white p-5" placeholder="Write here.." cols="30" rows="10" required></textarea>
                            <br>

                            <!-- DYNAMIC NUMBER OF QUESTIONS -->
                            <div class="questions">
                                <input type="number" class="border-bottom hidden" name="count" id="count" value="1">
                                <div class="white" style="padding: 15px; margin-bottom: 30px">
                                    <div class="flex flex-col">
                                        <label for="question">Question</label>
                                        <input type="text" class="border-bottom" name="question[]" required>
                                    </div>
                                    <br>
                                    <div class="flex flex-col">
                                        <label for="answer">Answer</label>
                                        <input type="text" class="border-bottom" name="answer[]" required>
                                    </div>
                                    <br>
                                    <div class="flex flex-col">
                                        <label for="score">Score</label>
                                        <input type="number" min="1" class="border-bottom" name="score[]" required>
                                    </div>
                                </div>
                            </div>

                            <div class="flex centered-align">
                                <button class="transparent-btn" id="add" type="button">Add item</button>
                                <button class="transparent-btn" id="remove" type="button">Remove item</button>
                            </div>
                            <br>

                            <button class="blue" type="submit">Save</button>
                            </form>
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
    <script type="text/javascript" src="../js/modal.js"></script>
    <script>
        var questions = 1;

        // add question
        $("#add").click(() => {
            $(".questions")
            .append('<div class="white" style="padding: 15px; margin-bottom: 30px">' +
                        '<div class="flex flex-col">' +
                            '<label for="question">Question</label>' +
                            '<input type="text" class="border-bottom" name="question[]" required>' +
                        '</div>' +
                        '<br>' +
                        '<div class="flex flex-col">' +
                            '<label for="answer">Answer</label>' +
                            '<input type="text" class="border-bottom" name="answer[]" required>' +
                        '</div>' +
                        '<br>' +
                        '<div class="flex flex-col">' +
                            '<label for="score">Score</label>' +
                            '<input type="number" min="1" class="border-bottom" name="score[]" required>' +
                        '</div>' +
                    '</div>');
            questions++;
            $("#count").val(questions);
        });

        // remove question
        $("#remove").click(() => {
            if(questions > 1){
                $(".questions").children().last().remove();
                questions--;
                $("#count").val(questions);
            }else{
                alert("There should atleast be 1 question in the quiz");
            }
        });
    </script>
</body>

</html>