<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "GET"){
        date_default_timezone_set('Asia/Manila');
        $current_time = time();

        $current_time = new DateTime(date("H:i:s", $current_time));
        $end_time = $_SESSION["end_time"];

        $time_duration = $current_time->diff($end_time);

        $hour = $time_duration->h;
        $minute = $time_duration->i;
        $second = $time_duration->s;

        if($hour == 0 && $minute == 0 && $second == 0){
            // action if time has ran out
            echo "No more time left";
        }else{
            echo $hour . " hours " . $minute . " minutes " . $second . " seconds"; 
        }
   }
?>