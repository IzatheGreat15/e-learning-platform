<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: index.php");

    if($_SESSION["role"] != "ADMIN")
      header("location: ../courses.php");

    if(isset($_GET['id'])){
        $course = mysqli_fetch_assoc($db->query("SELECT * FROM subjects WHERE id = ".$_GET['id']));
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

                <p id="current" class="hidden">document</p>

                <!-- CONTENT -->
                <div class="flex flex-col" style="margin-top: 5%;">
                    <form action="<?= !isset($_GET['id']) ? "../../backend/admin/create_subjects.php" : "../../backend/admin/update_subjects.php" ?>" class="flex-col mx-20" method="POST">
                        <input type="text" class="border-bottom px-10" name="title" placeholder="Course" value="<?= isset($_GET['id']) ? $course['subject_name'] : '' ?>">
                        <input type="number" class="hidden" name="subject_id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
                        <br>

                        <label for="">Grade Level:</label>
                        <select name="grade_level" id="" class="white rounded-corners px-10">
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '<option value="' . $x . '">' . $x . '</option>';
                            }
                            ?>
                        </select>
                        <br>

                        <label for="">Subject Coordinator:</label>
                        <select name="teacher" id="" class="white rounded-corners px-10">
                            <?php foreach($db->query('SELECT * FROM users WHERE role = "TEACHER"') as $teacher): ?>
                                <option value="<?= $teacher['id'] ?>" <?= $teacher['id'] == $course['teacher_id'] ? "selected" : "" ?>><?= $teacher['fname'] ?> <?= $teacher['lname'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <br>
                        
                        <?php if(isset($_GET['id'])): ?>
                        <label for="">Subject Groups:</label>
                        <div class="flex flex-col">
                            <!-- INDIVIDUAL SUBJECT GROUP -->
                            <table class="whole">
                                <?php foreach($db->query("SELECT * FROM subject_group WHERE subject_id = ".$_GET['id']) as $sg): ?>
                                <?php 
                                    $section = mysqli_fetch_assoc($db->query("SELECT * FROM sections WHERE id = ".$sg['section_id']));
                                    $teacher = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = ".$sg['teacher_id']));
                                ?>
                                <tr class="t-center sg" id="<?= $sg['id'] ?>">
                                    <td style="width: 33%;"><p><?= $sg['subject_group_name'] ?></p></td>
                                    <td style="width: 33%;"><p>Grade <?= $section['year_level'] ?> - Section <?= $section['section_name'] ?></p></td>
                                    <td style="width: 33%;"><p>Teacher <?= $teacher['fname'] ?> <?= $teacher['lname'] ?></p></td>
                                </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                        <?php endif ?>

                        <br>
                        <div class="flex full-width">
                            <button class="blue half-width mx-small">Save</button>
                            <button class="bg-danger half-width mx-small">Delete</button>
                        </div>
                    </form>
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

    <script src="navbar.js"></script>
    <script>
        $(".sg").click((e) => {
            var id = $(e.currentTarget).attr("id");

            location.replace("course-groups.php?id="+id);
        });
    </script>
</body>

</html>