<?php
include_once "../../../configuracion.php";

$data = data_submitted();

$objControl = new AbmCompra;

$result["respuesta"] = $objControl->cambiarEstado(["id" => $data["id"],"idcompraestadotipo" => $data["idcompraestadotipo"]+1]);

if(!$result["respuesta"]){
    $result["errorMsg"] = "No se pudo concretar la modificación";
}

echo json_encode($result);

?>