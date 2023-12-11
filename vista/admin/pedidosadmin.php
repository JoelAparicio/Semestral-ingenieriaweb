<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Pedidos - Administrador</title>
</head>
<body>
<?php include_once "headeradmin.php"; ?>

<?php
require_once '../../config/base_de_datos.php';

$baseDeDatos = new base_de_datos();
$db = $baseDeDatos->getConnection();

$query = "
    SELECT p.ID_Pedido, u.usuario, u.Direccion, p.Fecha_Pedido, p.Estado, p.Total, 
           pr.Nombre AS NombreProducto, pr.Tamano, pr.Color, dp.Cantidad
    FROM pedidos p
    INNER JOIN usuarios u ON p.ID_Usuario = u.ID_Usuario
    INNER JOIN detalles_pedido dp ON p.ID_Pedido = dp.ID_Pedido
    INNER JOIN productos pr ON dp.ID_Producto = pr.ID_Producto
    ORDER BY p.Fecha_Pedido DESC
";

$stmt = $db->prepare($query);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$baseDeDatos->closeConnection();
?>

<div class="pedidos-container">
    <h1>Pedidos</h1>
    <table class="admin-table">
        <thead class="admin-table-head">
        <tr class="admin-table-row">
            <th>ID Pedido</th>
            <th>Usuario</th>
            <th>Dirección</th>
            <th>Fecha del Pedido</th>
            <th>Estado</th>
            <th>Nombre del Producto</th>
            <th>Talla</th>
            <th>Color</th>
            <th>Cantidad</th>
            <th>Total del Pedido</th>
        </tr>
        </thead>
        <tbody class="admin-table-body">
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= htmlspecialchars($pedido['ID_Pedido']) ?></td>
                <td><?= htmlspecialchars($pedido['usuario']) ?></td>
                <td><?= htmlspecialchars($pedido['Direccion']) ?></td>
                <td><?= htmlspecialchars($pedido['Fecha_Pedido']) ?></td>
                <td><?= htmlspecialchars($pedido['Estado']) ?></td>
                <td><?= htmlspecialchars($pedido['NombreProducto']) ?></td>
                <td><?= htmlspecialchars($pedido['Tamano']) ?></td>
                <td><?= htmlspecialchars($pedido['Color']) ?></td>
                <td><?= htmlspecialchars($pedido['Cantidad']) ?></td>
                <td>$<?= number_format($pedido['Total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php include_once "../usuario/footer.php"; ?>
</body>
</html>
