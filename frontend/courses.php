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
                        <img src="images/mail-blue.png" class="small icon" id="mail" alt="logo">
                    </a>
                </div>
                <div class="centered-align icon-container">
                    <a href="#">
                        <img src="images/question-blue.png" class="small icon" id="question" alt="logo">
                    </a>
                </div>
            </div>
            <!-- ACTUAL CONTENT -->
            <div class="content full-width">
                <h1>Your Courses</h1>
                <hr>
                <div class="flex-wrap">
                    <div class="card white">
                        <div class="flex full-width">
                            <div class="column">
                                <p>Course No.0002</p>
                            </div>
                            <div class="column t-end big-text">
                                <img src="images/right-arrow-blue.png" alt="next" class="small-icon">
                            </div>
                        </div>
                        <div class="flex fullest-width" style="margin-top: -30px;" >
                            <div class="column bigger-text">
                                <p>English 101</p>
                            </div>
                        </div>
                        <div class="flex" style="margin: -30px 0px -10px;">
                            <p>Grade 1 - Section Siopao</p>
                        </div>
                        <hr>
                        <div class="flex" style="margin: -5px 0px;">
                            <p>Monday: 10:30AM - 12:00PM</p>
                        </div>
                        <div class="flex" style="margin: -5px 0px -5px;">
                            <p>Tuesday: 10:30AM - 12:00PM</p>
                        </div>
                    </div>
                    <div class="card white">
                        <div class="flex full-width">
                            <div class="column">
                                <p>Course No.0002</p>
                            </div>
                            <div class="column t-end big-text">
                                <img src="images/right-arrow-blue.png" alt="next" class="small-icon">
                            </div>
                        </div>
                        <div class="flex fullest-width" style="margin-top: -30px;" >
                            <div class="column bigger-text">
                                <p>English 101</p>
                            </div>
                        </div>
                        <div class="flex" style="margin: -30px 0px -10px;">
                            <p>Grade 1 - Section Siopao</p>
                        </div>
                        <hr>
                        <div class="flex" style="margin: -5px 0px;">
                            <p>Monday: 10:30AM - 12:00PM</p>
                        </div>
                        <div class="flex" style="margin: -5px 0px -5px;">
                            <p>Tuesday: 10:30AM - 12:00PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/dashboard-blue.png" class="small icon" id="dashboard-mobile" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/document-blue.png" class="small icon" id="document-mobile" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/calendar-blue.png" class="small icon" id="calendar-mobile" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/mail-blue.png" class="small icon" id="mail-mobile" alt="logo">
                        </a>
                    </div>
                    <div class="centered-align icon-container">
                        <a href="#">
                            <img src="images/question-blue.png" class="small icon" id="question-mobile" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var current = "dashboard";

        $(document).ready(() => {
            $("#"+current).attr("src", "images/"+ current +"-white.png");
            $("#"+current).closest("div").addClass("icon-active");
            // for mobile devices
            $("#"+current+"-mobile").attr("src", "images/"+ current +"-white.png");
            $("#"+current+"-mobile").closest("div").addClass("icon-active");
        });

        $(".icon-container").mouseenter((e) => {
            var icon = $(e.currentTarget).find("img").attr("id");
            icon = icon.split("-");
            if(icon[0] != current){
                $(e.currentTarget).css("background-color", "#0D4C92");
                $(e.currentTarget).find("img").attr("src", "images/"+icon[0]+"-white.png");
            }
        });
        $(".icon-container").mouseleave((e) => {
            var icon = $(e.currentTarget).find("img").attr("id");
            icon = icon.split("-");
            if(icon[0] != current){
                $(e.currentTarget).css("background-color", "white");
                $(e.currentTarget).find("img").attr("src", "images/"+icon[0]+"-blue.png");
            }
        });

        // CARD ANIMATIONS
        $(".card").mouseenter((e) => {
            $(e.currentTarget).find("hr").css("background-color", "white");
            $(e.currentTarget).find("img").attr("src", "images/right-arrow-white.png");
        });
        $(".card").mouseleave((e) => {
            $(e.currentTarget).find("hr").css("background-color", "#0D4C92");
            $(e.currentTarget).find("img").attr("src", "images/right-arrow-blue.png");
        });
    </script>
</body>
</html>