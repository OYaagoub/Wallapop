<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title><?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 'main';
            switch ($page) {
                case 'DWES':
                    $ida=3;
                    echo 'DWES';
                    break;
                case 'DIW':
                    $ida=2;
                    echo 'DIW';
                    break;
                case 'DAW':
                    $ida=1;
                    echo 'DAW';
                    break;
                case 'DWEC':
                    $ida=4;
                    echo 'DWEC';
                    break;
                case 'DWES_JAVA':
                    $ida=5;
                    echo 'DWES_JAVA';
                    break;
                case 'PROJECT_FINAL':
                    $ida=6;
                    echo 'PROJECT_FINAL';
                    break;
                case 'searchS':
                    $ida=$_GET['id_asi'];
                    echo 'SearchS';
                    break;
                                         
                default:
                    echo 'Home';
                    break;
            }
            
            ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    
    </head>