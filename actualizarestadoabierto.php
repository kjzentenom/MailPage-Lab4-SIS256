<?php
session_start();
include("verificarsesion.php");
include("verificarestado.php");
include('conexion.php');

$id_correo = $_GET['id'];

$sql = "UPDATE correos SET estado = 'abierto' WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_correo);
if ($stmt->execute()) {
    echo 'Estado actualizado a abierto';
} else {
    echo 'Error al actualizar el estado';
}
$stmt->close();
$con->close();
?>