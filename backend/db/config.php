<?php
   /** DEFINES THE PARAMETERS OF DATABASE CONNECTION **/
   include("../credentials.php");
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   date_default_timezone_set("Asia/Manila");
