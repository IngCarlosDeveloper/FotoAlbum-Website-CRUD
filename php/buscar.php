<?php

require "conexion.php"; //llamo el archivo con permisos para la db

$sql_paises = "SELECT * from paises;"; //sintaxis sql para hacer la busqueda

$resultado_paises = mysqli_query($conexion, $sql_paises); //con los permisos de $conexion ejecuto $sql_query y almaceno en $resultado_paises

while ($fila = mysqli_fetch_assoc($resultado_paises)){
    echo $fila['IdPais'];
    echo $fila['NomPais'];
    echo "<br>";
}

// bucle que imprime fila x fila el resultado del select
?>