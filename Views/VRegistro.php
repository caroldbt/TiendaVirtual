<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Registro</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid d-flex">
            <a class="navbar-brand text-black" href="../index.php?salir"><img src="../Imagen/shaka.png" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../index.php?salir">VOLVER</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="post" action>
                        <p class="fs-6 fw-lighter">Todos los campos marcados con * son obligatorios</p>
                        <div class="divider d-flex align-items-center my-4 ">
                            <span>DATOS DE REGISTRO:</span>
                        </div>
                        <fieldset>
                            <!-- Usuario input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="nombre">USUARIO</label><sup>*</sup>
                                <input type="text" id="nombre" name='usu' class="form-control form-control-lg" required placeholder="Ingrese el usuario" />
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">E-MAIL</label><sup>*</sup>
                                <input type="email" id="email" name='email' class="form-control form-control-lg" required placeholder="Ingrese el e-mail" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="contrasena">CONTRASEÑA</label><sup>*</sup>
                                <input type="password" id="contrasena" name='pass' class="form-control form-control-lg" required placeholder="Indique la Contraseña" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="contrasena2">REPITA CONTRASEÑA</label><sup>*</sup>
                                <input type="password" id="contrasena2" name='pass2' class="form-control form-control-lg" required placeholder="Repita la Contraseña" />
                            </div>
                            <div class="parte row">
                                <p style="color:red;"><?php
                                    if (isset($vacio)) {
                                        foreach ($vacio as $v) {
                                            echo "<li>$v</li>";
                                        }
                                    }
                                    echo $mostrar;
                                    ?>
                                </p>
                        </fieldset>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-dark btn-lg btn-block" name='registro'>REGISTRARSE</button>
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <a href="../index.php?indice=Login" class='text-dark'>LOGIN</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>