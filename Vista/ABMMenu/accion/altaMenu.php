<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['nombre']) && isset($data['descripcion'])){
    $data["deshabilitado"] = "0000-00-00 00:00:00";

    $objC = new AbmMenu();
    $respuesta = $objC->alta($data);
    if (!$respuesta){
        $mensaje = " La accion ALTA No pudo concretarse";
        
    }
}
$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$mensaje;
   
}
 echo json_encode($retorno);
?>