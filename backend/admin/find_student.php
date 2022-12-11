<?php

    include("config.php");

    $s = $_GET['name'];

    $sql = $db->query("SELECT * FROM users WHERE role = 'STUDENT' AND fname LIKE '%".$s."%' OR role = 'STUDENT' AND lname LIKE '%".$s."%';");

    $ret = mysqli_fetch_all($sql);

    echo json_encode($ret);
?>