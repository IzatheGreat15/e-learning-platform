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

        <p id="current" class="hidden">document</p>

        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <?php include "navbar.php" ?>
            </div>

            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <!-- CONTENT -->
                <div class="flex flex-col" style="margin-top: 5%;">
                    <form action="" class="flex-col mx-20">
                        <input type="text" class="border-bottom px-10" name="title" placeholder="Section">
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

                        <label for="">Assigned Adviser:</label>
                        <select name="adviser" id="" class="white rounded-corners px-10">
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '<option value="' . $x . '">' . $x . '</option>';
                            }
                            ?>
                        </select>
                        <br>

                        <label for="">Academic Year:</label>
                        <input type="text" class="white rounded-corners px-10" name="ay" placeholder="2022 - 2023">
                        <br>

                        <label for="">Add Students</label>
                        <input type="text" class="white rounded-corners px-10" name="search" placeholder="Search..">
                        <br>

                        <!-- EDIT MODE ONLY -->
                        <div class="full-width">
                            <!-- SELECTED STUDENTS -->
                            <label for="">Selected Students</label>
                            <table class="whole selected full-width">
                                <tr class="flex space-between p-5">
                                    <td>Jane Doe (Student ID)</td>
                                    <td><img src="../images/x-blue.png" class="x mx-small" alt="logo" style="width: 10px;"></td>
                                </tr>
                            </table>
                            <br>
                            
                            <!-- CHOICES - REAL TIME UPDATE UPON SEARCH -->
                            <table class="whole full-width">
                                <tr class="flex space-between p-5 choice" id="1">
                                    <td>John Doe (Student ID)</td>
                                </tr>
                            </table>
                            <br>
                        </div>

                        <br>
                        <div class="flex full-width">
                            <button class="blue half-width mx-small">Save</button>
                            <button class="bg-danger half-width mx-small">Delete</button>
                        </div>
                        <br>
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
        $(document).on("click", ".choice", (e) => {
            var id = $(e.currentTarget).attr("id");
            var content = $(e.currentTarget).find("td").text();

            // delete form choices
            $(e.currentTarget).remove();

            // append to selected
            $(".selected")
            .append('<tr class="flex space-between p-5" id="'+ id +'">' +
                        '<td>'+ content +'</td>' +
                        '<td><img src="../images/x-blue.png" class="x mx-small" alt="logo" style="width: 10px;"></td>' +
                     '</tr>');
        });

        $(document).on("click", ".x", (e) => {
            // remove selected student
            $(e.currentTarget).parent("td").parent("tr").remove();
        });
    </script>
</body>

</html>