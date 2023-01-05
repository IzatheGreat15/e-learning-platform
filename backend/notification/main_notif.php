<?php
    include_once("send_internal_notif.php");
    
    $users = mysqli_fetch_all($db->query("SELECT users.contact_num, users.email, subject_group.subject_group_name FROM subject_group LEFT JOIN sections ON sections.id = subject_group.section_id LEFT JOIN enrollments ON enrollments.section_id = sections.id LEFT JOIN users on users.id = enrollments.student_id WHERE subject_group.id = ".$sg_id), MYSQLI_ASSOC);
    foreach($users as $user){
        include_once("send_email_notif.php");
    //     include_once("send_sms_notif.php");
    }
    
?>