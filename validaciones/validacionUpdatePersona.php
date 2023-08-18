<?php
session_start();

require_once("../controladores/ControladorUsuario.php");

use controladores\ControladorUsuario;

$controladorUsuario = new ControladorUsuario();

if(!isset($_SESSION["usuario"]) ||
    !isset($_SESSION["rol"]) ||
    !isset($_SESSION["id"]))
{
    header("Location: ../vistas/login.php?err=Credenciales%20invalidas");
}

$usuario = $controladorUsuario->verUsuario($_SESSION["id"]);

$usuario->setTelefono($_POST["telefono"]);
$usuario->setDireccion($_POST["direccion"]);
$usuario->setPassword($_POST["password"] != "" ? $_POST["password"] : null);

try
{
    if ($controladorUsuario->actualizarUsuario($usuario))
    {
        header("Location: ../vistas/persona/perfil.php?mnsj=Actualizado%20con%20Exito");
        exit();
    }
} catch (Exception $e)
{
    header("Location: .../vistas/persona/perfil.php?err=ha%20ocurrido%20un%20error");
    exit();
}