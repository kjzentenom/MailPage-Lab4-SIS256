<?php
if ($_SESSION["estado"]==0)
{
    echo "Su cuenta ha sido suspendida, por favor contacte al administrador";
    ?>
    <meta http-equiv="refresh" content="3;url=formlogin.html">
    <?php
    die();
}
?>