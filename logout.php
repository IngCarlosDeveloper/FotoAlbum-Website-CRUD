<?php
session_start();

session_unset();

session_destroy();

header("Location: ../album_base_datos/login.php");
exit();
?>