<?php

session_start();

if (!isset($_SESSION['NomUsuario'])) {
    header("Location: login.php");
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

    $fotos .= "<div class='foto-slide'>";
    $fotos .= "<h2>$titulo</h2>";
    $fotos .= "<img src='fotos/$ruta_foto'>";
    $fotos .= "</div>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Mi Sitio de Fotos</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body class="main-body">
    <h1 id="bienvenida">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></h1>
    <hr>
    
    <h3>¿Qué te gustaría hacer?</h3>
    <ul class="acciones-lista">
        <li><a href="mis_albumes.php" class="accion-link">Ver mis álbumes</a></li>
        <li><a href="crear_album.php" class="accion-link">Crear un nuevo álbum</a></li>
        <li><a href="añadir_foto_album.php" class="accion-link">Añadir foto a un álbum</a></li>
        <li><a href="buscador.php" class="accion-link">Ir al buscador</a></li>
        <li><a href="perfil.php" class="accion-link">Ir al perfil</a></li>
    </ul>
    
    <hr>

    <div class="top-fotos-section">
        <h1 class="top-fotos-titulo">Top ultimas 5 Fotos:</h1>
        <div class="slider-container">
            <button class="slider-btn slider-btn-left" id="slider-prev">&#8592;</button>
            <div class="fotos-lista" id="slider-track">
                <?php echo $fotos; ?>
            </div>
            <button class="slider-btn slider-btn-right" id="slider-next">&#8594;</button>
        </div>
    </div>
    
    <p><a href="php/logout.php" class="logout-link">Cerrar sesión</a></p>

    <script src="js/index.js"></script>
</body>
</html>