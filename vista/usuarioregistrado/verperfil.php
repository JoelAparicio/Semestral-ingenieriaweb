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
    <title>GlamGrid</title>
</head>
<body>
<?php include_once "headerregistrado.php"; ?>

<form id="perfilForm" class="perfil-container" action="../../backend/editarperfil.php" method="post">
    <div class="perfil-item">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
    </div>
    <div class="perfil-item">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
    </div>
    <div class="perfil-item">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($_SESSION['direccion']); ?>" readonly>
    </div>
    <div class="perfil-item">
        <label for="rol">Rol:</label>
        <input type="text" id="rol" name="rol" value="<?php echo htmlspecialchars($_SESSION['rol']); ?>" readonly>
    </div>
    <button type="button" id="botonEditar">Editar</button>
    <button type="submit" id="botonGuardar" style="display:none;">Guardar</button>
</form>


<?php include_once "../usuario/footer.php"; ?>

<script>
    document.getElementById('botonEditar').addEventListener('click', function() {
        document.getElementById('email').readOnly = false;
        document.getElementById('direccion').readOnly = false;

        this.style.display = 'none';
        document.getElementById('botonGuardar').style.display = 'block';
    });

    document.getElementById('botonGuardar').addEventListener('click', function() {
        var form = document.getElementById('perfilForm');
        form.submit();
    });
</script>

</body>
</html>