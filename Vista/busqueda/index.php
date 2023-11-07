<?php
$titulo = "SLASH";
include_once "../Estructura/headerInseguro.php";

$param = data_submitted();
$objC = new AbmProducto();
if(isset($param["q"])){
    $arreglo = $objC->buscar(["nombre" => $param["q"]]);
}

$combo = "";
if(isset($arreglo)){
    foreach($arreglo as $producto){
        $imagen = "../../Control/Subidas/". md5($producto->getId()) . ".jpg";
        $imagen = (file_exists($imagen)) ? $imagen : "../img/product-placeholder.jpg";

        $detalle = explode("///",$producto->getDetalle());
        $precio = $detalle[0];

        $combo .= '
        <a href="../Producto/index.php?id='.$producto->getId().'" class="text-decoration-none text-dark producto-busqueda">
            <div class="col-12 border-bottom row d-flex align-items-center" style="height:200px">
                <div class="col-6" style="max-width:200px;max-height:200px">
                    <img class="img-fluid" src="'.$imagen.'" alt="'.$producto->getNombre().'">
                </div>
                <div class="col-6 d-flex flex-column justify-content-center">
                    <h5 class="fw-bold">'.$producto->getNombre().'</h5>
                    <h3 class="fw-light">$<span id="precio">'.$precio.'</span></h3>
                </div>
            </div>
        </a>';
    }
}

?>

<!-- Contenido -->
<main class="col-12 my-3 mx-auto w-100 max">
    <h2 class="border-bottom pb-3 mb-0">
        <?php
            if(isset($param["q"]) && isset($arreglo) && count($arreglo) == 1){
                echo count($arreglo) . ' resultado para «' . $param["q"] . '»';
            }else if(isset($param["q"]) && isset($arreglo) && count($arreglo) > 1){
                echo count($arreglo) . ' resultados para «' . $param["q"] . '»';
            }else{
                echo "No se encontraron resultados para su búsqueda";
            }
        ?>
    </h2>

    <div class="col-12">
        <?php echo $combo ?>
    </div>
</main>

<?php
include_once "../Estructura/footer.php";
?>