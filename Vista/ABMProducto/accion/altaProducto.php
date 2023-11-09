<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['nombre'])){
    $objC = new AbmProducto();

    $detalle = $data["precio"] . "///" . $data["detalle"];
    $data["detalle"] = $detalle; 

    $respuesta = $objC->alta($data);
    
    if (!$respuesta["resultado"]){
        $sms_error = "El alta no pudo concretarse.";
    }
}else{
    $sms_error = "Hubo un error en el envío. Vuelva a intentarlo.";
}

if($respuesta["resultado"]){
    $objC->subirArchivo(["imagen" => $_FILES, "id" => $respuesta["obj"]->getId()]);
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>