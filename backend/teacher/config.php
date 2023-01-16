<?php
   /** DEFINES THE PARAMETERS OF DATABASE CONNECTION **/
   // define('DB_SERVER', 'localhost');
   // define('DB_USERNAME', 'u342914934_marickuser');
   // define('DB_PASSWORD', ':F5t3XlQTPM8');
   // define('DB_DATABASE', 'u342914934_marickdb');

   
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'elearn_db');

   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   date_default_timezone_set("Asia/Manila");
   $year = 2023;
   $url = "https://marickelemsch.online/";
   ini_set("file_uploads", "On");

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require '../notification/php_mailer/src/Exception.php';
   require '../notification/php_mailer/src/PHPMailer.php';
   require '../notification/php_mailer/src/SMTP.php';

   $phpmailer = new PHPMailer();
   $phpmailer->isSMTP();
   $phpmailer->Host = 'smtp.hostinger.com';
   $phpmailer->SMTPAuth = true;
   $phpmailer->Port = 587;
   $phpmailer->Username = 'marickmail@marickelemsch.online';
   $phpmailer->Password = 'SDCB^(A!rcqy39';
   $phpmailer->setFrom('marickmail@marickelemsch.online');
   $phpmailer->isHTML(true);
