<?php

require_once("../../controladores/ControladorFactura.php");
require_once("../../controladores/ControladorUsuario.php");
require_once("../../modelos/Factura.php");

use controladores\ControladorFactura;
use controladores\ControladorUsuario;

$controladorFactura = new ControladorFactura();
$controladorUsuario = new ControladorUsuario();

$id = null;

if(!empty($_GET["id"]))
{
    $id = $_GET["id"];
}
else
{
    header("Location: ../persona/dahsboard.php");
}

$factura = $controladorFactura->verFactura($id);
$usuarioFactura = $controladorUsuario->findByDocumento($factura?->getDocuemntoPerosna());
$nombrePagina = "Factura - ". $id;

$objetosRepetidos = [];

if($factura)
{
    foreach ($factura?->getProductos() as $producto)
    {
        $clave = serialize([
            'nombre' => $producto?->getNombre(),
        ]);
        if (array_key_exists($clave, $objetosRepetidos)) {
            $objetosRepetidos[$clave]++;
        } else {
            $objetosRepetidos[$clave] = 1;
        }
    }
}

function buscarObjetoRepetido($arrayDeObjetos, $propiedades)
{
    foreach ($arrayDeObjetos as $objeto) {
        if ($objeto?->getNombre() == $propiedades['nombre']) {
            return $objeto;
        }
    }
    return null;
}

include_once("../layouts/header.php");
include_once("../layouts/nav.php");
?>

<?php if(!$factura): ?>
    <h2 style="text-align: center; min-height: 450px">No extiste la factura <?php echo $id ?></h2>
<?php endif; ?>

<?php if($factura): ?>

    <h3 style="text-align: center" class="mt-3">Factura - <?php echo $id ?></h3>

    <div class="container mt-3">
        <h2>Datos del Cliente</h2>
        <table class="table table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $usuarioFactura->getId(); ?>
                </td>
                <td>
                    <?php echo $usuarioFactura->getNombre(); ?>
                </td>
                <td>
                    <?php echo $usuarioFactura->getDocumento(); ?>
                </td>
                <td>
                    <?php echo $usuarioFactura->getTelefono(); ?>
                </td>
                <td>
                    <?php echo $usuarioFactura->getCorreo(); ?>
                </td>
                <td>
                    <?php echo $factura->getFecha(); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <h2>Productos</h2>

        <?php foreach ($objetosRepetidos as $clave => $cantidad):

                $propiedades = unserialize($clave);
                $objetoRepetido = buscarObjetoRepetido($factura->getProductos(), $propiedades);

            ?>

            <div class="media d-flex">
                <img src="<?php echo $objetoRepetido->getImagen() ?>"
                     class="align-self-end  ml-3"
                     alt="Producto"
                     style="height: 150px; margin-right: 20px; width: 150px"
                >
                <div class="media-body text-right">
                    <h5 class="mt-0"><?php echo $objetoRepetido->getnombre() ?></h5>
                    <p>ID: <?php echo $objetoRepetido->getId() ?></p>
                    <p>Precio: $<?php echo $objetoRepetido->getPrecio() ?></p>
                    <p>Cantidad: <?php echo $cantidad ?></p>
                </div>
            </div>

        <?php endforeach; ?>
        <hr>
        <p style="font-size: 25px"><b>Total</b>: $<?php echo $factura?->getTotal(); ?></p>
    </div>

<?php endif; ?>


<?php
include_once("../layouts/footer.php");
?>