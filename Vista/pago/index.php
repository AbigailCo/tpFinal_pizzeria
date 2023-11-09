<?php
$titulo = "Pago";
include_once "../Estructura/headerSeguro.php";

$objControl = new AbmCompra();

$param["idusuario"] = $session->getUsuario()->getId();
$compras = $objControl->retornarCarrito($param);

$total = 0;

if(isset($compras)){
    $param["id"] = $compras->getId();
    $list = $objControl->buscarItems($param);
}


echo '<main class="col-12 my-3 mx-auto w-100 max">';
$combo =  "";

if (isset($list) && count($list) > 0) {
  foreach ($list as $elem) {
    $detalle = explode("///",$elem->getObjProducto()->getDetalle());
    $precio = $detalle[0] * $elem->getCantidad();
    $total += $precio;

    $combo .= '<li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
        ' .  mb_strimwidth($elem->getObjProducto()->getNombre(), 0, 20, "...") . 'x ' . $elem->getCantidad() . '
        <span>$'.$precio.'</span>
      </li>';

    $precio .= '';
  }

  echo '<!-- Credit card form -->
    <main class="col-12 my-3 mx-auto w-100 max">
        <div id="errores"></div>
      <div class="row">
        <div class="col-md-8 mb-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Dirección de Envío</h5>
            </div>
            <div class="card-body">
              <form id="form-abm" method="POST" action="../pedidos/index.php">
                <input type="text" name="id" id="id" value="' . $list[0]->getObjCompra()->getId() . '" hidden>
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="nombre" name="nombre" class="form-control" required />
                      <label class="form-label" for="nombre">Nombre</label>
                      <div class="invalid-feedback" id="feedback-nombre"></div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="apellido" name="apellido" class="form-control" required />
                      <label class="form-label" for="apellido">Apellido</label>
                      <div class="invalid-feedback" id="feedback-apellido"></div>
                    </div>
                  </div>
                </div>
    
                <!-- Text input -->
                <div class="form-outline mb-4">
                  <input type="text" id="direccion" name="direccion" class="form-control" required />
                  <label class="form-label" for="direccion">Dirección</label>
                  <div class="invalid-feedback" id="feedback-direccion"></div>
                </div>
    
                <hr class="my-4" />
    
                <h5 class="mb-4">Pago</h5>
    
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="titular" name="titular" class="form-control" required />
                      <label class="form-label" for="titular">Titular de la tarjeta</label>
                      <div class="invalid-feedback" id="feedback-titular"></div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="numero" name="numero" class="form-control" maxlength="16"  required/>
                      <label class="form-label" for="numero" >Número de tarjeta</label>
                      <div class="invalid-feedback" id="feedback-numero"></div>
                    </div>
                  </div>
                </div>
    
                <div class="row mb-4">
                  <div class="col-3">
                    <div class="form-outline">
                      <input type="text" id="vencimiento" name="vencimiento" class="form-control" required maxlength="5" />
                      <label class="form-label" for="vencimiento">Fecha de vencimiento</label>
                      <div class="invalid-feedback" id="feedback-vencimiento"></div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-outline">
                      <input type="password" id="cvv" name="cvv" class="form-control" maxlength="4" />
                      <label class="form-label" for="cvv">CVV</label>
                      <div class="invalid-feedback" id="feedback-cvv"></div>
                    </div>
                  </div>
                </div>
    
                <button class="btn btn-primary btn-lg btn-block" type="submit" id="btn-submit">
                  Realizar Pago
                </button>
              </form>
            </div>
          </div>
        </div>
    
        <div class="col-md-4 mb-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Su compra</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                ' . $combo . '
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Envio
                  <span>Gratis</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Total</strong>
                    <strong>
                      <p class="mb-0">(con IVA)</p>
                    </strong>
                  </div>
                  <span><strong>$'.$total.'</strong></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Credit card form -->';
} else {
  echo mostrarError("No puede realizar un pago sin haber agregado productos a su carrito.<br>
  <a href='../home/index.php'>Ir al inicio</a>");
}

echo "</main>"
?>

<script src="../js/pago.js"></script>

<?php
include_once "../Estructura/footer.php";
?>