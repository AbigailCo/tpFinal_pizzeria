<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$resultado = false;

$objControl = new AbmCompra();
$resultado = $objControl->accionPago($data);

if (!$resultado) {
    $errorMsg = "No se pudo concretar el pago.";
}

$result["resultado"] = $resultado;
if (isset($errorMsg)) {
    $result["error"] = $errorMsg;
}

echo json_encode($result);



