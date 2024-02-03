<?php


require_once "BD_PDO.php";
class PaginacionModel
{
    private $paginas;

    function __construct($paginas)
    {
        $this->paginas = $paginas;
    }


    function totalPaginas($codcat)
    {
        $paginas = $this->paginas;
        BD_PDO::conectar();
        try {
            //select * from producto where codigoCategoria=:codcat
            $tabla = array('producto');
            $sacarConsulta = array('*');
            $condiciones = array('codigoCategoria' => $codcat);
            $resultado = BD_PDO::generar_Consulta($sacarConsulta, $tabla, $condiciones);
            $numProductos = count($resultado);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
        /*Obtengo el n total de registros de mi bd
        y calcula cuantas paginas a mostrar en bloques los registros
        */
        $total = intval($numProductos / $paginas);
        if ($numProductos % $paginas) {
            $total++;
        }
        return $total;
    }

    function registros($inicio, $codcat)
    {
        /*Obtengo los registros de la bd que se mostraran en la pagina 
        con el limit, mostramos un limite de registros
        */
        BD_PDO::conectar();
        try {
            //select * from producto where codigoCategoria='codcat limit1,2
            $origen = array('producto');
            $sacar = array('*');
            $inicio = ($inicio - 1) * $this->paginas;
            $condiciones = array('codigoCategoria' => array('valor' => $codcat, 'relacion' => "="));
            $extras = array("limit ".$inicio.",".$this->paginas => "");
            $resultado = BD_PDO::generar_Consulta2($sacar, $origen, $condiciones, array(), $extras);
            //var_dump($resultado);
            return $resultado;
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    function paginacion($n, $total, $categoria)
    {
        //Paginacion con bootstrap creando botones
        $mostrar = "";
        $mostrar .= "<nav aria-label='Page navigation example col-12'>";
        $mostrar .= "<ul class='pagination col-12 justify-content-center'>";
        if ($n == 1) {
            $mostrar .= "<li class='page-item disabled'><button onclick='listar(1,\"$categoria\")' class='page-link' href='?pagina=1' aria-label='Previous'>
        <span aria-hidden='true'>&laquo;</span>
        </button></li>";
        } else {
            $mostrar .= "<li class='page-item'><button onclick='listar(1,\"$categoria\")' class='page-link' href='?pagina=1' aria-label='Previous'>
        <span aria-hidden='true'>&laquo;</span></button></li>";
        }
        for ($i = 1; $i <=$total; $i++) {
            $j = $i * 1;
            if ($n == $i) {
                $mostrar .= "<li class='page-item active'><button onclick='listar($i,\"$categoria\")' class='page-link' href='?pagina=" . $i . "'>" . $j . "</button></li>";
            } else {
                $mostrar .= "<li class='page-item'><button onclick='listar($i,\"$categoria\")'  class='page-link' href='?pagina=" . $i . "'>" . $j . "</button></li>";
            }
        }
        if ($n == $total) {
            $mostrar .= "<li class='page-item disabled'><button onclick='listar($total,\"$categoria\")' class='page-link' href='?pagina=" . $total . "'><span href='?pagina=" . $total . "' aria-hidden='true'>&raquo;</span></button>
        </li>";
        } else {
            $mostrar .= "<li class='page-item'><button onclick='listar($total,\"$categoria\")'class='page-link' href='?pagina=" . $total . "'><span href='?pagina=" . $total . "' aria-hidden='true'>&raquo;</span></button>
        </li>";
        }

        $mostrar .= "</ul></nav>";
        return $mostrar;
    }
}
