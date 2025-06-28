<?php

session_start();

if (!isset($_SESSION['NomUsuario'])) {
    header("Location: login.php");
    exit(); // Detenemos la ejecución del script.
}

$nombre_usuario = $_SESSION['NomUsuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Mi Sitio de Fotos</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></h1>
    <hr>
    
    <h3>¿Qué te gustaría hacer?</h3>
    <ul>
        <li><a href="mis_albumes.php">Ver mis álbumes</a></li>
        
        <li><a href="crear_album.php">Crear un nuevo álbum</a></li>
        
        <li><a href="añadir_foto_album.php">Añadir foto a un álbum</a></li>
        
        <li><a href="buscador.php">Ir al buscador</a></li>
    </ul>
    
    <hr>
    
    <p><a href="logout.php">Cerrar sesión</a></p>

</body>
</html>