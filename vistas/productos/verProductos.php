<?php

require_once("../../controladores/ControladorProducto.php");

use controladores\ControladorProducto;

$controladorProducto = new ControladorProducto();
$productos = $controladorProducto->verProductos();
$nombrePagina = "Productos";
$carrito = false;

include_once("../layouts/header.php");
include_once("../layouts/nav.php");
?>

<div class="container mt-5">

    <div class="w-100">
        <?php if(!empty($_GET["mnsj"])): ?>

            <div
                    class="alert alert-success w-25"
                    style="margin-top: 20px; position: absolute; z-index: 2; right: 20px; opacity: 0.9"
                    role="alert"
            >
                <i class="bi bi-check-lg text-success" ></i>
                <?php echo $_GET["mnsj"] ?>
            </div>

        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <?php include_once("vistaProductos.php"); ?>

    </div>
</div>

<?php include_once("../layouts/footer.php") ?>

