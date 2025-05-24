<?php
session_start();
require("verificarsesion.php");
require("verificarnivel.php");
include('conexion.php');

$id_cuenta = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cuenta);
if ($stmt->execute()) {
    echo 'Cuenta eliminado exitosamente';
} else {
    echo 'Error al eliminar el correo';
}
$stmt->close();
$con->close();
?>

