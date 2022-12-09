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
                <!-- CONTENT -->
                <div class="flex flex-col" style="margin-top: 5%;">
                    <form action="" class="flex-col mx-20">
                        <div class="centered-align">
                            <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                <!-- PROFILE PICTURE -->
                                <img src="../images/student.png" class="logo" alt="logo" style="width: 80px;">
                            </div>
                        </div>
                        <div class="centered-align flex flex-col">
                            <label for="change_pp" class="white px-10 centered-align rounded-corners btn" id="white">
                                Change Profile Picture
                                <input type="file" id="change_pp" style="display: none;">
                            </label>
                            <p class="file"></p>
                        </div>
                        <br>

                        <label for="">First Name</label>
                        <input type="text" class="white rounded-corners px-10" name="fname" placeholder="John">
                        <br>

                        <label for="">Last Name</label>
                        <input type="text" class="white rounded-corners px-10" name="lname" placeholder="Doe">
                        <br>

                        <label for="">Email Address</label>
                        <input type="email" class="white rounded-corners px-10" name="email" placeholder="johndoe@email.com">
                        <br>

                        <div class="centered-align">
                            <p class="change-pass">Change Password</p>
                        </div>

                        <div class="centered-align">
                            <input class="btn white rounded-corners px-10 half-width" id="white" type="submit" name="submit" value="Save">
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

    <!-- MODAL FOR CHANGE PASSWORD -->
    <div id="modal-change" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col full-width">
                <h3>Change Password</h3>
                <form action="" method="POST" class="full-width">
                    <div class="flex flex-col full-width">
                        <label for="">Old Password</label>
                        <input type="password" class="white rounded-corners px-10" name="fname" placeholder="*****">
                        <br>

                        <label for="">New Password</label>
                        <input type="password" class="white rounded-corners px-10" name="fname" placeholder="*****">
                        <br>

                        <label for="">Confirm Password</label>
                        <input type="password" class="white rounded-corners px-10" name="fname" placeholder="*****">
                        <br>
                    </div>
                    <div class="centered-align">
                        <button type="submit" name="submit" class="blue mx-small">YES</button>
                        <button type="button" class="close-btn blue mx-small">NO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="navbar.js"></script>
    <script src="../js/modal.js"></script>
    <script>
        // hover animations
        $(".btn").mouseenter((e) => {
            var color = $(e.currentTarget).attr("id");

            var change = (color == "white") ? "blue" : "white";

            $(e.currentTarget).removeClass(color);
            $(e.currentTarget).addClass(change);
            $(e.currentTarget).attr("id", change);
        });
        $(".btn").mouseleave((e) => {
            var color = $(e.currentTarget).attr("id");

            var change = (color == "white") ? "blue" : "white";

            $(e.currentTarget).removeClass(color);
            $(e.currentTarget).addClass(change);
            $(e.currentTarget).attr("id", change);
        });

        $("label").change((e) => {
            var filename = $(e.currentTarget).find("input").val().split("\\");
            $(".file").text(filename[2]);
        });

        $(".change-pass").click((e) => {
            $("#modal-change").show();
        });
    </script>
</body>

</html>