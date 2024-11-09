<?php
$session = new Session();
$resp = $session->validar();

if (!$resp) {
    header("Location: $PROJECT_PATH/vista/login");
}

// TODO: verificar que el usuario tenga el rol de administrador

?>
<header>
    <h1>Anillos</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos">Productos</a></li>
            <li><a href="productos">ABM Productos</a></li>
        </ul>
    </nav>
</header>