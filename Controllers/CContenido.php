<?php

require_once "Controllers/CSeguridad.php";

$_SESSION['redi'] = "Controllers/CContenido.php";
//redireccionar el indice si es igual a Login, es para que permanezca en la pagina

if (isset($_GET['indice']) && $_GET['indice'] == 'Login') {
    header('Location:index.php');
}

require_once "Model/BD_PDO.php";
BD_PDO::conectar();

//$_GET['nombre']='Jersey punto';
//$condicionesConsulta=array('nombre'=>array('valor'=>'%$nombre%','relacion'=>'like'));
//var_dump(BD_PDO::generar_Consulta2($sacarConsulta,$origenTabla,$condicionesConsulta));
//

$sacarConsulta = array('codigo', 'nombre', 'precio', 'foto', 'descripcion', 'unidad');
$tabla2 = 'producto';
$tabla = array($tabla2);
$carrito = 'carrito';
$usu = $_SESSION['usu'];
$aviso = "";
//Cesta actualizacion
if (isset($_POST['producto'])) {
    //datos necesarios para la consulta
    $ud = $_POST['ud'];
    $producto = "";
    foreach ($_POST['producto'] as $codigo => $valor) {
        $producto = $codigo;
    }
    //comprobacion de unidades no superior al stock.
    //consulta, tabla/condiciones: select unidades from productos where codigo ='$producto'
    $sacar = array('unidad');
    $condiciones = array('codigo' => $producto);
    $resultado = BD_PDO::generar_Consulta($sacar, $tabla, $condiciones);
    
    if (count($resultado) > 0) {
        if ($ud <=  $resultado[0]->unidad) {
            //insert into carrito (usuario, codigo, unidades) values(usuario, codigo, unidades);

            $valores = array('codigo' => $producto, 'usuario' => $usu, 'unidades' => $ud);
            $insertar = BD_PDO::generar_insertar($carrito, $valores);
            if (!$insertar) {
                $aviso = "Error al cargar su cesta.";
            }
        } else {
            $aviso = "No hay unidades.";
        }
    }
}
//Consulta de productos en Cesta 
//SELECT SUM(aggregate_expression) FROM tables[WHERE conditions];  
$sacar = array('SUM(unidades) unidades');
$condiciones = array('usuario' => $usu);
$carrito = array($carrito);
$resultadoCesta = BD_PDO::generar_Consulta($sacar, $carrito, $condiciones);
$cesta = $resultadoCesta[0]->unidades;
if ($cesta == NULL) {
    $cesta = 0;
}




//var_dump($_POST);
if (isset($_POST['ver'])) {
    //$condiciones= array('socios.email' => $_POST['correo']); (opcional)
    foreach ($_POST['ver'] as $sacar => $valor) {
        $pro = $sacar;
    }
    $condiciones = array('codigo' => $pro);
    $respuesta = BD_PDO::generar_Consulta($sacarConsulta, $tabla, $condiciones);
    $codigo = $respuesta[0]->codigo;
    $nombre = $respuesta[0]->nombre;
    $imagen = $respuesta[0]->foto;
    $precio = $respuesta[0]->precio;
    $descripcion = $respuesta[0]->descripcion;
    $unidad = $respuesta[0]->unidad;
    if ($unidad == 0) {
        $mensaje = "No hay existencias.";
    } else {
        $mensaje = "Hay $unidad disponibles.";
    }


    require_once "Views/VProducto.php";
    die();
}


$mostrar = "";
$respuesta = BD_PDO::generar_Consulta2($sacarConsulta, $tabla);
if (count($respuesta) > 0) {
    foreach ($respuesta as $row) {
        //devuelvo la consulta de la tabla
        $cod = $row->codigo;
        $mostrar .= "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white'>"
            . "<button class='border-0 bg-white text-uppercase' type='submit' name='ver[$cod]'><form action='' method='post' ><p><img src='Imagen/" . $row->foto . "' alt='Imagen no disponible' width=250px height=380px></p>"
            . "<p><b>" . $row->nombre . "</b></p>"
            . "<p>" . $row->precio . "</p>"
            //. "<input type='checkbox' class='me-2 col-sm-3 col-md-3 col-lg-3' name='producto[" . $row->codigo . "]'>"
            . "</button></form>"
            . "</div></div>";
    }
} else {
    $mostrar = "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white' >No se ha encontrado resultados</div></div";
}

/*
if (isset($_POST['comprar']) && isset($_POST['producto'])) {
    $_SESSION['carrito'] = array();
    $producto = $_POST['producto'];
    $sacar = array('unidad');

    foreach ($producto as $indice => $valor) {
        //consulta update producto set unidad=unidad-1 where codigo='c12';
        //select unidad from producto where codigo='c12';

        $condicionesConsulta = array('codigo' => $indice);
        $array = BD_PDO::generar_Consulta($sacar, $tabla, $condicionesConsulta);
        $unidades = $array[0]->unidad;

        if ($unidades > 0) {
            $valores = array('unidad' => $unidades - 1);
            $condiciones = array('codigo' => $indice);
            BD_PDO::generar_actualizar($tabla2, $valores, $condiciones);
            $mostrar = "Compra realizada correctamente";
        } else {
            $mostrar = "No hay existencias";
        }
    }
    //var_dump($_POST);
}
*/



require_once "Views/VContenido.php";
