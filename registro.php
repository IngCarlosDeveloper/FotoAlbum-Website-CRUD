<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="procesar_registro.php" method="POST">
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

        <label for="pais">País:</label><br>
        <select id="pais" name="pais" required>
        <option value="">Seleccione un país</option>
            <?php
            // Generar opciones de la lista desplegable
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['IdPais'] . '">' . htmlspecialchars($row['NomPais']) . '</option>';
                }
            } else {
                echo '<option value="">No hay países disponibles</option>';
            }
            ?>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>