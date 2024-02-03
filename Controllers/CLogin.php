<?php

if (isset($_GET['salir'])) {
    $_SESSION = array();
}

$respuesta = '';
if (isset($_POST['login'])) {
    if (isset($_POST['usu']) && isset($_POST['pass'])) {
        $usuario = trim($_POST['usu']);
        $password = trim($_POST['pass']);
        //select usuario from usuarios where usuario=usu;
        require_once "Model/BD_PDO.php";
        BD_PDO::conectar();
        $tabla = array('usuarios');
        $consulta = array('*');
        $binary = true;
        $condiciones = array('usuario' => $usuario);
        //var_dump($condiciones);
        $registro = BD_PDO::generar_Consulta($consulta, $tabla, $condiciones, array(), array(), $binary);
        var_dump($registro);
        if (count($registro) > 0) {
            foreach ($registro as $key) {
                var_dump($val);
                if (password_verify($password, $key->contrasena)) {
                    
                    $_SESSION['usu'] = $usuario;
                    $_SESSION['pass'] = $password;
                    if ($usuario == 'admin') {
                        require_once "Controllers/CAdminPrincipal.php";
                        die();
                    } else {
                        require_once "Controllers/CContenido.php";
                        die();
                    }
                }else {
                    $respuesta = "Identificacion incorrecta";
                }
            }
        }else{
            $respuesta="Usuario no existe";
        }
    }
}
require_once "Views/VLogin.php";
