<?php

include("config.php");
session_start();

$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = ".$user_id));
$emessage = "To verify your account on the LMS of Marick ELementary School, please click this link: ".$url."backend/verify_account.php?token=".$user['token'];

$phpmailer->addAddress($user['email']);

$phpmailer->Subject = "Marick Elementary School LMS Account Verification Link";
$phpmailer->Body = $emessage;

echo $phpmailer->send();

session_destroy();
header("location: ../frontend/index.php?msg=verifEmailSent");