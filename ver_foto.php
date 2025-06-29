<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Foto</title>
</head>
<body>

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
    <div>
        <h1>Titulo de la Foto:<?php echo $titulo_foto; ?> </h1>
        <img src="fotos/<?php echo $ruta_foto; ?>" alt="">
        <h2>Fecha de creacion:<?php echo $fecha_foto; ?> </h2>
        <h2>Pais de la Foto:<?php echo $nombre_pais; ?> </h2>
        <h2>Album:<?php echo $nombre_album; ?> </h2>
        <h2>Autor:<?php echo $nombre_usuario; ?> </h2>
    </div>
</body>
</html>