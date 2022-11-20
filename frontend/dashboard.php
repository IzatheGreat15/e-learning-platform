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
        <div class="top-navbar blue">
            <div class="left-align">
                <div class="img-container centered-align p-5">
                    <img src="images/student.png" class="small" alt="logo">
                </div>
                <div class="centered-align">
                    <div class="centered-align">
                        <label for="">Date Today</label>
                    </div>
                    <div class="btn">
                        <img src="images/bell-white.png" class="small" alt="logo">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <div class="centered-align icon-container">
                    <a href="#">
                        <img src="images/dashboard-blue.png" class="small icon" id="dashboard" alt="logo">
                    </a>
                </div>
                <div class="centered-align icon-container">
                    <a href="#">
                        <img src="images/document-blue.png" class="small icon" id="document" alt="logo">
                    </a>
                </div>
                <div class="centered-align icon-container">
                    <a href="#">
                        <img src="images/calendar-blue.png" class="small icon" id="calendar" alt="logo">
                    </a>
                </div>
                <div class="centered-align icon-container">
                    <a href="#">
                        <img src="images/mail-inbox-app-blue.png" class="small icon" id="mail-inbox-app" alt="logo">
                    </a>
                </div>
                <div class="centered-align icon-container">
                    <a href="#">
                        <img src="images/question-blue.png" class="small icon" id="question" alt="logo">
                    </a>
                </div>
            </div>
            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <h1>Dashboard</h1>
                <div class="flex column-container">
                    <div class="column">
                        <h3>Today</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <div class="curve-container blue flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p>100 pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p>Lab Activitiy 1.0 - Create a key</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: November 28, 2022 - 11:59 PM</p>
                                </div>
                            </div>
                        </div>
                        <!-- ACTIVITY -->
                        <div class="curve-container blue flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p>100 pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p>Lab Activitiy 1.0 - Create a key</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: November 28, 2022 - 11:59 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <!-- ANNOUNCEMENTS - LIMIT TO 3 -->
                        <h3>Announcements</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p>100 pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p>Lab Activitiy 1.0 - Create a key</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: November 28, 2022 - 11:59 PM</p>
                                </div>
                            </div>
                        </div>
                
                        <!-- ACTIVITY -->
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p>100 pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p>Lab Activitiy 1.0 - Create a key</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: November 28, 2022 - 11:59 PM</p>
                                </div>
                            </div>
                        </div>

                        <a href="#"><p class="t-center">See more...</p></a>

                        <!-- UPCOMING ASSIGNMENTS - LIMIT TO 3 -->
                        <h3>Upcoming Assignments</h3>
                        <hr>
                        <!-- ACTIVITY -->
                        <div class="curve-container white flex-col">
                            <div class="flex">
                                <div class="column small-text">
                                    <p>Course No.1 - English 101</p>
                                </div>
                                <div class="column t-end big-text">
                                    <p>100 pts</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -50px;">
                                <div class="column big-text">
                                    <p>Lab Activitiy 1.0 - Create a key</p>
                                </div>
                            </div>
                            <div class="flex" style="margin-top: -25px;">
                                <div class="column small-text">
                                    <p>Due: November 28, 2022 - 11:59 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/dashboard-blue.png" class="small icon" id="dashboard" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/document-blue.png" class="small icon" id="document" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/calendar-blue.png" class="small icon" id="calendar" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/mail-inbox-app-blue.png" class="small icon" id="mail-inbox-app" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/question-blue.png" class="small icon" id="question" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".icon-container").mouseenter((e) => {
            var icon = $(e.currentTarget).find("img").attr("id");
            $(e.currentTarget).css("background-color", "#0D4C92");
            $(e.currentTarget).find("img").attr("src", "images/"+icon+"-white.png");
        });
        $(".icon-container").mouseleave((e) => {
            var icon = $(e.currentTarget).find("img").attr("id");
            $(e.currentTarget).css("background-color", "white");
            $(e.currentTarget).find("img").attr("src", "images/"+icon+"-blue.png");
        });
    </script>
</body>
</html>