<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['id'])){
    $objC = new AbmUsuario();

 
    $respuesta = $objC->baja($data);
    
    if (!$respuesta){
        $sms_error = "La baja no pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>