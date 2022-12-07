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
        <?php include "../courses/topnavbar.php" ?>

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

                <form action="" class="flex-col mx-20" method="POST">
                    <label for="">First Name</label>
                    <input type="text" class="white rounded-corners px-10" name="fname" placeholder="John">
                    <br>

                    <label for="">Last Name</label>
                    <input type="text" class="white rounded-corners px-10" name="lname" placeholder="Doe">
                    <br>

                    <label for="">Email Address</label>
                    <input type="email" class="white rounded-corners px-10" name="email" placeholder="johndoe@email.com">
                    <br>

                    <label for="">Account Type</label>
                    <select name="type" id="" class="white rounded-corners px-10">
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Admin">Admin</option>
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
</body>

</html>