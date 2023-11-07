<?php
$titulo = "ABM Compras";
include_once "../Estructura/headerSeguro.php";

?>

<!-- Contenido -->
<main class="col-12 my-3 mx-auto w-100 max">
    <!-- TABLA -->
    <h2>ABM Compras</h2>
    <button class="btn btn-secondary my-2" onclick="recargar();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
        </svg>
    </button>
    <table class="table table-striped table-bordered nowrap" id="tabla">
        <thead class="bg-dark text-light">
            <th field="id">Id</th>
            <th field="usuario">Usuario</th>
            <th field="productos">Productos</th>
            <th field="fecha">Fecha de Compra</th>
            <th field="estado">Estado</th>
            <th field="fechaestado">Estado desde</th>
            <th field="accion">Acciones</th>
        </thead>
        <tbody>

        </tbody>
    </table>

    <!-- MODAL -->
    <div class="modal fade" id="dlg" tabindex="-1" aria-labelledby="dlg" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="fw-5 text-center m-3" id="title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" id="form-abm" method="post">
                    <div class="modal-body">
                        <div id="errores" class="col-12"></div>
                        <div id="edit-form">
                            <input type="text" name="id" id="id" hidden>
                            <input type="text" name="idcompraestadotipo" id="idcompraestadotipo" hidden>
                            <div class="col-12 mb-2">
                                <h3><span id="estadoactual"></span></h3>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-secondary" id="iniciada" role="progressbar" aria-label="Example with label" id="progreso" style="width: 33%;display:none;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-primary" id="aceptada" role="progressbar" aria-label="Example with label" id="progreso" style="width: 33%;display:none;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" ></div>
                                    <div class="progress-bar bg-success" id="enviada" role="progressbar" aria-label="Example with label" id="progreso" style="width: 34%;display:none;" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" ></div>
                                </div>
                            </div>
                        </div>
                        <div id="delete-form">
                            <p class="text-danger">¿Esta seguro de que quiere cancelar esta compra? <em>Esta acción es irreversible</em></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-submit" class="btn btn-primary">Avanzar</button>
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="$('#dlg').modal('hide');">
                    </div>
                </form>
            </div>
        </div>
</main>
<script src="../js/compra.js"></script>

<?php
include_once "../Estructura/footer.php";
?>