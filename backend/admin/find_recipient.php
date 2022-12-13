<?php

    include("config.php");

    $s = $_GET['name'];

    $sql = $db->query("SELECT * FROM users WHERE role != 'ADMIN' AND (fname LIKE '%".$s."%' OR lname LIKE '%".$s."%');");

    $ret = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    echo json_encode($ret);
?>