<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmUsuario = new abmusuario();
$usuarioExistente = $abmUsuario->buscar(['usnombre' => $datos['usnombre']]);

if (count($usuarioExistente) > 0) {
    header('Location: ../login/registro.php?message=' . urlencode("Nombre de usuario existente"));
    exit;
}

$exito = $abmUsuario->alta($datos);
if (!$exito) {
    header('Location: ../login/registro.php?message=' . urlencode('Error en el registro'));
    exit;
}

$nuevoUsuario = $abmUsuario->buscar($datos);
$datosUsRol = [
    'idusuario' => $nuevoUsuario[0]->getIdusuario(),
    'idrol' => 1,
];
$abmUsuarioRol = new ABMUsuarioRol();
$abmUsuarioRol->alta($datosUsRol);

$sesion = new session();
$sesion->iniciar($datos['usnombre'], $datos['uspass']);
list($inicioSesion, $error) = $sesion->validar();
if (!$inicioSesion) {
    $sesion->cerrar();
    header('Location: ../login/registro.php?message=' . urlencode($error));
    exit;
} else {
    header('Location: ../index.php');
    exit;
}

?>