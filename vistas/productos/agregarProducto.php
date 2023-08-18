<?php

$nombrePagina = "Agregar producto";

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

<div class="container mt-5">
    <h2 style="text-align: center">Ingrese los detalles del producto</h2>

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

    <?php if(!empty($_GET["err"])): ?>

        <div class="alert alert-danger" style="margin-top: 20px" role="alert">
            <i class="bi bi-exclamation-circle text-danger"></i>
            <?php echo $_GET["err"] ?>
        </div>

    <?php endif; ?>

    <form
        action="../../validaciones/validacionProducto.php"
        method="POST"
        class="w-50"
        style="margin-left: 25%"
    >
        <div class="form-group mb-2">
            <label for="nombre">Nombre:</label>
            <input
                type="text"
                class="form-control"
                name="nombre"
                required
            >
        </div>
        <div class="form-group mb-2">
            <label for="codigo">Código:</label>
            <input
                type="text"
                class="form-control"
                name="codigo"
                required
            >
        </div>
        <div class="form-group mb-2">
            <label for="precio">Precio (sin puntos o comas):</label>
            <input
                type="number"
                class="form-control"
                name="precio"
                required
            >
        </div>
        <div class="form-group mb-2">
            <label for="imagen">Imagen (enlace de Google):</label>
            <input
                type="url"
                class="form-control"
                name="imagen"
                required
            >
            <small class="form-text text-muted">La imagen debe ser un enlace de Google.</small>
        </div>
        <div class="d-flex justify-content-center w-100">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

<?php include_once("../layouts/footer.php") ?>