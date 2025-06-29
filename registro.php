<?php
include "php/listapais.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body class="main-body">
    <h2 class="form-title">Formulario de Registro</h2>
    <form action="php/procesar_registro.php" method="POST" enctype="multipart/form-data" class="form-registro">
        <label for="usuario">Nombre de Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" maxlength="15" required><br><br>

        <label for="clave">Clave:</label><br>
        <input type="password" id="clave" name="clave" maxlength="15" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sexo">Sexo:</label><br>
        <select id="sexo" name="sexo" required>
            <option value="1">Masculino</option>
            <option value="2">Femenino</option>
        </select><br><br>

        <label for="fnacimiento">Fecha de Nacimiento:</label><br>
        <input type="date" id="fnacimiento" name="fnacimiento" required><br><br>

        <label for="ciudad">Ingrese ciudad</label><br>
        <input type="text" id="ciudad" name="ciudad" maxlength="15" required><br><br>

        <label for="pais">País:</label><br>
        <select id="pais" name="pais" required>
        <option value="0">Seleccione un país</option>
        <?php
            echo $opcionesPais
            //imprimimos la variable con toda la informacion
            ?>
        </select><br><br>
        
        <label for="foto">Foto de Perfil:</label><br>
        <input type="file" id="foto" name="foto" accept="image/*" required><br><br>

        <button type="submit" class="btn-principal">Registrar</button>
    </form>
    <script type="text/javascript" src="js/buscador.js"></script>
</body>
</html>