<?php
    include("../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: index.php");

    $thread_id = $_GET['id'];

    $message_query = "SELECT * FROM messages WHERE thread_id = ".$thread_id;
    $sender_query = "SELECT * FROM users where id = ";
    $messages = $db->query($message_query);
    $thread = mysqli_fetch_assoc($db->query("SELECT thread_subject FROM threads where id = ".$_GET['id']));
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
                        <h1><?= $thread['thread_subject'] ?></h1>
                    </div>
                </div>

                <hr>
                <br>

                <!-- CONTENT OF PAGE -->
                <?php foreach($messages as $message): ?>
                <?php $sender = mysqli_fetch_assoc($db->query($sender_query.$message['sender_id'])) ?>
                <div class="full-width flex-col">
                    <div class="white flex-mobile" style="padding: 10px;">
                        <div class="flex">
                            <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                <!-- PROFILE PICTURE -->
                                <img src="images/student.png" class="logo" alt="logo">
                            </div>

                            <div class="flex flex-col full-width" style="margin: 0px 10px;">
                                <h5><?= date("F d, Y h:i A", strtotime($message["created_on"])) ?></h5>
                                <div class="flex space-between flex-mobile" style="margin: -40px 0px -20px 0px;">
                                    <p><?= $sender['fname'].' '.$sender['lname'] ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- SHOW ENTIRE MESSAGE -->
                        <p class="text-justify"><?= $message['message_body'] ?></p>
                    </div>
                </div>
                <br>
                <?php endforeach ?>

                <!-- REPLY BUTTON -->
                <div class="white" style="margin-top: -2px;">
                    <button class="reply">Reply</button>
                </div>
                <br>

                <!-- REPLY FIELD -->
                <div class="flex-col white content" style="margin-bottom: 15px; display:none" id="reply-field">
                    <form method="POST" action="../backend/messaging/send_message.php">
                        <input type="number" name="thread_id" style="display:none;" value="<?php echo $_GET['id'] ?>">
                        <textarea name="reply" id="" cols="30" class="full-width" rows="10" style="margin: 20px 0px"></textarea>
                        <div class="t-end" style="margin-bottom: 10px">
                            <button class="blue" type="submit">Reply</button>
                        </div>
                    </form>
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
        $(".reply").click(() => {
            $("#reply-field").slideToggle();
        });
    </script>
</body>

</html>