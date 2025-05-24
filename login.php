<?php session_start();
include("conexion.php");

$correo = $_POST['correo'];
$password = sha1($_POST['password']);

$sql = $con->prepare('SELECT id,user,correo,nombre,nivel,estado FROM usuarios WHERE correo=? AND password=?');
$sql->bind_param("ss", $correo, $password);
$sql->execute();

$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];
    $_SESSION['correo'] = $correo;
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['user'] = $row['user'];
    $_SESSION['nivel'] = $row['nivel'];
    $_SESSION['estado'] = $row['estado'];
  echo 'true';
} else {
  echo 'false';
}
?>