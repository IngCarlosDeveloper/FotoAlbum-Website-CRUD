<?php

include "php/conexion.php";
session_start();

if (!isset($_SESSION['IdUsuario'])) {
     header(header: "Location: login.php");
    exit();
}

$idUsuario = $_SESSION['IdUsuario'];

// álbumes del usuario 
$sql_albumes = "SELECT IdAlbum, Titulo_album FROM Albumes WHERE Usuario = ? ORDER BY Titulo_album ASC";
$stmt_albumes = $conexion->prepare($sql_albumes);
$stmt_albumes->bind_param("i", $idUsuario);
$stmt_albumes->execute();
$resultado_albumes = $stmt_albumes->get_result();

$opcionesAlbum = "";
if ($resultado_albumes->num_rows > 0) {
    while ($fila = $resultado_albumes->fetch_assoc()) {
        $opcionesAlbum .= "<option value='" . $fila['IdAlbum'] . "'>" . htmlspecialchars($fila['Titulo_album']) . "</option>";
    }
} else {
    // Si el usuario no tiene álbumes, F
    $opcionesAlbum = "<option value='' disabled selected>Primero crea un álbum</option>";
}
$stmt_albumes->close();

$sql_paises = "SELECT IdPais, NomPais FROM Paises ORDER BY NomPais ASC";
$resultado_paises = $conexion->query($sql_paises);

$opcionesPais = "<option value=''>Selecciona un país (Opcional)</option>";
if ($resultado_paises->num_rows > 0) {
    while ($fila = $resultado_paises->fetch_assoc()) {
        $opcionesPais .= "<option value='" . $fila['IdPais'] . "'>" . htmlspecialchars($fila['NomPais']) . "</option>";
    }
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir foto a álbum</title>
    <link rel="stylesheet" href="css/añadir_foto_album.css">
</head>
<body class="main-body">
    <h2 class="form-title">Añadir Foto a Álbum</h2>
    <form action="php/procesar_foto.php" method="POST" enctype="multipart/form-data" class="form-foto">
        <label for="titulo">Título de la foto (opcional):</label><br>
        <input type="text" id="titulo" name="titulo"><br><br>

        <label for="fichero">Selecciona el archivo de la foto:</label><br>
        <input type="file" id="fichero" name="fichero" accept="image/*" required><br><br>

        <label for="album">Selecciona el álbum:</label><br>
        <select id="album" name="album" required>
            <?php echo $opcionesAlbum; ?>
        </select><br><br>

        <label for="fecha">Fecha en que fue tomada (opcional):</label><br>
        <input type="date" id="fecha" name="fecha"><br><br>

        <label for="pais">País donde fue tomada (opcional):</label><br>
        <select id="pais" name="pais">
            <?php echo $opcionesPais; ?>
        </select><br><br>

        <button type="submit" class="btn-principal">Subir Foto</button>
    </form>
    <br>
    <a href="index.php" class="accion-link">Volver al inicio</a>
</body>
</html>