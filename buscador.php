<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link rel="stylesheet" href="css/buscador.css">
</head>
<body>
<?php

include("php/listapais.php");
//incluimos el archivo que hace la busqueda

?>

    <form method="POST"> 
        <select name="Pais" id="Pais">
                <option value="0">Seleccione Pais</option>
            <?php
            echo $opcionesPais
            //imprimimos la variable con toda la informacion
            ?>
            
        </select>

        <label for="palabraBuscar">Buscador:</label>  
            <input type="text" id="palabraBuscar" name="palabraBuscar">
        </form>

        <table>
            <thead>
                <th>Id Foto </th>
                <th> Titulo </th>
                <th> Fecha </th>
                <th> Album </th>
                <th> FRegistro </th>
                <th> Foto </th>
            </thead>
            <tbody id="contenido">
            </tbody>
        </table>


    <script type="text/javascript" src="js/buscador.js"></script>
    <a href="index.php">Volver al inicio</a>
</body>
</html>