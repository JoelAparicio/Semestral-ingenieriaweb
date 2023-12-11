<?php
session_start();
require_once '../config/base_de_datos.php';

function calcularTotalCarrito($db, $idUsuario) {
    $query = "SELECT SUM(dc.Precio * dc.Cantidad) as total FROM detalles_carrito dc
              INNER JOIN carrito c ON dc.ID_Carrito = c.ID_Carrito
              WHERE c.ID_Usuario = :idUsuario";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'] ?? 0;
}

function vaciarCarrito($db, $idUsuario) {
    $queryEliminarDetalles = "DELETE FROM detalles_carrito WHERE ID_Carrito IN (SELECT ID_Carrito FROM carrito WHERE ID_Usuario = :idUsuario)";
    $stmtEliminarDetalles = $db->prepare($queryEliminarDetalles);
    $stmtEliminarDetalles->bindParam(':idUsuario', $idUsuario);
    $stmtEliminarDetalles->execute();

    $queryEliminarCarrito = "DELETE FROM carrito WHERE ID_Usuario = :idUsuario";
    $stmtEliminarCarrito = $db->prepare($queryEliminarCarrito);
    $stmtEliminarCarrito->bindParam(':idUsuario', $idUsuario);
    $stmtEliminarCarrito->execute();
}

if (isset($_POST['accion'])) {
    $baseDeDatos = new base_de_datos();
    $db = $baseDeDatos->getConnection();

    $nombreUsuario = $_SESSION['username'] ?? null;
    if ($nombreUsuario) {
        $queryUsuario = "SELECT ID_Usuario FROM usuarios WHERE usuario = :nombreUsuario";
        $stmtUsuario = $db->prepare($queryUsuario);
        $stmtUsuario->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmtUsuario->execute();
        $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
        $idUsuario = $usuario['ID_Usuario'] ?? null;

        if ($_POST['accion'] == 'realizarPedido' && $idUsuario) {
            $total = calcularTotalCarrito($db, $idUsuario);
            $estadoPedido = 'pendiente';
            $queryPedido = "INSERT INTO pedidos (ID_Usuario, Estado, Total) VALUES (:idUsuario, :estadoPedido, :total)";
            $stmtPedido = $db->prepare($queryPedido);
            $stmtPedido->bindParam(':idUsuario', $idUsuario);
            $stmtPedido->bindParam(':estadoPedido', $estadoPedido);
            $stmtPedido->bindParam(':total', $total);
            $stmtPedido->execute();
            $idPedido = $db->lastInsertId();

            $queryDetalles = "SELECT ID_Producto, Cantidad, Precio FROM detalles_carrito WHERE ID_Carrito IN (SELECT ID_Carrito FROM carrito WHERE ID_Usuario = :idUsuario)";
            $stmtDetalles = $db->prepare($queryDetalles);
            $stmtDetalles->bindParam(':idUsuario', $idUsuario);
            $stmtDetalles->execute();
            $detallesCarrito = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);

            foreach ($detallesCarrito as $detalle) {
                $queryInsertDetalle = "INSERT INTO detalles_pedido (ID_Pedido, ID_Producto, Cantidad, Precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)";
                $stmtInsertDetalle = $db->prepare($queryInsertDetalle);
                $stmtInsertDetalle->bindParam(':idPedido', $idPedido);
                $stmtInsertDetalle->bindParam(':idProducto', $detalle['ID_Producto']);
                $stmtInsertDetalle->bindParam(':cantidad', $detalle['Cantidad']);
                $stmtInsertDetalle->bindParam(':precio', $detalle['Precio']);
                $stmtInsertDetalle->execute();
            }

            vaciarCarrito($db, $idUsuario);

            $_SESSION['mensaje'] = 'Pedido realizado con éxito.';
            header("Location: ../vista/usuarioregistrado/indexregistrado.php");
            exit();
        } elseif ($_POST['accion'] == 'vaciarCarrito' && $idUsuario) {
            vaciarCarrito($db, $idUsuario);

            $_SESSION['mensaje'] = 'El carrito ha sido vaciado.';
            header("Location: ../vista/usuarioregistrado/carritoregistrado.php");
            exit();
        }
    }

    $baseDeDatos->closeConnection();
}

header("Location: ../vista/usuarioregistrado/carritoregistrado.php");
exit();