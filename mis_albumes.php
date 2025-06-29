<?php

include "php/conexion.php";

session_start();

if (!isset($_SESSION['IdUsuario'])) {
     header(header: "Location: login.php");
    exit();
}

$idUsuario = $_SESSION['IdUsuario'];

$sql = "SELECT IdAlbum, Titulo_album, Descripcion, Fecha FROM albumes WHERE Usuario = ? ORDER BY Titulo_album ASC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idUsuario); // 'i' porque IdUsuario es un entero.
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Álbumes</title>
    <link rel="stylesheet" href="css/mis_albumes.css">
</head>
<body class="main-body">
    <h2 class="top-fotos-titulo">Mis Álbumes</h2>
    <p><a href="index.php" class="accion-link" style="display:inline-block;max-width:200px;">Volver a la página de inicio</a></p>
    <hr>
    <div class="albumes-lista">
    <?php
    if ($resultado->num_rows > 0) {
        while ($album = $resultado->fetch_assoc()) {
            echo "<div class='album-card'>";
            echo "<h4 class='album-titulo'>" . htmlspecialchars($album['Titulo_album']) . "</h4>";
            echo "<p class='album-desc'><strong>Descripción:</strong> " . htmlspecialchars($album['Descripcion']) . "</p>";
            echo "<p class='album-fecha'><strong>Fecha:</strong> " . htmlspecialchars($album['Fecha']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p class='album-vacio'>Aún no has creado ningún álbum. <a href='crear_album.php' class='accion-link'>¡Crea uno ahora!</a></p>";
    }

    $stmt->close();
    $conexion->close();
    ?>
    </div>
</body>
</html>