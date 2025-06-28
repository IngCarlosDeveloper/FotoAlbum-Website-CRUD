<?php

include "conexion.php";

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql = "SELECT IdUsuario, NomUsuario FROM Usuarios WHERE NomUsuario = ? AND Clave = ?";
$stmt = $conexion->prepare($sql);

// Si la consulta falla, te avisa cualquier vaina
if ($stmt === false) {
    die("Error en la consulta SQL: " . $conexion->error);
}

$stmt->bind_param("ss", $usuario, $clave);
$stmt->execute();
$resultado = $stmt->get_result();

//vemos si se encontró un usuario.
if ($resultado->num_rows === 1) {
    // Si hay usuario, iniciamos la sesión.
    session_start();
    $fila = $resultado->fetch_assoc();
    $_SESSION['IdUsuario'] = $fila['IdUsuario'];
    $_SESSION['NomUsuario'] = $fila['NomUsuario'];
    
    // Redirigimos al usuario al buscador.
    header("Location: ../index.php");
    exit();
} else {
    // Si no se encontró el usuario o la clave es incorrecta.
    echo "Usuario o clave incorrectos. <a href='../login.html'>Volver a intentar</a>";
}

// Cerramos la conexión.
$stmt->close();
$conexion->close();

?>