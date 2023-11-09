<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

$objC = new AbmUsuario();
if($data["pass"] == "null"){
    unset($data["pass"]);
}
$sinModificaciones = $objC->buscar($data);

// Modificación usuario
if (isset($data['id']) && !isset($sinModificaciones)){
    if(!$objC->revisar($data)){
        $objC = new AbmUsuario();

        $data["deshabilitado"] = "'0000-00-00 00:00:00'";
        $data["pass"] = "";

        $respuesta = $objC->modificacion($data);
        
        if (!$respuesta){
            $sms_error = "La modificación no pudo concretarse";
        }
    }else{
        $sms_error = "El usuario o el mail ya se encuentran registrados por otro usuario.";
    }
}else{
    if(!isset($sinModificaciones)){
        $sms_error = "Hubo un error en el envío. Vuelva a intentarlo.";
    }
}

// Modificación rol

if(isset($data["roles"]) && !isset($sms_error)){
    $colecIdRoles = $objC->buscarRoles($data);

    foreach($colecIdRoles as $usuarioRol){
        $arreglo[] = $usuarioRol->getObjRol()->getId();
    }


    $add = array_diff($data["roles"], $arreglo);
    $remove = array_diff($arreglo, $data["roles"]);

    foreach($remove as $idRolRemove){
        $data["idrol"] = $idRolRemove;
        $respuesta = $objC->quitarRol($data);
        $sms_error = ($respuesta) ?  null : "No se pudieron otorgar los roles.";
    }

    foreach($add as $idRolAdd){
        $data["idrol"] = $idRolAdd;
        $respuesta = $objC->darRol($data);
        $sms_error = ($respuesta) ? null : "No se pudieron otorgar los roles.";
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