<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

$clause = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "deleted_on IS NOT NULL" : "deleted_on IS NULL";
$announcement_query = "SELECT * FROM admin_announcements WHERE " . $clause;
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
                        <h1>Announcements</h1>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <?php if ($_SESSION['role'] == "ADMIN")
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
                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        <div class="mx-20 t-end">
                            <?php
                            $url = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "announcements.php" : "announcements.php?type=archived";
                            $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "Active" : "Archived";
                            ?>
                            <a href="<?= $url ?>"><button class="blue" type="button"><?= $btn ?></button></a>
                        </div>
                        <br>
                        <!-- ONE ANNOUNCEMENT -->
                        <?php if ($db->query($announcement_query)->num_rows > 0) : ?>
                            <?php foreach ($db->query($announcement_query) as $announcement) : ?>
                                <div class="flex-col mx-20">
                                    <div class="left-align blue">
                                        <div class="p-10 text title">
                                            <?= $announcement["announcement_title"] ?>
                                        </div>
                                        <!-- FOR ADMIN ONLY - DELETE BUTTON -->
                                        <?php if ($_SESSION['role'] == "ADMIN") : ?>
                                            <div class="centered-align">
                                                <?php $class = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "res-btn" : "del-btn" ?>
                                                <div class="<?= $class ?> p-10">
                                                    <?php $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "restore" : "x-white"; ?>
                                                    <img src="../images/<?= $btn ?>.png" class="small del" alt="delete" style="width: 20px; height: 20px;" id="<?= $announcement['id'] ?>">
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="white p-5 text-justify content">
                                        <!-- SHOW ENTIRE TEXT -->
                                        <p><?= $announcement["announcement_body"] ?></p>
                                        <p class="t-end bold">Posted on:</p>
                                        <p class="t-end"><?= date("F d, Y h:i A", strtotime($announcement["created_on"])) ?></p>
                                    </div>
                                </div>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="centered-align">
                                <h3>No Announcment Given Yet</h3>
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

    <!-- MODAL FOR DELETE ANNOUNCEMENT -->
    <div id="modal-delete" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to archive <span id="name"></span>?</h3>
                <form action="../../backend/admin/delete_announcement.php" method="POST">
                    <input type="hidden" name="id" id="del-val" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL FOR RESTORE ANNOUNCEMENT -->
    <div id="modal-restore" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to restore <span class="name"></span>?</h3>
                <form action="../../backend/admin/restore_announcement.php" method="POST">
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
            $("#name").text(title);
            $("#del-val").val($(e.currentTarget).find("img").attr("id"));
        });

        $(".add").click((e) => {
            location.href = "admin-announcements.php?mode=add";
        });

        $(".res-btn").click((e) => {
            $("#modal-restore").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            $(".name").text(title);
            $("#restore").attr("href", "../../backend/admin/restore_announcement.php?id="+ $(e.currentTarget).find("img").attr("id"));
        });
    </script>
</body>

</html>