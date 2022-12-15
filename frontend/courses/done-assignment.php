<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");

      $assignment_response_id = $_GET['id'];
    
    $assignment_query = "
        SELECT *
        FROM assignment_responses AS AR
        LEFT JOIN assignments AS A ON AR.assignment_id = A.id
        LEFT JOIN assignment_files AS AF on AR.id = AF.AR_id 
        WHERE AR.id = ".$assignment_response_id;
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
                    <?php foreach($db->query($assignment_query) as $assignment): ?>
                        <div class="flex-col mx-20">
                            <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                <!-- QUIZ HEADER -->
                                <div class="left-align quiz-header">
                                    <div class="flex-col full-width" style="padding-right: 15px">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h3><?= $assignment["assignment_title"] ?></h3>
                                                </th>
                                                <th style="width: 30%;">
                                                    <h3 class="t-end"><?= $assignment["response_score"] !== NULL ? $assignment["response_score"] : "unchecked" ?> / <?= $assignment["max_score"] ?> pts</h3>
                                                </th>
                                            </tr> 
                                            <tr>
                                            <td>Due: <?= date("F d, Y h:i A", time()) ?> &nbsp; | &nbsp;Due in <?= date("d", strtotime($assignment["close_datetime"]) - time()) ?> days <?= date("H", strtotime($assignment["close_datetime"]) - time()) ?> hours</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <br>

                                <!-- INSTRUCTIONS -->
                                <p><?= $assignment["assignment_instruction"] ?></p>

                            </div>
                        </div>
                        <br>

                        <div id="questions" class="mx-20">
                            <?php if($assignment["submission_type"] == "FILE_UPLOAD") 
                            echo '
                            <p>Uploaded file: </p>
                            <a href="../files/assignment/'.$assignment["file_location"].'">'.$assignment["file_location"].' (Download)</a>
                            <iframe src="../files/assignment/'.$assignment["file_location"].'" frameborder="0" width="100%" height="600px"></iframe>
                            ';
                            else
                            echo '
                            <p>Response: </p>
                            <p>'.$assignment["response_answer"].'</p>
                            ';
                            if($_SESSION['role'] == "TEACHER" && $assignment["response_score"] === NULL)
                            echo'
                                <!-- IF USER IS A TEACHER -->
                                <form action="../../backend/teacher/score_assignment.php" method="POST">
                                    <input type="number" name="ar_id" class="hidden" value="'.$_GET['id'].'">
                                    <div class="flex space-between" style="width:40%">
                                        <label for="">Input Score</label>
                                        <input type="text" name="score" class="white" placeholder="Score here">
                                    </div>
                                    <button class="blue">Submit</button>
                                </form>
                            ';
                            ?>
                        </div>
                    <?php endforeach ?>
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
        $("#start").click((e) => {
            $("#questions").show();
            $(e.currentTarget).hide();
        });
    </script>
</body>
</html>