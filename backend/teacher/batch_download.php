<?php

    session_start();

    $assignment_id = $_GET['id'];
    $sg_id = $_SESSION['sg_id'];
    $zip = new ZipArchive;
    $download = 'download.zip';
    $zip->open($download, ZipArchive::CREATE);

    $path = opendir("../../frontend/files/assignment/".$sg_id."_".$assignment_id);
    $f_path = "../../frontend/files/assignment/".$sg_id."_".$assignment_id;

    while (false !== ($image = readdir($path))) { /* Add appropriate path to read content of zip */
        if($image !== "." && $image !== "..")
            $zip->addFile($f_path."/".$image, $image);
    }
    $zip->close();
    header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename = $download");
    header('Content-Length: ' . filesize($download));
    header("Location: $download");