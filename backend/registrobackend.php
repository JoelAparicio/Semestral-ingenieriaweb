<?php
session_start();
include __DIR__ . '/../config/base_de_datos.php';

$usuario = $_POST['username'] ?? '';
$correoElectronico = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($usuario) || empty($correoElectronico) || empty($password)) {
    $_SESSION['errorMessage'] = 'Por favor, rellene todos los campos.';
    header("Location: ../vista/usuario/registro.php");
    exit();
}

$baseDeDatos = new Base_de_datos();
$conn = $baseDeDatos->getConnection();

$query = "SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario OR Correo_Electronico = :correoElectronico";
$stmt = $conn->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':correoElectronico', $correoElectronico);
$stmt->execute();

if ($stmt->fetchColumn() > 0) {
    $_SESSION['errorMessage'] = 'Usuario o email ya registrado.';
    header("Location: ../vista/usuario/registro.php");
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insertQuery = "INSERT INTO usuarios (usuario, Correo_Electronico, password) VALUES (:usuario, :correoElectronico, :hashedPassword)";
$insertStmt = $conn->prepare($insertQuery);
$insertStmt->bindParam(':usuario', $usuario);
$insertStmt->bindParam(':correoElectronico', $correoElectronico);
$insertStmt->bindParam(':hashedPassword', $hashedPassword);

if ($insertStmt->execute()) {
    header("Location: ../vista/usuario/login.php");
} else {
    $_SESSION['errorMessage'] = 'Error al registrar el usuario.';
    header("Location: ../vista/usuario/registro.php");
}
exit();
?>
