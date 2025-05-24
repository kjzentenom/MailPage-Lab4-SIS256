<?php
if ($_SESSION["nivel"]==0)
{
    echo "No tiene permisos para acceder a esta página";
    ?>
    <meta http-equiv="refresh" content="3;url=dashboard.php">
    <?php
    die();
}
?>