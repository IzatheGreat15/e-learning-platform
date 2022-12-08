<?php
    include("config.php");
    session_start();

    $subject_id = mysqli_fetch_assoc($db->query("SELECT subject_id from subject_group WHERE id = ".$_SESSION['sg_id']))['subject_id'];
    
    var_dump($_POST);

    $module_sql = "INSERT INTO modules (module_title, subject_id) VALUES ('".$_POST['module_title']."', ".$subject_id.")";
    if($db->query($module_sql) === TRUE){
        echo $subject_id;
        $module_id = mysqli_fetch_assoc($db->query("SELECT id from modules ORDER BY id DESC"))['id'];
        for($x = $y = 0; $x < $_POST['lesson_count']; $x++){
            $lesson_sql = "INSERT INTO lessons (lesson_title, module_id) VALUES ('".$_POST['lesson_title'][$x]."', ".$module_id.")";
            if($db->query($lesson_sql)){
                $lesson_id = mysqli_fetch_assoc($db->query("SELECT id from lessons ORDER BY id DESC"))['id'];
                for($z = 0; $z < $_POST['file_count'][$x]; $z++, $y++){
                    $file_name = uploadFile($_FILES['lesson_file'], $y);
                    if($file_name !== FALSE){
                        $lesson_file_sql = "INSERT INTO lesson_files (file_location, lesson_id) VALUES ('".$file_name."', ".$lesson_id.")";
                        $db->query($lesson_file_sql);
                    }
                }
            }
        }
    }else{
        echo $db->error;
    }
    header("location: ../../frontend/courses/quizzes.php");
?>