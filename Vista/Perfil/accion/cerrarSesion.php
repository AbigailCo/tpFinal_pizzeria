<?php
// Configuración
include_once "../../../configuracion.php";

$session = new Session();

$session->cerrar();

header("Location:../../Home/index.php");

?>