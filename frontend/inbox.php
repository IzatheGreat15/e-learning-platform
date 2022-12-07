<?php
    include("../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: ../index.php");

    $thread_query = "SELECT * FROM threads WHERE respondent1_id = ".$_SESSION['user_id']." OR respondent2_id = ".$_SESSION['user_id'];
    $threads = $db->query($thread_query);
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
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
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
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>Inbox</h1>
                    </div>
                    <div class="column t-end">
                        <button class="blue compose" style="margin-top: 25px;">
                            <div class="flex">
                                <img src="images/attachment-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                <div>
                                    Compose
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <hr>
                <br>

                <!-- CONTENT OF PAGE -->
                <div class="full-width flex-col">
                <?php if($threads != FALSE): ?>
                <?php foreach($threads as $thread): ?>
                <a href="view-message.php?id=<?= $thread["id"] ?>">
                    <div class="white flex" style="padding: 10px">
                        <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                            <!-- PROFILE PICTURE -->
                            <img src="images/student.png" class="logo" alt="logo">
                        </div>

                        <div class="flex flex-col full-width" style="margin: 0px 10px;">
                            <h5>Sender Name</h5>
                            <div class="flex space-between" style="margin: -40px 0px -20px 0px;">
                                <h4><?= $thread["thread_subject"] ?></h4>
                                <?php $other_respondent = $thread['respondent1_id'] == $_SESSION['user_id'] ? $thread['respondent2_id'] : $thread['respondent1_id'];?>
                                <?php $m = mysqli_fetch_assoc($db->query("SELECT * FROM messages WHERE thread_id = ".$thread['id']." ORDER BY created_on DESC")) ?>
                                <p><?= date("F d, Y h:mA", strtotime($m["created_on"])) ?></p>
                            </div>
                            <!-- LIMIT MESSAGE LENGTH -->
                            <p class="text-justify"><?php if($m['sender_id'] == $_SESSION['user_id']) echo "Me: "; ?> <?php echo $m['message_body']; ?></p>
                        </div>
                    </div>
                </a>
                <?php endforeach ?>
                <?php endif ?>
                <?php if($threads == FALSE): ?>

                <?php endif ?>
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
    <script>
        $(".compose").click(() => {
            window.location.replace("compose.php");
        });
    </script>
</body>

</html>