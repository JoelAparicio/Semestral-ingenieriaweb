<?php
session_start();
require_once '../../config/base_de_datos.php';

$usuarioActual = $_SESSION['ID_Usuario'] ?? null;
$articulosCarrito = [];
$total = 0;

if ($usuarioActual) {
    $baseDeDatos = new base_de_datos();
    $db = $baseDeDatos->getConnection();

    // Consultar los artículos en el carrito del usuario
    $query = "SELECT p.Nombre, dc.Cantidad, dc.Precio FROM detalles_carrito dc
              INNER JOIN carrito c ON dc.ID_Carrito = c.ID_Carrito
              INNER JOIN productos p ON dc.ID_Producto = p.ID_Producto
              WHERE c.ID_Usuario = :usuarioActual";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':usuarioActual', $usuarioActual);
    $stmt->execute();
    $articulosCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcular el total
    foreach ($articulosCarrito as $item) {
        $total += $item['Cantidad'] * $item['Precio'];
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
</div>

<?php include_once "../usuario/footer.php"; ?>
</body>
</html>

