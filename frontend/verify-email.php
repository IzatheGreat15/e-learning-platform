<?php
include("../backend/config.php");
session_start();

if (isset($_SESSION["user_id"])) {
    if ($_SESSION["role"] == "ADMIN")
        header("location: admin/dashboard.php");
    else
        header("location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- EXTERNAL CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="css/general.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>E-Learning Management System</title>
</head>

<body>
    <div class="body-container centered-align">
        <div class="curved-container blue centered-align">
            <div class="flex-col">
                <div class="centered-align">
                    <div class="img-container centered-align" style="padding: 10px;">
                        <i class="fa fa-check fa-2x white" style="border-color: white"></i>
                    </div>
                </div>
                <br>
                <div class="form-container">
                    <div class="flex-col">
                        <center>
                        <h2>Your account has been verified</h2>
                        <p>You now have <b>FULL ACCESS</b> with the E-learning System. Please click the button below to start learning.</p>
                        </center>
                    </div>
                    <br><br><br>
                    <div class="centered-align">
                        <button type="submit" class="white br-10 pointer">Continue</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>

</html>