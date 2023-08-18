<?php

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/modelos/Producto.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/controladores/ControladorProducto.php");

use modelos\Producto;
use controladores\ControladorProducto;

$controladorProducto = new ControladorProducto();


if(empty($_POST["nombre"]) ||
    empty($_POST["codigo"]) ||
    empty($_POST["precio"]) ||
    empty($_POST["imagen"]))
{
    header("Location: ../vistas/productos/agregarProducto.php?err=Ingrese%20todos%20los%20datos");
    exit();
}

$precio = $_POST["precio"];
$nombre = $_POST["nombre"];
$codigo = $_POST["codigo"];
$imagen = $_POST["imagen"];

$pattern = '/\.jpg/i';
$patternPng = '/\.png/i';


if(!preg_match($pattern, $imagen) &&
    !preg_match($patternPng, $imagen) ||
    strlen($imagen) >= 255)
{
    header("Location: ../vistas/productos/agregarProducto.php?err=La%20URL%20no%20es%20valida");
    exit();
}

$producto = new Producto();

$producto->setPrecio($precio);
$producto->setCodigo($codigo);
$producto->setNombre($nombre);
$producto->setImagen($imagen);

if($controladorProducto->addProducto($producto)){
    header("Location: ../vistas/productos/agregarProducto.php?mnsj=Agregado%20con%20Exito");
    exit();
}

