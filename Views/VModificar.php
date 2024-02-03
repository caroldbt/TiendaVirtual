<?php
$enlaces = [
    'LISTAR' => 'CAdminPrincipal.php',
    'NUEVO' => 'CNuevo.php',
    'ELIMINAR' => 'CEliminar.php',
    'MODIFICAR' => 'CModificar.php',

];
$boton = '';
foreach ($enlaces as $nombre => $categoria) {
    $boton .= "<li class='nav-item'><a class='navbar-brand text-dark' href='$categoria'><button class='btn btn-outline me-2 categorias' type='button' cat='$categoria'>$nombre</button></li>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Modificar Producto</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid ">
            <a class="navbar-brand" href=""><img src="../Imagen/shaka.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <?= $boton; ?>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link text-dark" href="../index.php?salir">DESCONECTAR</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <section class="content">
        <div class="container">
            <div class="row justify-content-around ">
                <form action="" method="post">
                    <?= $mostrarSelect; ?>
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-dark btn-lg btn-block" name="mostrar" value="LISTAR PRODUCTO">
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-around table-responsive  " id="listado">
                <?= $mostrar; ?>
            </div>
        </div>

    </section>
    <?php
    require_once "../Views/VFooter.php";
    ?>
    <script type="text/javascript" src="../JS/Modificar.js"></script>
</body>


</html>