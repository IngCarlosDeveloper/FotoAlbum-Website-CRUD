<?php
    include "conexion.php";
    include "../ver_foto.php";

    $id_foto = isset($_GET['foto']) ? $conexion -> real_escape_string($_GET['foto']) : NULL;

    echo ("Foto: $id_foto");



?>