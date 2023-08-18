<?php
session_start();

$nombrePagina = "Registro de clientes";
include_once("../layouts/header.php");

if(!empty($_SESSION["id"])){
    session_write_close();
    include_once("../layouts/nav.php");
}

?>

<div class="container mt-5 w-75" style="margin-left: 12.5%">
    <h2 style="text-align: center">Registro de un nuevo cliente</h2>

    <?php if(!empty($_GET["err"])): ?>

        <div class="alert alert-danger" style="margin-top: 20px" role="alert">
            <i class="bi bi-exclamation-circle text-danger"></i>
            <?php echo $_GET["err"] ?>
        </div>

    <?php endif; ?>

    <?php if(!empty($_GET["mnsj"])): ?>

        <div class="alert alert-success" style="margin-top: 20px" role="alert">
            <i class="bi bi-check-lg text-success" ></i>
            <?php echo $_GET["mnsj"] ?>
        </div>

    <?php endif; ?>

    <form action="../../validaciones/validacionNuevoUsuario.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input
                type="text"
                class="form-control"
                id="nombre"
                name="nombre"
                autocomplete="false"
                minlength="3"
                required
            >
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input
                type="number"
                class="form-control"
                id="telefono"
                name="telefono"
                autocomplete="false"
                minlength="10"
                maxlength="13"
                required
            >
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input
                type="email"
                class="form-control"
                id="correo"
                name="correo"
                autocomplete="false"
                required
            >
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input
                type="text"
                class="form-control"
                id="direccion"
                name="direccion"
                autocomplete="false"
                required
            >
        </div>
        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input
                type="number"
                class="form-control"
                id="documento"
                name="documento"
                autocomplete="false"
                minlength="8"
                required
            >
        </div>
        <?php if(!empty($_SESSION["id"])): ?>

            <div>
                <label for="validationCustom04" class="form-label">State</label>
                <select
                    class="form-select"
                    name="rol"
                    required
                >
                    <option selected disabled value="">Rol...</option>
                    <option value="1">Administrador</option>
                    <option value="2">Cliente</option>
                </select>
            </div>

        <?php endif; ?>
        <div>
            <label for="password" class="form-label">Contraseña</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                autocomplete="false"
                minlength="8"
                required
            >
        </div>
        <small>La contraseña debe tener una longitud de más de 8 caracteres</small>
        <br>
        <small>La contraseña debe contener una Mayuscula, una minuscula, un numero y un caracter especial</small>
        <br><br>
        <button
            type="submit"
            class="btn btn-primary w-25"
            style="margin-left: 37.5%"
        >
            registrar
        </button>
    </form>
</div>

<?php include_once("../layouts/footer.php") ?>