<?php
include_once '../../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    $datos = data_submitted();

    $controlUsuario = new controlUsuario();
    $respuesta = $controlUsuario->login($datos);

    if ($respuesta['messageErr'] != "?messageErr=") {
        $message = $respuesta['messageErr'];
        header('Location: ../login/login.php' . $message);
        exit;
    } else {
        $message = $respuesta['messageOk'];
        header('Location: ../index.php' . $message);
        exit;
    }
} else {
    header('Location: ../login/login.php?messageErr=' . urlencode("Sesión ya iniciada"));
    exit;
}
?>