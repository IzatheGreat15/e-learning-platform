<?php
    include("../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");

    $announcement_query = "SELECT * FROM admin_announcements WHERE id = ".$_GET['id'];
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

        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <?php include "pages/navbar.php" ?>
            </div>

            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>Admin Announcements</h1>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                </div>

                <hr>

                <br>

                <!-- CONTENT -->
                <div class="flex mobile">
                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        <!-- ONE ANNOUNCEMENT -->
                        <?php if($db->query($announcement_query)->num_rows > 0 ): ?>
                        <?php foreach($db->query($announcement_query) as $announcement): ?>
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <?= $announcement["announcement_title"] ?>
                                </div>
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
                        <?php else: ?>
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
                    <?php include "pages/navbar.php" ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script>
        $(".btn").click((e) => {
            $("#modal-delete").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            $("#name").text(title);
        });

        $(".add").click((e) => {
            location.replace("admin-announcements.php?mode=add");
        });

        $(".del").click((e) => {
            $("#del-val").val(e.currentTarget.id);
            console.log($("#del-val").val());
        });
    </script>
</body>
</html>