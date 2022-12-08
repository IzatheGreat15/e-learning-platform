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

                <p id="current" class="hidden">document</p>

                <!-- CONTENT -->
                <div class="flex flex-col" style="margin-top: 5%;">
                    <form action="" class="flex-col mx-20">
                        <input type="text" class="border-bottom px-10" name="title" placeholder="Course">
                        <br>

                        <label for="">Grade Level:</label>
                        <select name="grade_level" id="" class="white rounded-corners px-10">
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '<option value="' . $x . '">' . $x . '</option>';
                            }
                            ?>
                        </select>
                        <br>

                        <label for="">Subject Coordinator:</label>
                        <select name="grade_level" id="" class="white rounded-corners px-10">
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '<option value="' . $x . '">' . $x . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                        
                        <label for="">Subject Groups:</label>
                        <div class="flex flex-col">
                            <!-- INDIVIDUAL SUBJECT GROUP -->
                            <table class="whole">
                                <tr class="t-center sg" id="1">
                                    <td style="width: 33%;"><p>SG Name</p></td>
                                    <td style="width: 33%;"><p>Grade 1 - Section Siopao</p></td>
                                    <td style="width: 33%;"><p>Teacher Joyce Kelmer</p></td>
                                </tr>
                                <tr class="t-center sg" id="2">
                                    <td style="width: 33%;"><p>SG Name</p></td>
                                    <td style="width: 33%;"><p>Grade 1 - Section Siopao</p></td>
                                    <td style="width: 33%;"><p>Teacher Joyce Kelmer</p></td>
                                </tr>
                            </table>
                        </div>

                        <br>
                        <div class="flex full-width">
                            <button class="blue half-width mx-small">Save</button>
                            <button class="bg-danger half-width mx-small">Delete</button>
                        </div>
                    </form>
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

    <script src="navbar.js"></script>
    <script>
        $(".sg").click((e) => {
            var id = $(e.currentTarget).attr("id");

            location.replace("course-groups.php?id="+id);
        });
    </script>
</body>

</html>