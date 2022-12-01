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
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>English</h1>
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
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <a href="discussion.php?id=?" style="color: white;">Discussion Title</a>
                                </div>
                                <!-- FOR TEACHERS ONLY - DELETE BUTTON -->
                                <div class="centered-align">
                                    <div class="btn">
                                        <img src="../images/x-white.png" class="small" alt="delete" style="width: 20px;">
                                    </div>
                                </div>
                            </div>

                            <div class="white p-5 text-justify content">
                                <!-- SHOW ENTRIE TEXT -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p class="t-end bold">Posted on:</p>
                                <p class="t-end">November 18, 2022 11:59PM</p>
                            </div>
                            <div class="white" style="margin-top: -2px;">
                                <button class="reply">Reply</button>
                            </div>
                        </div>
                        <br>

                        <div class="flex-col mx-20 white content" style="margin-bottom: 15px; display: none;" id="reply-field">
                            <textarea name="reply" id="" cols="30" rows="10" style="margin: 20px 0px"></textarea>
                            <div class="t-end" style="margin-bottom: 10px">
                                <button class="blue">Reply</button>
                            </div>
                        </div>

                        <!-- REPLIES -->
                        <div class="flex-col mx-20 white" style="margin-bottom: 15px;">
                            <div class="flex content" style="margin-top: 5px;">
                                <div class="img-container centered-align p-5 blue">
                                    <img src="../images/student.png" class="small" alt="logo">
                                </div>
                                <div>
                                    <h4>John Doe</h4>
                                </div>
                            </div>
                            <div class="text-justify content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p class="t-end bold">Posted on:</p>
                                <p class="t-end">November 18, 2022 11:59PM</p>
                            </div>
                        </div>
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
    <script>
        // show reply option for discussion
        $(".reply").click(() => {
            $("#reply-field").slideToggle();
        });
    </script>
</body>
</html><!DOCTYPE html>
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
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>English</h1>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <div class="column t-end">
                        <button class="blue" style="margin-top: 25px;">
                            <div class="flex">
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                <div>
                                    Add
                                </div>
                            </div>
                        </button>
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
                        
                        <div class="flex-col mx-20">
                            <!-- ONE QUIZ -->
                            <div class="white p-5 text-justify content" style="position: relative; margin-bottom: 15px">
                                <div class="left-align">
                                    <div class="centered-align p-5">
                                        <a href="quiz.php?id=?" class="link text"><h3>Quiz No.1 - Quiz Title</h3></a>
                                    </div>
                                    <div class="centered-align">
                                        <div class="centered-align">
                                            <h3>100 pts</h3>
                                        </div>
                                        <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                        <div class="btn" style="margin-top: -10px; margin-right: -10px;">
                                            <img src="../images/dot-blue.png" class="small" style="width: 8px;" alt="logo">
                                        </div>
                                    </div>
                                </div>

                                <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                <div class="white quiz-option p-5 flex-col t-end" style="width: 200px;">
                                    <a href="view-responses-quizzes.php" class="link text">View Responses</a> <br>
                                    <!-- ONLY IF IT HASNT BEEN PUBLISHED YET -->
                                    <a href="#" class="link text">Publish</a> <br>
                                    <a href="#" class="link text">Delete</a>
                                 </div>

                                <div class="left-align description">
                                    <div class="centered-align p-5 description">
                                        <p>Due November 28, 2022 11:59PM</p>
                                        <p style="margin: 0px 20px;"> | </p>
                                        <p>1 hr and 30 mins</p>
                                    </div>
                                    <div class="centered-align">
                                        <p>37 Questions</p>
                                    </div>
                                </div>
                            </div>

                        </div>
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
    <script>
        $(".btn").click((e) => {
            $(e.currentTarget).parent("div").parent("div").parent("div").find(".quiz-option").toggle();
        });
    </script>
</body>
</html>