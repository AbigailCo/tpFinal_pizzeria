<?php 
include_once "../../../configuracion.php";

// Que busque a todos los activos
$objControl = new AbmRol();
$list = $objControl->buscar(null);

$arreglo_salida =  array();

foreach ($list as $elem){
    $nuevoElem["permisos"] = "";
    $data["id"] = $elem->getId();
    
    $permisos = $objControl->buscarPermisos($data);

    if(isset($permisos)){
        foreach($permisos as $permiso){
            $nuevoElem["permisos"] .= '<span class="badge rounded-pill text-bg-primary mx-1" id="'. $elem->getId() .'-'. $permiso->getObjMenu()->getId() .'">
            '. $permiso->getObjMenu()->getNombre() . "</span>";
        }
    }

    $nuevoElem["id"] = $elem->getId();
    $nuevoElem["roldescripcion"] = $elem->getRolDescripcion();
    $nuevoElem["accion"] =
    '<button class="btn btn-warning" id="edit-' . $elem->getId() . '" onclick="editMenu();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg>
    </button>';
    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida);
