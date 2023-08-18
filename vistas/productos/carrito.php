<?php

$nombrePagina = "Carrito";
include_once("../layouts/header.php");
include_once("../layouts/nav.php");
require_once("../../controladores/ControladorProducto.php");

use controladores\ControladorProducto;

$controladorProducto = new ControladorProducto();
$productos = array();
$productosRepetidos = [];
$carrito = true;

if(isset($_SESSION["rol"])) {
    if ($_SESSION["rol"] != 2) {
        header("Location: ../persona/dashboard.php");
        exit();
    }
}
else
{
    header("Location: ../login.php?err=Credenciales%20invalidas");
    exit();
}

foreach ($_SESSION["carrito"] as $idProducto)
{
    $clave = serialize([
        'id' => $idProducto,
    ]);
    if (array_key_exists($clave, $productosRepetidos))
    {
        $productosRepetidos[$clave]++;
    }
    else
    {
        $productosRepetidos[$clave] = 1;
    }

    $productoFind = $controladorProducto->verProducto($idProducto);
    $productos[] = $productoFind;
}

function buscarObjetoRepetido($arrayDeObjetos, $propiedades)
{
    foreach ($arrayDeObjetos as $objeto)
    {
        if ($objeto->getId() == $propiedades['id'])
        {
            return $objeto;
        }
    }
    return null;
}

$cantProductos = count($_SESSION["carrito"]);

?>

<div class="container mt-3" style="min-height: 400px">

    <?php if($cantProductos == 0): ?>
        <h2
                style="text-align: center"
                class="mb-2"
        >
            No hay articulos en el carrito
        </h2>
    <?php endif ?>

    <?php if($cantProductos != 0): ?>
        <h2
                style="text-align: center"
                class="mb-2"
        >
            Cantidad de articulos: <?php echo $cantProductos?>
        </h2>
    <?php endif ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <?php foreach ($productosRepetidos as $clave => $cantidad):

                $propiedades = unserialize($clave);
                $producto = buscarObjetoRepetido($productos, $propiedades);

        ?>

            <div class="col">
                <div class="card shadow-lg rounded" style="height: 500px; overflow-y: hidden" >
                    <div class="card-header bg-secondary text-white">
                        <img
                                src="<?php echo $producto->getImagen()?>"
                                style="width: 100%; height: 230px"
                        >
                    </div>
                    <div class="card-body">
                        <p style="overflow: hidden; max-height: 1.4em; text-overflow: ellipsis; white-space: nowrap;">
                            <strong> Producto: </strong>
                            <?php echo ucfirst($producto->getNombre()); ?>
                        </p>
                        <p>
                            <strong>ID:</strong>
                            <?php echo $producto->getId(); ?>
                        </p>
                        <p>
                            <strong>Codigo:</strong>
                            <?php echo $producto->getCodigo(); ?>
                        </p>
                        <p>
                            <strong>Precio:</strong>
                            <?php echo $producto->getPrecio(); ?>
                        </p>
                        <p>
                            <strong>Cantidad:</strong>
                            <?php echo $cantidad ?>
                        </p>

                        <?php if($_SESSION["rol"] == 1): ?>

                            <a
                                    href="verProducto.php?id=<?php echo $producto->getId(); ?>"
                                    class="btn btn-primary"
                            >
                                Ver producto
                            </a>

                        <?php endif;?>

                        <?php if($_SESSION["rol"] == 2 && !$carrito): ?>

                            <a
                                    class="btn btn-outline-primary mt-2"
                                    style="width: 100%;"
                                    href="../../validaciones/carrito.php?id=<?php echo $producto->getId()?>"
                            >
                                Añadir al carrito
                            </a>

                        <?php endif;?>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <?php if($cantProductos != 0): ?>
        <a
                href="../../validaciones/generarFactura.php"
                class="btn btn-primary w-50 mt-4"
                style="margin-left: 25%"
        >
            Generar Factura
        </a>
    <?php endif ?>

</div>

<?php include_once("../layouts/footer.php") ?>

