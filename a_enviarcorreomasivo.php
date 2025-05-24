<?php
session_start();
require('verificarsesion.php');
require('verificarnivel.php');
include('conexion.php');

$remitente = $_POST['remitente'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$estado = 'enviado';
$tipo = 1;

$sql_select_usuarios = "SELECT id, nombre, correo FROM usuarios WHERE id != ?";
$stmt_select = $con->prepare($sql_select_usuarios);
$stmt_select->bind_param("i", $remitente);
$stmt_select->execute();
$result_usuarios = $stmt_select->get_result();

$sql_insert = "INSERT INTO correos (id_remitente, id_destinatario, asunto, cuerpo, fecha_envio, estado, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $con->prepare($sql_insert);

$correos_enviados_count = 0;
$total_destinatarios = 0;

while ($row = $result_usuarios->fetch_assoc()) {
    $total_destinatarios++;
    $destinatario_id = $row['id'];
    $fecha_envio = date('Y-m-d H:i:s');

    $stmt_insert->bind_param("iissssi",
        $remitente,
        $destinatario_id,
        $asunto,
        $mensaje,
        $fecha_envio,
        $estado,
        $tipo
    );

    if ($stmt_insert->execute()) {
        $correos_enviados_count++;
    } else {
        error_log("Error al enviar correo a ID " . $destinatario_id . ": " . $stmt_insert->error);
    }
}

$stmt_select->close();
$stmt_insert->close();
$con->close();

if ($correos_enviados_count === $total_destinatarios && $total_destinatarios > 0) {
    echo 'Correo enviado exitosamente a todos los ' . $correos_enviados_count . ' usuarios.';
} elseif ($total_destinatarios > 0) {
    echo 'Correo enviado a ' . $correos_enviados_count . ' de ' . $total_destinatarios . ' usuarios. Hubo errores.';
} else {
    echo 'No se encontraron destinatarios a quienes enviar el correo (o solo el remitente existe).';
}

?>