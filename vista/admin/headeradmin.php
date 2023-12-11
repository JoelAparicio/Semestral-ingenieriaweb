<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
</head>
<body>
<?php
require_once '../../config/base_de_datos.php';

$baseDeDatos = new base_de_datos();
$db = $baseDeDatos->getConnection();

$query = "SELECT COUNT(*) as total_pedidos FROM pedidos";
$stmt = $db->prepare($query);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

$totalPedidos = $resultado['total_pedidos'] ?? 0;

$baseDeDatos->closeConnection();
?>

<header class="header">
    <div class="logo-container">
        <img src="../img/logo.png" alt="GlamGrid Logo">
    </div>

    <div id="buttons-container">
        <button id="initButton">Inicio</button>
        <button id="orderButton">Pedidos (<?= $totalPedidos ?>)</button>
        <button id="productButton">Productos</button>
    </div>

    <div class="user-cart">
        <div class="user-panel-container">
            <img src="../img/usuario.png" alt="Panel de Usuario" id="userPanel">
            <p id="nombreUsuario">Bienvenido, <?php
                if (isset($_SESSION['username'])) {
                    $usuario= htmlspecialchars($_SESSION['username']);
                    echo $usuario;
                }
                ?></button></p>
            <div class="user-dropdown-menu" id="userMenu">
                <a href="../usuario/index.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userPanel = document.getElementById('userPanel');
        const userMenu = document.getElementById('userMenu');
        const initButton = document.getElementById('initButton');
        const orderButton = document.getElementById('orderButton');
        const productButton = document.getElementById('productButton');

        userPanel.addEventListener('click', function() {
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            if (!userPanel.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.style.display = 'none';
            }
        });

        initButton.addEventListener('click', function() {
            window.location.href = 'indexadmin.php';
        });
        orderButton.addEventListener('click', function() {
            window.location.href = 'pedidosadmin.php';
        });
        productButton.addEventListener('click', function() {
            window.location.href = 'productosadmin.php';
        });
    });
</script>

</body>
</html>
