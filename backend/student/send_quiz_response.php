<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      var_dump($_POST);
      $student_id = $_SESSION['user_id'];
      $quiz_id = $_POST['id'];

      $sql = $db->prepare("INSERT INTO quiz_responses (qi_id, student_id, response_answer, response_score) VALUES (?,?,?,?)");

      for($x = 0; $x < sizeof($_POST['answer']); $x++){
          $item_id = $_POST['i-id'][$x];
          $response = $_POST['answer'][$x];

          $item = mysqli_fetch_assoc($db->query("SELECT item_answer, max_score  FROM quiz_items WHERE id = ".$item_id));

          $correct_answer = $item['item_answer'];
          $perfect = $item['max_score'];

          $score = ($response === $correct_answer) ? $perfect : 0;

          $sql->bind_param("iisi", $item_id, $student_id, $response, $score);
          if($sql->execute()){
              header("location: ../../frontend/courses/done-quiz.php?id=".$quiz_id."&msg=errorSavingResponse");
          }
      }
      header("location: ../../frontend/courses/done-quiz.php?id=".$quiz_id."&msg=success");
   }else{
    header("location: ../../frontend/courses/done-quiz.php?id=".$quiz_id."&msg=invalidMethod");
   }
?>