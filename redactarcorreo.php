<meta charset="UTF-8">
<link rel="stylesheet" href="css/redactarcorreo.css">
<?php
session_start();
include('verificarsesion.php');
include('conexion.php');

$sql = "SELECT id,correo,nombre FROM usuarios order by nombre";
$con->prepare($sql);
$result = $con->query($sql);

?>
<form id="form-correo">
    <input type="hidden" name="remitente" id="remitente" value="<?php echo $_SESSION['id']; ?>">
    <select name="destinatario" id="destinatario">
        <option value="">-- Seleccione un usuario --</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>">
                <?php echo $row['nombre']; ?> | <?php echo $row['correo']; ?>
            </option>
        <?php } ?>
    </select>
    <input type="text" name="asunto" id="asunto" placeholder="Asunto">
    <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Escribe tu mensaje"></textarea>
    <div class="botones">
            <a href="javascript:accionCorreo('pendiente')">Guardar</a>
            <a href="javascript:accionCorreo('enviado')">Enviar</a>
    </div>
</form>

