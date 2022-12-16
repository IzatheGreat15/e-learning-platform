<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../index.php");

    if(!isset($_SESSION["sg_id"]))
        header("location: ../courses.php");   

    if($_SESSION['role'] == "STUDENT"){
        $student_id = $_SESSION['user_id'];
    }else if($_SESSION['role'] == "TEACHER"){
        $student_id = $_GET['s_id'];
    }

    $sg_id = $_SESSION['sg_id'];

    $course_name = mysqli_fetch_assoc($db->query("SELECT * FROM subject_group WHERE id = ".$sg_id))['subject_group_name'];
    $student = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = ".$student_id));
    $activities_query = "
        SELECT a.id, a.assignment_title AS activity_name, 'assignment' AS activity_type, a.max_score AS perfect, a.created_on AS creation_date
        FROM assignments AS a 
        WHERE a.sg_id = ".$sg_id."
        UNION
        SELECT q.id, q.quiz_title AS activity_name, 'quiz' AS activtity_type, SUM(qi.max_score) AS perfect, q.created_on AS creation_date
        FROM quizzes AS q
        LEFT JOIN quiz_items AS qi ON qi.quiz_id = q.id 
        WHERE q.sg_id = ".$sg_id." GROUP BY q.id
        ORDER BY creation_date ASC";

    $total_perfect = 0;
    $total_current = 0;
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
                            <table>
                                <tr>
                                    <td>
                                        <h1><?= $student['fname'] ?> <?= $student['lname'] ?></h1>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 25%">Name</th>
                                    <th style="width: 25%">Date</th>
                                    <th style="width: 25%">Score</th>
                                    <th style="width: 25%">Total</th>
                                </tr>
                                <!-- LOOP DEPENDING ON ACTIVTIES -->
                                <?php $activities = $db->query($activities_query) ?>
                                <?php if($activities->num_rows > 0): ?>
                                <?php foreach($activities as $activity): ?>
                                <?php 
                                    $assignment_score_sql = "
                                    SELECT response_score AS score
                                    FROM assignment_responses AS qr
                                    WHERE assignment_id = ".$activity['id']." AND student_id = ".$student_id;

                                    $quiz_score_sql = "
                                    SELECT SUM(response_score) AS score
                                    FROM quiz_responses AS qr
                                    LEFT JOIN quiz_items AS qi ON qr.qi_id = qi.id
                                    WHERE qi.quiz_id = ".$activity['id']." AND qr.student_id = ".$student_id."
                                    GROUP BY qi.quiz_id";

                                    $query = $activity['activity_type'] == "quiz" ? $quiz_score_sql : $assignment_score_sql;

                                    $response = $db->query($query)->num_rows > 0 ? mysqli_fetch_assoc($db->query($query)) : NULL;
                                    if(isset($response['score'])){
                                        $total_current += $response['score']; 
                                        $total_perfect += $activity['perfect']; 
                                    }

                                ?>
                                <tr>
                                    <td style="width: 25%; text-align: center;"><a href="<?= $activity['activity_type'] ?>.php?id=<?= $activity['id'] ?>"> <?= $activity['activity_name'] ?></a></td>
                                    <td style="width: 25%; text-align: center;"><?= date("F d, Y", strtotime($activity['creation_date'])) ?></td>
                                    <td style="width: 25%; text-align: center;"><?= $response == NULL ? 'Unanswered...' : ($response['score'] == NULL ? 'Checking...' : $response['score']) ?></td>
                                    <td style="width: 25%; text-align: center;"><?= $activity['perfect'] ?></td>
                                </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td style="width: 25%; text-align: center;">Total</td>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"><?= $total_current ?></td>
                                    <td style="width: 25%; text-align: center;"><?= $total_perfect ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"><h3>Total: <?=  $total_perfect == 0 ? 'No Grade Yet' : number_format((float)$total_current / $total_perfect * 100, 2, '.', '').'%' ?></h3></td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" style="width: 100%; text-align: center;">
                                        <div class="centered-align">
                                            <h3>No Activty Recorded Yet</h3>
                                        </div> 
                                    </td>
                                </tr>
                                <?php endif ?>
                            </table>
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