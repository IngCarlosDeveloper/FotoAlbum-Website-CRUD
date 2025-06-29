<?php

include "conexion.php";
session_start();

// Si no hay sesion, afuera mi rey.
if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../login.php");
    exit();
}

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$pais = !empty($_POST['pais']) ? $_POST['pais'] : null; 
$idUsuario = $_SESSION['IdUsuario'];

$sql = "INSERT INTO Albumes (Titulo, Descripcion, Fecha, Pais, Usuario) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conexion->error);
}


// 's' para string, 's' para string, 's' para date, 'i' para integer, 'i' para integer
// El tipo 'd' se puede usar para la fecha, pero 's' también funciona si el formato es 'YYYY-MM-DD'.
$stmt->bind_param("sssii", $titulo, $descripcion, $fecha, $pais, $idUsuario);

if ($stmt->execute()) {
    echo "¡Álbum creado! <a href='../buscador.php'>Volver al buscador</a>";
} else {
    echo "Hubo un error al crear el álbum: " . $stmt->error;
}

// 6. Cerramos la sentencia y la conexión.
$stmt->close();
$conexion->close();
?>