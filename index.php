<?php

session_start();

if (!isset($_SESSION['NomUsuario'])) {
    header(header: "Location: login.php");
    exit(); // Detenemos la ejecución del script.
}

$nombre_usuario = $_SESSION['NomUsuario'];

include ("php/conexion.php");

$sql = "SELECT titulo, fichero from fotos ORDER BY FRegistro DESC LIMIT 5;";

$resultado = mysqli_query($conexion, $sql);

$fotos = '';

while($row = mysqli_fetch_assoc($resultado)){
    $ruta_foto = $row['fichero'];
    $titulo = $row['titulo'];

    $fotos .= "<h2>$titulo</h2>";
    $fotos .= "<img src='fotos/$ruta_foto'>";

}

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

        <li><a href="perfil.php">Ir al perfil</a></li>
    </ul>
    
    <hr>

    <div>
        <h1>Top ultimas 5 Fotos:</h1>
        <div>
            <?php
            echo $fotos;
            ?>
        </div>
    </div>
    
    <p><a href="php/logout.php">Cerrar sesión</a></p>

</body>
</html>