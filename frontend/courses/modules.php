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
                <!-- header -->
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
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 5px; margin-top: 2px;">
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
                    <div class="content full-width flex-col">
                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <img src="images/down-white.png" class="down" alt="">
                                    Module 1. All About Nouns
                                </div>
                                <!-- FOR TEACHERS ONLY - EDIT BUTTON -->
                                <div class="centered-align">
                                    <div class="btn">
                                        <img src="../images/draw-white.png" class="small" alt="edit" style="width: 20px;">
                                    </div>
                                </div>
                            </div>

                            <div class="lesson">
                                <div class="white p-5" style="margin-top: -2px;">
                                    <a href="#" class="link text p-5">Lesson 1. Proper and Common Nouns</a>
                                </div>
                                <div class="white p-5" style="margin-top: -2px;">
                                    <a href="#" class="link text p-5">Lesson 1. Proper and Common Nouns</a>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="flex-col mx-20">
                            <div class="left-align blue">
                                <div class="p-10 text">
                                    <img src="../images/down-white.png" class="down" alt="">
                                    Module 1. All About Nouns
                                </div>
                                <!-- FOR TEACHERS ONLY - EDIT BUTTON -->
                                <div class="centered-align">
                                    <div class="btn">
                                        <img src="../images/draw-white.png" class="small" alt="edit" style="width: 20px;">
                                    </div>
                                </div>
                            </div>

                            <div class="lesson">
                                <div class="white p-5" style="margin-top: -2px;">
                                    <a href="#" class="link text p-5">Lesson 1. Proper and Common Nouns</a>
                                </div>
                                <div class="white p-5" style="margin-top: -2px;">
                                    <a href="#" class="link text p-5">Lesson 1. Proper and Common Nouns</a>
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

    <script></script>
</body>
</html>