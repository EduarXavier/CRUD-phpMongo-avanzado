<?php

$nombrePagina = "Clientes";

include_once("../layouts/header.php");
include_once("../layouts/nav.php");
require_once("../../controladores/ControladorUsuario.php");

use controladores\ControladorUsuario;

$controladorUsuario = new ControladorUsuario();
$clientes = $controladorUsuario->verClientes();


if(isset($_SESSION["rol"]))
{
    if($_SESSION["rol"] != 1)
    {
        header("Location: dashboard.php");
        exit();
    }
}
else{
    header("Location: ../login.php?err=Credenciales%20invalidas");
    exit();
}

?>

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" style="min-height: 400px">

        <?php foreach ($clientes as $cliente): ?>

            <div class="col">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-secondary text-white">
                        <strong> Cliente: </strong>
                        <?php echo ucfirst($cliente->getNombre()); ?>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>ID:</strong>
                            <?php echo $cliente->getId(); ?>
                        </p>
                        <p>
                            <strong>Teléfono:</strong>
                            <?php echo $cliente->getTelefono(); ?>
                        </p>
                        <p>
                            <strong>Correo:</strong>
                            <?php echo $cliente->getCorreo(); ?>
                        </p>
                        <p>
                            <strong>Dirección:</strong>
                            <?php echo $cliente->getDireccion(); ?>
                        </p>
                        <p>
                            <strong>Documento:</strong>
                            <?php echo $cliente->getDocumento(); ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<?php include_once("../layouts/footer.php") ?>

