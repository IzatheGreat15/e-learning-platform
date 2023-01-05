<?php
    session_start();
    include_once("backend/db/RunAtFirstUse.php");
    header("location: frontend/index.php");
?>