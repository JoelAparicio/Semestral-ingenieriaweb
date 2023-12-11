<?php
session_start();
require_once '../config/base_de_datos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $idCategoria = $_POST['categoria'];
    $tamano = $_POST['tamano'];
    $color = $_POST['color'];

    $baseDeDatos = new Base_de_datos();
    $conn = $baseDeDatos->getConnection();

    $stmt = $conn->prepare("INSERT INTO productos (Nombre, Descripcion, Precio, Stock, ID_Categoria, Tamano, Color) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $stock, $idCategoria, $tamano, $color]);

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
