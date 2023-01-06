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
?>