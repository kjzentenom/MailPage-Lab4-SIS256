<?php
session_start();
include('conexion.php');

$nombre = $_POST['nombre'];
$user = $_POST['usuario'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$nivel = 0;
$estado = 1;

if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
    $nivel = $_POST['nivel'];
}

$sql = "INSERT INTO usuarios (nombre, user, correo, password, nivel, estado) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("ssssii", $nombre, $user, $correo, $password, $nivel, $estado);

if ($stmt->execute()) {
  echo 'Registro exitoso, Introduzca su correo y contraseña para iniciar sesión';
} else {
  echo 'Error al registrar el usuario';
}

?>