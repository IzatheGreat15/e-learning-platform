<?php
    $notif = $db->prepare("INSERT INTO notifications (sg_id, message, link) VALUES (?,?,?)");
    $notif->bind_param("iss", $sg_id, $message, $link);
?>