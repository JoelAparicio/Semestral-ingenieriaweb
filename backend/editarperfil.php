<?php
session_start();
include_once '../config/base_de_datos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $database = new Base_de_datos();
    $conn = $database->getConnection();

    $query = "UPDATE usuarios SET Correo_Electronico = ?, Direccion = ? WHERE Usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $direccion);
    $stmt->bindParam(3, $usuario);

    if ($stmt->execute()) {
        $_SESSION['UpdateMessage'] = 'Usted actualizó sus datos, por favor vuelva a iniciar sesión.';
        header("Location: ../vista/usuario/login.php");
        exit();
    } else {
        $_SESSION['UpdateMessage'] = 'Error al actualizar los datos.';
        header("Location: ../vista/usuarioregistrado/editarperfil.php");
        exit();
    }
}
?>
