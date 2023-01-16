<?php

include("config.php");
session_start();

$token = mysqli_fetch_assoc($db->query("SELECT token FROM users WHERE email = ".$_POST['email']));
$emessage = "To verify your account on the LMS of Marick ELementary School, please click this link: ".$url."/backend/verify_account.php?token=".$token;

$phpmailer->addAddress($email);

$phpmailer->Subject = "Marick Elementary School LMS Account Verification Link";
$phpmailer->Body = $emessage;

echo $phpmailer->send();