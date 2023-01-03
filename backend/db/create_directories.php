<?php
    $path = "frontend/files";
    if(!is_dir($path)){
        mkdir($path, $mode = 0777, true);
        mkdir($path."/assignment", $mode = 0777, true);
        mkdir($path."/lesson", $mode = 0777, true);
        mkdir($path."/profile", $mode = 0777, true);
        copy("frontend/images/student.png", "frontend/files/profile/student.png");
        echo "Directories created.";
    }else{
        echo "Directories already exist.";
    }
?>