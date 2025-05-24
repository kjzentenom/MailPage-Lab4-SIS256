<?php
session_start();
require("verificarsesion.php");
include("conexion.php");

$miscorreos = $_SESSION['id'];

$sql="SELECT
    c.id,
    c.asunto,
    c.cuerpo,
    c.fecha_envio,
    c.estado,
    c.tipo,
    u_dest.correo AS correo_destinatario,
    u_dest.nombre AS nombre_destinatario
FROM
    correos AS c
JOIN
    usuarios AS u_dest ON c.id_destinatario = u_dest.id
JOIN
    usuarios AS u_remit ON c.id_remitente = u_remit.id
WHERE
    c.id_remitente = $miscorreos AND c.estado = 'pendiente' AND c.tipo = 1;";

$resultado=$con->query($sql);

$arreglocorreos = [];
while($row=mysqli_fetch_array($resultado)){
    $arreglocorreos[] = [ 
         "o" => "Para:",
        "id" => $row['id'],
        "correo" => $row['correo_destinatario'],
        "nombre" => $row['nombre_destinatario'],
        "estado"=>$row["estado"],
        "asunto"=>$row["asunto"],
        "cuerpo"=>$row["cuerpo"],
        "fecha_envio"=>$row["fecha_envio"],
        "tipo"=>$row["tipo"],
    ];
}
echo json_encode($arreglocorreos);
?>