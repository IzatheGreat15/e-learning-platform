<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: ../index.php");
    
    $discussion_id = $_GET['id'];

    $discussion_query = "SELECT id, discussion_title, discussion_instruction, created_on FROM discussions WHERE id = ".$discussion_id;
    $course_name_query = "SELECT subject_group_name FROM subject_group WHERE id = ".$_SESSION['sg_id'];
    $reply_query = "SELECT users.fname, users.lname, discussion_replies.reply_body, discussion_replies.created_on FROM discussion_replies JOIN users ON discussion_replies.student_id = users.id WHERE discussion_id = ".$discussion_id;
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
                    <?php foreach($db->query($discussion_query) as $discussion): ?>
                    <div class="full-width flex-col">
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <a href="discussion.php?id=<?= $discussion['id'] ?>" style="color: white;" class="title"><?= $discussion['discussion_title'] ?></a>
                                </div>
                                <!-- FOR TEACHERS ONLY - DELETE BUTTON -->
                                <?php if($_SESSION['role'] == "TEACHER")
                                echo'
                                <div class="centered-align">
                                    <div class="btn">
                                        <img src="../images/x-white.png" class="small" alt="delete" style="width: 20px;">
                                    </div>
                                </div>
                                '?>
                            </div>

                            <div class="white p-5 text-justify content">
                                <!-- SHOW ENTRIE TEXT -->
                                <p><?= $discussion['discussion_instruction'] ?></p>
                                <p class="t-end bold">Posted on:</p>
                                <p class="t-end"><?= date("F d, Y h:i A", strtotime($discussion["created_on"])) ?></p>
                            </div>
                            <div class="white" style="margin-top: -2px;">
                                <button class="reply">Reply</button>
                            </div>
                        </div>
                        <br>

                        <div class="flex-col mx-20 white content" style="margin-bottom: 15px; display:none" id="reply-field">
                            <form method="POST" action="../../backend/student/send_discussion_reply.php">
                                <input type="number" name="discussion_id" style="display:none;" value="<?= $discussion['id'] ?>">
                                <textarea name="reply" id="" cols="105" rows="10" style="margin: 20px 0px; resize: none" required></textarea>
                                <div class="t-end" style="margin-bottom: 10px">
                                    <button class="blue" type="submit">Reply</button>
                                </div>
                            </form>
                            
                        </div>
                        <?php endforeach ?>

                        <!-- REPLIES -->
                        <?php foreach($db->query($reply_query) as $reply): ?>
                        <div class="flex-col mx-20 white" style="margin-bottom: 15px;">
                            <div class="flex content" style="margin-top: 5px;">
                                <div class="img-container centered-align p-5 blue">
                                    <img src="../images/student.png" class="small" alt="logo">
                                </div>
                                <div>
                                    <h4><?= $reply['fname'] ?> <?= $reply['lname'] ?></h4>
                                </div>
                            </div>
                            <div class="text-justify content">
                                <p><?= $reply['reply_body'] ?></p>
                                <p class="t-end bold">Posted on:</p>
                                <p class="t-end"><?= date("F d, Y h:i A", strtotime($reply["created_on"])) ?></p>
                            </div>
                        </div>
                        <?php endforeach ?>
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
                <h3>Are you sure you want to archive <span id="name"></span>?</h3>
                <form action="" method="POST">
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
        // show reply option for discussion
        $(".reply").click(() => {
            $("#reply-field").slideToggle();
        });

        $(".btn").click((e) => {
            $("#modal-delete").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            $("#name").text(title);
        });
    </script>
<?php include_once '../css/unverified.php' ?>
</body>
</html>