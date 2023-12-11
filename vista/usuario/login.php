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
    <link rel="stylesheet" href="../css/style.css">
    <title>GlamGrid Login</title>
</head>
<body>
<?php include_once "header.php"; ?>

<div class="login-container">
    <form action="../../backend/loginbackend.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <?php
        if (isset($_SESSION['errorMessage'])) {
        echo "<p class='error'>{$_SESSION['errorMessage']}</p>";
        unset($_SESSION['errorMessage']); // Limpia el mensaje de error
        }

        if (isset($_SESSION['UpdateMessage'])) {
        echo "<p class='update'>{$_SESSION['UpdateMessage']}</p>";
         unset($_SESSION['UpdateMessage']); // Limpia el mensaje de actualización
            }
        ?>
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
        <a href="registro.php" class="btn-registro">Registrarse</a>
    </form>
</div>

<?php include_once "footer.php"; ?>
</body>
</html>

