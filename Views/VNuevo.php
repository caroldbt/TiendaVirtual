<?php
$enlaces = [
    'LISTAR' => 'CAdminPrincipal.php',
    'NUEVO' => 'CNuevo.php',
    'ELIMINAR' => 'CEliminar.php',
    'MODIFICAR' => 'CModificar.php',

];
$boton = '';
foreach ($enlaces as $nombre => $cat) {
    $boton .= "<li class='nav-item'><a class='navbar-brand text-dark' href='$cat'><button class='btn btn-outline me-2 categorias' type='button' cat='$cat' >$nombre</button></a></li>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="Librerias/JQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Nuevo Producto</title>
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
    <section class="vh-100">
        <div class="container py-5 h-100">
            <form class="form-control " enctype="multipart/form-data" method="post" action id="formulario">
                <div class="mb-3 row ">
                    <label for="codigo" class="col-sm-2 col-form-label">CÓDIGO</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" maxlength="3" id="codigo" name="codigo" placeholder="CODIGO">
                    </div>
                </div>
                <div class="mb-3 row ">
                    <label for="nombre" class="col-sm-2 col-form-label">NOMBRE</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" name="nombre" id="nombre" maxlength="200" placeholder="Nombre del producto">
                    </div>
                </div>
                <div class="mb-3 row ">
                    <label for="descripcion" class="col-sm-2 col-form-label">DESCRIPCIÓN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" id="descripcion" name="descripcion" maxlength="255" placeholder="Descripción del producto">
                    </div>
                </div>
                <div class="mb-3 row ">
                    <label for="precio" class="col-sm-2 col-form-label">PRECIO</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control-plaintext" id="precio" name="precio" step="00.01" placeholder="Precio del producto">
                    </div>
                </div>
                <div class="mb-3 row ">
                    <label for="ud" class="col-sm-2 col-form-label">UNIDADES</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control-plaintext" id="ud" name="ud" step="1" min="1" max="100" placeholder="Unidades del producto">
                    </div>
                </div>
                <?=$categoria?>
                <div class="mb-3 row ">
                    <label for="formFile" class="col-sm-2 col-form-label">AÑADIR IMAGEN/FOTO</label>
                    <div class="col-sm-10">
                        <input class="form-control-plaintext" type="file" id="formFile" accept="image/png, .jpg, .jpeg" name="foto">
                    </div>
                </div>
                <div class="mb-3 row ">
                    <div class="col-sm-10">
                        <p><?= $texto ?></p>
                    </div>
                </div>
                <div class="mb-3 row d-flex justify-content-center">
                    <div class="col-sm-10 d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark " name="anadir">AÑADIR PRODUCTO</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>