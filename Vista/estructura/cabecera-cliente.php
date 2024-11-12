<?php
$session = new Session();
$resp = $session->validar();

if (!$resp) {
    header("Location: $PROJECT_PATH/vista/login");
}

// TODO: verificar que el usuario tenga el rol de cliente

?>

<header class="position-sticky top-0 shadow mb-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <h1> Angel Wings Jewelry</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Iniciar Sesion </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Registrarse</a>
                    </li>
                </ul>
                <img class="ms-auto me-3" style="height: 35px; width: auto;" src="/angelwings.ico" alt="<logo Angel Wings">
            </div>
        </div>
    </nav>
</header>