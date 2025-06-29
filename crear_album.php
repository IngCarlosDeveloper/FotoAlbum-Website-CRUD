<?php

include "php/conexion.php";

session_start();

// Si no hay sesion, afuera mi rey.
if (!isset($_SESSION['IdUsuario'])) {
     header(header: "Location: login.php");
    exit();
}

$sql_paises = "SELECT IdPais, NomPais FROM Paises ORDER BY NomPais ASC";
$resultado_paises = $conexion->query($sql_paises);

$opcionesPais = "";
if ($resultado_paises->num_rows > 0) {
    while ($fila = $resultado_paises->fetch_assoc()) {
        $opcionesPais .= "<option value='" . $fila['IdPais'] . "'>" . htmlspecialchars($fila['NomPais']) . "</option>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo álbum</title>
</head>
<body>
    <h2>Crear Nuevo Álbum</h2>
    <form action="php/procesar_album.php" method="POST">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>

        <label for="fecha">Fecha (o período):</label><br>
        <input type="date" id="fecha" name="fecha"><br><br>

        <label for="pais">País donde se tomaron las fotos:</label><br>
        <select id="pais" name="pais">
            <option value="">Seleccione Pais</option>
            <?php echo $opcionesPais; ?>
        </select><br><br>

        <input type="hidden" name="usuario" value="<?php echo $_SESSION['IdUsuario']; ?>">

        <button type="submit">Crear Álbum</button>
    </form>
    <br>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
<?php
// Cerramos la conexión a la base de datos al finalizar.
$conexion->close();
?>