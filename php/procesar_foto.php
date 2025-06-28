<?php
include "conexion.php";
session_start();

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../login.php");
    exit();
}

$titulo = !empty($_POST['titulo']) ? $_POST['titulo'] : null;
$fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : null;
$pais = !empty($_POST['pais']) ? $_POST['pais'] : null;
$album = $_POST['album']; //

$fichero_info = $_FILES['fichero'];
$error_fichero = $fichero_info['error'];

// Carpeta donde se guardarán las fotos.
$carpeta_destino = "../fotos/";

if ($error_fichero !== UPLOAD_ERR_OK) {
    die("Error al subir el archivo. Código de error: " . $error_fichero);
}

//Genera un nombre de archivo único 
$extension = pathinfo($fichero_info['name'], PATHINFO_EXTENSION);
$nombre_fichero_unico = uniqid('foto_', true) . '.' . $extension;
$ruta_fichero_destino = $carpeta_destino . $nombre_fichero_unico;

// Movemos el archivo a la carpeta
if (move_uploaded_file($fichero_info['tmp_name'], $ruta_fichero_destino)) {
    
    //Insertamos la información 
    $sql = "INSERT INTO Fotos (Titulo, Fecha, Pais, Album, Fichero) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        // Si hay un error, lo mostramos y eliminamos el archivo subido.
        unlink($ruta_fichero_destino); 
        die("Error al preparar la consulta: " . $conexion->error);
    }
    
    $stmt->bind_param("ssiis", $titulo, $fecha, $pais, $album, $nombre_fichero_unico);
    
    if ($stmt->execute()) {
        echo "¡Foto subida y registrada con éxito! <br><a href='../buscador.php'>Volver al buscador</a>";
    } else {
        // Si hay un error al insertar en la BD, eliminamos el archivo subido.
        unlink($ruta_fichero_destino);
        echo "Error al registrar la foto en la base de datos: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "Error al mover el archivo subido al servidor.";
}

$conexion->close();
?>