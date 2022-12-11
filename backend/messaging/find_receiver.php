<?php

    include("config.php");

    $s = $_GET['name'];

    $sql = $db->query("SELECT * FROM users WHERE fname LIKE '%".$s."%' AND role <> 'ADMIN' OR lname LIKE '%".$s."%' AND role <> 'ADMIN';");

    $ret = mysqli_fetch_all($sql);

    echo json_encode($ret);
?>