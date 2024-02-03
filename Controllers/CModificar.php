<?php
$mostrar = "";

if(isset($_POST['modificar'])){
    require_once "../Model/BD_PDO.php";
    BD_PDO::conectar();
    //array con todas las columnas de la tabla
    $almacenarDatos=array('nombre','descripcion','precio','codigoCategoria','foto','unidad');
    //elimino modificar, para evitar que se meta en un bucle
    unset($_POST['modificar']);
    //recorrer post[pro]
    foreach($_POST['pro'] as $value){
        $codigo='';
        foreach($value as $columna => $valor){
            if(!in_array($columna, $almacenarDatos)){
                $codigo=$columna;
                  /*
     * $tabla='tabla';
     * $valores=array('columna'=>'valor','columna'=>'valor');
     * $condiciones= array('socios.email' => $_POST['correo']); (opcional)
     * update usuario set nombre_apellido=$nombre, telefono=$telefono where correo=correo;
     *      */
                $tabla='producto';
                $valores=array($codigo=>$valor);
                $condiciones=array('codigo'=>$valor);
                BD_PDO::generar_actualizar($tabla,$valores,$condiciones);
                $codigo=$valor;
            }else{
                $tabla='producto';
                $valores=array($valor=>$columna);
                $condiciones=array('codigo'=>$codigo);
                BD_PDO::generar_actualizar($tabla,$valores,$condiciones);
            }
        }
    }
}
require_once "../Funciones/FModificar.php";
if (isset($_POST['mostrar'])) {

    $_SESSION['categoria'] = $_POST['codigoCategoria'];
    $mostrar = modificar($_POST['codigoCategoria']);
} elseif (isset($_SESSION['categoria'])) {

    $mostrar = modificar($_POST['codigoCategoria']);
}
require_once "../Model/CategoriasModel.php";

$sql = new CategoriasModel(1, 2);
$categoria = CategoriasModel::getCategorias();

require_once "../Funciones/FCategorias.php";
$mostrarSelect = '';
$mostrarSelect = selectCategoria($categoria);


require_once "../Views/VModificar.php";
