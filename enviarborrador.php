<?php
include('conexion.php');

$id_correo = $_GET['id'];
$estado = $_GET['accion'];
$remitente = $_POST['remitente'];
$destinatario = $_POST['destinatario'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$fecha = date('Y-m-d H:i:s');
$tipo = 1;

$sql = "UPDATE correos SET id_remitente = ?, id_destinatario = ?, asunto = ?, cuerpo = ?, fecha_envio = ?, estado = ?, tipo = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("iissssii", $remitente, $destinatario, $asunto, $mensaje, $fecha, $estado, $tipo, $id_correo);

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