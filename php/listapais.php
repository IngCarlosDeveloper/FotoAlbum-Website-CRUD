<?php
#------------------------------------------------CONEXION A LA DB----------------------------------------

require "conexion.php"; //llamo el archivo con permisos para la db

#------------------------------------------------CARGADOR DE OPCIONES---------------------------

$sql_paises = "SELECT * from paises;"; //sintaxis sql para hacer la busqueda

$resultado_paises = mysqli_query($conexion, $sql_paises); //con los permisos de $conexion ejecuto $sql_query y almaceno en $resultado_paises

$opcionesPais = 0;

while ($fila = mysqli_fetch_assoc($resultado_paises)){
    $opcionesPais .= "<option value =". $fila["IdPais"] .">". $fila["NomPais"] ."</option>";
    //En el bucle se empaqueta "<option value = $variable> $variable </option>"
}

// bucle que imprime fila x fila el resultado del select

?>