<?php
    include("../backend/config.php");
        session_start();

    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"])) {
        header("location: index.php");
    }

    if(isset($_GET['token'])){
        $_SESSION['user_id'] = mysqli_fetch_assoc($db->query("SELECT id FROM users WHERE token = ".$_GET['token']))['id'];
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
                <form action="../backend/change_password.php" method="POST">
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
                    <h3 class="mt-5 br-10">Reset Password</h3>

                    <div class="flex-col">
                        <label for="password" class="mt-5 br-10">New Password</label>
                        <input type="password" class="mt-5 br-10" name="new_password" id="password">
                    </div>
                    <br>
                    <div class="flex-col">
                        <label for="password" class="mt-5 br-10">Confirm Password</label>
                        <input type="password" class="mt-5 br-10" name="confirm_password" id="password">
                    </div>
                    <br><br><br>
                    <div class="centered-align">
                        <button type="submit" class="white br-10 pointer">Reset</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
<?php include_once '../css/unverified.php' ?>
</body>
</html>