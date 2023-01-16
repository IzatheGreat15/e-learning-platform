<?php
    $notif = $db->prepare("INSERT INTO notifications (sg_id, message, link) VALUES (?,?,?)");
    $notif->bind_param("iss", $sg_id, $message, $link);

    $users = mysqli_fetch_all($db->query("SELECT users.contact_num, users.email, subject_group.subject_group_name FROM subject_group LEFT JOIN sections ON sections.id = subject_group.section_id LEFT JOIN enrollments ON enrollments.section_id = sections.id LEFT JOIN users on users.id = enrollments.student_id WHERE subject_group.id = ".$sg_id), MYSQLI_ASSOC);
    foreach($users as $user){
        
        $emessage = $message.' From: Paref Southridge School';

        $phpmailer->addAddress($user['email']);
    
        $phpmailer->Subject = $user['subject_group_name'].": ".$subject;
        $phpmailer->Body = $emessage;
    
        echo $phpmailer->send();

        $ch = curl_init();
        $parameters = array(
            'apikey' => '52fd5e88168c12c0103f833418dbc24f', 
            'number' => $user['contact_num'],
            'message' => $message.' From: Marick Elementery School (SMS Notification)'.$link,

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
    
?>