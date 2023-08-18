<?php

require_once("../../controladores/ControladorProducto.php");

use controladores\ControladorProducto;

$controladorProducto = new ControladorProducto();
$id = null;

if(!empty($_GET["id"]))
{
    $id = $_GET["id"];
}
else
{
    header("Location: verProductos.php");
    exit();
}

$producto = $controladorProducto->verProducto($id);
$nombrePagina = "Producto - ". $producto?->getNombre();

include_once("../layouts/header.php");
include_once("../layouts/nav.php");

if(isset($_SESSION["rol"]))
{
    if($_SESSION["rol"] != 1)
    {
        header("Location: ../persona/dashboard.php");
        exit();
    }

}
else
{
    header("Location: ../login.php?err=Credenciales%20invalidas");
    exit();
}

?>

<h2 class="pt-5" style="text-align: center">Detalles del producto</h2>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="row">
                        <div class="col-3">
                            <img
                                    src="<?php echo $producto?->getImagen() ?>"
                                    class="img-fluid h-100"
                                    alt="Imagen del producto"
                            >
                        </div>
                        <div class="col-9">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Nombre: <?php echo $producto?->getNombre() ?>
                                </h5>
                                <p class="card-text">
                                    ID: <?php echo $producto?->getId() ?>
                                </p>
                                <p class="card-text">
                                    Código: <?php echo $producto?->getCodigo() ?>
                                </p>
                                <p class="card-text">
                                    Precio: <?php echo $producto?->getPrecio() ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once("../layouts/footer.php");?>