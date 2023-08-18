<?php
session_start();

if(!isset($_SESSION["usuario"]) || !isset($_SESSION["rol"]))
{
    header("Location: ../login.php?err=Credenciales%20invalidas");
    exit();
}

$usuario = $_SESSION["usuario"];
$rol = $_SESSION["rol"];

?>

<nav class="navbar navbar-expand-lg bg-dark " data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../persona/perfil.php">
            <?php echo $usuario ?>
        </a>
        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a
                            class="nav-link"
                            href="/proyectosPhpStorm/phpMongoAvanzado/vistas/persona/dashboard.php"
                    >
                        Inicio
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                    >
                        Productos
                    </a>
                    <ul class="dropdown-menu">

                        <?php if($rol == 1): ?>
                            <li><a class="dropdown-item" href="../productos/agregarProducto.php">Agregar productos</a></li>
                        <?php endif; ?>

                        <li><a class="dropdown-item" href="../productos/verProductos.php">Ver productos</a></li>

                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                    >
                        Usuarios
                    </a>
                    <ul class="dropdown-menu">

                        <?php if($rol == 1): ?>
                            <li><a class="dropdown-item" href="../persona/verClientes.php">Ver Clientes</a></li>
                            <li><a class="dropdown-item" href="../persona/registroPersona.php">Añadir usuario</a></li>
                        <?php endif; ?>

                        <?php if($rol == 2): ?>
                            <li><a class="dropdown-item" href="../productos/carrito.php">Ver carrito</a></li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../../validaciones/cerrarSesion.php">Cerrar sesión</a>
                </li>
            </ul>

            <?php if($rol == 1): ?>
                <form action="../productos/verFactura.php" class="d-flex" role="search">
                    <input class="form-control me-2" name="id" placeholder="Buscar factura">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            <?php endif; ?>

        </div>
    </div>
</nav>
