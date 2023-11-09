<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['idcompraitem'])){
    $objC = new AbmCompra();

    $arreglo = $objC->buscarItems($data);

    if($arreglo[0]->getObjProducto()->getCantStock() >= $data["cantidad"]){
        $respuesta = $objC->modificarItem($data);
    }else{
        $sms_error =  "No contamos con stock para esa cantidad (Máximo: " . $arreglo[0]->getObjProducto()->getCantStock() . ").";
    }

    if (!isset($sms_error) && !$respuesta){
        $sms_error = "La modificación no pudo concretarse";
    }
}else{
    $sms_error = "Hubo un error en el envío. Vuelva a intentarlo.";
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>