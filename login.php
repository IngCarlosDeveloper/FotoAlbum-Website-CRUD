<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="main-body">
    <form action="php/procesar_login.php" method="post" class="form-login">
        <label for="usuario">Usuario:</label>
        <input id="usuario" name="usuario" required><br>
        <label for="clave">Clave:</label>
        <input id="clave" type="password" name="clave" required><br>
        <input type="submit" value="Entrar" class="btn-principal">
    </form>
    <p><a href="registro.php" class="accion-link">Registrate</a></p>
</body>
</html>