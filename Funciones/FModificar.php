<?php
function modificar($categoria)
{
    require_once "../Model/PaginacionModel.php";
    $pagina = 1;
    $num = 4;
    $mostrar = "";
    $botones = "";
    $i=0;

    $paginacion = new PaginacionModel($num);

    //var_dump($totalPaginas);
    $totalPaginas = $paginacion->totalPaginas($categoria);
    $registros = $paginacion->registros($pagina, $categoria);
    //var_dump($registros);
    if (count($registros) > 0) {
        $mostrar .= "<form action='' method='post' ><table class='table align-middle'><thead>"
            . "<tr><th>CÓDIGO</th><th>NOMBRE</th><th>DESCRIPCIÓN</th><th>CÓDIGO</th><th>CÓDIGO CATEGORIA</th><th>FOTO</th><th>STOCK</th></thead><tr>";
        foreach ($registros as $row) {
            //devuelvo la consulta de la tabla
            $mostrar .= "<tr>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][$row->codigo]' value=" . $row->codigo . "></td>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][nombre]' value=" . $row->nombre . "></td>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][descripcion]' value=" . $row->descripcion  . "></td>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][precio]' value=" . $row->precio . "></td>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][codigoCategoria]' value=" . $row->codigoCategoria  . "></td>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][foto]' value=" . $row->foto   . "></td>"
                . "<td><input class='border-0 bg-white text-uppercase' type='text' name='pro[$i][unidad]' value=" . $row->unidad  . "></td>";
                $i++;
        }
        $mostrar .= "</tr></tbody></table><div class='d-flex justify-content-center'><input type='submit' class='btn btn-dark btn-lg btn-block' name='modificar' class='btn btn-dark btn-lg btn-block' value='Modificar datos de Producto'></div></form>";

        $botones = $paginacion->paginacion($pagina, $totalPaginas, $categoria);
    } else {
        $mostrar .= "<div class='col-6 col-sm-6 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0'><div class='p-3 border-0 bg-white' >No hay productos</div></div";
        return $mostrar;
    }
    return $mostrar . $botones;
}
