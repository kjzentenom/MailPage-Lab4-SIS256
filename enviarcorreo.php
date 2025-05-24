<?php
include('conexion.php');

$remitente = $_POST['remitente'];
$destinatario = $_POST['destinatario'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$fecha = date('Y-m-d H:i:s');
$estado = $_GET['accion'];
$tipo = 1;

$sql = "INSERT INTO correos (id_remitente, id_destinatario, asunto, cuerpo, fecha_envio, estado, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("iissssi", $remitente, $destinatario, $asunto, $mensaje, $fecha, $estado, $tipo);

if ($stmt->execute()) {
    if($estado == 'enviado'){
        echo 'Correo enviado exitosamente';
    } else {
        echo 'Correo guardado como borrador';
    }
} else {
    echo 'Error al enviar el correo';
}

?>