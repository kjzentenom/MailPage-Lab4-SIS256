<?php
session_start();
require('verificarsesion.php');
require('verificarnivel.php');
include('conexion.php');

$id_cuenta = $_GET['id'];
$nombre = $_POST['nombre'];
$user = $_POST['usuario'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$nivel = $_POST['nivel'] ?? 0;
$estado = $_POST['estado'] ?? 1;

$sql = "UPDATE usuarios SET nombre = ?, user = ?, correo = ?, password = ?, nivel = ?, estado = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssiii", $nombre, $user, $correo, $password, $nivel, $estado, $id_cuenta);

if ($stmt->execute()) {
  echo 'Cuenta actualizada exitosamente';
} else {
  echo 'Error al Actualizar la cuenta';
}

?>