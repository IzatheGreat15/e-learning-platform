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
                <h2>Enrollments</h2>
                <div class="flex">
                    <div class="column full-width">
                        <!-- SECTION -->
                        <select name="section" id="" class="t-center white half-width half-to-full">
                            <?php
                                for ($x = 1; $x <= 6; $x++) {
                                    echo '<option value="' . $x . '">' . $x . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="column t-end">
                        <button class="blue add">
                            <div class="flex">
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                <div>
                                    Add
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <br>
                <hr>

                <!-- USERS -->
                <table class="full-width">
                    <tr class="space-between t-center" id="1">
                        <td>Grade 1 - Section Siopao</td>
                        <td>Teacher Adviser</td>
                        <td>34 students</td>
                        <td>2022 - 2023</td>
                        <td class="flex">
                            <img src="../images/draw-blue.png" class="edit mx-small" alt="logo" style="width: 20px;">
                            <img src="../images/x-blue.png" class="x mx-small" alt="logo" style="width: 20px;">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "navbar.php" ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR DELETE USER -->
    <div id="modal-delete" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to remove <span id="name"></span>?</h3>
                <form action="../../backend/teacher/delete_announcement.php" method="POST">
                    <input type="hidden" name="id" id="del-val" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <script src="navbar.js"></script>
    <script src="../js/modal.js"></script>
    <script>
        $(".x").click((e) => {
            var name = $(e.currentTarget).parent("td").parent("tr").find("td:eq(0)").text();

            $("#modal-delete").show();
            $("#name").text(name);
        });

        $(".add").click((e) => {
            location.replace("admin-enrollments.php?mode=add");
        });

        $(".edit").click((e) => {
            var id = $(e.currentTarget).parent("td").parent("tr").attr("id");

            location.replace("admin-enrollments.php?mode=edit&id="+id);
        }); 
    </script>
</body>

</html>