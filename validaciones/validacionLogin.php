<?php

require_once("../controladores/ControladorUsuario.php");

use controladores\ControladorUsuario;

if(empty($_POST["usuario"]) &&
    empty($_POST["clave"]))
{
    header("Location: ../vistas/login.php?err=Ingrese%20todos%20los%20datos");
    exit();
}

$controladorPersona = new ControladorUsuario();

$user = $_POST["usuario"];
$clave = $_POST["clave"];

$usuario = $controladorPersona->login($user, $clave);

if($usuario)
{
    session_start();

    $_SESSION["usuario"] = $usuario->getCorreo();
    $_SESSION["rol"] = $usuario->getRol();
    $_SESSION["id"] = $usuario->getId();
    $_SESSION["documento"] = $usuario->getDocumento();
    $_SESSION["carrito"] = array();

    header("Location: ../vistas/persona/dashboard.php");
}
else
{
    header("Location: ../vistas/login.php?err=Credenciales%20invalidas");
}

exit();