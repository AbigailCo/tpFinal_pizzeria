<?php 
include_once "../../../configuracion.php";


$objControl = new AbmCompra();

$session = new Session();

$param["idusuario"] = $session->getUsuario()->getId();
$list = $objControl->buscar($param);

$arreglo_salida =  array();

if(isset($list) && count($list) > 0){
    foreach ($list as $elem){
        $nuevoElem["id"] = $elem->getId();

        $nuevoElem["productos"] = "";
        $items = $objControl->buscarItems(["id" => $elem->getId()]);

        if(isset($items) && count($items) > 0){
            $nuevoElem["productos"] .= "<ul>";
            foreach($items as $item){
                $nuevoElem["productos"] .=
                '<li>
                '.  mb_strimwidth($item->getObjProducto()->getNombre(), 0, 20, "...").'x '. $item->getCantidad() .'
                </li>';
            }
            $nuevoElem["productos"] .= "</ul>";
        }

        $nuevoElem["fecha"] = $elem->getCoFecha();

        $nuevoElem["estado"] = "";
        $estado = $objControl->buscarEstado(["id" => $elem->getId(), "fechafin" => "0000/00/00 00:00"]);
        
        if($estado[0]->getObjCompraEstadoTipo()->getIdcet() == 2){
            $nuevoElem["accion"] =
            '<button class="btn btn-danger borrado" id="delete-' . $elem->getId() . '" onclick="destroyMenu();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </button>';
        }else{
            $nuevoElem["accion"] =
            '<button class="btn btn-danger borrado disabled">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </button>';
        }

        $nuevoElem["estado"] .= '<span class="badge rounded-pill text-bg-primary mx-1" id="'. $elem->getId() .'-'. $estado[0]->getObjCompraEstadoTipo()->getIdcet() .'">
                    '. $estado[0]->getObjCompraEstadoTipo()->getCetdescripcion() . "</span>";
        
        array_push($arreglo_salida,$nuevoElem);
    }
}

echo json_encode($arreglo_salida);
