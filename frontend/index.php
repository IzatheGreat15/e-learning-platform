<?php
   include("../backend/config.php");
   session_start();

   if(isset($_SESSION["user_id"]) ){
        if($_SESSION["role"] == "ADMIN" && $_SESSION["role"] == "REGISTRAR")
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
    <link rel="stylesheet" type="text/css" href="css/modal.css">
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
                <form action="../backend/login.php" method="POST">
                    <!-- ERROR MESSAGES -->
                    <?php
                    $error = "";
                    $msg = "";
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "incorrectpassword"){
                            $error = "Incorrect Password. Try Again";
                        }
                        if($_GET["error"] == "accountdoesnotexist"){
                            $error = "Account does not exist. Try Again";
                        }
                    }
                    if(isset($_GET['msg'])){
                        if($_GET["msg"] == "verifEmailSent"){
                            $msg = "The verification email has been sent to your email. Please verify it before logging in.";
                        }
                    }
                    ?>
                    <p class="danger"><?php echo $error ?></p>
                    <p class="msg"><?php echo $msg ?></p>
                    <div class="flex-col">
                        <label for="email" class="mt-5 br-10">Email Address</label>
                        <input type="email" class="mt-5 br-10" name="email" id="email">
                    </div>
                    <br>
                    <div class="flex-col">
                        <label for="password" class="mt-5 br-10">Password</label>
                        <input type="password" class="mt-5 br-10" name="password" id="password">
                    </div>
                    <br><br><br>
                    <div class="centered-align">
                        <button type="submit" class="white br-10 pointer">Login</button>
                    </div>
                    <br>
                    <div class="centered-align">
                        <a href="forgot-password.php" class="link pointer" style="color: white;">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>