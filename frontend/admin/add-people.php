<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../index.php");

    if($_SESSION["role"] != "ADMIN")
      header("location: ../dashboard.php");
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

        <p id="current" class="hidden">document</p>

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
                        <h2> Add People</h2>
                    </div>
                </div>

                <form action="../../backend/admin/create_user.php" class="flex-col mx-20" method="POST">
                    <label for="">First Name</label>
                    <input type="text" class="white rounded-corners px-10" name="fname" placeholder="John" required>
                    <br>

                    <label for="">Last Name</label>
                    <input type="text" class="white rounded-corners px-10" name="lname" placeholder="Doe" required>
                    <br>

                    <label for="">Email Address</label>
                    <input type="email" class="white rounded-corners px-10" name="email" placeholder="johndoe@email.com" required>
                    <br>

                    <label for="">Contact Number</label>
                    <input type="tel" class="white rounded-corners px-10" name="contact_num" maxlength="11" placeholder="091234567890" required>
                    <br>

                    <label for="">Account Type</label>
                    <select name="type" id="" class="white rounded-corners px-10" required>
                        <option value="STUDENT">Student</option>
                        <option value="TEACHER">Teacher</option>
                        <option value="REGISTRAR">Registrar</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                    <br>

                    <button class="blue" type="submit">Save</button>
                </form>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "navbar.php" ?>
                </div>
            </div>
        </div>


        <script src="navbar.js"></script>
        <script>
        </script>
<?php include_once '../css/unverified.php' ?>
</body>

</html>