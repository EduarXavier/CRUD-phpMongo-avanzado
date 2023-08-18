<?php
session_start();

$nombrePagina = "Login";
include_once("layouts/header.php");

if(!empty($_SESSION["usuario"]) && !empty($_SESSION["rol"]))
{
    header("Location: ../vistas/persona/dashboard.php");
    exit();
}

?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card p-4" style="width: 50%;">

        <h2 class="mb-4 text-center">Iniciar Sesión</h2>
        <form action="../validaciones/validacionLogin.php" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input
                        type="text"
                        class="form-control"
                        name="usuario"
                        placeholder="Ingrese su usuario"
                >
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input
                        type="password"
                        class="form-control"
                        id="contrasena"
                        name="clave"
                        placeholder="Ingrese su contraseña"
                >
            </div>
            <button type="submit" class="btn btn-primary w-25">Iniciar Sesión</button>
            <a class="btn btn-primary w-25" href="persona/registroPersona.php">Registro</a>
        </form>

        <?php if(!empty($_GET["err"])): ?>

            <div class="alert alert-danger" style="margin-top: 20px" role="alert">

                <?php echo $_GET["err"] ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php include_once("layouts/footer.php") ?>