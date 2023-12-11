<?php
session_start();
require_once '../config/base_de_datos.php';

if (isset($_POST['product_id']) && isset($_POST['user_id'])) {
    $productID = $_POST['product_id'];
    $userID = $_POST['user_id'];

    $baseDeDatos = new base_de_datos();
    $db = $baseDeDatos->getConnection();

    $queryCarrito = "INSERT INTO carrito (ID_Usuario) VALUES (:userID)";
    $stmtCarrito = $db->prepare($queryCarrito);
    $stmtCarrito->bindParam(':userID', $userID);

    if ($stmtCarrito->execute()) {
        $idCarrito = $db->lastInsertId();
        $_SESSION['ID_Carrito'] = $idCarrito;
        $cantidad = 1;
        $precio = obtenerPrecioProducto($db, $productID);

        $queryDetalles = "INSERT INTO detalles_carrito (ID_Carrito, ID_Producto, Cantidad, Precio) VALUES (:idCarrito, :productID, :cantidad, :precio)";
        $stmtDetalles = $db->prepare($queryDetalles);
        $stmtDetalles->bindParam(':idCarrito', $idCarrito);
        $stmtDetalles->bindParam(':productID', $productID);
        $stmtDetalles->bindParam(':cantidad', $cantidad);
        $stmtDetalles->bindParam(':precio', $precio);

        if ($stmtDetalles->execute()) {

            header("Location: ../vista/usuarioregistrado/indexregistrado.php");
            exit();
        } else {
            error_log("Error al insertar en detalles_carrito: " . $stmtDetalles->errorInfo()[2]);
            header("Location: ../vista/usuarioregistrado/indexregistrado.php"); // Suponiendo que tienes una página de error
            exit();
        }
    } else {
        error_log("Error al insertar en carrito: " . $stmtCarrito->errorInfo()[2]);
        header("Location: ../vista/usuarioregistrado/indexregistrado.php"); // Suponiendo que tienes una página de error
        exit();
    }

    $baseDeDatos->closeConnection();
} else {
    error_log("Error al recibir los datos necesarios");
    header("Location: ../vista/usuarioregistrado/indexregistrado.php");
    exit();
}

function obtenerPrecioProducto($db, $productID) {
    $queryPrecio = "SELECT Precio FROM productos WHERE ID_Producto = :productID";
    $stmtPrecio = $db->prepare($queryPrecio);
    $stmtPrecio->bindParam(':productID', $productID);
    $stmtPrecio->execute();
    $producto = $stmtPrecio->fetch(PDO::FETCH_ASSOC);
    return $producto['Precio'] ?? 0;
}
?>
