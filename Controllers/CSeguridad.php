<?php

if(!isset($_SESSION['usu'])){
    $_GET['salir']='salir';
    require_once "error.php";
    die();
}
