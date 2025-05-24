<?php
session_start();
require('verificarsesion.php');
require('verificarnivel.php');
include('conexion.php');

$sql = "SELECT id,nombre,user,correo,password,nivel,estado FROM usuarios order by nombre";
$result = $con->query($sql);

while ($row = mysqli_fetch_array($result)) {
    $arreglousuarios[] = [
        "id" => $row['id'],
        "nombre" => $row['nombre'],
        "user" => $row['user'],
        "correo" => $row['correo'],
        "password" => $row['password'],
        "nivel" => $row['nivel'],
        "estado" => $row['estado']
    ];
}
echo json_encode($arreglousuarios);
?>