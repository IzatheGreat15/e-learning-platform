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
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>English</h1>
                    </div>
                    <div class="column t-end more">
                        <img src="../images/more-blue.png" alt="menu" class="small" style="margin-top: 25px;">
                    </div>
                    <!-- FOR TEACHERS ONLY - ADD BUTTON -->
                    <div class="column t-end">
                        <button class="blue add" style="margin-top: 25px;">
                            <div class="flex">
                                <img src="../images/plus-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                <div>
                                    Add
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <hr>

                <br>

                <!-- CONTENT -->
                <div class="flex mobile">
                    <!-- Course Navbar -->
                    <?php include "course-navbar.php" ?>

                    <br>
                    <!-- CONTENT OF PAGE -->
                    <div class="full-width flex-col">
                        
                        <div class="flex-col mx-20">
                            <!-- ONE ASSIGNMENT -->
                            <div class="white p-5 text-justify content" style="position: relative; margin-bottom: 15px">
                                <div class="left-align">
                                    <div class="centered-align p-5">
                                        <a href="assignment.php?id=?" class="link text title"><h3>Assignment No.1 - Assignment Title</h3></a>
                                    </div>
                                    <div class="centered-align">
                                        <div class="centered-align">
                                            <h3>100 pts</h3>
                                        </div>
                                        <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                        <div class="btn" style="margin-top: -10px; margin-right: -10px;">
                                            <img src="../images/dot-blue.png" class="small" style="width: 8px;" alt="logo">
                                        </div>
                                    </div>
                                </div>

                                <!-- FOR TEACHERS ONLY - MORE OPTIONS -->
                                <div class="white quiz-option p-5 flex-col t-end" style="width: 200px;">
                                    <a href="view-responses-assignments.php?id=" class="link text">View Responses</a> <br>
                                    <!-- ONLY IF IT HASNT BEEN PUBLISHED YET -->
                                    <a href="#" class="link text">Publish</a> <br>
                                    <a class="link text dlt-btn">Delete</a>
                                 </div>

                                <div class="left-align description">
                                    <div class="centered-align p-5 description">
                                        <p>Due November 28, 2022 11:59PM</p>
                                        <p style="margin: 0px 20px;"> | </p>
                                        <p>1 hr and 30 mins</p>
                                    </div>
                                    <div class="centered-align">
                                        <p>37 Questions</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br>

                    </div>
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

    <!-- MODAL FOR DELETE ASSIGNEMENT -->
    <div id="modal-delete" class="modal-bg">
        <div class="modal-body">
            <span class="close">&times;</span>
            <div class="centered-align flex-col">
                <h3>Are you sure you want to remove <span id="name"></span>?</h3>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="">
                    <button type="submit" name="submit" class="blue">YES</button>
                    <button type="button" class="close-btn blue">NO</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="navbar.js"></script>
    <script type="text/javascript" src="../js/modal.js"></script>
    <script>
        $(".btn").click((e) => {
            $(e.currentTarget).parent("div").parent("div").parent("div").find(".quiz-option").toggle();
        });

        $(".dlt-btn").click((e) => {
            $("#modal-delete").show();

            var title = $(e.currentTarget).parent("div").parent("div").find(".title").text();
            $("#name").text(title);
        });

        $(".add").click((e) => {
            location.replace("admin-assignments.php?mode=add");
        });
    </script>
</body>
</html>