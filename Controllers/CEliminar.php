<?php
$mostrar = "";


if (isset($_POST['borrar'])) {

    require_once "../Model/BD_PDO.php";
    BD_PDO::conectar();

    if (empty($_POST['cod'])) {
        $mostrar = "Debe seleccionar al menos un producto";
    } else {
        foreach ($_POST['cod'] as $codigo) {
            /*
     * $tabla=palabras;
     * $condiciones= array('socios.email' => $_POST['correo']); (opcional)
     */
            $tabla = 'producto';
            $condiciones = array('codigo' => $codigo);
            BD_PDO::generar_borrar($tabla, $condiciones);
        }
    }
}

if (isset($_POST['mostrar'])) {
    require_once "../Funciones/FEliminar.php";
    $_SESSION['categoria'] = $_POST['codigoCategoria'];
    $mostrar = borrar($_POST['codigoCategoria']);
} elseif (isset($_SESSION['categoria'])) {
    $mostrar = borrar($_POST['codigoCategoria']);
}
require_once "../Model/CategoriasModel.php";
$sql = new CategoriasModel(1, 2);
$categoria = CategoriasModel::getCategorias();
require_once "../Funciones/FCategorias.php";
$mostrarSelect = '';
$mostrarSelect = selectCategoria($categoria);

require_once "../Views/VEliminar.php";
die();
