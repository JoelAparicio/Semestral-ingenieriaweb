<?php
session_start();
require_once '../../config/base_de_datos.php';

$baseDeDatos = new Base_de_datos();
$conn = $baseDeDatos->getConnection();

// Obtener categorías para la lista desplegable
$queryCategorias = "SELECT ID_Categoria, Nombre FROM categorias";
$stmtCategorias = $conn->prepare($queryCategorias);
$stmtCategorias->execute();
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Añadir Producto - Administrador</title>
</head>
<body>
<?php include_once "headeradmin.php"; ?>

<div class="product-form-container">
    <?php if (isset($_SESSION['message'])): ?>
        <p class="message_success"><?= $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); // Eliminar el mensaje después de mostrarlo ?>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="message_error"><?= $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); // Eliminar el mensaje después de mostrarlo ?>
    <?php endif; ?>
    <h1>Añadir Nuevo Producto</h1>
    <form action="../../backend/crearproductobackend.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['ID_Categoria'] ?>"><?= htmlspecialchars($categoria['Nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tamano">Tamaño:</label>
            <input type="text" id="tamano" name="tamano" required>
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>
        </div>
        <button type="submit" class="submit-btn">Añadir Producto</button>
    </form>
</div>

<?php include_once "../usuario/footer.php"; ?>
</body>
</html>

