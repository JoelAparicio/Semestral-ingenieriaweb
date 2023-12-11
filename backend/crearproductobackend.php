<?php
session_start();
require_once '../config/base_de_datos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $idCategoria = $_POST['categoria'];
    $tamano = $_POST['tamano'];
    $color = $_POST['color'];

    // Conexión a la base de datos
    $baseDeDatos = new Base_de_datos();
    $conn = $baseDeDatos->getConnection();

    // Inserción en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (Nombre, Descripcion, Precio, Stock, ID_Categoria, Tamano, Color) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $stock, $idCategoria, $tamano, $color]);

    // Verificar la inserción y enviar un mensaje al administrador
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = 'Producto agregado con éxito.';
        header('Location: ../vista/admin/productosadmin.php');
        exit();
    } else {
        $_SESSION['error'] = 'Hubo un error al agregar el producto.';
        header('Location: ../vista/admin/productosadmin.php');
        exit();
    }

}
?>
