<?php
include("../../backend/config.php");
session_start();

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
    header("location: ../index.php");

if ($_SESSION["role"] != "ADMIN" && $_SESSION["role"] != "REGISTRAR")
    header("location: ../dashboard.php");

$clause = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "deleted_on IS NOT NULL" : "deleted_on IS NULL";
$section_sql = "SELECT * FROM sections WHERE " . $clause . " AND year_level = ";
$grades = $db->query("SELECT year_level FROM sections GROUP BY year_level");
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
    <style>
        td {
            padding: 10px;
        }
    </style>
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
                        <select name="section" id="year" class="t-center white half-width half-to-full">
                            <option value="0">All</option>
                            <?php
                            for ($x = 1; $x <= 6; $x++) {
                                echo '<option value="' . $x . '">Grade ' . $x . '</option>';
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

                <div class="t-end">
                    <?php
                    $url = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "enrollments.php" : "enrollments.php?type=archived";
                    $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "Active" : "Archived";
                    ?>
                    <a href="<?= $url ?>"><button class="blue" type="button"><?= $btn ?></button></a>
                </div>
                <br>

                <!-- USERS -->
                <?php if ($db->query("SELECT id FROM sections")->num_rows > 0) : ?>
                    <?php foreach ($grades as $grade) : ?>
                        <div class="s-table" id="table<?= $grade['year_level'] ?>">
                            <h2>Grade <?= $grade['year_level'] ?></h2>
                            <table class="full-width">
                                <tr class="space-between t-center" id="0">
                                    <td><b>Section Name</b></td>
                                    <td><b>Teacher Adviser</b></td>
                                    <td><b>Population</b></td>
                                    <td><b>School Year</b></td>

                                </tr>
                                <?php foreach ($db->query($section_sql . $grade["year_level"]) as $section) : ?>
                                    <tr class="space-between t-center" id="<?= $section['id'] ?>">
                                        <td>Grade <?= $grade['year_level'] ?> - Section <?= $section['section_name'] ?></td>
                                        <?php if (isset($section['adviser_id'])) $adviser = mysqli_fetch_assoc($db->query("SELECT lname, fname FROM users where id =" . $section['adviser_id'])) ?>
                                        <td><?= !isset($section['adviser_id']) ? "Unassigned" : $adviser['fname'] . " " . $adviser['lname'] ?></td>
                                        <?php $stud_count = mysqli_fetch_assoc($db->query("SELECT count(*) FROM enrollments where section_id =" . $section['id']))['count(*)'] ?>
                                        <td><?= $stud_count ?> students</td>
                                        <td><?= $section['school_year'] ?></td>
                                        <?php if ($_SESSION["role"] == "REGISTRAR") : ?>
                                            <td class="flex">
                                                <img src="../images/draw-blue.png" class="edit mx-small pointer" alt="logo" style="width: 20px;">
                                                <?php $class = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "res-btn" : "del-btn";
                                                $btn = (isset($_GET["type"]) && $_GET["type"] == "archived") ? "restore-blue" : "x-blue"; ?>
                                                <img src="../images/<?= $btn ?>.png" class="<?= $class ?> pointer" alt="logo" id="<?= $section['id'] ?>" style="width: 20px;">
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                            <br><br>
                        </div>
                    <?php endforeach ?>
                <?php else : ?>
                    <h2 class="centered-align">No Section Created Yet. Please make some.</h2>
                <?php endif ?>
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
                <h3>Are you sure you want to archive <span class="name"></span>?</h3>
                <form action="../../backend/admin/delete_section.php" method="POST">
                    <input type="hidden" name="id" id="del-val" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL FOR RESTORE SECTION -->
    <div id="modal-restore" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to restore <span class="name"></span>?</h3>
                <form action="../../backend/teacher/restore_section.php" method="POST">
                    <input type="hidden" name="id" id="del-val" value="">
                    <a href="#" id="restore"><button type="button" name="submit" class="blue">YES</button></a>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <script src="navbar.js"></script>
    <script src="../js/modal.js"></script>
    <script>
        $(".del-btn").click((e) => {
            var name = $(e.currentTarget).parent("td").parent("tr").find("td:eq(0)").text();
            var id = $(e.currentTarget).attr("id");

            $("#modal-delete").show();
            $(".name").text(name);
            $("#del-val").val(id);
        });

        $(".res-btn").click((e) => {
            $("#modal-restore").show();
            var name = $(e.currentTarget).parent("td").parent("tr").find("td:eq(0)").text();
            var id = $(e.currentTarget).attr("id");

            
            $(".name").text(name);
            $("#del-val").val(id);
            $("#restore").attr("href", "../../backend/admin/restore_section.php?id="+ $(e.currentTarget).attr("id"));
        });

        $(".add").click((e) => {
            location.href = "admin-enrollments.php?mode=add";
        });

        $(".edit").click((e) => {
            var id = $(e.currentTarget).parent("td").parent("tr").attr("id");

            location.href = "admin-enrollments.php?mode=edit&id=" + id;
        });

        $("#year").on("change", () => {
            console.log("#" + $("#year").val());
            $(".s-table").hide();
            if ($("#year").val() == 0)
                $(".s-table").show();
            else
                $("#table" + $("#year").val()).show();
        });
    </script>
</body>

</html>