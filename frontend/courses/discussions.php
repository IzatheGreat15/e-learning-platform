<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

if (!isset($_SESSION["sg_id"]))
    header("location: ../courses.php");

$clause = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "deleted_on IS NOT NULL" : "deleted_on IS NULL";
$discussion_query = "SELECT id, discussion_title, discussion_instruction, created_on FROM discussions WHERE " . $clause . " AND sg_id = " . $_SESSION['sg_id'];
$course_name_query = "SELECT subject_group_name FROM subject_group WHERE id = " . $_SESSION['sg_id'];
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
                        <?php endforeach ?>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <?php if ($_SESSION['role'] == "TEACHER")
                        echo '
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
                    ' ?>
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
                        <div class="mx-20 t-end">
                            <?php
                            $url = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "discussions.php" : "discussions.php?type=archived";
                            $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "Active" : "Archived";
                            ?>
                            <a href="<?= $url ?>"><button class="blue" type="button"><?= $btn ?></button></a>
                        </div>
                        <br>
                        <!-- ONE DISCUSSION -->
                        <?php $discussions = $db->query($discussion_query) ?>
                        <?php if ($discussions->num_rows > 0) : ?>
                            <?php foreach ($discussions as $discussion) : ?>
                                <div class="flex-col mx-20">
                                    <div class="left-align blue">
                                        <div class="p-10 text">
                                            <a href="discussion.php?id=<?= $discussion["id"] ?>" style="color: white;" class="title"><?= $discussion["discussion_title"] ?></a>
                                        </div>
                                        <!-- FOR TEACHERS ONLY - DELETE BUTTON -->
                                        <?php if ($_SESSION['role'] == "TEACHER") : ?>
                                            <div class="centered-align">
                                                <div class="btn">
                                                    <?php $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "restore" : "x-white"; 
                                                    $class = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "res-btn" : "del-btn"?>
                                                    <img src="../images/<?= $btn ?>.png" class="small <?= $class ?>" alt="delete" style="width: 20px; height: 20px;" id="<?= $discussion["id"] ?>">
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="white p-5 text-justify content">
                                        <!-- LIMIT CHARACTERS -->
                                        <p><?= $discussion["discussion_instruction"] ?></p>
                                        <p class="t-end bold">Posted on:</p>
                                        <p class="t-end"><?= date("F d, Y h:i A", strtotime($discussion["created_on"])) ?></p>
                                    </div>
                                </div>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="centered-align">
                                <h3>No Discussion</h3>
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

    <!-- MODAL FOR DELETE DISCUSSION -->
    <div id="modal-delete" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to archive <span class="name"></span>?</h3>
                <form action="../../backend/teacher/delete_discussion.php" method="POST">
                    <input type="hidden" name="id" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL FOR RESTORE DISCUSSION -->
    <div id="modal-restore" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to restore <span class="name"></span>?</h3>
                <form action="../../backend/teacher/restore_discussion.php" method="POST">
                    <input type="hidden" name="id" id="del-val" value="">
                    <a href="#" id="restore"><button type="button" name="submit" class="blue">YES</button></a>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="navbar.js"></script>
    <script type="text/javascript" src="../js/modal.js"></script>
    <script>
        $(".del-btn").click((e) => {
            $("#modal-delete").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            var id = $(e.currentTarget).attr("id");

            $(".name").text(title);
            $("input[name='id']").val(id);
        });

        $(".res-btn").click((e) => {
            $("#modal-restore").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            var id = $(e.currentTarget).attr("id");

            $(".name").text(title);
            $("#restore").attr("href", "../../backend/teacher/restore_discussion.php?id=" + $(e.currentTarget).attr("id"));
        });

        $(".add").click((e) => {
            location.href = "admin-discussions.php?mode=add";
        });
    </script>
<?php include_once '../css/unverified.php' ?>
</body>

</html>