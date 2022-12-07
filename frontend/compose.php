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

                    <form class="white flex flex-col" style="padding: 25px" method="POST" action="../backend/messaging/create_thread.php">
                        <input type="text" class="white" name="recepient" placeholder="Recepient" style="margin-bottom: 15px;">
                        <input type="text" class="white" name="subject" placeholder="Subject" style="margin-bottom: 15px;">
                        <textarea name="message" class="white p-5" placeholder="Write here.." id="" cols="30" rows="20"></textarea>
                        <div class="flex">
                            <div class="column full-width">
                            </div>
                            <div class="column t-end">
                                <button class="blue" style="margin-top: 25px;" type="submit">
                                    <div class="flex">
                                        <img src="images/send-message-white.png" alt="menu" style="width: 16px; margin-right: 8px; margin-top: 1px;">
                                        <div>
                                            Send
                                        </div>
                                    </div>
                                </button>
                            </div>
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

    </script>
</body>

</html>