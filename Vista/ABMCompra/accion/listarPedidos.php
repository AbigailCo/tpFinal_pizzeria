<?php
include_once "../../../configuracion.php";


$objControl = new AbmCompra();

$list = $objControl->buscarEstado(["fechafin" => "0000/00/00 00:00"]);

$arreglo_salida =  array();

if (isset($list) && count($list) > 0) {
    foreach ($list as $elem) {
        if ($elem->getObjCompraEstadoTipo()->getIdcet() != 1) {
            $nuevoElem["id"] = $elem->getObjCompra()->getId();

            $nuevoElem["productos"] = "";
            $items = $objControl->buscarItems(["id" => $nuevoElem["id"]]);

            $nuevoElem["usuario"] = $elem->getObjCompra()->getObjUsuario()->getNombre();

            if (isset($items) && count($items) > 0) {
                $nuevoElem["productos"] .= "<ul>";
                foreach ($items as $item) {
                    $nuevoElem["productos"] .=
                        '<li>
                ' .  mb_strimwidth($item->getObjProducto()->getNombre(), 0, 20, "...") . 'x ' . $item->getCantidad() . '
                </li>';
                }
                $nuevoElem["productos"] .= "</ul>";
            }


            $nuevoElem["fecha"] = $elem->getObjCompra()->getCoFecha();

            $nuevoElem["estado"] = "";

            $nuevoElem["estadofecha"] = $elem->getFechaIni();


            $nuevoElem["estado"] .= '<span class="badge rounded-pill text-bg-primary mx-1" id="' . $nuevoElem["id"] . '-' . $elem->getObjCompraEstadoTipo()->getIdcet() . '">
            ' . $elem->getObjCompraEstadoTipo()->getCetdescripcion() . "</span>";
        
            $nuevoElem["estadoid"] = $elem->getObjCompraEstadoTipo()->getIdcet();     

            $nuevoElem["accion"] = "";
            if($nuevoElem["estadoid"] != 5){
                $nuevoElem["accion"] =
                    '<button class="btn btn-warning" id="edit-' . $nuevoElem["id"] . '" onclick="editMenu();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
                </button>
                <button class="btn btn-danger borrado" id="delete-' . $nuevoElem["id"] . '" onclick="destroyMenu();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </button>';
            }

            if($nuevoElem["estadoid"] == 4){
                $nuevoElem["accion"] =
                    '
                <button class="btn btn-danger borrado" id="delete-' . $nuevoElem["id"] . '" onclick="destroyMenu();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </button>';
            }

            array_push($arreglo_salida, $nuevoElem);
        }
    }
}

echo json_encode($arreglo_salida);
