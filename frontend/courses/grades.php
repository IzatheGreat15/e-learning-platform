<?php
    session_start();
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
                            <table>
                                <tr>
                                    <td>
                                        <h1>Student Name</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 25%">Name</th>
                                    <th style="width: 25%">Date</th>
                                    <th style="width: 25%">Score</th>
                                    <th style="width: 25%">Total</th>
                                </tr>
                                <!-- LOOP DEPENDING ON ACTIVTIES -->
                                <tr>
                                    <td style="width: 25%; text-align: center;">SBA - Packet Tracer</td>
                                    <td style="width: 25%; text-align: center;">November 20, 2022</td>
                                    <td style="width: 25%; text-align: center;">87</td>
                                    <td style="width: 25%; text-align: center;">100</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%; text-align: center;">Total</td>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;">87</td>
                                    <td style="width: 25%; text-align: center;">100</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"></td>
                                    <td style="width: 25%; text-align: center;"><h3>Total: 100%</h3></td>
                                </tr>
                            </table>
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