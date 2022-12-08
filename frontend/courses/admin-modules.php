<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: ../index.php");

    if($_SESSION["role"] != "TEACHER")
      header("location: modules.php");
 
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
                <div class="flex mobile">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        <!-- ONE DISCUSSION -->
                        <form action="../../backend/teacher/create_module.php" class="flex-col mx-20" method="POST" enctype="multipart/form-data">
                            <input type="text" class="border-bottom" name="module_title" placeholder="Module Name">
                            <input type="number" id="l_count" class="hidden" name="lesson_count" value="1">
                            <br>

                            <div class="flex flex-col modules">
                                <div class="indiv">
                                    <div class="flex space-between">
                                        <input type="text" class="border-bottom full-width" name="lesson_title[]" placeholder="Lesson Name">
                                        <input type="number" class="hidden" name="file_count[]" value="1">
                                        <img src="../images/add.png" alt="add" class="transparent-btn mod-add" style="width: 20px; height: 20px">
                                        <img src="../images/minus.png" alt="minus" class="transparent-btn mod-remove" style="width: 22px; height: 22px; margin-top: -1px;">
                                    </div>
                                    <div class="files flex flex-col">
                                        <input type="file" name="lesson_file[]">
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <br>

                            <div class="flex centered-align">
                                <button class="transparent-btn add" type="button">Add lesson</button>
                                <button class="transparent-btn remove" type="button">Remove lesson</button>
                            </div>

                            <br>
                            <button class="blue" type="submit">Publish</button>
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
        var lesson_count;
        $(document).on("click", ".add", (e) => {
            $(".modules")
                .append('<div class="indiv">' +
                        '<div class="flex space-between">' +
                            '<input type="text" class="border-bottom full-width" name="lesson_title[]" placeholder="Lesson Name">' +
                            '<input type="number" class="hidden" name="file_count[]" value="1">' +
                            '<img src="../images/add.png" alt="add" class="transparent-btn mod-add" style="width: 20px; height: 20px">' +
                            '<img src="../images/minus.png" alt="minus" class="transparent-btn mod-remove" style="width: 22px; height: 22px; margin-top: -1px;">' +
                        '</div>' +
                        '<div class="files flex flex-col">' +
                            '<input type="file" name="lesson_file[]">' +
                        '</div>' +
                        '<br>' +
                    '</div>');
            lesson_count = parseInt($("#l_count").val());
            $("#l_count").val(lesson_count + 1);
        });

        // REMOVE LESSONS IN MODULE
        $(document).on("click", ".remove", (e) => {
            var modules = $(".modules").find(".indiv").length;

            if (modules > 1) {
                $(".modules").children().last().remove();
                lesson_count = parseInt($("#l_count").val());
                $("#l_count").val(lesson_count - 1);
            } else {
                alert("There should atleast be 1 lesson in the module");
            }
        });

        var file_count;
        // ADD FILES IN LESSON
        $(document).on("click", ".mod-add", (e) => {
            $(e.currentTarget).parent("div").parent("div").find(".files")
                .append("<input type='file' name='lesson_file[]'>");
            file_count = parseInt($(e.currentTarget).parent("div").parent("div").find(".hidden").val());
            $(e.currentTarget).parent("div").parent("div").find(".hidden").val(file_count + 1);
        });

        // REMOVE FILES IN LESSON
        $(document).on("click", ".mod-remove", (e) => {
            var files = $(e.currentTarget).parent("div").parent("div").find(".files").find("*").length;

            if (files > 1) {
                $(e.currentTarget).parent("div").parent("div").find(".files").children().last().remove();
                file_count = parseInt($(e.currentTarget).parent("div").parent("div").find(".hidden").val());
                $(e.currentTarget).parent("div").parent("div").find(".hidden").val(file_count - 1);
            } else {
                alert("There should atleast be 1 file in the lesson");
            }
        });
    </script>
</body>

</html>