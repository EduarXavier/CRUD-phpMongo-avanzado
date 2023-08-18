<?php

$nombrePagina = "Perfil";
include_once("../layouts/header.php");
include_once("../layouts/nav.php");
include_once("../../controladores/ControladorUsuario.php");

use controladores\ControladorUsuario;

$controladorUsuario = new ControladorUsuario();

$usuario = $controladorUsuario->verUsuario($_SESSION["id"]);

?>

<div class="container mt-4 ">
    <div class="row justify-content-center">
        <div class="col-6">

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

            <form
                class="border border-secondary-subtle p-5 rounded"
                method="post"
                action="../../validaciones/validacionUpdatePersona.php"
            >
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        style="color: gray"
                        type="text"
                        class="form-control"
                        name="nombre"
                        value="<?php echo $usuario->getNombre()?>"
                        readonly
                    >
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input
                        type="text"
                        class="form-control"
                        name="telefono"
                        value="<?php echo $usuario->getTelefono()?>"
                        autocomplete="off"
                    >
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input
                        style="color: gray"
                        type="email"
                        class="form-control"
                        name="correo"
                        value="<?php echo $usuario->getCorreo()?>"
                        readonly
                    >
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion"
                        value="<?php echo $usuario->getDireccion()?>"
                        autocomplete="off"
                    >
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        autocomplete="off"
                    >
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>

            </form>
        </div>
    </div>
</div>

<?php include_once("../layouts/footer.php") ?>