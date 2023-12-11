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
                <a href="../usuarioregistrado/verperfil.php">Ver perfil</a>
                <a href="../usuario/index.php">Cerrar sesión</a>
            </div>
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
            window.location.href = 'carritoregistrado.php';
        });
        initButton.addEventListener('click', function() {
            window.location.href = 'indexregistrado.php';
        });
    });

</script>




</body>
</html>