<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
</head>
<body>

<?php

include("php/buscar.php");
//incluimos el archivo que hace la busqueda

?>

    <form action="">
        <select name="Pais" id="Pais">
            <?php
            echo $opcionesPais
            //imprimimos la variable con toda la informacion
            ?>
        </select>
        <input type="text">
    </form>
</body>
</html>