<?php 
include_once "../../../configuracion.php";


$objControl = new AbmCompra();
$session = new Session();
$objProducto = new AbmProducto;

$result["errorMsg"] = "";
$respuesta = false;

// Recibo idusuario, idproducto y cantidad
$param = data_submitted();
$param["idusuario"] = $session->getUsuario()->getId();
$producto = $objProducto->buscar(["id" => $param["idproducto"]]);

// Busqueda de carrito
$carrito = $objControl->retornarCarrito($param);

// Si no hay carrito, lo creo.
if(!isset($carrito)){
    $resultado = $objControl->alta($param);
    if(isset($resultado)){
        $param["id"] = $resultado["obj"]->getId();
        // Crear estado
        $respuesta = $objControl->estadoInicial($param);
        $respuesta = true;
    }
}else{
    $param["id"] = $carrito->getId();
    $respuesta = true;
}

$banderaItem = false;

// Retorna un unico resultado o null
$item = $objControl->buscarItems($param);

if(isset($item) && $respuesta){
    // Encontre producto igual
    $param["idcompraitem"] = $item[0]->getId();
    $param["cantidad"] = $item[0]->getCantidad() + $param["cantidad"];
    
    if($item[0]->getObjProducto()->getCantStock() >= $param["cantidad"]){
        $respuesta = $objControl->modificarItem($param);
        $banderaItem = true;
    }
}elseif($respuesta){
    // No encontre producto igual
    if($producto[0]->getCantStock() >= $param["cantidad"]){
        $respuesta = $objControl->agregarItem($param);
        $banderaItem = true;
    }
}

if(!$banderaItem){
    $result["errorMsg"] .= "No contamos con stock para esa cantidad (Máximo: " . $producto[0]->getCantStock() . "). ";
    $respuesta = false;
}
if(!$respuesta){
    $result["errorMsg"] .= "No se pudo concretar la acción.";
}

$result["respuesta"] = $respuesta;

echo json_encode($result);
