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
        <?php include "pages/topnavbar.php" ?>

        <p id="current" class="hidden">document</p>

        <div class="flex content-container full-height">
            <!-- SIDE NAVIGATION BAR - FOR BIGGER SCREENS -->
            <div class="side-navbar">
                <?php include "pages/navbar.php" ?>
            </div>

            <!-- ACTUAL CONTENT -->
            <div class="content full-width white">
                <!-- HEADER -->
                <div class="flex">
                    <div class="column full-width">
                        <h1>Inbox</h1>
                    </div>
                </div>

                <hr>
                <br>

                <!-- CONTENT OF PAGE -->
                <div class="full-width flex-col">
                    <div class="white flex-mobile" style="padding: 10px;">
                        <div class="flex">
                            <div class="img-container centered-align p-5" style="background-color: #0D4C92; padding: 10px;">
                                <!-- PROFILE PICTURE -->
                                <img src="images/student.png" class="logo" alt="logo">
                            </div>

                            <div class="flex flex-col full-width" style="margin: 0px 10px;">
                                <h5>Sender Name</h5>
                                <div class="flex space-between flex-mobile" style="margin: -40px 0px -20px 0px;">
                                    <h4>Subject Mail</h4>
                                    <p>Date and Time Sent</p>
                                </div>
                            </div>
                        </div>

                        <!-- LIMIT MESSAGE LENGTH -->
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus egestas ex bibendum porta. Sed consectetur ornare sem id volutpat. Cras vitae lobortis orci, ut bibendum tellus. Vestibulum tristique mauris eget tellus pulvinar, ut vestibulum velit congue. Vivamus eget bibendum odio. Morbi porta nisi eget posuere pulvinar. Morbi eget facilisis velit. Mauris leo quam, ornare ac est quis, luctus volutpat orci. Quisque eu lorem mattis, convallis ipsum ac, pulvinar nisi. Aliquam tincidunt dui non leo eleifend, nec pellentesque ex interdum. In hac habitasse platea dictumst. Fusce orci eros, sagittis non hendrerit at, luctus vel quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non erat sagittis, lacinia dolor fermentum, dignissim leo. Sed nec sem at elit ullamcorper tempor nec sed neque.</p>
                    </div>
                    <div class="white" style="margin-top: -2px;">
                        <button class="reply">Reply</button>
                    </div>
                </div>
                <br>

                <div class="flex-col white content" style="margin-bottom: 15px; display:none" id="reply-field">
                    <form method="POST" action="">
                        <input type="number" name="" style="display:none;" value="">
                        <textarea name="reply" id="" cols="30" class="full-width" rows="10" style="margin: 20px 0px"></textarea>
                        <div class="t-end" style="margin-bottom: 10px">
                            <button class="blue" type="submit">Reply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- BOTTOM NAVIGATION BAR - FOR SMALLER SCREENS -->
            <div class="bottom-navbar white">
                <div class="left-align">
                    <?php include "pages/navbar.php" ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/navbar.js"></script>
    <script>
        $(".reply").click(() => {
            $("#reply-field").slideToggle();
        });
    </script>
</body>

</html>