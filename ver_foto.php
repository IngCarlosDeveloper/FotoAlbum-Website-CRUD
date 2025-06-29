<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Foto</title>
    <link rel="stylesheet" href="css/ver_foto.css">
</head>
<body class="main-body">

    <?php

    include "php/conexion.php";

    $id_foto = isset($_GET['foto']) ? $conexion -> real_escape_string($_GET['foto']) : NULL;

    $sql_buscar_foto = "SELECT fotos.Titulo, fotos.Fichero, fotos.Fecha, paises.NomPais, albumes.Titulo_album,
    usuarios.NomUsuario FROM fotos INNER JOIN albumes ON fotos.Album = albumes.IdAlbum
    INNER JOIN paises ON fotos.Pais = paises.IdPais INNER JOIN usuarios ON albumes.Usuario = usuarios.IdUsuario
    WHERE IdFoto = $id_foto;";

    //echo $sql_buscar_foto;

    $resultado = mysqli_query($conexion, $sql_buscar_foto);
    $num_filas = $resultado->num_rows;

    if($num_filas === 1){

        while($row = mysqli_fetch_assoc($resultado)){
        $titulo_foto = $row['Titulo'];
        $ruta_foto = $row['Fichero'];
        $fecha_foto = $row['Fecha'];
        $nombre_pais = $row['NomPais'];
        $nombre_album = $row['Titulo_album'];
        $nombre_usuario = $row['NomUsuario'];
    }
    }
    ?>
    <div class="foto-detalle">
        <h1 class="foto-titulo">Titulo de la Foto: <?php echo $titulo_foto; ?></h1>
        <img src="fotos/<?php echo $ruta_foto; ?>" alt="" class="foto-img">
        <div class="foto-info">
            <h2>Fecha de creacion: <span><?php echo $fecha_foto; ?></span></h2>
            <h2>Pais de la Foto: <span><?php echo $nombre_pais; ?></span></h2>
            <h2>Album: <span><?php echo $nombre_album; ?></span></h2>
            <h2>Autor: <span><?php echo $nombre_usuario; ?></span></h2>
        </div>
    </div>
</body>
</html>