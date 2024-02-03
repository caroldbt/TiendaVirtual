<?php
/**
 * Description of BD_PDO
 *
 * @author user
 */
class BD_PDO {
    private static $connex;
    private static $base='Tienda';
    private static $host='127.0.0.1';
    private static $usuario='root';
    private static $contraseña='';
    
    static function conectar(){
        self::$connex= new PDO("mysql:host=".self::$host
                                .";dbname=".self::$base
                                ,self::$usuario, self::$contraseña);
    }
    
    //La función recibirá cuatro arrays
    /*
    $sacar= array('email'); (obligatorio)
    $origen= array('socios'); (obligatorio)
    $foranea= array('socios.email' => 'avalista.email'); (innecesario, si no hay varios origenes. 
     * en caso contrario a de agregarse obligatoriamente.)
    $condiciones= array('socios.email' => $_POST['correo']); (opcional)
    $extras= array('group by'=>$valor); (opcional)

    Te devuelve la consulta generada.*/
    static function generar_Consulta($sacar,$origen,$condiciones=Array(),$foranea=Array(),$extras=Array(),$hab_binary=false){
        if(empty($sacar)) return false;
        if(empty($origen)) return false;
        
        $consulta="select ";
        
        //Datos
        $contador=0;
        foreach($sacar as $campo){
            if($contador==0) $consulta.=$campo;
            else $consulta.=",".$campo;
            $contador++;
        }
        
        //Origenes
        $contador=0;
        foreach($origen as $tabla){
            if($contador==0) $consulta.=" from ".$tabla;
            else $consulta.=",".$tabla;
            $contador++;
        }
        
        //Condiciones
        if(!empty($foranea) && count($origen)>1){
            $contador=0;
            $binary=($hab_binary)?"binary":"";
            
            foreach($foranea as $campo1=>$campo2){
                if($contador==0) $consulta.=" where $campo1=$campo2";
                else $consulta.=" and $campo1=$campo2";
                $contador++;
            } 
            
            foreach($condiciones as $campo=>$valor) $consulta.=" and $campo= $binary :$campo";
        }
        else{
            $contador=0;
            $binary=($hab_binary)?"binary":"";
            foreach($condiciones as $campo=>$valor){
                if($contador==0) $consulta.=" where $campo= $binary :$campo";
                else $consulta.=" and $campo= $binary :$campo";
                $contador++;
            } 
        }
        
        //Extras
        foreach ($extras as $extra=>$configuracion) $consulta.=" $extra $configuracion";
        
        //var_dump($consulta);

        //Ejecución
        $ejecucion = self::$connex->prepare($consulta);
        foreach($condiciones as $campo=>&$valor) $ejecucion->bindParam(":$campo",$valor);
        $ejecucion->execute();
        $resultado=$ejecucion->fetchAll(PDO::FETCH_OBJ);

        return $resultado;

    }
    
