<?php
require_once '../../config/base_de_datos.php';

$usuarioActual = $_SESSION['username'] ?? null;
$cantidadEnCarrito = 0;

if ($usuarioActual) {
    $baseDeDatos = new base_de_datos();
    $db = $baseDeDatos->getConnection();

    // Obtener el ID_Usuario basado en el nombre de usuario
    $queryUsuario = "SELECT ID_Usuario FROM usuarios WHERE usuario = :usuario";
    $stmtUsuario = $db->prepare($queryUsuario);
    $stmtUsuario->bindParam(':usuario', $usuarioActual);
    $stmtUsuario->execute();
    $resultadoUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
    $userID = $resultadoUsuario['ID_Usuario'] ?? null;

    if ($userID) {
        // Consultar la cantidad de artículos en el carrito
        $queryCarrito = "SELECT COUNT(*) as total FROM detalles_carrito WHERE ID_Carrito IN (SELECT ID_Carrito FROM carrito WHERE ID_Usuario = :userID)";
        $stmtCarrito = $db->prepare($queryCarrito);
        $stmtCarrito->bindParam(':userID', $userID);
        $stmtCarrito->execute();
        $resultadoCarrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);
        $cantidadEnCarrito = $resultadoCarrito['total'] ?? 0;
    }

    $baseDeDatos->closeConnection();
}

?>

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
<header class="header">
    <div class="logo-container">
        <img src="../img/logo.png" alt="GlamGrid Logo">
    </div>

    <div class="category-container">
        <button id="initButton">Inicio</button>
        <button id="categoryButton">Categorias de ropa</button>
        <div class="category-dropdown-menu" id="categoryMenu">
            <a href="camisasregistrado.php">Camisas</a>
            <a href="pantalonesregistrado.php">Pantalones</a>
            <a href="zapatosregistrado.php">Zapatos</a>
            <a href="camisetasregistrado.php">Camisetas</a>
        </div>
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
                <a href="verperfil.php">Ver perfil</a>
                <a href="../usuario/index.php">Cerrar sesión</a>
            </div>
        </div>
        <div class="cart-container">
            <img src="../img/carrito.png" alt="Carrito" id="shoppingCart">
            <span class="cart-badge"><?= $cantidadEnCarrito ?></span>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userPanel = document.getElementById('userPanel');
        const userMenu = document.getElementById('userMenu');
        const shoppingCart = document.getElementById('shoppingCart');
        const categoryButton = document.getElementById('categoryButton');
        const categoryMenu = document.getElementById('categoryMenu');
        const initButton = document.getElementById('initButton');

        userPanel.addEventListener('click', function() {
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        });

        categoryButton.addEventListener('click', function() {
            categoryMenu.style.display = categoryMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            if (!userPanel.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.style.display = 'none';
            }
            if (!categoryButton.contains(event.target) && !categoryMenu.contains(event.target)) {
                categoryMenu.style.display = 'none';
            }
        });

        shoppingCart.addEventListener('click', function() {
            window.location.href = 'ruta/a/tu/pagina/del/carrito.html';
        });
        initButton.addEventListener('click', function() {
            window.location.href = 'indexregistrado.php';
        });
    });

</script>




</body>
</html>