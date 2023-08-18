<?php

$nombrePagina = "Dashboard";
require_once("../layouts/header.php");
require_once("../layouts/nav.php");
require_once("../../controladores/ControladorFactura.php");
require_once("../../controladores/ControladorUsuario.php");
require_once("../../modelos/Factura.php");

use controladores\ControladorFactura;
use controladores\ControladorUsuario;
use modelos\Factura;

$controladorFactura = new ControladorFactura();
$controladorUsuario = new ControladorUsuario();

$facturas = array();

if($_SESSION["rol"] == 1)
{
    $facturas = $controladorFactura->verFacturas();
}
else
{
    $facturas = $controladorFactura->verMisFacturas($_SESSION["documento"]);
}

?>

<div class="container mt-5" style="min-height: 400px">

    <?php if($facturas): ?>

        <h2 style="text-align: center" class="mb-3">
            Facturas : <?php echo count($facturas) ?>
        </h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

            <?php foreach ($facturas as $factura) :

                    $usuarioFactura = $controladorUsuario->findByDocumento($factura?->getDocuemntoPerosna());

            ?>
                <a
                        href="../productos/verFactura.php?id=<?php echo $factura->getId(); ?>"
                        style="text-decoration: none"
                >
                    <div class="col">
                        <div class="card shadow-lg rounded">
                            <div class="card-header bg-secondary text-white">
                                <strong> ID: </strong>
                                <?php echo $factura->getId(); ?>
                            </div>
                            <div class="card-body">
                                <p>
                                    <strong>Cliente :</strong>
                                    <?php echo ucfirst($usuarioFactura->getNombre()); ?>
                                </p>
                                <p>
                                    <strong>Teléfono:</strong>
                                    <?php echo $usuarioFactura->getTelefono(); ?>
                                </p>
                                <p>
                                    <strong>Correo:</strong>
                                    <?php echo $usuarioFactura->getCorreo(); ?>
                                </p>
                                <p>
                                    <strong>Articulos:</strong>
                                    <?php echo count($factura->getProductos()); ?>
                                </p>
                                <p>
                                    <strong>Fecha:</strong>
                                    <?php echo $factura->getFecha(); ?>
                                </p>
                                <p>
                                    <strong>Total:</strong>
                                    <?php echo $factura->getTotal(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>

            <?php endforeach; ?>

        </div>

    <?php endif ?>

</div>

<?php include_once("../layouts/footer.php") ?>

