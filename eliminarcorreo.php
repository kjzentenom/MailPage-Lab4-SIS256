<?php
session_start();
require("verificarsesion.php");
include('conexion.php');

$id_correo = $_GET['id'];
$sql = "UPDATE correos SET tipo = 0 WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_correo);
if ($stmt->execute()) {
    echo 'Correo eliminado exitosamente';
} else {
    echo 'Error al eliminar el correo';
}
$stmt->close();
$con->close();
?>

