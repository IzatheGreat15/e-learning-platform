<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'php_mailer/src/Exception.php';
    require 'php_mailer/src/PHPMailer.php';
    require 'php_mailer/src/SMTP.php';

    $message = $message.' <br /><a href="http://localhost/E-Learning-Project/frontend/courses/'.$link.'"><button type="button">View Assignment Here</button></a>';

    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'd640fa24417cee';
    $phpmailer->Password = 'd320b289b66c22';

    $phpmailer->setFrom('mailer@elearning.online');
    $phpmailer->addAddress('jayp.tejada@gmail.com'); //$user['email'];
    $phpmailer->isHTML(true);

    $phpmailer->Subject = $user['subject_group_name'].": ".$subject;
    $phpmailer->Body = $message;

    echo $phpmailer->send();
?>