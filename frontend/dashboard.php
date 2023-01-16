<?php
    include("../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: index.php");

    if($_SESSION["role"] == "ADMIN" || $_SESSION["role"] == "REGISTRAR")
      header("location: admin/dashboard.php");

    if($_SESSION['role'] == "STUDENT"){
        $curr_query = "SELECT a.id AS a_id, sg.id AS sg_id, max_score, assignment_title, close_datetime, subject_group_name FROM assignments AS a LEFT JOIN subject_group AS sg ON a.sg_id = sg.id LEFT JOIN sections AS s ON s.id = sg.section_id LEFT JOIN enrollments AS e ON e.section_id = s.id WHERE CAST(a.close_datetime AS DATE) = CAST(CURRENT_TIMESTAMP AS DATE) AND a.id NOT IN (SELECT assignment_id FROM assignment_responses WHERE student_id = ".$_SESSION['user_id'].") AND e.student_id = ".$_SESSION['user_id']." LIMIT 3";
        $announcement_query = "SELECT sa.announcement_title, sa.created_on, sa.id AS sa_id, sg.id AS sg_id, sg.subject_group_name FROM subject_announcements AS sa LEFT JOIN subject_group AS sg ON sa.announcer_id = sg.id LEFT JOIN sections AS s ON s.id = sg.section_id LEFT JOIN enrollments AS e ON e.section_id = s.id WHERE e.student_id = ".$_SESSION['user_id']." UNION SELECT announcement_title, created_on, id AS sa_id, 0 AS sg_id, 'Admin' AS subject_group_name FROM admin_announcements ORDER BY created_on DESC LIMIT 3";
        $future_query  = "SELECT a.id AS a_id, sg.id AS sg_id, max_score, assignment_title, close_datetime, subject_group_name FROM assignments AS a LEFT JOIN subject_group AS sg ON a.sg_id = sg.id LEFT JOIN sections AS s ON s.id = sg.section_id LEFT JOIN enrollments AS e ON e.section_id = s.id WHERE a.id NOT IN (SELECT assignment_id FROM assignment_responses WHERE student_id = ".$_SESSION['user_id'].") AND e.student_id = ".$_SESSION['user_id']." LIMIT 3";
    }else{
        $curr_query = "SELECT a.id AS a_id, sg.id AS sg_id, max_score, assignment_title, close_datetime, subject_group_name FROM assignments AS a LEFT JOIN subject_group AS sg ON a.sg_id = sg.id WHERE CAST(a.close_datetime AS DATE) = CAST(CURRENT_TIMESTAMP AS DATE) AND sg.teacher_id = ".$_SESSION['user_id'];
        $announcement_query = "SELECT sa.announcement_title, sa.created_on, sa.id AS sa_id, sg.id AS sg_id, sg.subject_group_name FROM subject_announcements AS sa LEFT JOIN subject_group AS sg ON sa.announcer_id = sg.id WHERE sg.teacher_id = ".$_SESSION['user_id'];
        $future_query = "SELECT a.id AS a_id, sg.id AS sg_id, max_score, assignment_title, close_datetime, subject_group_name FROM assignments AS a LEFT JOIN subject_group AS sg ON a.sg_id = sg.id WHERE sg.teacher_id = ".$_SESSION['user_id']." LIMIT 3";
    }
    
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
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <title>E-Learning Management System</title>
</head>
<body>
    <div class="body-container flex-col">
        <!-- TOP NAVIGATION BAR -->
        <?php include "pages/topnavbar.php" ?>

        <p id="current" class="hidden">document</p>

        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <?php include "pages/navbar.php" ?>
            </div>
            
            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <h1>Dashboard</h1>

                <a href="../backend/logout.php"><p id="current" class="">Logout</p></a>

                <div class="flex column-container">
                    <div class="column">
                        <h3>Today</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <?php $activities = $db->query($curr_query) ?>
                        <?php if($activities->num_rows > 0): ?>
                        <?php foreach($activities as $activity): ?>
                        <a href="courses/assignment.php?id=<?= $activity["a_id"] ?>">
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.<?= $activity["sg_id"] ?> - <?= $activity["subject_group_name"] ?></p>
                                </div>
                                <div class="column t-end big-text">
                                    <p><?= $activity["max_score"] ?> pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p><?= $activity["assignment_title"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: <?= date("F d, Y - h:i A", strtotime($activity["close_datetime"])) ?></p>
                                </div>
                            </div>
                        </div>
                        </a>
                        <?php endforeach ?>
                        <?php else: ?>
                            <div class="centered-align">
                            <h3>No Assignment for Today</h3>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="column">
                        <!-- ANNOUNCEMENTS - LIMIT TO 3 -->
                        <h3>Announcements</h3>
                        <hr>
                        <?php $announcements = $db->query($announcement_query) ?>
                        <?php if($announcements->num_rows > 0): ?>
                        <?php foreach($announcements as $announcement): ?>
                        <?php if($announcement['sg_id'] != 0): ?>    
                        <a href="courses/announcements.php?id=<?= $announcement["sg_id"] ?>&aid=<?= $announcement["sa_id"] ?>">
                        <?php else: ?> 
                        <a href="announcements-admin.php?id=<?= $announcement["sa_id"] ?>">
                        <?php endif ?>
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p><?= $announcement["sg_id"] == 0 ? 'Message from ' : "Course No. ".$announcement["sg_id"]." - " ?><?= $announcement["subject_group_name"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -30px;">
                                <div class="column big-text">
                                    <p><?= $announcement["announcement_title"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Posted: <?= date("F d, Y - h:i A", strtotime($announcement["created_on"])) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php else: ?>
                            <div class="centered-align">
                            <h3>No Announcement</h3>
                            </div>
                        <?php endif ?>

                        <!-- UPCOMING ASSIGNMENTS - LIMIT TO 3 -->
                        <h3>Upcoming Assignments</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <?php $activities = $db->query($future_query) ?>
                        <?php if($activities->num_rows > 0): ?>
                        <?php foreach($activities as $activity): ?>
                        <a href="courses/assignment.php?id=<?= $activity["a_id"] ?>">
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.<?= $activity["sg_id"] ?> - <?= $activity["subject_group_name"] ?></p>
                                </div>
                                <div class="column t-end big-text">
                                    <p><?= $activity["max_score"] ?> pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p><?= $activity["assignment_title"] ?></p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: <?= $activity["close_datetime"] == NULL ? 'Not Set' : date("F d, Y - h:i A", strtotime($activity["close_datetime"])) ?></p>
                                </div>
                            </div>
                        </div>
                        </a>
                        <?php endforeach ?>
                        <?php else: ?>
                            <div class="centered-align">
                            <h3>No Assignment</h3>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "pages/navbar.php" ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/navbar.js"></script>
<?php include_once 'css/unverified.php' ?>
</body>
</html>