<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

// Rol
if (isset($data['roldescripcion'])){
    $objC = new AbmRol();

    $respuesta = $objC->alta($data);
    
    if (!$respuesta["resultado"]){
        $sms_error = "La alta no pudo concretarse";
    }
}else{
    $sms_error = "Hubo un error en el envío. Vuelva a intentarlo.";
}


// Menu
if(isset($data["permisos"]) && !isset($sms_error)){

    foreach($data["permisos"] as $idpermiso){

        $arreglo["idmenu"] = $idpermiso;
        $arreglo["id"] = $respuesta["obj"]->getId();

        if(!$objC->darPermiso($arreglo)){
            $sms_error = "No se pudieron asignar los roles.";
        }
    }
}else{
    if(!isset($sms_error)){
        $sms_error = "No puede dejar a un usuario sin ningún rol";
    }
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>