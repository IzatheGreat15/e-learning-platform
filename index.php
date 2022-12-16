<?php
    session_start();

    include("backend/db/RunAtFirstUse.php");
    header("location: frontend/index.php");
?>