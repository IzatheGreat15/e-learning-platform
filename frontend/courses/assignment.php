<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../index.php");

    if($_SESSION["role"] == "TEACHER")
        header("location: view-responses-assignments.php?id=".$_GET['id']);

    $_SESSION['sg_id'] = mysqli_fetch_assoc($db->query("SELECT sg_id FROM assignments WHERE id = ".$_GET['id']))['sg_id'];
    $assignment_id = $_GET['id'];  

    $assignment_response_query = "SELECT id FROM assignment_responses WHERE student_id = ".$_SESSION['user_id']." AND assignment_id = ".$assignment_id;

    $s = $db->query($assignment_response_query);
    if($s->num_rows > 0)
        header("location: done-assignment.php?id=".mysqli_fetch_assoc($s)['id']);
    
    $assignment_query = "SELECT id, assignment_title, close_datetime, max_score, assignment_instruction, submission_type FROM assignments WHERE id = ".$assignment_id;
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
                    <?php foreach($db->query($assignment_query) as $assignment): ?>
                    <div class="full-width flex-col">
                        
                        <div class="flex-col mx-20">
                            <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                <!-- QUIZ HEADER -->
                                <div class="left-align quiz-header">
                                    <div class="flex-col full-width" style="padding-right: 15px">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h3 class="t-start"><?= $assignment["assignment_title"] ?></h3>
                                                </th>
                                                <th style="width: 30%;">
                                                    <h3 class="t-end"><?= $assignment["max_score"] ?> pts</h3>
                                                </th>
                                            </tr> 
                                            <tr>
                                                <td>Due: <?= $assignment["close_datetime"] == NULL ? 'Not Set' : date("F d, Y h:i A", strtotime($assignment["close_datetime"])) ?> &nbsp; | &nbsp;Due in <?= $assignment["close_datetime"] == NULL ? 'Not Set' : date("d", strtotime($assignment["close_datetime"]) - time()) ?> days <?= $assignment["close_datetime"] == NULL ? 'Not Set' : date("H", strtotime($assignment["close_datetime"]) - time()) ?> hours</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- START BUTTON -->
                                    <?php
                                    if(strtotime($assignment["close_datetime"]) > time() || $assignment["close_datetime"] == NULL) 
                                    echo '
                                    <div class="t-center">
                                        <button class="blue" id="start" style="margin: 0px 10px;">Start</button>
                                    </div>
                                    '?>
                                </div>

                                <br>

                                <!-- INSTRUCTIONS -->
                                <p><?= $assignment["assignment_instruction"] ?></p>

                            </div>
                        </div>
                        <br>

                        <div id="questions" class="mx-20" style="display: none;">
                            <form enctype="multipart/form-data" method="POST" action="../../backend/student/send_assignment_response.php">
                            <input type="number" class="hidden" name="assignment_id" value="<?= $assignment_id ?>" required>
                            <?php if($assignment["submission_type"] == "FILE_UPLOAD"): ?>
                            <label for="file">Upload your assignment</label>    
                            <input type="file" id="file" name="file" required>
                            <?php endif ?>
                            <?php if($assignment["submission_type"] == "TEXTBOX"): ?>
                            <h4>Answer:</h4>
                            <textarea name="reply" id="text" cols="30" class="full-width" rows="10" style="margin: 0px"></textarea>
                            <?php endif ?>
                            <div class="mx-20 t-end">
                                <button class="blue" type="submit">Submit</button>
                            </div>
                            </form>
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
        $("#start").click((e) => {
            $("#questions").show();
            $(e.currentTarget).hide();
        });
    </script>
</body>
</html>