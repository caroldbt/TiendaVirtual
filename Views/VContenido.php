<?php
$enlaces = [
    'PANTALONES' => 'pantalon',
    'VESTIDOS' => 'vestido',
    'JERSÉIS' => 'jersey',
    'ABRIGOS' => 'abrigo',
    'ZAPATOS' => 'zapato'
];
$boton = '';
foreach ($enlaces as $nombre => $categoria) {
    $boton .= "<li class='nav-item'><button class='btn btn-outline me-2 categorias' type='button' cat='$categoria' >$nombre</button></li>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="Librerias/JQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Tienda Contenido</title>
</head>

<body>
   
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid ">
            <a class="navbar-brand text-dark" href="index.php"><img src="Imagen/shaka.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <?= $boton; ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="text" id='nombre' placeholder="BUSCAR" aria-label="Search">
                    <button class="btn btn-outline-dark" type="button" name='buscar' id='buscar'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></button>
                </form>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="" name='comprar' id='comprar'>CESTA <span class="">(<?=$cesta?>)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-dark" href="index.php?salir">DESCONECTAR</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <section class="content">
        <form action="" method="post">
            <!--<input type="submit" name="comprar" value="Comprar">-->
            <div class="container">
                <div class="row justify-content-around " id="campo">
                    <?= $mostrar; ?>
                </div>
            </div>
        </form>
    </section>
    <?php
    require_once "Views/VFooter.php";
    ?>
    <script src='JS/peticion.js'></script>
    <?=$aviso?>
</body>

</html>