<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

$objC = new AbmRol();
$sinModificaciones = $objC->buscar($data);

// Modificación rol
if (isset($data['id']) && !isset($sinModificaciones)){
    $respuesta = $objC->modificacion($data);
    
    if (!$respuesta){
        $sms_error = "La modificación no pudo concretarse";
    }
}else{
    if(!isset($sinModificaciones)){
        $sms_error = "Hubo un error en el envío. Vuelva a intentarlo.";
    }
}

// Modificación permisos

if(isset($data["permisos"]) && !isset($sms_error)){
    $colecIdPermisos = $objC->buscarPermisos($data);

    foreach($colecIdPermisos as $menuRol){
        $arreglo[] = $menuRol->getObjMenu()->getId();
    }

    $add = array_diff($data["permisos"], $arreglo);
    $remove = array_diff($arreglo, $data["permisos"]);

    foreach($remove as $idPermisoRemove){
        $data["idmenu"] = $idPermisoRemove;
        $respuesta = $objC->quitarPermiso($data);
        $sms_error = ($respuesta) ?  null : "No se pudieron otorgar los permisos.";
    }

    foreach($add as $idPermisoAdd){
        $data["idmenu"] = $idPermisoAdd;
        $respuesta = $objC->darPermiso($data);
        $sms_error = ($respuesta) ? null : "No se pudieron otorgar los permisos.";
    }
}else{
    if(!isset($sms_error)){
        $sms_error = "No puede dejar a un rol sin ningún permiso";
    }
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>