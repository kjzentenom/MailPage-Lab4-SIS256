<?php
session_start();
include("verificarsesion.php");
include("verificarestado.php");
include("conexion.php");

$id_correo = $_GET['id'];

$sql = "SELECT id, asunto, cuerpo, fecha_envio FROM correos 
        WHERE id = ?;";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_correo);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();


?>
<class class="correo">
    <class class="info-correo">
        <h5>Enviado el:</h5> <a><?php echo $row['fecha_envio']; ?></a><br>
        <h5>Asunto: </h5> <a><?php echo $row['asunto']; ?></a><br>
    </class>
    <p><?php echo $row['cuerpo']; ?></p>
</class>