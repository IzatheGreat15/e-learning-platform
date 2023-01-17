<?php
   include("../config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
        $quiz_id = $_POST["id"];

        date_default_timezone_set('Asia/Manila');
        $current_time = time();

        $sql = $db->query("SELECT * FROM quizzes WHERE id = ". $quiz_id);
        $quiz = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        $time_limit = explode(":", $quiz[0]["time_limit"]);

        $hour = $time_limit[0];
        $minute = $time_limit[1];
        $second = $time_limit[2];

        $end_time = strtotime("+". $hour ." hours +". $minute ." minutes +". $second ." seconds", $current_time);
        // echo date("H:i:s", $current_time)." ".date("H:i:s", $end_time);
        // $current_time = new DateTime(date("H:i:s", $current_time));
        $end_time = new DateTime(date("H:i:s", $end_time));
        $_SESSION["end_time"] = $end_time;

    
        // $time_duration = $current_time->diff($end_time);
        // echo $time_duration->h . " hours " . $time_duration->i . " minutes " . $time_duration->s . " seconds"; 
   }
?>