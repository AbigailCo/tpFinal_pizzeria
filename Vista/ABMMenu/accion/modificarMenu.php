<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['id'])){
    $objC = new AbmMenu();

    $data["deshabilitado"] = "'0000-00-00 00:00:00'";
 
    $respuesta = $objC->modificacion($data);
    
    if (!$respuesta){
        $sms_error = " La accion MODIFICACION no pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>