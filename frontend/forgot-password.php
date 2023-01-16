<?php
    include("../backend/config.php");
    session_start();

    if(isset($_SESSION["user_id"]) && isset($_SESSION["role"])) {
        header("location: index.php");
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
    <link rel="stylesheet" type="text/css" href="../css/modal.css">
    <title>E-Learning Management System</title>
</head>
<body>
    <div class="body-container centered-align">
        <div class="curved-container blue">
            <div class="centered-align">
                <div class="img-container centered-align" style="padding: 10px;">
                    <img src="images/student.png" class="logo" alt="logo">
                </div>
            </div>
            <br>
            <div class="form-container">
                <form action="../backend/send_reset_password_email.php" method="POST">
                    <!-- ERROR MESSAGES -->
                    <?php
                    $error = "";
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "incorrectpassword"){
                            $error = "Incorrect Password. Try Again";
                        }
                        if($_GET["error"] == "accountdoesnotexist"){
                            $error = "Account does not exist. Try Again";
                        }
                    }
                    ?>
                    <p class="danger"><?php echo $error ?></p>
                    <h3 class="mt-5 br-10">Forgot Password</h3>
              
                    <div class="flex-col">
                        <label for="email" class="mt-5 br-10">Email Address</label>
                        <input type="email" class="mt-5 br-10" name="email" id="email">
                    </div>
                    <br><br><br>
                    <div class="centered-align">
                        <button type="submit" class="white br-10 pointer">Send</button>
                    </div>
                    <br>
                    <div class="centered-align">
                        <a href="index.php" class="link pointer" style="color: white;">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>