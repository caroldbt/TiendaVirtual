<?php

require_once "BD_PDO.php";
class CategoriasModel{
    private $codcategoria;
    private $tipo;

    function __construct($codcategoria,$tipo){
        $this->codcategoria = $codcategoria;
        $this->tipo = $tipo;
    }

    static function getCategorias(){
        BD_PDO::conectar();
        //select * from Categorias;
        $tabla= array('categorias');
        $consulta= array('*');
        $respuesta=BD_PDO::generar_Consulta($consulta,$tabla);
        return $respuesta;
    }
}