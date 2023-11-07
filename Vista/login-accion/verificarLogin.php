<?php

include_once "../../configuracion.php";
$param = data_submitted();
$respuesta = array();
$resultado = "";
$error = "";

if(!isset($param["username"]) || !isset($param["password"])){
    $error = "Hubo un error con el envío. Por favor, inténtelo de nuevo.";
}else{
    // Contacto con control
    $session = new Session();
    $resultado = $session->iniciar($param["username"], $param["password"]);

    if(!$respuesta){
        $error = "Usuario o contraseña incorrectos o deshabilitados.";
    }
}



$respuesta["resultado"] = $resultado;
$respuesta["error"] = $error;

echo json_encode($respuesta);

?>