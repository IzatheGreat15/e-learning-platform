<?php

    include("../config.php");

    $s = $_GET['name'];

    $sql = $db->query("SELECT * FROM users WHERE role = 'STUDENT' AND fname LIKE '%".$s."%' AND id NOT IN (SELECT student_id FROM enrollments) OR role = 'STUDENT' AND lname LIKE '%".$s."%' AND id NOT IN (SELECT student_id FROM enrollments);");

    $ret = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    echo json_encode($ret);
?>