<?php
$titulo = "SLASH";
include_once "../Estructura/headerInseguro.php";

$objC = new AbmProducto();
$colecProductos = $objC->buscar(null);

$destacados = array_rand($colecProductos, 6);

$colecRecientes = array();
$colecRecientes[] = $colecProductos[count($colecProductos) - 1];
$colecRecientes[] = $colecProductos[count($colecProductos) - 2];
$colecRecientes[] = $colecProductos[count($colecProductos) - 3];

?>
<!-- Contenido -->
<main class="col-12 mx-auto">
    <div id="carouselExampleIndicators" class="carousel slide mx-auto shadow" data-bs-ride="carousel" style="max-width:1400px;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner  rounded-bottom">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="../img/banner-1.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="../img/banner-2.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="../img/banner-3.png" class="d-block w-100" alt="">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="max col-12 mx-auto my-4">
        <h2 class="mb-4">Destacados</h2>
        <div class="row col-12 mb-5 mx-auto">
            <?php
            foreach ($destacados as $productoKey) {
                $imagen = "../../Control/Subidas/". md5($colecProductos[$productoKey]->getId()) . ".jpg";
                $imagen = (file_exists($imagen)) ? $imagen : "../img/product-placeholder.jpg";

                $detalle = explode("///",$colecProductos[$productoKey]->getDetalle());
                $precio = $detalle[0];
            

                echo
                '<div class="col-12 col-md-4 mb-3"><a class="text-dark text-decoration-none" href="../Producto/index.php?id='. $colecProductos[$productoKey]->getId() .'">
                <div class="card" style="width: 18rem;height:450px">
                    <img src="'. $imagen .'" class="card-img-top" alt="' . $colecProductos[$productoKey]->getNombre() . '">
                    <div class="card-body">
                        <p class="card-title">' . $colecProductos[$productoKey]->getNombre() . '</p>
                        <h4>$'.$precio.'</h4>
                    </div>
                </div></a>
                </div>';
            }
            ?>
        </div>
        <h3 class="mb-4">Recientemente añadidos</h3>
        <div class="row col-12 mb-5 mx-auto">
            <?php
            foreach ($colecRecientes as $producto) {
                $imagen = "../../Control/Subidas/". md5($producto->getId()) . ".jpg";
                $imagen = (file_exists($imagen)) ? $imagen : "../img/product-placeholder.jpg";
            
                $detalle = explode("///",$producto->getDetalle());
                $precio = $detalle[0];

                echo
                '<div class="col-12 col-md-4 mb-3"><a class="text-dark text-decoration-none" href="../Producto/index.php?id='. $producto->getId() .'">
                <div class="card" style="width: 18rem;height:450px">
                    <img src="'.$imagen.'" class="card-img-top" alt="' . $producto->getNombre() . '">
                    <div class="card-body">
                        <p class="card-title">' . $producto->getNombre() . '</p>
                        <h4>$'.$precio.'</h4>
                    </div>
                </div></a>
                </div>';
            }
            ?>
        </div>
        <h3 class="text-center mb-4">Encontranos en:</h3>
        <div style="width: 100%">
            <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=%20San%20Mart%C3%ADn%20434,%20Neuqu%C3%A9n%20Capital%20+(Mi%20nombre%20de%20egocios)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/car-satnav-gps/">Car Navigation Systems</a></iframe>
        </div>

    </div>
    </div>
</main>



<?php
include_once "../Estructura/footer.php";
?>