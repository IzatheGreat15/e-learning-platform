<?php
   /** DEFINES THE PARAMETERS OF DATABASE CONNECTION **/
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'u342914934_marickuser');
   define('DB_PASSWORD', ':F5t3XlQTPM8');
   define('DB_DATABASE', 'u342914934_marickdb');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   date_default_timezone_set("Asia/Manila");
   $year = 2023;
   ini_set("file_uploads", "On");

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'notification/php_mailer/src/Exception.php';
   require 'notification/php_mailer/src/PHPMailer.php';
   require 'notification/php_mailer/src/SMTP.php';

   $phpmailer = new PHPMailer();
   $phpmailer->isSMTP();
   $phpmailer->Host = 'smtp.mailtrap.io';
   $phpmailer->SMTPAuth = true;
   $phpmailer->Port = 2525;
   $phpmailer->Username = 'd640fa24417cee';
   $phpmailer->Password = 'd320b289b66c22';
   $phpmailer->setFrom('mailer@elearning.online');
   $phpmailer->isHTML(true);
?>