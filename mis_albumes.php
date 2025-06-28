<?php

include "php/conexion.php";

session_start();

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: login.php");
    exit();
}

$idUsuario = $_SESSION['IdUsuario'];

$sql = "SELECT IdAlbum, Titulo, Descripcion, Fecha FROM Albumes WHERE Usuario = ? ORDER BY Titulo ASC";
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
</head>
<body>
    <h2>Mis Álbumes</h2>
    <p><a href="index.php">Volver a la página de inicio</a></p>
    <hr>
    
    <?php
    if ($resultado->num_rows > 0) {
        while ($album = $resultado->fetch_assoc()) {
            echo "<div>";
            echo "<h4>" . htmlspecialchars($album['Titulo']) . "</h4>";
            echo "<p><strong>Descripción:</strong> " . htmlspecialchars($album['Descripcion']) . "</p>";
            echo "<p><strong>Fecha:</strong> " . htmlspecialchars($album['Fecha']) . "</p>";
            echo "</div>";
            echo "<hr>";
        }
    } else {
        echo "<p>Aún no has creado ningún álbum. <a href='crear_album.php'>¡Crea uno ahora!</a></p>";
    }

    $stmt->close();
    $conexion->close();
    ?>

</body>
</html>