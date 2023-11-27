<?php 
require_once 'app/http/Healper/healper.php';
require_once 'app/http/controllars/connexionController.php';
require_once 'app/http/controllars/loginSignController.php';
require_once 'app/http/controllars/anuncioController.php';
include 'app/models/User.php';
include 'app/models/Anuncio.php';
include 'app/models/Image.php';
$healper = new Healper();
$log = new LoginController();
$anu = new AnuncioController();
$log->checklogcode();
$email=$pass=$fullname=$location=$phone="";
if (isset($_GET['page'])) {
    if ($_GET['page'] == "home") {
        $anuncios=$anu->getAll();
        require("resource/views/includes/cardAds.php");
    } elseif ($_GET['page'] == "details") {
        if(isset($_POST['action']) && $_POST['action'] =="imgp"){
            $path=$healper->moveImagesAds($_SESSION['id_user'],$_POST['id_st'],$_FILES['imgpN'],"home");
            if ($anu->updateImageAnu($_POST['id_st'],$path)) {
                unlink($_POST['imgpA']);
            }

        }
        if(isset($_POST['action']) && $_POST['action'] =="imgs"){
            $path=$healper->moveImagesAds($_SESSION['id_user'],$_POST['id_st'],$_FILES['imgN'],"home");
            if ($anu->updateImage($_POST['id_img'],$path)) {
                unlink($_POST['imgA']);
            }

        }
        if(isset($_POST['action']) && $_POST['action'] =="price"){
            if ($anu->updatePrice($_POST['id_st'],$_POST['monida'].$_POST['price1'].".".$_POST['price2'])) {
                
            }

        }
        if(isset($_POST['action']) && $_POST['action'] =="title"){
            if ($anu->updateTitle($_POST['id_st'],$healper->cleanString($_POST['title'],"misanuncios"))) {
                
            }

        }
        if(isset($_POST['action']) && $_POST['action'] =="description"){
            if ($anu->updateDescription($_POST['id_st'],$healper->cleanString($_POST['description'],"misanuncios"))) {
                
            }

        }
        if (isset($_GET['id_st']) && $_GET['id_st'] != "") {
            $anun_details = $anu->getById($_GET['id_st']);
            $images_details = $anu->getImagesAnu($_GET['id_st']);
            $user_details=$log->getUserDataAnu($anun_details->getId_user());
            $edit="false";
            if (isset($_SESSION['id_user']) && $anun_details->getId_user()==$_SESSION['id_user']) {
                $edit="true";
            }
            require("resource/views/pages/details.php");
            
        }else{
            header("Location: index.php?page=home");
        }
    }
    elseif ($_GET['page'] == "login") {
        if (isset($_POST['action']) && $_POST['action'] == "login") {
            $email = $healper->cleanEmail($_POST['email'],$_GET['page']);
            $password = $_POST['password'];
            $log->login($email,$password);
           
        }
        if (isset($_SESSION['logcode'])) {
            header("Location: /Wallapop/index.php?page=home");
        }else{
            require("resource/views/pages/login.php");
        }
    }
    elseif ($_GET['page'] == "signUp") {
        if (isset($_POST['action']) && $_POST['action'] == "signUp") {
            $newUser=new User();
            $email=$_POST['email'];
            $pass=$_POST['password'];
            $fullname=$_POST['fullname'];
            $location=$_POST['location'];
            $phone=$_POST['phone'];
            $newUser->setEmail($healper->cleanEmail($email,$_GET['page']));
            $newUser->setPassword($healper->cleanPassword($pass));
            $newUser->setFullname($healper->cleanString($fullname,$_GET['page']));
            $newUser->setPhone($healper->cleanPhone($phone));
            $newUser->setPoblacion($healper->cleanString($location,$_GET['page']));
            $newUser->setPhoto($healper->moveImageUser($_FILES['imageUser'],$_GET['page']));
            $log->signUp($newUser);

        }
        if (isset($_SESSION['logcode'])) {
            header("Location: /Wallapop/index.php?page=home");
        }else{

            require("resource/views/pages/signUp.php");
        }
    }elseif ($_GET['page'] == "misanuncios") {
        
        $title=$description=$monida=$photoPran="";
        $p1=$p1="";
        if (isset($_POST['action']) && $_POST['action'] == "new") {
            $title=$_POST['title'];
            $description=$_POST['description'];
            $photoPran=$_FILES['photoPran'];
            $anuncio_new=new Anuncio();
            $anuncio_new->setTitle($healper->cleanString($_POST['title'],$_GET['page']));
            $anuncio_new->setDescription($healper->cleanString($_POST['description'],$_GET['page']));
            $monida=$_POST['monida'];
            $p1=$_POST['price1'];
            $p2=$_POST['price2'];
            $anuncio_new->setPrice($monida.$p1.".".$p2);
            $anuncio_new->setId_user($_SESSION['id_user']);
            $anuncio_new->setImage($healper->moveImagesAds($_SESSION['id_user'],"HeadImages",$_FILES['photoPran'],$_GET['page']));
            $inserted_anu=$anu->insert($anuncio_new);
            if(isset($_FILES['photos'])){
                $images = $_FILES['photos'];

                // Loop through each uploaded file
                for ($i = 0; $i < count($images['name']); $i++) {
                    $image = array(
                        'name' => $images['name'][$i],
                        'type' => $images['type'][$i],
                        'tmp_name' => $images['tmp_name'][$i],
                        'error' => $images['error'][$i],
                        'size' => $images['size'][$i]
                    );

                    $path = $healper->moveImagesAds($_SESSION['id_user'], $inserted_anu->getId(), $image, $_GET['page']);
                    $anu->insertImage($inserted_anu->getId(), $path);
                }

            }

            
        }
        if (isset($_GET['id_anuncion_del']) && !empty($_GET['id_anuncion_del'])) {
            $anuncio_predel=$anu->getById($_GET['id_anuncion_del']);
            $id_user_predel=$anuncio_predel->getId_user();
            if ($id_user_predel==$_SESSION['id_user']) {
                
                
                $path="public/assets/uploads/".$_SESSION['id_user']."/".$_GET['id_anuncion_del']."/";
                if (is_dir($path)) {
                    foreach (scandir($path) as $item) {
                        if ($item == '.' || $item == '..') {
                            continue;
                        }
                
                        unlink($path . DIRECTORY_SEPARATOR . $item);
                    }
                    rmdir($path);
                }
                $image=$anuncio_predel->getImage();
                if (is_file($image)) {
                    # code...
                    unlink($image);
                }
                $anu->removeImages($_GET['id_anuncion_del']);
                if ($anu->delete($_GET['id_anuncion_del'])) {
                    header("Location: /Wallapop/index.php?page=misanoncios");
                }
            }else{

            }

            
        }
        
        if (isset($_SESSION['logcode'])) {
            $misanuncios=$anu->getByUser($_SESSION['id_user']);
            require("resource/views/pages/misanuncios.php");
        }else{
            header("Location: /Wallapop/index.php?page=home");
        
        }

    }elseif ($_GET['page'] == "logout") {
        $log->logout();
        
    }elseif ($_GET['page'] == "searchBox") {
        $anuncios=$anu->searchByTitle($healper->cleanString($_GET['search'],"home"));
        require( "resource/views/includes/cardAds.php");
    }
} else {
    $anuncios=$anu->getAll();
    require( "resource/views/includes/cardAds.php");
}

?>
