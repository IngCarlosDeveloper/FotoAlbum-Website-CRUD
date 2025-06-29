<?php

include "conexion.php";

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$email = $_POST['email'];
$sexo = $_POST['sexo'];
$fnacimiento = $_POST['fnacimiento'];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$nombre_fichero_foto = ""; 

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fichero_info = $_FILES['foto'];

    $carpeta_destino = "../fotos_perfil/";
    
    // Genera un nombre único 
    $extension = pathinfo($fichero_info['name'], PATHINFO_EXTENSION);
    $nombre_fichero_unico = uniqid('foto_', true) . '.' . $extension;
    $ruta_fichero_destino = $carpeta_destino . $nombre_fichero_unico;

    // Mueve el archivo temporal a la carpeta
    if (move_uploaded_file($fichero_info['tmp_name'], $ruta_fichero_destino)) {
        // Si se movió correctamente, guarda el nombre del archivo para la base de datos.
        $nombre_fichero_foto = $nombre_fichero_unico;
    } else {
        echo "Error al mover el archivo subido.<br>";
    }
}

$sql = "INSERT INTO Usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Pais, Ciudad, Foto) 
        VALUES ('$usuario', '$clave', '$email', '$sexo', '$fnacimiento', '$pais', '$ciudad', '$nombre_fichero_foto')";


if( mysqli_query($conexion, $sql) ){
    echo "<script>
        alert('¡Usuario registrado!');
        window.location.href = '../login.php';
    </script>";
    exit();
} else {
    // Si falla, muestra el error y elimina el archivo subido.
    echo "<script>
        alert('Hubo un error al registrar el usuario: " . mysqli_error($conexion) . "');
        window.location.href = '../login.php';
    </script>";
    // Borramos el archivo si se subió, para no dejar archivos basura.
    if (!empty($nombre_fichero_foto) && file_exists($ruta_fichero_destino)) {
        unlink($ruta_fichero_destino);
    }
}

mysqli_close($conexion);

?>