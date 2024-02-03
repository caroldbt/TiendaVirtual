<?php
function listado($categoria)
{
    require_once "../Model/PaginacionModel.php";
    $pagina = 1;
    define("ELEM_PAGINA", 2);
    $mostrar = "";
    $botones = "";
    

    $paginacion = new PaginacionModel(ELEM_PAGINA);
    $totalPaginas = $paginacion->totalPaginas($categoria);
    //var_dump($totalPaginas);

    $registros = $paginacion->registros($pagina, $categoria);
    //var_dump($registros);
    if (count($registros) > 0) {
        foreach ($registros as $row) {
            //devuelvo la consulta de la tabla
            $cod = $row->codigo;
            $mostrar .= "<div class='col-6 col-sm-6 col-md-5 col-lg-3 '><div class='p-3 border-0 bg-white'>"
                . "<button class='border-0 bg-white text-uppercase' type='submit' name='ver[$cod]'><form action='' method='post' ><p><img src='../Imagen/" . $row->foto . "' alt='Imagen no disponible' width=250px height=380px></p>"
                . "<p><b>" . $row->codigo . "</b></p>"
                . "<p><b>" . $row->nombre . "</b></p>"
                . "<p>" . $row->descripcion . "</p>"
                . "<p><b>" . $row->precio . "</b></p>"
                . "<p><b>Stock:" . $row-> unidad. "</b></p>"
                //. "<input type='checkbox' class='me-2 col-sm-3 col-md-3 col-lg-3' name='producto[" . $row->codigo . "]'>"
                . "</button></form>"
                . "</div></div>";
        }
        $botones .= $paginacion->paginacion($pagina, $totalPaginas, $categoria);
    } else {
        $mostrar .= "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white' >No hay productos</div></div";
    }
    return $mostrar.$botones;
}
