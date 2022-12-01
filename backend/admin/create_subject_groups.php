<?php
   /** ADD SUBJECT GROUPS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $adviser_id   = $_POST["adviser"];
      $year_level   = $_POST["year_level"];
      $section_name = $_POST["section_name"];
      $school_year  = $_POST["school_year"];

      $sql = "INSERT INTO sections (adviser_id, year_level, section_name, school_year) VALUES (?,?,?,?)";

      if ($db->query($sql) === TRUE) {
         echo "Section ".$section_name." created successfully";
       } else {
         echo "Error inserting section: " . $db->error;
       }
		
      if($count == 1) {
         $_SESSION['login_user'] = $myemail;
         
         header("location: ../frontend/index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>