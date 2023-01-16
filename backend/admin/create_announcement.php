<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $announcement_title    = $_POST['title'];
      $announcement_body     = $_POST['content'];

      $sql = "INSERT INTO admin_announcements (announcement_title, announcement_body) VALUES ('".$announcement_title."','".$announcement_body."')";

      if ($db->query($sql) === TRUE) {
        echo "Announcement saved successfully";
        if($isNotif == TRUE){
            $message = $announcement_body;

            $users = mysqli_fetch_all($db->query("SELECT contact_num FROM users"), MYSQLI_ASSOC);

            foreach($users as $user){
              $ch = curl_init();
              $parameters = array(
                  'apikey' => '52fd5e88168c12c0103f833418dbc24f', 
                  'number' => $user['contact_num'],
                  'message' => $message.' From: Marick Elementery School (SMS Notification)',

              );
              curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
              curl_setopt( $ch, CURLOPT_POST, 1 );
              
              //Send the parameters set above with the request
              curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
              
              // Receive response from server
              curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
              $output = curl_exec( $ch );
              curl_close ($ch);
              
              //Show the server response
              echo $output;
            }
            if($notif->execute())
              header("location: ../../frontend/admin/announcements.php?m=sucess");
            else
              header("location: ../../frontend/admin/announcements.php?m=notifFailed");
        }else{
          header("location: ../../frontend/admin/announcements.php?m=sucess");
        }
      } else {
        echo "Error saving announcement: " . $db->error;
      }
      header("location: ../../frontend/admin/announcements.php?m=sucess");
   }
?>