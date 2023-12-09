<?php
session_start();
include __DIR__ . '/../config/base_de_datos.php';

$usuario = $_POST['username']; // Asegúrate de validar y limpiar esta entrada
$password = $_POST['password']; // Igualmente, valida y limpia esta entrada

$baseDeDatos = new Base_de_datos();
$conn = $baseDeDatos->getConnection();

$query = "SELECT Correo_Electronico, Direccion, Rol FROM usuarios WHERE usuario = :usuario";
$stmt = $conn->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['username'] = $usuario;
    $_SESSION['email'] = $row['Correo_Electronico'];
    $_SESSION['direccion'] = $row['Direccion'];
    $_SESSION['rol'] = $row['Rol'];

    if ($row['Rol'] == 'admin') {
        header("Location: ../vista/admin/indexadmin.php"); // Redirige al admin
    } else {
        header("Location: ../vista/usuarioregistrado/indexregistrado.php"); // Redirige al usuario normal
    }
    exit();
}

$_SESSION['errorMessage'] = 'Autenticación fallida';
header("Location: ../vista/usuario/login.php");
exit();
?>

