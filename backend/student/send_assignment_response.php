<?php
    include("config.php");
    include("../file_handling/upload_file.php");
    session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $assignment_id    = $_POST['assignment_id'];
      $student_id       = $_SESSION['user_id'];

      $sql = $db->prepare("INSERT INTO assignment_responses (assignment_id, student_id, response_answer) VALUES (?,?,?)");
      $sql->bind_param("iis", $assignment_id, $student_id, $response_answer);

      $response_answer  = isset($_POST['reply']) ? $_POST['reply'] : NULL;

      if ($sql->execute() === TRUE) {
        if(!isset($_POST['reply'])){
          $response_answer = uploadFileSingle($_FILES["file"], "assignment");
          $ar_id = mysqli_fetch_assoc($db->query("SELECT id from assignment_responses ORDER BY id DESC"))['id'];
          $sql = $db->prepare("INSERT INTO assignment_files (ar_id, file_location) VALUES (?,?)");
          $sql->bind_param("is", $ar_id, $response_answer);
          if($sql->execute()){
            echo "Reply saved successfully"; 
          }
        }
        header("location: ../../frontend/courses/assignment.php?id=".$assignment_id);
      }else{
        echo $db->error;
      }
   }
?>