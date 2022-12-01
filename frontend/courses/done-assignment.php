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
                                                    <h3 class="t-end">90 / 100 pts</h3>
                                                </th>
                                            </tr> 
                                            <tr>
                                                <td>Due Nov 18, 2022 9:00PM &nbsp; | &nbsp; 1hr and 40 mins</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <br>

                                <!-- INSTRUCTIONS -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                            </div>
                        </div>
                        <br>

                        <div id="questions" class="mx-20">
                            <p>Uploaded file: </p>
                            <a href="#">Download: filename.pdf</a>
                            <br><br>

                            <!-- IF USER IS A TEACHER -->
                            <form action="">
                                <div class="flex space-between" style="width:40%">
                                    <label for="">Input Score</label>
                                    <input type="text" name="score" placeholder="Score here">
                                </div>
                                <button class="blue">Submit</button>
                            </form>
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
        $("#start").click((e) => {
            $("#questions").show();
            $(e.currentTarget).hide();
        });
    </script>
</body>
</html>