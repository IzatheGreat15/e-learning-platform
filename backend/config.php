<?php
   /** DEFINES THE PARAMETERS OF DATABASE CONNECTION **/
   include("credentials.php");
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   date_default_timezone_set("Asia/Manila");
   $year = 2023;
   $url = "http://localhost/E-Learning-Project-main/";
   ini_set("file_uploads", "On");

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'notification/php_mailer/src/Exception.php';
   require 'notification/php_mailer/src/PHPMailer.php';
   require 'notification/php_mailer/src/SMTP.php';

   $phpmailer = new PHPMailer();
   $phpmailer->isSMTP();
   $phpmailer->Host = 'smtp.hostinger.com';
   $phpmailer->SMTPAuth = true;
   $phpmailer->Port = 587;
   $phpmailer->Username = 'marickmail@marickelemsch.online';
   $phpmailer->Password = 'SDCB^(A!rcqy39';
   $phpmailer->setFrom('marickmail@marickelemsch.online');
   $phpmailer->isHTML(true);
?>