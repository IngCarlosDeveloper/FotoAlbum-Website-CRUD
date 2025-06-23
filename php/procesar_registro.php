<?php

include "conexion.php";

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$email = $_POST['email'];
$sexo = $_POST['sexo'];
$fnacimiento = $_POST['fnacimiento'];
$pais = $_POST['pais'];

$pais = 1;

$sql = "INSERT INTO Usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Pais) VALUES ('$usuario', '$clave', '$email', '$sexo', '$fnacimiento', '$pais')";

if( mysqli_query($conexion,$sql) ){
    echo "eto funciona";
}else{
    echo "eto no funciona goku";
}

mysqli_close($conexion);