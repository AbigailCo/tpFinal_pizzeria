<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

// Modificación usuario
if (isset($data['id'])){
    $objC = new AbmUsuario();

    // Reviso si el usuario o el mail están tomados
    if(!$objC->revisar($data)){

        $data["deshabilitado"] = "'0000-00-00 00:00:00'";

        if(isset($data["passActual"])){
            $busqueda["id"] = $data["id"];
            $busqueda["pass"] = $data["passActual"];
    
            // Revisar si la pass actual está bien
            $resultado = $objC->buscar($busqueda);
        }

        if(isset($resultado) && count($resultado) > 0){
            // Registrar los datos y la pass
            $respuesta = $objC->modificacion($data);

            if (!$respuesta){
                $sms_error = "La modificación no pudo concretarse";
            }
        }else{
            $sms_error = "La contraseña actual es incorrecta";
        }       
    }else{
        $sms_error = "El usuario o el mail ya se encuentran registrados";
    }
}else{
    $sms_error = "Hubo un error en el envío. Vuelva a intentarlo";
}

$retorno['respuesta'] = $respuesta;

if (isset($sms_error)){
    $retorno['errorMsg']=$sms_error;
}

echo json_encode($retorno);
?>