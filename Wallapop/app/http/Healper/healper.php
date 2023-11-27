<?php
class Healper 
{
    /**
     * 
     * @param type $id_user
     * @param type $id_anon
     * @param type $image
     * @param type $page
     * @return type $imagepath
     */
    function moveImagesAds($id_user,$id_anuncio,$image,$page){
        $targetUser = "public/assets/uploads/".$id_user;
        $targetAnoncio = $targetUser."/".$id_anuncio;

        $targetFile=$image['name'];
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        $imagepath=$targetAnoncio."/". "image_".date("YmdHis") . '_' . uniqid().".".$imageFileType;
        if (file_exists($targetUser)) {
            if (file_exists($targetAnoncio)) {
                $this->saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath);
            }else{
                mkdir($targetAnoncio, 0777, true);
                $this->saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath);
            }
        }else{
            
            mkdir($targetUser,0777, true);
            mkdir($targetAnoncio,0777,true);
            $this->saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath);
        }
        return $imagepath;

    }
    function moveImageUser($image,$page){
        $targetUser = "public/assets/uploads/"."ImgProfiles";
        $targetAnoncio = $targetUser."/Images";
        $targetFile=$image['name'];
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        $imagepath=$targetAnoncio."/". "image_".date("YmdHis") . '_' . uniqid().".".$imageFileType;
        if (file_exists($targetUser)) {
            if (file_exists($targetAnoncio)) {
                $this->saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath);
            }else{
                
                mkdir($targetAnoncio, 0777, true);
                $this->saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath);
            }
        }else{
            mkdir($targetUser,0777, true);
            mkdir($targetAnoncio,0777,true);
            $this->saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath);
        }
        return $imagepath;

    }
    public function saveImage($image, $targetAnoncio, $page, $imageFileType, $imagepath) {
        $check = getimagesize($image['tmp_name']);
        if ($check === false) {
            $_SESSION['error']="File is not an image.";
            header("Location: /Wallapop/index.php?page=$page");
            exit();
        }
        if ($image['size'] > 5000000) {
            $_SESSION['error']="File too large >5MB ";
            header("Location: /Wallapop/index.php?page=$page");
            exit();
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $_SESSION['error']="Only JPG, JPEG, PNG, and GIF files are allowed.";
            header("Location: /Wallapop/index.php?page=$page");
            exit();

        }
        
        if (!move_uploaded_file($image['tmp_name'], $imagepath)) {
            $_SESSION['error']="Error uploading image";
            header("Location: /Wallapop/index.php?page=$page");
            exit();
        }

    }
    public function cleanString($content, $page){
        if (empty(trim($content))) {
            $_SESSION['error']="Empty input found";
            header("Location: /Wallapop/index.php?page=$page");
            exit();
        }else{

            $string = preg_replace("/[^A-Za-z1-9\s_-]/", '', $content);
            $content = filter_var($string , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            return $content;
        }
    }
    
    public function cleanEmail($email,$page){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }else{
            $_SESSION['error']="Email is not valid";
            header("Location: /Wallapop/index.php?page=$page");
            exit();

        }
    }
    public function cleanPassword($password){
        $password = password_hash($password,PASSWORD_DEFAULT);
        return $password;
    }
    public function cleanPhone($phone){
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        return $phone;
    }
    
}


?>
