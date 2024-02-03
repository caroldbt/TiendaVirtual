<?php
if(isset($_GET['salir'])){
    $_SESSION=array();
}

if(isset($_GET['indice'])){
    $dir='Controllers/C'.$_GET['indice'].'.php';
    if(file_exists($dir)){
        require_once $dir;
        die();
    }
}
if(isset($_SESSION['redi'])){
    require_once $_SESSION['redi'];
    die();
}


require_once "Views/VPrincipal.php";