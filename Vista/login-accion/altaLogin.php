<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;

// Usuario
if (isset($data['nombre'])){
    $objC = new AbmUsuario();
    if(!$objC->revisar($data)){
        
        $data["deshabilitado"] = "0000-00-00 00:00:00";
    
        $respuesta = $objC->alta($data);
        $objC->darRol(["id" => $respuesta["obj"]->getId(), "idrol" => 3]);
        
        if (!$respuesta["resultado"]){
            $sms_error = "La alta no pudo concretarse";
        }
    }else{
        $sms_error = "El usuario o el mail ya se encuentran registrados.";
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