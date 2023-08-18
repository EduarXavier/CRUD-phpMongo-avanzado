<?php

require_once("../controladores/ControladorUsuario.php");
require_once("../modelos/Persona.php");

use controladores\ControladorUsuario;
use modelos\Persona;

$controladorUsuario = new ControladorUsuario();

if(empty($_POST["nombre"]) ||
    empty($_POST["telefono"]) ||
    empty($_POST["correo"]) ||
    empty($_POST["direccion"]) ||
    empty($_POST["documento"]) ||
    empty($_POST["password"]))
{
    header("Location: ../vistas/persona/registroPersona.php?err=Llenar%20todos%20los%20campos");
    exit();
}
else
{
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $documento = $_POST["documento"];
    $rol = $_POST["rol"] ?? 2;

    $password = null;
    $correo = null;

    if(filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL))
    {
        $correo = $_POST["correo"];
    }
    else
    {
        header("Location: ../vistas/persona/registroPersona.php?err=Correo%20invalido");
        exit();
    }

    if(validacionClave($_POST["password"]))
    {
        $password = $_POST["password"];
    }

    $persona = new Persona();

    $persona->setNombre($nombre);
    $persona->setTelefono($telefono);
    $persona->setCorreo($correo);
    $persona->setDireccion($direccion);
    $persona->setDocumento($documento);
    $persona->setRol($rol);
    $persona->setPassword($password);

    try
    {
        $controladorUsuario->addUsuario($persona);

        header("Location: ../vistas/persona/registroPersona.php?mnsj=Registrado%20con%20exito");
        exit();
    }
    catch (PDOException $exception)
    {
        if ($exception->getCode() === '23505')
        {
            header("Location: ../vistas/persona/registroPersona.php?err=El%20correo%20o%20el%20documento%20está%20en%20uso");
        }
        else
        {
            header("Location: ../vistas/persona/registroPersona.php?err=Ha%20ocurrido%20un%20error");
        }

        exit();

    }

}

function validacionClave($clave): ?bool
{
    $longitudMinima = 8;
    $mayuscula = preg_match('/[A-Z]/', $clave);
    $minuscula = preg_match('/[a-z]/', $clave);
    $numero = preg_match('/[0-9]/', $clave);
    $caracterEspacial = preg_match('/[\W_]/', $clave);

    if (
        strlen($clave) <= $longitudMinima ||
        !$caracterEspacial ||
        !$mayuscula ||
        !$minuscula ||
        !$numero)
    {
        header("Location: ../vistas/persona/registroPersona.php?err=La%20claves%20no%20es%20segura");
        exit();
    }
    else
    {
        return true;
    }
}