<?php
session_start();
require_once '../config/base_de_datos.php';

// Asegúrate de recibir los datos necesarios
if (isset($_POST['product_id']) && isset($_POST['user_id'])) {
    $productID = $_POST['product_id'];
    $userID = $_POST['user_id'];

    // Crear una instancia de la clase base_de_datos y obtener la conexión
    $baseDeDatos = new base_de_datos();
    $db = $baseDeDatos->getConnection();

    // Insertar en la tabla carrito
    $queryCarrito = "INSERT INTO carrito (ID_Usuario) VALUES (:userID)";
    $stmtCarrito = $db->prepare($queryCarrito);
    $stmtCarrito->bindParam(':userID', $userID);

    if ($stmtCarrito->execute()) {
        // Obtener el ID_Carrito generado
        $idCarrito = $db->lastInsertId();
        $_SESSION['ID_Carrito'] = $idCarrito;
        // Aquí necesitas determinar la cantidad y el precio. Puedes obtener el precio de la tabla productos
        // Por ejemplo, asumiendo una cantidad predeterminada de 1
        $cantidad = 1;
        $precio = obtenerPrecioProducto($db, $productID);

        // Insertar en la tabla detalles_carrito
        $queryDetalles = "INSERT INTO detalles_carrito (ID_Carrito, ID_Producto, Cantidad, Precio) VALUES (:idCarrito, :productID, :cantidad, :precio)";
        $stmtDetalles = $db->prepare($queryDetalles);
        $stmtDetalles->bindParam(':idCarrito', $idCarrito);
        $stmtDetalles->bindParam(':productID', $productID);
        $stmtDetalles->bindParam(':cantidad', $cantidad);
        $stmtDetalles->bindParam(':precio', $precio);

        if ($stmtDetalles->execute()) {
            // Redirigir o manejar el éxito

            header("Location: ../vista/usuarioregistrado/indexregistrado.php");
            exit();
        } else {
            // Registrar el error y/o redirigir a una página de error
            error_log("Error al insertar en detalles_carrito: " . $stmtDetalles->errorInfo()[2]);
            header("Location: ../vista/usuarioregistrado/indexregistrado.php"); // Suponiendo que tienes una página de error
            exit();
        }
    } else {
        // Registrar el error y/o redirigir a una página de error
        error_log("Error al insertar en carrito: " . $stmtCarrito->errorInfo()[2]);
        header("Location: ../vista/usuarioregistrado/indexregistrado.php"); // Suponiendo que tienes una página de error
        exit();
    }

    $baseDeDatos->closeConnection();
} else {
    // Redirigir o manejar el error de forma adecuada
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
