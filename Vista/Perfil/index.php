<?php
$titulo = "Perfil";
include_once "../Estructura/headerSeguro.php";

$objC = new AbmUsuario();
$data["id"] = $session->getUsuario()->getId();

$arreglo = $objC->buscar($data);


?>

<!-- Contenido -->
<main class="col-12 my-3 mx-auto w-100 max">
    <div class="col-12 rounded">
        <div class="row col-12 p-3 rounded mx-auto">
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center flex-column bg-light p-5">
                <img src="../img/placeholder-pfp.jpg" class="rounded-circle img-fluid d-flex align-items-center justify-content-center" alt="Foto de perfil">
                <h2><?php echo $arreglo[0]->getNombre();  ?></h2>
                <p class="text-secondary"><?php echo $arreglo[0]->getMail();  ?></p>
            </div>
            <div class="col-12 col-md-8 p-5">
                <div id="errores"></div>
                <form method="POST" id="form-abm">
                    <h3 class="mb-2">Editar Perfil</h3>
                    <input type="text" name="id" id="id" hidden value="<?php echo $arreglo[0]->getId();  ?>">
                    <div class="col-12 mb-2">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $arreglo[0]->getNombre();  ?>">
                        <div class="invalid-feedback" id="feedback-nombre"></div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="mail" class="form-label">Correo electrónico *</label>
                        <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $arreglo[0]->getMail();  ?>">
                        <div class="invalid-feedback" id="feedback-mail"></div>
                    </div>
                    <div class="col-12 mb-2" id="password-field">
                        <label for="passActual" class="form-label">Contraseña actual *</label>
                        <input type="password" class="form-control passwords" name="passActual" id="passActual">
                        <div class="invalid-feedback" id="feedback-passActual"></div>
                    </div>
                    <div class="col-12 mb-2" id="password-field">
                        <label for="pass" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control passwords" name="pass" id="pass">
                        <div class="invalid-feedback" id="feedback-pass"></div>
                    </div>
                    <div class="col-12 mb-3" id="validate-password-field">
                        <label for="validarPass" class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control passwords" name="validarPass" id="validarPass">
                        <div class="invalid-feedback" id="feedback-validarPass"></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Editar</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="../js/perfil.js"></script>
<?php
include_once "../Estructura/footer.php";
?>