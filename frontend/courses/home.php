<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: index.php");

if (isset($_GET['id'])) {
    $_SESSION['sg_id'] = $_GET['id'];
}

$course_name_query = "SELECT * FROM subject_group WHERE id = " . $_SESSION['sg_id'];
$course = mysqli_fetch_assoc($db->query("SELECT subjects.* FROM subject_group JOIN subjects ON subjects.id = subject_group.subject_id WHERE subject_group.id = " . $_SESSION['sg_id']));

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
                            <?php $id = $course_name["subject_id"] ?>
                        <?php endforeach ?>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <!-- ONLY IF THE TEACHER IS THE SUBJECT COORDINATOR OF THE SUBJECT -->
                    <?php if ($_SESSION['user_id'] == $course['teacher_id']) : ?>
                        <div class="column t-end">
                            <button class="blue edit" style="margin-top: 25px;">
                                Edit
                            </button>
                        </div>
                    <?php endif ?>
                </div>
                <hr>
                <br>
                <!-- CONTENT -->
                <div class="flex mobile">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>

                    <!-- CONTENT OF PAGE -->
                    <div class="centered-align t-center full-width flex-col">
                        <!-- depends on the teacher -->
                        <?php foreach ($db->query($course_name_query) as $course_name) : ?>
                            <h1>WELCOME TO <?= $course_name["subject_group_name"] ?></h1>
                        <?php endforeach ?>
                        <button class="blue started">Get Started</button>
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
<!-- MODAL FOR UNVERIFIED ACCOUNTS -->
<!-- ONLY IF THE ACCOUNT IS NOT YET VERIFIED -->
<?php if($_SESSION["isVerified"] == "FALSE"): ?>
<div id="modal-delete" class="modal-bg" style="display: block; z-index: 300">
    <div class="modal-body">
        <span class="close">&times;</span>
        <div class="centered-align flex-col">
            <h3>Your account has not yet been verified.</h3>
            <form action="<?= $url ?>backend/send_verification_email.php" method="POST">
                <input type="hidden" name="email" value="<?= mysqli_fetch_assoc($db->query("SELECT email FROM users WHERE id = ".$_SESSION['user_id']))['email'] ?>">
                <button type="submit" name="submit" class="blue">VERIFY ACCOUNT</button>
            </form>
        </div>
    </div>
</div>
<?php endif ?>
    

    <script type="text/javascript" src="navbar.js"></script>
    <script>
        $(".started").click(() => {
            window.location.href = "modules.php?id=";
        });

        $(".edit").click((e) => {
            var id = "<?= $id ?>";
            location.href = "../admin/admin-courses.php?id="+id;
        });
    </script>
<?php include_once '../css/unverified.php' ?>
</body>

</html>