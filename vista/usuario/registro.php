<?php
session_start();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>GlamGrid</title>
</head>
<body>
<?php include_once "header.php"; ?>

<div class="registro-container">
    <form action="../../backend/registrobackend.php" method="POST">
        <h2>Registro de Usuario</h2>
        <?php
        if (isset($_SESSION['errorMessage'])) {
            echo "<p class='error'>{$_SESSION['errorMessage']}</p>";
            unset($_SESSION['errorMessage']); // Limpieza el mensaje de error
        }?>
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Registrarse</button>
    </form>
</div>

<?php include_once "footer.php"; ?>
</body>
</html>
