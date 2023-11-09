<?php
include_once "../../../configuracion.php";

$data = data_submitted();

$objControl = new AbmCompra;

$result["respuesta"] = $objControl->cambiarEstado(["id" => $data["id"],"idcompraestadotipo" => 5]);

if(!$result["respuesta"]){
    $result["errorMsg"] = "No se pudo concretar la cancelación";
}

if($result["respuesta"]){
    $abmProducto = new AbmProducto;

    $list = $objControl->buscarItems($data);

    if(isset($list)){
        foreach($list as $item){
            $abmProducto->cambiarStock(["id" => $item->getObjProducto()->getId(),"cantidad" => $item->getCantidad(),"operacion" => "suma"]);
        }   
    }
}

echo json_encode($result);

?>