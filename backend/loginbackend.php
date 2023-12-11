<?php
session_start();
include __DIR__ . '/../config/base_de_datos.php';

$usuario = $_POST['username'];
$password = $_POST['password'];

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
        header("Location: ../vista/admin/indexadmin.php");
    } else {
        header("Location: ../vista/usuarioregistrado/indexregistrado.php");
    }
    exit();
}

$_SESSION['errorMessage'] = 'Autenticación fallida';
header("Location: ../vista/usuario/login.php");
exit();


