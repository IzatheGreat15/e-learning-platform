<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
      header("location: index.php");

    if($_SESSION["role"] != "ADMIN")
      header("location: ../dashboard.php");
    if(isset($_GET['id']))
        $section = mysqli_fetch_assoc($db->query("SELECT * FROM sections WHERE id = ".$_GET['id']));
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
                    <form action="<?= !isset($_GET['id']) ? "../../backend/admin/create_sections.php" : "../../backend/admin/update_sections.php" ?>" class="flex-col mx-20" method="POST">
                        <input type="text" class="border-bottom px-10" name="title" placeholder="Section" value="<?= isset($_GET['id']) ? $section['section_name'] : '' ?>">
                        <br>

                        <label for="">Grade Level:</label>
                        <select name="grade_level" id="" class="white rounded-corners px-10">
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '<option value="' . $x . '" ';
                                if(isset($_GET['id']))echo $x == $section['year_level'] ? "selected" : "";
                                echo '>Grade ' . $x . '</option>';
                            }
                            ?>
                        </select>
                        <br>

                        <label for="">Assigned Adviser:</label>
                        <select name="adviser" id="" class="white rounded-corners px-10">
                        <?php foreach($db->query("SELECT * FROM users WHERE role = 'TEACHER'") as $teacher): ?>
                            <option value="<?= $teacher['id'] ?>" <?php if(isset($GET['id'])) echo $teacher['id'] == $_GET['id'] ? "selected" : "" ?>>Teacher <?= $teacher['fname'] ?> <?= $teacher['lname'] ?></option>
                        <?php endforeach ?>
                        </select>
                        <br>

                        <label for="">Academic Year:</label>
                        <input type="number" class="white rounded-corners px-10" name="ay" placeholder="2022 - 2023" value="<?= isset($_GET['id']) ? $section['school_year'] : '' ?>" readonly>
                        <br>

                        <label for="">Add Students</label>
                        <input type="text" class="white rounded-corners px-10" name="search" id="term" placeholder="Search..">
                        <br>

                        <!-- EDIT MODE ONLY -->
                        <div class="full-width">
                            <!-- SELECTED STUDENTS -->
                            <label for="">Selected Students</label>
                            <table class="whole selected full-width">
                                <tr class="flex space-between p-5">
                                    <td class="hidden"><input type="hidden" value="1" name="student[]"></td>
                                    <td>Jane Doe (Student ID)</td>
                                    <td><img src="../images/x-blue.png" class="x mx-small" alt="logo" style="width: 10px;"></td>
                                </tr>
                            </table>
                            <br>
                            
                            <!-- CHOICES - REAL TIME UPDATE UPON SEARCH -->
                            <label for="">Results</label>
                            <table class="whole full-width search-table">
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
            .append('<tr class="flex space-between p-5">' +
                        '<td class="hidden"><input type="hidden" value="'+ id +'" name="student[]"></td>' +
                        '<td>'+ content +'</td>' +
                        '<td><img src="../images/x-blue.png" class="x mx-small" alt="logo" style="width: 10px;"></td>' +
                    '</tr>');
        });

        $(document).on("click", ".x", (e) => {
            // remove selected student
            $(e.currentTarget).parent("td").parent("tr").remove();
        });

        $('#term').on("keyup", function() {
            var search = $('#term').val();
            var r;
            $.ajax({
                type: "GET",
                url: "../../backend/admin/find_student.php",
                data: { name: search },
                success: function (res) {
                    console.clear();
                    r = JSON.parse(res);

                    // empty the table
                    $(".search-table").empty();
                    if(search.length > 0){
                        for( let x in r){
                            console.log(r[x]);
                            $(".search-table")
                            .append(' '+
                                '<tr class="flex space-between p-5 choice" id="'+ r[x].id +'">' +
                                    '<td>'+ r[x].fname +' '+ r[x].lname +' ('+ r[x].id +')</td>' +
                                '</tr>' +
                            '');
                        }
                    }
                }
            });
            
        });


    </script>
</body>

</html>