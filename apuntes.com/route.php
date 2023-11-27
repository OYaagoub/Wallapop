<?php 

// switch ($requestPath) {
//     case preg_match('/^\/update\/(\d+)$/', $requestPath, $matches):
//         // Render the product page for the product with the ID $matches[1]
//         break;
//     case preg_match('/^\/delete\/(\d+)$/', $requestPath, $matches):
//         break;
//     case preg_match('/^\/new\/(\d+)$/', $requestPath, $matches):
//         break;
//     case '/':
//         include_once('temas.php');

//    





include_once('models.php');

include_once('controllers.php');
$requestPath = $_SERVER['REQUEST_URI'];
$page = isset($_GET['page']) ? $_GET['page'] : 'main';

switch ($page) {
    case 'main':
        include_once('asignaturas.php');
        break;
    case 'DAW':
        $id=1;
        $models= new Models();
        $title="DAW";
        $temas = $models->getTemas($id);
        include_once('temas.php');
        break;
    case 'DIW':
        $id=2;
        $models= new Models();
        $temas = $models->getTemas($id);
        include_once('temas.php');
        break;
    case 'DWES':
        $id=3;
        $models= new Models();
        $temas = $models->getTemas($id);
        include_once('temas.php');
        break;
    case 'DWEC':
        $id=4;
        $models= new Models();
        $temas = $models->getTemas($id);
        include_once('temas.php');
        break;
    case 'DWES_JAVA':
        $id=5;
        $models= new Models();
        $temas = $models->getTemas($id);
        include_once('temas.php');
        break;
    case 'PROJECT_FINAL':
        $id=6;
        $models= new Models();
        $temas = $models->getTemas($id);
        include_once('temas.php');
        break;
    case 'new':
        $id=$_POST['id'];
        $apunte=$_POST['content'];
        $nombre=$_POST['nombre'];
        $models= new Models();
        $setApunte = $models->setApunte($id,$apunte,$nombre);
        $retVal = ($setApunte==true) ? header("Location: {$_SERVER['HTTP_REFERER']}"):  printf('Error With information') ;
        
        break;
    case 'delete':
        $id=$_GET['id'];
        $models= new Models();
        $delApunte = $models->delApunte($id);
        $retVal = ($delApunte==true) ? header("Location: {$_SERVER['HTTP_REFERER']}"):  printf('Error With information') ;
        break;
    case 'searchS':
        $search=$_GET['search'];
        $id_asignatura_s=$_GET['id_asi'];
        $models= new Models();
        if(isset($id_asignatura_s)){
            
            $search = $models->getSearchIn($search,$id_asignatura_s);
            
        }else{
            
            $search = $models->getSearch($search);
        }
        include_once('temasS.php');

        
        break;
    default:
        echo 'ERROR 404';
        break;
}


?>
