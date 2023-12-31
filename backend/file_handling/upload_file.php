<?php    
    
    function uploadFile($file, $x, $folder){
        ini_set("file_uploads", "On");
        $target_dir = "../../frontend/files/".$folder."/";
        $target_file = $target_dir . basename($file["name"][$x]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"][$x]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            return basename($file["name"][$x]);
        }
        
        // Check file size
        if ($file["size"][$x] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "pptx" && $imageFileType != "xlsx") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
            $extension  = pathinfo( $file["name"][$x], PATHINFO_EXTENSION ); // jpg
            $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
            
            if (move_uploaded_file($file["tmp_name"][$x], $target_dir.$basename)) {
                echo "The file ". htmlspecialchars( basename( $file["name"][$x])). " has been uploaded.";
                return $basename;
            } else {
                echo "Sorry, there was an error uploading your file. Final";
            }
        }
        return false;
    }

    function uploadFileSingle($file, $folder){
        ini_set("file_uploads", "On");
        $target_dir = "../../frontend/files/".$folder."/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            return basename($file["name"]);
        }
        
        // Check file size
        if ($file["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "pptx" && $imageFileType != "xlsx") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {

            $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
            $extension  = pathinfo( $file["name"], PATHINFO_EXTENSION ); // jpg
            $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

            if (move_uploaded_file($file["tmp_name"], $target_dir.$basename)) {
                echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
                return $basename;
            } else {
                echo "Sorry, there was an error uploading your file. Final fail.";
            }
        }
        return false;
    }
?>