<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

if ($_SESSION["role"] != "TEACHER")
    header("location: assignments.php");

if (!isset($_GET['id']))
    header("location: assignments.php");

$assignment_id = $_GET['id'];
$_SESSION['sg_id'] = mysqli_fetch_assoc($db->query("SELECT sg_id FROM assignments WHERE id = " . $_GET['id']))['sg_id'];

$assignment = mysqli_fetch_assoc($db->query("SELECT assignment_title, max_score FROM assignments WHERE id = " . $assignment_id));
$course_name = mysqli_fetch_assoc($db->query("SELECT subject_group_name FROM subject_group WHERE id = " . $_SESSION['sg_id']))['subject_group_name'];

$assignment_responses = $db->query("SELECT * FROM assignment_responses WHERE assignment_id = " . $assignment_id);

date_default_timezone_set("Asia/Manila");

$view = "";
if (!isset($_GET["view"])) {
    $view = "grid";
} else {
    $view = $_GET["view"];
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- EXTERNAL CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <title>E-Learning Management System</title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
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
                            <div class="flex space-between centered-align">
                                <h2><?= $assignment['assignment_title'] ?></h2>
                                <div class="flex">
                                    <button class="blue centered-align" style="height: 40px;">Download All Responses</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php if ($view == "grid") : ?>
                                        <a href="view-responses-assignments.php?id=<?= $assignment_id ?>&view=table">
                                            <button class="blue centered-align" style="height: 40px;">
                                                Table View &nbsp;&nbsp;
                                                <img src="../images/table.png" alt="menu" style="width: 16px;">
                                            </button>
                                        </a>
                                    <?php elseif ($view == "table") : ?>
                                        <a href="view-responses-assignments.php?id=<?= $assignment_id ?>&view=grid">
                                            <button class="blue centered-align" style="height: 40px;">
                                                Grid View &nbsp;&nbsp;
                                                <img src="../images/grid.png" alt="menu" style="width: 16px;">
                                            </button>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>

                            <!-- GRID VIEW -->
                            <?php if ($view == "grid") : ?>
                                <?php if ($assignment_responses->num_rows > 0) : ?>
                                    <?php foreach ($assignment_responses as $response) : ?>
                                        <?php $student = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = " . $response['student_id'])); ?>
                                        <a href="done-assignment.php?id=<?= $response['id'] ?>">
                                            <div class="white flex" style="padding: 10px">
                                                <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                                    <!-- PROFILE PICTURE -->
                                                    <img src="../images/<?= $student['pp_location'] ?>" class="logo" alt="logo">
                                                </div>

                                                <div class="flex space-between full-width" style="margin: 0px 10px;">
                                                    <div>
                                                        <h4></h4>
                                                        <p><?= date("F d, Y h:i A", strtotime($response["created_on"])) ?></p>
                                                    </div>
                                                    <div class="t-end">
                                                        <h4><?= $response['response_score'] != NULL ? $response['response_score'] : "unchecked" ?> / <?= $assignment['max_score'] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <br>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="centered-align"><?= $student['fname'] ?> <?= $student['lname'] ?>
                                        <h3>No Response Recorded Yet</h3>
                                    </div>
                                <?php endif ?>
                            <?php elseif ($view == "table") : ?>
                                <!-- TABLE VIEW -->
                                <br><br>
                                <table>
                                    <tr>
                                        <th style="width: 25%">Student</th>
                                        <th style="width: 25%">Date Submitted</th>
                                        <th style="width: 25%">Score</th>
                                        <th style="width: 25%">Percentage</th>
                                    </tr>
                                    <!-- LOOP DEPENDING ON ACTIVTIES -->
                                    <?php if ($assignment_responses->num_rows > 0) : ?>
                                        <?php foreach ($assignment_responses as $response) : ?>
                                            <?php $student = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = " . $response['student_id'])); ?>
                                            <tr>
                                                <td style="width: 25%; text-align: center;"><?= $student['fname'] ?> <?= $student['lname'] ?>(<?= $student['id'] ?>)</td>
                                                <td style="width: 25%; text-align: center;"><?= date("F d, Y", strtotime($response["created_on"])) ?> <br> <?= date("h:i A", strtotime($response["created_on"])) ?></td>
                                                <td style="width: 25%; text-align: center;">
                                                    <input type="number" class="white" name="minute" style="height: 15px; width: 15px" value="<?= $response['response_score'] ?>" min="0" max="<?= $assignment['max_score'] ?>" required>
                                                    / <?= $assignment['max_score'] ?>
                                                </td>
                                                <?php
                                                $percent = "TBD";
                                                if($response['response_score'] != NULL){
                                                    $percent = ($response['response_score'] / $assignment['max_score']) * 100 . "%";
                                                }
                                                ?>
                                                <td style="width: 25%; text-align: center;"><?= $percent ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <div class="centered-align">
                                            <h3>No Response Recorded Yet</h3>
                                        </div>
                                    <?php endif ?>
                                </table>
                                <br>
                                <div class="t-end">
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
</body>

</html>