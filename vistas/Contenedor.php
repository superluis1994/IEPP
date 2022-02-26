<?php
require_once "modelos/conexiones.php";
$procesos = new funciones();
$procesos->actualizarDatos();
require_once "./configuraciones/DatoSede.php";
require_once("Partes/header.php");







require_once("Partes/footer.php");

?>


