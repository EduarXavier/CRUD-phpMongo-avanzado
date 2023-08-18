<?php
session_start();

if(!isset($_SESSION["usuario"]) ||
    !isset($_SESSION["rol"]) ||
    !isset($_SESSION["id"]))
{
    header("Location: ../vistas/login.php?err=Credenciales%20invalidas");
}

if(empty($_GET["id"]))
{
    header("Location: ../vistas/productos/verProductos.php");
}

$id = $_GET["id"];

$arrayId = $_SESSION["carrito"];
$arrayId[] = $id;

$_SESSION["carrito"] = $arrayId;

header("Location: ../vistas/productos/verProductos.php?mnsj=Producto%20$id%20agregado%20al%20carrito");
exit();



