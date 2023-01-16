<?php
   /** DEFINES THE PARAMETERS OF DATABASE CONNECTION **/
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'u342914934_mysqlusername');
   define('DB_PASSWORD', 'gKiek]t9*u9X');
   define('DB_DATABASE', 'u342914934_mysqldbname113');

   // define('DB_SERVER', 'localhost');
   // define('DB_USERNAME', 'root');
   // define('DB_PASSWORD', '');
   // define('DB_DATABASE', 'elearn_db');

   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   date_default_timezone_set("Asia/Manila");
   $year = 2023;
   $url = "https://marickelemsch.online/";
   // $url = "https://localhost/elearning/";
   ini_set("file_uploads", "On");