    //La función recibirá cuatro arrays en esta puedes especificar realacion en los where.
    /*
    $sacar= array('0' => 'email'); (obligatorio)
    $origen= array('0' => 'socios'); (obligatorio)
    $foranea= array('socios.email' => 'avalista.email'); (innecesario, si no hay varios origenes. 
     * en caso contrario a de agregarse obligatoriamente.)
    $condiciones= array('socios.email' => array("valor"=>'Hola',"relacion"=>'>=')); (opcional)
    $extras= array('group by'=>$valor); (opcional)

    Te devuelve la consulta generada.*/
    static function generar_Consulta2($sacar,$origen,$condiciones=Array(),$foranea=Array(),$extras=Array(),$hab_binary=false){
        if(empty($sacar)) return false;
        if(empty($origen)) return false;
        
        $consulta="select ";
        
        //Datos
        $contador=0;
        
        foreach($sacar as $campo){
            if($contador==0) $consulta.=$campo;
            else $consulta.=",".$campo;
            $contador++;
        }
        
        //Origenes
        $contador=0;
        foreach($origen as $tabla){
            if($contador==0) $consulta.=" from ".$tabla;
            else $consulta.=",".$tabla;
            $contador++;
        }
        
        //Condiciones
        if(!empty($foranea) && count($origen)>1){
            $contador=0;
            $binary=($hab_binary)?"binary":"";
            
            foreach($foranea as $campo1=>$campo2){
                if($contador==0) $consulta.=" where $campo1=$campo2";
                else $consulta.=" and $campo1=$campo2";
                $contador++;
            } 
            
            foreach($condiciones as $campo=>$valor) {
                $relacion=$valor['relacion'];
                $consulta.=" and $campo $relacion $binary :$campo";
            }
        }
        else{
            $contador=0;
            $binary=($hab_binary)?"binary":"";
            foreach($condiciones as $campo=>$valor){
                $relacion=$valor['relacion'];
                if($contador==0) $consulta.=" where $campo $relacion $binary :$campo";
                else $consulta.=" and $campo $relacion $binary :$campo";
                $contador++;
            } 
        }
        
        //Extras
        foreach ($extras as $extra=>$configuracion) $consulta.=" $extra $configuracion";
        //var_dump($consulta);
        
        
        //Ejecución
        $ejecucion = self::$connex->prepare($consulta);
        foreach($condiciones as $campo=>&$valor) $ejecucion->bindParam(":$campo",$valor['valor']);
        $ejecucion->execute();
        $resultado=$ejecucion->fetchAll(PDO::FETCH_OBJ);

        return $resultado;
    }
    
    /*Te da la sentencia para insertar.

     * $tabla=string
     * $values=array("campo"=>"valor");
     * 
     *      */
    static function generar_insertar($tabla,$values){
        if(trim($tabla)=='') return false;
        if(empty($values)) return false;
        
        $consulta="insert into $tabla (";
        $valores='';
        $cont=0;
        foreach ($values as $campo=>$valor){
            if($cont==0) {
                $consulta.=$campo;
                $valores.=":$campo";
            }
            else {
                $consulta.=",".$campo;
                $valores.=",:$campo";
            }
            $cont++;
        }
        $consulta.=") values($valores);";
        //var_dump($consulta);
        //Ejecución
        $ejecucion = self::$connex->prepare($consulta);
        foreach($values as $campo=>&$valor) $ejecucion->bindParam(":$campo",$valor);
        return $ejecucion->execute();
    }
    
    /*
     * $tabla=palabras;
     * $condiciones= array('socios.email' => $_POST['correo']); (opcional)
     */
    static function generar_borrar($tabla,$condiciones=array()){
        if(trim($tabla)=='') return false;
        
        $consulta="delete from $tabla";
        $cont=0;
        foreach ($condiciones as $campo=> $valor){
            if($cont==0) $consulta.=" where $campo=:$campo";
            else $consulta.=" and $campo=:$campo";
            $cont++;
        }
        var_dump($consulta);
        $ejecucion = self::$connex->prepare($consulta);
        foreach($condiciones as $campo=>&$valor) $ejecucion->bindParam(":$campo",$valor);
        return $ejecucion->execute();
    }
    
    /*
     * $tabla='tabla';
     * $valores=array('columna'=>'valor','columna'=>'valor');
     * $condiciones= array('socios.email' => $_POST['correo']); (opcional)
     *      */    
    static function generar_actualizar($tabla,$valoresnuevos,$condiciones=array()){
        if(trim($tabla)=='') return false;
        if(empty($valoresnuevos)) return false;
        
        $consulta="update $tabla set ";
        
        $cont=0;
        foreach($valoresnuevos as $campo=>$valor){
            if($cont==0) $consulta.="$campo=:$campo"."1";
            else $consulta.=",$campo=:$campo"."1";
            $cont++;
        }
        
        $cont=0;
        foreach($condiciones as $campo=>$valor){
            if($cont==0) $consulta.=" where $campo=:$campo"."2";
            else $consulta.=" and $campo=:$campo"."2";
            $cont++;
        }
        
        var_dump($consulta);
        
        $ejecucion = self::$connex->prepare($consulta);
        foreach($valoresnuevos as $campo=>&$valor) $ejecucion->bindParam(":$campo"."1",$valor);
        foreach($condiciones as $campo=>&$valor) $ejecucion->bindParam(":$campo"."2",$valor);
        return $ejecucion->execute();
    }
    
}
