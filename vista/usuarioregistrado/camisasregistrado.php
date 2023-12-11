<?php
session_start();
require_once '../../config/base_de_datos.php';
$baseDeDatos = new base_de_datos();
$db = $baseDeDatos->getConnection();

$userID = null;
if (isset($_SESSION['username'])) {
    $usuario = $_SESSION['username'];

    $queryUsuario = "SELECT ID_Usuario FROM usuarios WHERE usuario = :usuario";
    $stmtUsuario = $db->prepare($queryUsuario);
    $stmtUsuario->bindParam(':usuario', $usuario);
    $stmtUsuario->execute();
    $resultadoUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

    if ($resultadoUsuario) {
        $userID = $resultadoUsuario['ID_Usuario'];
    }
}
$query = "SELECT * FROM productos WHERE ID_Categoria = (SELECT ID_Categoria FROM categorias WHERE Nombre = 'Camisas')";
$stmt = $db->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/style.css">
        <title>Camisas - GlamGrid</title>
    </head>
    <body>
    <?php include_once "headerregistrado.php"; ?>
    <div class="products-container">
        <?php foreach ($productos as $producto): ?>
            <div class="product-item">
                <img src="../img/<?= htmlspecialchars($producto['Nombre']) ?>.jpg" alt="<?= htmlspecialchars($producto['Nombre']) ?>" class="product-image">
                <h2><?= htmlspecialchars($producto['Nombre']) ?></h2>
                <p><?= htmlspecialchars($producto['Descripcion']) ?></p>
                <p>Tamaño: <?= htmlspecialchars($producto['Tamano']) ?></p>
                <p>Color: <?= htmlspecialchars($producto['Color']) ?></p>
                <p>Stock: <?= htmlspecialchars($producto['Stock']) ?></p>
                <p>Precio: $<?= htmlspecialchars($producto['Precio']) ?></p>
                <form action="../../backend/productobackend.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $producto['ID_Producto'] ?>">
                    <input type="hidden" name="user_id" value="<?= $userID ?>">
                    <button type="submit" name="add_to_cart" class="add-to-cart">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include_once "../usuario/footer.php"; ?>
    </body>
    </html>

<?php $baseDeDatos->closeConnection(); ?>