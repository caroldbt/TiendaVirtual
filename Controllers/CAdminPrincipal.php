<?php


$mostrar="";
if(isset($_POST['mostrar'])){
    require_once "../Funciones/FListar.php";

    $mostrar=listado($_POST['codigoCategoria']);
}
require_once "../Model/CategoriasModel.php";
$sql=new CategoriasModel(1,2);
$categoria=CategoriasModel::getCategorias();
require_once "../Funciones/FCategorias.php";
$mostrarSelect='';
$mostrarSelect=selectCategoria($categoria);

require_once "../Views/VAdmin.php";
die();