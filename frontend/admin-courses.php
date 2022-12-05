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
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
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

                <p id="current" class="hidden">document</p>

                <!-- CONTENT -->
                <div class="flex flex-col" style="margin-top: 5%;">
                    <form action="" class="flex-col mx-20">
                        <input type="text" class="border-bottom" name="title" placeholder="Course">
                        <br>
                        <div class="flex space-between">
                            <div style="width: 45%;" class="flex flex-col">
                                <label for="due">Grade Level:</label>
                                <select name="grade_level" id="" class="white">
                                    <?php 
                                    for($x = 1; $x <= 6; $x++){
                                        echo '<option value="'. $x .'">'. $x .'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div style="width: 45%;" class="flex flex-col">
                                <label for="due">Section:</label>
                                <select name="section" id="" class="white">
                                    <!-- replace with actual sections -->
                                    <?php 
                                    for($x = 1; $x <= 6; $x++){
                                        echo '<option value="'. $x .'">'. $x .'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for="due">Due Date:</label>
                        <input type="datetime-local" class="white" name="due" placeholder="Due Date">
                        <br>
                        <label for="instructions">Instructions:</label>
                        <textarea name="instructions" id="instructions" class="white p-5" placeholder="Write here.." cols="30" rows="10"></textarea>
                        <br>
                        <button class="blue">Save</button>
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
    </script>
</body>

</html>