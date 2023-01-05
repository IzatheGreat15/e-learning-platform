<?php
    $notif = $db->prepare("INSERT INTO notifications (sg_id, message, link) VALUES (?,?,?)");
    $notif->bind_param("iss", $sg_id, $message, $link);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'php_mailer/src/Exception.php';
    require 'php_mailer/src/PHPMailer.php';
    require 'php_mailer/src/SMTP.php';

    $users = mysqli_fetch_all($db->query("SELECT users.contact_num, users.email, subject_group.subject_group_name FROM subject_group LEFT JOIN sections ON sections.id = subject_group.section_id LEFT JOIN enrollments ON enrollments.section_id = sections.id LEFT JOIN users on users.id = enrollments.student_id WHERE subject_group.id = ".$sg_id), MYSQLI_ASSOC);
    foreach($users as $user){
        
        $emessage = $message.' <br /><a href="http://localhost/E-Learning-Project/frontend/courses/'.$link.'"><button type="button">View Activity Here</button></a>';

        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'd640fa24417cee';
        $phpmailer->Password = 'd320b289b66c22';
    
        $phpmailer->setFrom('mailer@elearning.online');
        $phpmailer->addAddress($user['email']);
        $phpmailer->isHTML(true);
    
        $phpmailer->Subject = $user['subject_group_name'].": ".$subject;
        $phpmailer->Body = $emessage;
    
        echo $phpmailer->send();

        $ch = curl_init();
        $parameters = array(
            'apikey' => 'aaa9b8eaeccc90902e6d299bac9c645a', 
            'number' => $users['contact_num'],
            'message' => $message.' Link: http://localhost/E-Learning-Project/frontend/courses/'.$link,
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