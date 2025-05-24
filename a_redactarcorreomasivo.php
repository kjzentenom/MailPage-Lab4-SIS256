<meta charset="UTF-8">
<link rel="stylesheet" href="css/redactarcorreo.css">
<?php
session_start();
require('verificarsesion.php');
require('verificarnivel.php');
include('conexion.php');

?>
<form id="form-correo-masivo" action="javascript:enviarNotificacionMasiva()" method="POST">
    <class class="correo">
        <input type="hidden" name="remitente" id="remitente" value="<?php echo $_SESSION['id']; ?>">
        <input type="text" name="destinatario" id="destinatario" value="Notificar a: TODOS" readonly>
        <input type="text" name="asunto" id="asunto" placeholder="Asunto">
        <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Escribe tu mensaje"></textarea>
        <input type="submit" value="Enviar">
    </class>
</form>