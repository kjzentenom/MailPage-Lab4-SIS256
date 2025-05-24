<!DOCTYPE html>
<html lang="es">
<?php
session_start();
include("verificarsesion.php");
include("verificarestado.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/tablas.css">
    <link rel="stylesheet" href="./css/modal.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Dashboard</h1>
            <div class="info-user">
                <h2>Bienvenido <?php echo $_SESSION['nombre']; ?></h2>
                <h4>Usuario: @<?php echo $_SESSION['user']; ?></h4>
            </div>

        </header>

        <div class="main">
            <aside>
                <?php
                if ($_SESSION['nivel'] == '1') { ?>

                    <nav>
                        <a href="javascript:listarUsuarios()">Administrar Cuentas</a>
                        <a href="javascript:auditarCorreos()">Auditar Correo</a>
                        <a href="javascript:notificacionMasiva()">Notificaciones Masivas</a>

                    </nav>

                    <?php
                } else if ($_SESSION['nivel'] == '0') { ?>

                        <nav>
                            <a id="openModalBtn" href="javascript:modalCorreo()">Redactar Correo</a>
                            <a href="javascript:listarCorreos('becorreo.php')">Bandeja de Entrada</a>
                            <a href="javascript:listarCorreos('bscorreo.php')">Bandeja de Salida</a>
                            <a href="javascript:listarCorreos('bocorreo.php')">Borradores</a>
                        </nav>

                    <?php
                } ?>
                <nav>
                    <br>
                    <a href="logout.php">Cerrar Sesion</a>
                </nav>
            </aside>
            <class id="contenido">

            </class>
        </div>

        <footer>

        </footer>

    </div>

    <a id="openModalBtn"></a>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="titulo-modal">Título del Modal</h2>
            <div id="contenido-modal">

            </div>
        </div>
    </div>
    <script src="./js/fetch.js"></script>
    <script src="./js/modal.js"></script>
</body>

</html>