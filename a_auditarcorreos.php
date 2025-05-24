<?php
session_start();
require('verificarsesion.php');
require('verificarnivel.php');
include('conexion.php');

$sql = "SELECT
    c.id AS id_correo,
    c.asunto,
    c.cuerpo,
    c.fecha_envio,
    c.estado,
    c.tipo,
    u_remit.correo AS correo_remitente,
    u_remit.nombre AS nombre_remitente,
    u_dest.correo AS correo_destinatario,
    u_dest.nombre AS nombre_destinatario
FROM
    correos AS c
JOIN
    usuarios AS u_remit ON c.id_remitente = u_remit.id
JOIN
    usuarios AS u_dest ON c.id_destinatario = u_dest.id
ORDER BY
    c.fecha_envio;";

$result = $con->query($sql);
while ($row = mysqli_fetch_array($result)) {
    $arreglocorreos[] = [
        "id_correo" => $row['id_correo'],
        "asunto" => $row['asunto'],
        "cuerpo" => $row['cuerpo'],
        "fecha_envio" => $row['fecha_envio'],
        "estado" => $row['estado'],
        "tipo" => $row['tipo'],
        "correo_remitente" => $row['correo_remitente'],
        "nombre_remitente" => $row['nombre_remitente'],
        "correo_destinatario" => $row['correo_destinatario'],
        "nombre_destinatario" => $row['nombre_destinatario']
    ];
}
echo json_encode($arreglocorreos);
?>

