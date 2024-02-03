<?php
require_once "../Model/BD_PDO.php";
$select = $_GET['categoria'];

$sacarConsulta = array('codigo', 'nombre', 'precio', 'foto');
$tabla = array('producto');
$condicionesConsulta = array('nombre' => array('valor' => "%$select%", 'relacion' => 'like'));
BD_PDO::conectar();
$respuesta = BD_PDO::generar_Consulta2($sacarConsulta, $tabla, $condicionesConsulta);

if (count($respuesta) > 0) {
    $mostrar = "";
    foreach ($respuesta as $row) {
        $cod = $row->codigo;
        $mostrar .= "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white'>"
            . "<button class='border-0 bg-white text-uppercase' type='submit' name='ver[$cod]'><form action='' method='post'><p><img src='Imagen/" . $row->foto . "' alt='Imagen no disponible' width=250px height=380px></p>"
            . "<p><b>" . $row->nombre . "</b></p>"
            . "<p>" . $row->precio . "</p>"
            //. "<input type='checkbox' class='me-2 col-sm-3 col-md-3 col-lg-3' name='producto[" . $row->codigo . "]'>"
            . "</button></form>"
            . "</div></div>";
    }
} else {
    $mostrar = "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white'height=400px>No se ha encontrado resultados</div></div";
}
echo $mostrar;
