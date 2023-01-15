<?php
    $path = "frontend/files";
    if(!is_dir($path)){
        mkdir($path, $mode = 0777, true);
        if(!is_dir($path."/assignment"))
            mkdir($path."/assignment", $mode = 0777, true);
        if(!is_dir($path."/lesson"))
            mkdir($path."/lesson", $mode = 0777, true);
        if(!is_dir($path."/profile"))
            mkdir($path."/profile", $mode = 0777, true);
        copy("frontend/images/student.png", "frontend/files/profile/student.png");
        echo "Directories created.";
    }else{
        echo "Directories already exist.";
    }
?>