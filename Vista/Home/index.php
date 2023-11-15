<?php
$titulo = "PIZZERIA";
include_once "../Estructura/headerInseguro.php";

$objC = new AbmProducto();
$colecProductos = $objC->buscar(null);
//selecciono aleatoriamente 6 productos de la colección y los almaceno en $destacados
$destacados = array_rand($colecProductos, 6);
//$colecRecientes contiene los últimos 3 productos de la colección.
$colecRecientes = array();
$colecRecientes[] = $colecProductos[count($colecProductos) - 1];
$colecRecientes[] = $colecProductos[count($colecProductos) - 2];
$colecRecientes[] = $colecProductos[count($colecProductos) - 3];

?>
<!-- Contenido -->
<!--este carousel es de bootstrap-->
<main class="col-12 mx-auto">
    <div id="carouselExampleIndicators" class="carousel slide mx-auto shadow" data-bs-ride="carousel" style="max-width:1400px;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner  rounded-bottom">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="../img/1.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="../img/2.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="../img/3.png" class="d-block w-100" alt="">
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
        <h2 class="mb-4">Las mas pedidas</h2>
        <div class="row col-12 mb-5 mx-auto">
            <?php
            foreach ($destacados as $productoKey) {
                //Construyo una ruta de archivo para la img del producto. Uso la función md5() para generar un hash único basado en el ID del producto.
                $imagen = "../../Control/img_productos/". md5($colecProductos[$productoKey]->getId()) . ".jpg";
                //Verifico si el archivo definido en la variable $imagen existe en el sistema de archivos. Si es false-> le asigo lo que esta en /img/product-placeholder.jpg
                $imagen = (file_exists($imagen)) ? $imagen : "../img/product-placeholder.jpg";
                //Tomo el detalle del producto y lo divido en partes usando el separador "///" con la función explode()
                $detalle = explode("///",$colecProductos[$productoKey]->getDetalle());
                $precio = $detalle[0];
            

                echo
                '<div class="col-12 col-md-4 mb-3"><a class="text-dark text-decoration-none" href="../Producto/index.php?id='. $colecProductos[$productoKey]->getId() .'">
                <div class="card" style="width: 18rem;height: 29rem">
                    <img src="'. $imagen .'" class="card-img-top" alt="' . $colecProductos[$productoKey]->getNombre() . '" style="width: 100%; height: 60%;">
                    <div class="card-body">
                        <p class="card-title">' . $colecProductos[$productoKey]->getNombre() . '</p>
                        <h4>$'.$precio.'</h4>
                    </div>
                </div></a>
                </div>';
            }
            ?>
        </div>
        <h3 class="mb-4">Mas productos</h3>
        <div class="row col-12 mb-5 mx-auto">
            <?php
            foreach ($colecRecientes as $producto) {
                $imagen = "../../Control/img_productos/". md5($producto->getId()) . ".jpg";
                $imagen = (file_exists($imagen)) ? $imagen : "../img/product-placeholder.jpg";
            
                $detalle = explode("///",$producto->getDetalle());
                $precio = $detalle[0];

                echo
                '<div class="col-12 col-md-4 mb-3"><a class="text-dark text-decoration-none" href="../Producto/index.php?id='. $producto->getId() .'">
                <div class="card" style="width: 18rem;height:30rem">
                    <img src="'.$imagen.'" class="card-img-top" alt="' . $producto->getNombre() . '" style="width: 100%; height: 60%;">
                    <div class="card-body">
                        <p class="card-title">' . $producto->getNombre() . '</p>
                        <h4>$'.$precio.'</h4>
                    </div>
                </div></a>
                </div>';
            }
            ?>
        </div>
        <h3 class="text-center mb-4">Visitanos</h3>
        <div style="width: 100%">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3101.641968118809!2d-68.05646602469152!3d-38.97784257170697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x960a33959fafd205%3A0x8278a0736b2c49f1!2sLos%20Carritos!5e0!3m2!1ses-419!2sar!4v1699392938796!5m2!1ses-419!2sar"  width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
         
        </div>

    </div>
    </div>
</main>



<?php
include_once "../Estructura/footer.php";
?>