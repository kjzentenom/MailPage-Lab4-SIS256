<meta charset="UTF-8">
<link rel="stylesheet" href="css/redactarcorreo.css">
<?php
session_start();
require('verificarsesion.php');
include('conexion.php');

$id_correo = $_GET['id'];

$sql_correo = "SELECT id_destinatario, asunto, cuerpo, fecha_envio, estado, tipo FROM correos 
        WHERE id = ?;";
$stmt = $con->prepare($sql_correo);
$stmt->bind_param("i", $id_correo);
$result_correo = $stmt->execute();
$row_correo = $stmt->get_result()->fetch_assoc();

$sql = "SELECT id,correo,nombre FROM usuarios order by nombre";
$con->prepare($sql);
$result = $con->query($sql);

?>
<form id="form-correo">
    <class class="correo">
        <input type="hidden" name="remitente" id="remitente" value="<?php echo $_SESSION['id']; ?>">
    <select name="destinatario" id="destinatario">
        <option value="">-- Seleccione un usuario --</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>" <?php echo $row_correo['id_destinatario'] == $row['id'] ? 'selected' : ''; ?>>
                <?php echo $row['nombre']; ?> | <?php echo $row['correo']; ?>
            </option>
        <?php } ?>
    </select>
    <input type="text" name="asunto" id="asunto" placeholder="Asunto" value="<?php echo $row_correo['asunto']; ?>">
    <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Escribe tu mensaje"><?php echo $row_correo['cuerpo']; ?></textarea>
    <div class="botones">
            <a href="javascript:guardarEditarCorreo('pendiente','<?php echo $id_correo; ?>')">Guardar</a>
            <a href="javascript:enviarBorrador('enviado','<?php echo $id_correo; ?>')">Enviar</a>
    </div>
    </class>
</form>

