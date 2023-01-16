<?php

include("config.php");
session_start();
if(isset($_POST['email'])){
    $user = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE email = '".$_POST['email']."'"));
    $emessage = "To reset the password of your account on the LMS of Marick ELementary School, please click this link: ".$url."frontend/reset-password.php?token=".$user['token'];

    $phpmailer->addAddress($user['email']);

    $phpmailer->Subject = "Marick Elementary School LMS Account Password Reset Link";
    $phpmailer->Body = $emessage;

    echo $phpmailer->send();

    header("location: ../frontend/index.php?msg=resetPassEmailSent");
}
