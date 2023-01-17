<?php
session_start();
include("../config.php");

if($_SESSION['role'] == "STUDENT" && isset($_SESSION['section_id']))
$notifs = $db->query("SELECT * FROM notifications JOIN subject_group ON notifications.sg_id = subject_group.id JOIN sections ON sections.id = subject_group.section_id WHERE section_id = ".$_SESSION['section_id']." ORDER BY notifications.created_on DESC");
else        
$notifs = $db->query("SELECT * FROM notifications JOIN subject_group ON notifications.sg_id = subject_group.id WHERE subject_group.teacher_id = ".$_SESSION['user_id']." ORDER BY notifications.created_on DESC");

echo json_encode($notifs);
?>