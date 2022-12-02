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
                <div class="flex mobile" style="margin-bottom: 20px;">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        
                        <div class="flex-col mx-20">
                            <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                <!-- QUIZ HEADER -->
                                <div class="left-align quiz-header">
                                    <div class="flex-col full-width" style="padding-right: 15px">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h3>Quiz No.1 - Quiz Title</h3>
                                                </th>
                                                <th style="width: 30%;">
                                                    <h3 class="t-end">100 pts</h3>
                                                </th>
                                            </tr> 
                                            <tr>
                                                <td>Due Nov 18, 2022 9:00PM &nbsp; | &nbsp; 1hr and 40 mins</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="left-align white submission-deets" style="width: 300px;">
                                        <div class="flex-col" style="margin: 0px 10px;">
                                            <p class="bold">Submission Details:</p>
                                            <p style="margin-top: -10px;">Your Score: 50pts</p>
                                            <p style="margin-top: -10px;">Time Spent: 41 mins</p>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <!-- INSTRUCTIONS -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                        <br>

                        <div id="questions">
                            <!-- ONE QUESTION -->
                            <div class="flex-col mx-20 white content rounded-corners">
                                <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                    <div class="left-align quiz-header">
                                        <div class="flex-col full-width" style="padding-right: 15px">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <h2>Question 1</h2>
                                                    </th>
                                                    <th>
                                                        <h2 class="t-end">5 / 5 pts</h2>
                                                    </th>
                                                </tr> 
                                            </table>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- QUESTION -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                    <!-- ANSWER FIELD -->
                                    <div class="full-width flex">
                                        <p>Your Answer: </p>
                                        <input type="text" class="white" style="margin: 10px 15px; width: 30%;" readonly>
                                    </div>
                                    <p>Correct Answer: Lorem ipsum</p>
                                </div>
                            </div>
                            <br>

                            <!-- ONE QUESTION -->
                            <div class="flex-col mx-20 white content rounded-corners">
                                <div class="p-5 text-justify" style="position: relative; margin-bottom: 15px">
                                    <div class="left-align quiz-header">
                                        <div class="flex-col full-width" style="padding-right: 15px">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <h2>Question 2</h2>
                                                    </th>
                                                    <th>
                                                        <h2 class="t-end">5 / 5 pts</h2>
                                                    </th>
                                                </tr> 
                                            </table>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- QUESTION -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                    <!-- ANSWER FIELD -->
                                    <div class="full-width flex">
                                        <p>Your Answer: </p>
                                        <input type="text" class="white" style="margin: 10px 15px; width: 30%;" readonly>
                                    </div>
                                    <p>Correct Answer: Lorem ipsum</p>
                                </div>
                            </div>
                            <br>

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
    </script>
</body>
</html>