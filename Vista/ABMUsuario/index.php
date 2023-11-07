<?php
$titulo = "ABM Usuario";
include_once "../Estructura/headerSeguro.php";
$objControlRoles = new AbmRol();
$colecRoles = $objControlRoles->buscar(null);

?>

<!-- Contenido -->
<main class="col-12 my-3 mx-auto w-100 max">
    <!-- TABLA -->
    <h2>ABM - Usuario</h2>
    <button class="btn btn-primary my-2" onclick="newMenu();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
        </svg>
        Nuevo
    </button>
    <button class="btn btn-secondary my-2" onclick="recargar();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
        </svg>
    </button>
    <table class="table table-striped table-bordered nowrap" id="tabla">
        <thead class="bg-dark text-light">
            <th field="id">Id</th>
            <th field="nombre">Nombre</th>
            <th field="mail">Mail</th>
            <th field="roles">Roles</th>
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
                            <div class="col-12 mb-2">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                <div class="invalid-feedback" id="feedback-nombre"></div>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="mail" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" name="mail" id="mail">
                                <div class="invalid-feedback" id="feedback-mail"></div>
                            </div>
                            <div class="col-12 mb-2" id="password-field">
                                <label for="pass" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="pass" id="pass">
                                <div class="invalid-feedback" id="feedback-pass"></div>
                            </div>
                            <div class="col-12 mb-2">
                                Roles
                                <?php
                                if (count($colecRoles) > 0) {
                                    foreach ($colecRoles as $rol) {
                                        echo '<div class="col-12">';
                                        echo '<input type="checkbox" class="form-check-input roles" name="roles[]" value="' . $rol->getId() . '">
                                                <label for="roles" class="form-check-label">' .
                                            $rol->getRolDescripcion() . '</label>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                                <div class="invalid-feedback" id="feedback-roles"></div>
                            </div>
                        </div>
                        <div id="delete-form">
                            <p class="text-danger">¿Esta seguro de que quiere eliminar a <span id="rol-name"></span>?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-submit" class="btn btn-primary">Enviar</button>
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="$('#dlg').modal('hide');">
                    </div>
                </form>
            </div>
        </div>
</main>
<script src="../js/usuario.js"></script>

<?php
include_once "../Estructura/footer.php";
?>