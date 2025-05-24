<?php
if (!isset($_SESSION["correo"]))
{
    echo "Inicie Sesión para continuar";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.html">
    <?php
    die();
}
?>