<?php

//php.ini set file_uploads = On
class FileUtils
{
    function upload($companyPrefix,$uploadFolder,$file,$productId){
        $status='';
        
        //Step-I gather file properties to proceed
        $uploadPath = "C:/wamp64/www/-bps-/img/companies/".$companyPrefix."/".$uploadFolder."/";
        //$uploadPath = "/home/users/web/b2206/nf.thesuffahorg/public_html/bitguiders/bpos/img/companies/".$companyPrefix."/".$uploadFolder."/";
        
        $newFileName= ($productId!=-1?$productId.".jpg":basename($file["name"]));
        $uploadPath = $uploadPath.$newFileName;
        $fileName = $file["name"];
        
        $fileSize = $file["size"];
        
        $isUploadOk=0;
        
        //Step-II validate if its image file
        $check = getimagesize($file["tmp_name"]);
        if($check){
            $status = 'success > '.$check["mime"].'- '.$fileName;
            $isUploadOk=1;
        }else{
            $status = 'failure > not an image - '.$fileName;
            $isUploadOk=0;
        }
        
        //Step-II valide allowed image formats
        // Allow certain file formats
        $fileExtension = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
        if($fileExtension != "jpg" && $fileExtension != "png" && $fileExtension != "jpeg"
            && $fileExtension != "gif" ) {
                $status = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $isUploadOk = 0;
        }
            
        /* // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        } */
        
        // Check if $uploadOk is set to 0 by an error
        if ($isUploadOk == 0) {
            $status= "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            try{
                if(move_uploaded_file($file["tmp_name"], $uploadPath)){
                $status= "Product Image uploaded successfully.";
                }else{
                    $status= "Sorry, there was an error uploading your file.";
                }
            }catch(Exception $e){
                $status= "Sorry, there was an error uploading your file.".$e->getMessage();
            }
        }
        return $status;
    }//upload method end
}

?>