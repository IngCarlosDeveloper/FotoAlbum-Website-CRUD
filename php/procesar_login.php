<?php

echo "Hola";

session_start();

$pdo = new PDO("mysql:host=localhost;dbname=proyectobd", "", "");

$NomUsuario = $_POST['usuario'] ?? '';
$Clave = $_POST['clave'] ?? '';

echo $NomUsuario;
echo $Clave;

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE NomUsuario = ? LIMIT 1");
$stmt->execute([$usuario]);
$user = $stmt->fetch();

if ($user && $user['Clave'] === $clave) {
    $_SESSION['NomUsuario'] = $usuario;  // Guardamos sesión
    header("Location: buscador.php"); // Redirige al buscador
    exit;
} else {
    echo "Usuario o clave incorrectos";
}
?>