<?php
require_once "../Model/BD_PDO.php";
BD_PDO::conectar();
$vacio = [];
$mostrar="";
$tabla ='usuarios';
if (isset($_POST['registro'])) {
    if (empty($_POST['usu'])) {
        $vacio[] = "campo de usuario vacio";
    }
    if (empty($_POST['email'])) {
        $vacio[] = "Correo vacio";
    }
    if (empty($_POST['pass']) || empty($_POST['pass2'])) {
        $vacio[] = "Contrasena vacio";
    }
    if (empty($vacio)) {
        $usu = $_POST['usu'];
        $email = $_POST['email'];
        $contrasena = $_POST['pass'];
        $contrasena2 = $_POST['pass2'];
        if ($contrasena != $contrasena2) {
            $mostrar = "Las contraseñas debes ser iguales";
        } else {
            $_SESSION['usu']=$usu;
            $_SESSION['pass']=$contrasena;
            $cifrarPassword=password_hash($contrasena,PASSWORD_DEFAULT);
            //select usuario from usuarios where usuario=$usuario;
            $tabla2=[$tabla];
            $consulta = array('usuario');
            $condiciones = array('usuario' => $usu);
            $resultado = BD_PDO::generar_Consulta($consulta, $tabla2, $condiciones);
            if (count($resultado) == 0) {
                //insert into usuarios ('usuario', 'contrasena) values ($usu, $contrasena);
                $valor = array('usuario' => $usu, 'contrasena' => $cifrarPassword,'email'=>$email);
                var_dump($valor);
                $insertado=BD_PDO::generar_insertar($tabla, $valor);
                if($insertado){
                    $mostrar="Registrado correctamente";
                }else{
                    $mostrar="No se ha podido registrar";
                }
            }else{
                $mostrar="El usuario ya existe";
            }
        }
    }
}

require_once "../Views/VRegistro.php";
