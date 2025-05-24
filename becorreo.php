<?php
session_start();
include("verificarsesion.php");
include("verificarestado.php");
include("conexion.php");

$miscorreos = $_SESSION['id'];

$sql="SELECT
    c.id,
    c.asunto,
    c.cuerpo,
    c.fecha_envio,
    c.estado,
    c.tipo,
    u_remit.correo AS correo_remitente,
    u_remit.nombre AS nombre_remitente
FROM
    correos AS c
JOIN
    usuarios AS u_dest ON c.id_destinatario = u_dest.id
JOIN
    usuarios AS u_remit ON c.id_remitente = u_remit.id
WHERE
    c.id_destinatario = $miscorreos AND (c.estado = 'enviado' OR c.estado = 'abierto') AND c.tipo = 1;";

$resultado=$con->query($sql);

$arreglocorreos = [];
while($row=mysqli_fetch_array($resultado)){
    $arreglocorreos[] = [
        "o" => "De:",
        "id" => $row['id'],
        "correo" => $row['correo_remitente'],
        "nombre" => $row['nombre_remitente'],
        "estado"=>$row["estado"],
        "asunto"=>$row["asunto"],
        "cuerpo"=>$row["cuerpo"],
        "fecha_envio"=>$row["fecha_envio"],
        "tipo"=>$row["tipo"],
    ];
}
echo json_encode($arreglocorreos);
?>