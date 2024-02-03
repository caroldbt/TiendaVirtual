<?php
$texto = "";
if (isset($_POST['anadir'])) {
    require_once '../Funciones/FNuevo.php';
    $texto = anadir();
}

require_once "../Model/CategoriasModel.php";
$sql=new CategoriasModel(1,2);
$select=CategoriasModel::getCategorias();
require_once "../Funciones/FCategorias.php";
$categoria='';
$categoria=selectCategoria($select);

require_once "../Views/VNuevo.php";