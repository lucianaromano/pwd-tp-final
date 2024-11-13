<?php
include_once '../../configuracion.php';
$sesion = new session();
if ($sesion->activa()) {
    header("Location: $PROJECT_PATH/Vista/home");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>

    <!-- bootstrap -->
    <?php include_once("../estructura/bootstrap.php");?> 

    <link rel="stylesheet" href="../css/estilos.css">

</head>
<body>
    <?php include_once("../estructura/cabecera-publica.php");?> 
    
    <div class="container mt-3" >
        <div class=" justify-content-center">
            <div class="col" style="max-width: 800px;">
            <form action="../accion/accionRegistro.php" method="post" class="col-md-6 mt-3 " id="datosUsuario" name="usuarioNuevo">
            <h1 class="h3 text-center">Registrarse</h1>
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-floating">
                        <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre de usuario" required>
                        <label for="usnombre">Nombre de usuario </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-floating">
                        <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Mail" required>
                        <label for="usmail">Mail </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-floating">
                        <input class="form-control" id="uspass" name="uspass" type="password" placeholder="Contraseña" required>
                        <label for="uspass">Contraseña </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="form-floating">
                        <input class="form-control" id="uspass2" name="uspass2" type="password" placeholder="Confirmar contraseña" required>
                        <label for="uspass">Confirmar contraseña </label>
                    </div>
                </div>
            </div>
            <div class=" mt-4">
                <div class="d-grid">
                    <button class="btn" type="submit">Registrarme</button>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery Validate CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <<!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../js/validacIones.js"></script>
</body>
</html>