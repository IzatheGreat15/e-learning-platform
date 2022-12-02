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
                        <img src="../../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
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
                        <!-- ONE STUDENT -->
                        <div class="flex-col mx-20">
                            <h2>Assignment/Quiz Name</h2>
                            <a href="done-assignment.php?id=">
                                <div class="white flex" style="padding: 10px">
                                    <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                        <!-- PROFILE PICTURE -->
                                        <img src="../images/student.png" class="logo" alt="logo">
                                    </div>

                                    <div class="flex space-between full-width" style="margin: 0px 10px;">
                                        <div>
                                            <h4>Jane Doe</h4>
                                            <p>Date and Time Finished</p>
                                        </div>
                                        <div class="t-end">
                                            <h4>100 / 100</h4>
                                            <p>37 Questions</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
</body>

</html>