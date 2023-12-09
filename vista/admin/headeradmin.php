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
            <a href="#">Camisas</a>
            <a href="#">Pantalones</a>
            <a href="#">Zapatos</a>
            <a href="#">Camisetas</a>
        </div>
    </div>

    <div class="user-cart">
        <div class="user-panel-container">
            <img src="../img/usuario.png" alt="Panel de Usuario" id="userPanel">
            <div class="user-dropdown-menu" id="userMenu">
                <a href="#">Ver perfil</a>
                <a href="#">Cerrar sesión</a>
            </div>
        </div>
        <div class="cart-container">
            <img src="../img/carrito.png" alt="Carrito" id="shoppingCart">
            <span class="cart-badge">0</span> <!-- Etiqueta para la cantidad de artículos -->
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
            window.location.href = 'indexadmin.php';
        });
    });

</script>




</body>
</html>