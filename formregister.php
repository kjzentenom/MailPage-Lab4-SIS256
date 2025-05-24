<meta charset="UTF-8">
<?php
session_start();
?>
<form id="form-register" method="post" action="javascript:enviarDatosRegistro()">
    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required><br>
    <input type="text" name="usuario" id="usuario" placeholder="Usuario" required><br>
    <input type="email" name="correo" id="correo" placeholder="Correo Electronico" required><br>
    <input type="password" name="password" id="password" placeholder="Contraseña" required><br>
    
    <?php if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){ ?>
        <input type="radio" name="nivel" id="nivel1" value="1"> Administrador
        <br>
        <input type="radio" name="nivel" id="nivel0" value="0"> Usuario
        <br>
    <?php } ?>

    <input type="submit" id="btn-register" value="Registrarse">
</form>