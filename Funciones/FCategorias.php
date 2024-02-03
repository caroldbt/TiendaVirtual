<?php
//funcion para seleccionar categorias

function selectCategoria($resultado){
    $mensaje='';

    if(count($resultado)>0){
        $mensaje.="<select class='form-select' aria-label='Default select example' name='codigoCategoria'>
        <option selected>Seleccione una categoria...</option>";
        $contador=0;
        foreach($resultado as $filas){
            $mensaje.="<option value='".$filas->codigoCategoria."'>".$filas->tipo."</option>";
            $contador++;
        }
        $mensaje.="</select>";
    }
    return $mensaje;
}
