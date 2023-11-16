<?php 
require_once 'app/http/Healper/healper.php';
require_once 'app/http/controllars/connexionController.php';
require_once 'app/http/controllars/loginSignController.php';
require_once 'app/http/controllars/anuncioController.php';
include 'app/models/User.php';
include 'app/models/Anuncio.php';
$healper = new Healper();
$log = new LoginController();
$anu = new AnuncioController();
$log->checklogcode();

if (isset($_GET['page'])) {
    if ($_GET['page'] == "home") {
        require("resource/views/includes/cardAds.php");
    } elseif ($_GET['page'] == "details") {
        require("resource/views/pages/details.php");
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
            $newUser->setEmail($healper->cleanEmail($_POST['email'],$_GET['page']));
            $newUser->setPassword($healper->cleanPassword($_POST['password']));
            $newUser->setFullname($healper->cleanString($_POST['fullname'],$_GET['page']));
            $newUser->setPhone($healper->cleanPhone($_POST['phone']));
            $newUser->setPoblacion($healper->cleanString($_POST['location'],$_GET['page']));
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
                $images=$_FILES['photos'];
                foreach ($images as $image) {
                    $path=$healper->moveImagesAds($_SESSION['id_user'],$inserted_anu->getId(),$image,$_GET['page']);
                    $anu->insertImage($inserted_anu->getId(),$path);
                }

            }

            
        }
        if (isset($_POST['action']) && $_POST['action'] == "edit") {
            
        }
        if (isset($_POST['action']) && $_POST['action'] == "del") {
            
        }
        if (isset($_SESSION['logcode'])) {
            require("resource/views/pages/misanuncios.php");
        }else{
            header("Location: /Wallapop/index.php?page=home");
        
        }
    }elseif ($_GET['page'] == "logout") {
        $log->logout();
        
    }
} else {
    require( "resource/views/includes/cardAds.php");
}

?>
