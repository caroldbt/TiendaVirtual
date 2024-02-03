<?php
function borrar($categoria)
{

    require_once "../Model/PaginacionModel.php";
    $pagina = 1;
    $num = 1;
    $mostrar = "";
    $botones = "";

    $paginacion = new PaginacionModel($num);
    
    //var_dump($totalPaginas);
    $totalPaginas = $paginacion->totalPaginas($categoria);
    $registros = $paginacion->registros($pagina, $categoria);
    //var_dump($registros);
    if (count($registros) > 0) {
        $mostrar.="<form action='' method='post' ><table class='table align-middle'><thead>"
                ."<tr><th>CÓDIGO</th><th>NOMBRE</th><th>DESCRIPCIÓN</th><th>CÓDIGO</th><th>CÓDIGO CATEGORIA</th><th>FOTO</th><th>STOCK</th></thead><tr>";
        foreach ($registros as $row) {
            //devuelvo la consulta de la tabla
            $mostrar .= "<tr>"
                . "<td><input class='border-1 bg-white text-uppercase' type='checkbox' name=cod[] value=" .$row->codigo. "><p><b>" . $row->codigo . "</b></td>"
                . "<td><b>" . $row->nombre . "</b></td>"
                . "<td>" . $row->descripcion . "</td>"
                . "<td><b>" . $row->precio . "</b></td>"
                . "<td><b>" . $row->codigoCategoria . "</b></td>"
                ."<td><img src='../Imagen/" . $row->foto . "' alt='Imagen no disponible' width=200px height=200px></td>"
                . "<td><b>Stock:" . $row->unidad . "</b></td>";
        }
        $mostrar .= "</tr></tbody></table><div class='d-flex justify-content-center'><input type='submit' class='btn btn-dark btn-lg btn-block' name='borrar' class='btn btn-dark btn-lg btn-block' value='Eliminar Producto'></div></form>";
      
        $botones = $paginacion->paginacion($pagina, $totalPaginas, $categoria);
    } else {
        $mostrar .= "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white' >No hay productos</div></div";
        return $mostrar;
    }
    return $mostrar . $botones;
}
