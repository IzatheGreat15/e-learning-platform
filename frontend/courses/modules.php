<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");

    if(!isset($_SESSION["sg_id"]))
      header("location: ../courses.php");

    foreach($db->query("SELECT subject_id FROM subject_group WHERE id = ".$_SESSION['sg_id']) as $subject){
        $subject_id = $subject['subject_id'];
    }
      
    $course_name_query = "SELECT * FROM subject_group WHERE id = ".$_SESSION['sg_id'];

    $module_query = "SELECT id, module_title FROM modules WHERE subject_id = ".$subject_id;

    $page_query = "SELECT id, lesson_title  FROM lessons WHERE module_id = ";
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
                        <?php foreach($db->query($course_name_query) as $course_name): ?>
                            <h1><?= $course_name["subject_group_name"] ?></h1>
                        <?php endforeach ?>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <?php if($_SESSION['role'] == "TEACHER")
                    echo'
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
                    '?>
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
                        <!-- ONE MODULE -->
                        <?php $modules = $db->query($module_query) ?>
                        <?php if($modules->num_rows > 0): ?>
                        <?php foreach($modules as $module): ?>
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <img src="../images/down-white.png" class="down" alt="">
                                    <?= $module["module_title"] ?>
                                </div>
                                <!-- FOR TEACHERS ONLY - EDIT BUTTON -->
                                <div class="centered-align">
                                <?php if($_SESSION['role'] == "TEACHER")
                                    echo'
                                    <div class="btn">
                                        <img src="../images/x-white.png" class="small delete" alt="edit" style="width: 20px;" id="'.$module["id"].'">
                                    </div>
                                    '
                                ?>
                                </div>
                            </div>

                            <?php $lessons = $db->query($page_query.$module['id']) ?>
                            <?php if($lessons->num_rows > 0): ?>
                            <?php foreach($lessons as $lesson): ?>
                            <div class="lesson">
                                <div class="white p-5" style="margin-top: -2px;">
                                    <a href="lesson.php?id=<?= $lesson['id'] ?>" class="link text p-5"><?= $lesson['lesson_title'] ?></a>
                                </div>
                            </div>
                            <?php endforeach ?>
                            <?php else: ?>
                                <div class="centered-align">
                                <h3>Module Empty</h3>
                                </div>
                            <?php endif ?>
                        </div>
                        <br>
                        <?php endforeach ?>
                        <?php else: ?>
                            <div class="centered-align">
                            <h3>No Module Available</h3>
                            </div>
                        <?php endif ?>

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

    <!-- MODAL FOR DELETE MODULE -->
    <div id="modal-delete" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to remove <span id="name"></span>?</h3>
                <form action="../../backend/teacher/delete_module.php" method="POST">
                    <input type="hidden" name="id" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="navbar.js"></script>
    <script type="text/javascript" src="../js/modal.js"></script>
    <script>
        $(".add").click((e) => {
            location.replace("admin-modules.php?mode=add");
        });
        $(".edit").click((e) => {
            location.replace("admin-modules.php?mode=edit&id=?");
        });
        $(".delete").click((e) => {
            $("#modal-delete").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            var id = $(e.currentTarget).attr("id");

            $("#name").text(title);
            $("input[name='id']").val(id);
        });
    </script>
</body>
</html>