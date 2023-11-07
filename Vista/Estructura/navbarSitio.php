<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary navbar-expand-lg shadow">
    <div class="container-fluid max d-flex align-items-center justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-buildings-fill mb-1" viewBox="0 0 16 16">
                    <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z" />
                </svg>&nbsp;&nbsp;San Martín 434, Neuquén Capital&nbsp;&nbsp;
            </li>
            <li class="nav-item text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill mb-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                </svg>&nbsp;&nbsp;299-2343544&nbsp;&nbsp;
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-dark bg-dark sticky-top navbar-expand-lg">
    <div class="container-fluid max">
        <a class="navbar-brand fw-bold" href="../Home/index.php"><img src="../img/LOGO.png" alt="" class="img-fluid mb-1" style="max-width:100px;"></a>
        <div class="d-flex align-items-end justify-content-end flex-row collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item ms-3 d-flex align-items-center justify-content-center">
                    <form action="../busqueda/index.php" method="get" id="busqueda" novalidate>
                        <input type="text" class="form-control" id="q" name="q" placeholder="Buscar..." required>
                        <div id="error" hidden></div>
                    </form>
                </li>
                <li class="nav-item  ms-3 d-flex align-items-center justify-content-center">
                    <a data-bs-toggle="modal" href="<?php echo ($iniciada) ? "../carrito/index.php" : "#inicioSesion"  ?>" role="button" aria-controls="modal"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-cart3 text-light" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg></a>
                </li>
                <?php
                if ($iniciada) {
                    echo
                    '<li class="nav-item dropdown  ms-3 d-flex align-items-center justify-content-center">
                        <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-person-circle text-light" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Perfil/index.php">Ir a Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../Perfil/index.php">Editar Perfil</a></li>
                            <li><a class="dropdown-item text-danger" href="../Perfil/accion/cerrarSesion.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>';
                } else {
                    echo
                    '<li class="nav-item  ms-3 d-flex align-items-center justify-content-center">
                        <a data-bs-toggle="modal" href="#inicioSesion" role="button" aria-controls="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-person-circle text-light" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </a>
                    </li>';
                }

                ?>

            </ul>

        </div>
    </div>
</nav>

<!-- Modal de inicio de sesión -->
<div class="modal fade" id="inicioSesion" tabindex="-1" aria-labelledby="inicioSesion" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="fw-5 text-center m-3">Iniciar sesión</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" name="login" id="login" novalidate>
                    <div class="row">
                        <div class="col-12 col-md-9 mx-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                </span>
                                <input type="text" name="username" id="username" class="form-control rounded-end" placeholder="Username" />
                                <div class="invalid-feedback" id="feedback-username"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9 mx-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                    </svg>
                                </span>
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control rounded-end" />
                                <div class="invalid-feedback" id="feedback-password"></div>
                            </div>
                        </div>
                    </div>
                    ¿No tiene cuenta? <a data-bs-toggle="modal" href="#registro" role="button" aria-controls="modal">Regístrese</a>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mx-auto" id="login-submit">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="registro" tabindex="-1" aria-labelledby="registro" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="fw-5 text-center m-3">Registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div id="errores"></div>
                    <form method="POST" id="form-abm">
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
                            <input type="password" class="form-control passwords" name="pass" id="pass">
                            <div class="invalid-feedback" id="feedback-pass"></div>
                        </div>
                        <div class="col-12 mb-3" id="validate-password-field">
                            <label for="validarPass" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control passwords" name="validarPass" id="validarPass">
                            <div class="invalid-feedback" id="feedback-validarPass"></div>
                        </div>
                        ¿Ya tiene cuenta? <a data-bs-toggle="modal" href="#inicioSesion" role="button" aria-controls="modal">Inicie sesión</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mx-auto" id="btn-submit">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/busqueda.js"></script>