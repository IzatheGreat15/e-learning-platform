<?php
    include("../../backend/config.php");
    session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
      header("location: index.php");

    if ($_SESSION["role"] == "STUDENT") 
      header("location: ../courses.php");

    if(!isset($_GET['id']))
        header("location: courses.php");

    $sg = mysqli_fetch_assoc($db->query("SELECT * FROM subject_group WHERE id = ".$_GET['id']));
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
                <?php if ($_SESSION["role"] == "ADMIN") : ?>
                    <?php include "navbar.php" ?>
                <?php elseif ($_SESSION["role"] == "TEACHER") : ?>
                    <?php include "../courses/navbar.php" ?>
                <?php endif ?>
            </div>

            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">

                <p id="current" class="hidden">document</p>

                <!-- CONTENT -->
                <div class="flex flex-col" style="margin-top: 5%;">
                    <form action="../../backend/admin/update_subject_groups.php" class="flex-col mx-20" method="POST">
                        <input type="text" class="border-bottom px-10" name="title" placeholder="Course Group" value="<?= $sg['subject_group_name'] ?>">
                        <input type="number" class="hidden" name="sg_id" value="<?= $_GET['id'] ?>">
                        <br>

                        <?php $subject_name = mysqli_fetch_assoc($db->query("SELECT subject_name FROM subjects WHERE id = ".$sg['subject_id']))['subject_name']; ?>
                        <label for="">Subject:</label>
                        <input type="text" class="white rounded-corners px-10" name="subject" value="<?= $subject_name ?>" readonly>
                        <br>

                        <?php $section_name = mysqli_fetch_assoc($db->query("SELECT section_name FROM sections WHERE id = ".$sg['section_id']))['section_name']; ?>
                        <label for="">Section:</label>
                        <input type="text" class="white rounded-corners px-10" name="section" value="Section <?= $section_name ?>" readonly>
                        <br>

                        <label for="">Assigned Teacher: </label>
                        <select name="teacher" id="" class="white rounded-corners px-10">
                            <?php foreach($db->query('SELECT * FROM users WHERE role = "TEACHER"') as $teacher): ?>
                                <option value="<?= $teacher['id'] ?>" <?php if(isset($sg)) $teacher['id'] == $sg['teacher_id'] ? "selected" : "" ?>><?= $teacher['fname'] ?> <?= $teacher['lname'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <br>

                        <!-- SCHEDULE - DYNAMIC -->
                        <?php
                        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
                        $abv  = array("M", "Tu", "W", "Th", "F");
                        $day  = "";
                        $time = "";
                        if($sg["schedule"] != NULL){
                            $schedule = explode(" ", $sg["schedule"]);
                            $day = $schedule[0];
                            $time = $schedule[1];
                        }
                        
                        ?>
                        <label for="">Schedule:</label>
                        <div class="schedules">
                            <div>
                                <div class="flex space-between" style="align-items: center;">
                                    <input type="text" class="white rounded-corners smol px-10 mx-small" name="day" placeholder="Day" value="<?= $day ?>" readonly>
                                    <input type="text" class="white full-width rounded-corners px-10" name="time" value="<?= $time ?>" placeholder="Time">
                                    <img src="../images/add.png" alt="add" class="transparent-btn add hidden" style="width: 20px; height: 20px">
                                    <!-- <img src="../images/minus.png" alt="minus" class="transparent-btn mod-remove" style="width: 22px; height: 22px; margin-top: -1px;"> -->
                                </div>
                                <div class="flex days" style="align-items: center; margin-top: 10px;">
                                <?php
                                for ($x = 0; $x < count($days); $x++){
                                        $color = (str_contains($day, $abv[$x])) ? "blue" : "white";
                                        echo '<button class="'. $color .' rounded-corners mx-small day" id="'. $abv[$x] .'" value="'. $color .'" type="button" style="margin-bottom: 10px;">'. $days[$x] .'</button>';
                                    }
                                ?>
                                </div>
                                <br>
                            </div>
                        </div>

                        <button class="blue" type="submit" name="submit">Save</button>

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
        $(".add").click((e) => {
            $(".schedules")
            .append('<div>' +
                        '<div class="flex space-between" style="align-items: center;">' +
                            '<input type="text" class="white rounded-corners smol px-10 mx-small" name="day" placeholder="Day" readonly>' +
                            '<input type="text" class="white full-width rounded-corners px-10" name="schedule" placeholder="Time">' +
                            '<img src="../images/minus.png" alt="minus" class="transparent-btn remove" style="width: 22px; height: 22px; margin-top: -1px;">' +
                            '</div>' +
                            '<div class="flex days" style="align-items: center; margin-top: 10px;">' +
                        '<?php for ($x = 0; $x < count($days); $x++) { echo '<button class="white rounded-corners mx-small day" id="' . $abv[$x] . '" value="white" type="button" style="margin-bottom: 10px;">' . $days[$x] . '</button>';} ?>' +
                        '</div>' +
                        '<br>' +
                    '</div>');
        });

        $(document).on("click", ".remove", (e) => {
            $(e.currentTarget).parent("div").parent("div").remove();
        });

        $(document).on("click", ".day", (e) => {
            var id = $(e.currentTarget).attr("id");
            var mode = $(e.currentTarget).attr("value");
            var day = $(e.currentTarget).parent("div").parent("div").find("input[name='day']");

            if(mode == "white"){
                // to be selected
                $(day).val($(day).val() + id);

                // change bg color from white to blue
                $(e.currentTarget).removeClass("white");
                $(e.currentTarget).addClass("blue");
                $(e.currentTarget).val("blue");
            }else{
                // remove day
                var text = $(day).val();
                text = text.replaceAll(id, "");

                if(id == "T"){
                    text = text.replaceAll("h", "Th");
                }
                $(day).val(text);

                // change bg color from blue to white
                $(e.currentTarget).removeClass("blue");
                $(e.currentTarget).addClass("white");
                $(e.currentTarget).val("white");
            }
        });
    </script>
</body>

</html>