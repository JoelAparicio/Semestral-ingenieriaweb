<?php
session_start();
require_once '../../config/base_de_datos.php';

$nombreUsuario = $_SESSION['username'] ?? null;
$articulosCarrito = [];
$total = 0;

if ($nombreUsuario) {
    $baseDeDatos = new base_de_datos();
    $db = $baseDeDatos->getConnection();

    // Obtener ID_Usuario a partir del nombre de usuario
    $queryUsuario = "SELECT ID_Usuario FROM usuarios WHERE usuario = :nombreUsuario";
    $stmtUsuario = $db->prepare($queryUsuario);
    $stmtUsuario->bindParam(':nombreUsuario', $nombreUsuario);
    $stmtUsuario->execute();
    $resultadoUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
    $usuarioActual = $resultadoUsuario['ID_Usuario'] ?? null;

    if ($usuarioActual) {
        // Consultar los artículos en el carrito del usuario
        $query = "SELECT p.Nombre, dc.Cantidad, dc.Precio FROM detalles_carrito dc
                  INNER JOIN carrito c ON dc.ID_Carrito = c.ID_Carrito
                  INNER JOIN productos p ON dc.ID_Producto = p.ID_Producto
                  WHERE c.ID_Usuario = :usuarioActual";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usuarioActual', $usuarioActual);
        $stmt->execute();
        $articulosCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articulosCarrito as $item) {
            $total += $item['Cantidad'] * $item['Precio'];
        }
    }

    $baseDeDatos->closeConnection();
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Carrito - GlamGrid</title>
</head>
<body>
<?php include_once "headerregistrado.php"; ?>

<div class="carrito-container">
    <?php foreach ($articulosCarrito as $item): ?>
        <div class="carrito-item">
            <p>Producto: <?= htmlspecialchars($item['Nombre']) ?></p>
            <p>Cantidad: <?= htmlspecialchars($item['Cantidad']) ?></p>
            <p>Precio: $<?= htmlspecialchars($item['Precio']) ?></p>
        </div>
    <?php endforeach; ?>
    <div class="total-carrito">
        <span>Total: $<?= htmlspecialchars($total) ?></span>
    </div>
    <form action="../../backend/carritobackend.php" method="post">
        <button type="submit" name="accion" value="realizarPedido" class="btn-accion">Realizar Pedido</button>
        <button type="submit" name="accion" value="vaciarCarrito" class="btn-accion">Vaciar Carrito</button>
    </form>
</div>

<?php include_once "../usuario/footer.php"; ?>
</body>
</html>

