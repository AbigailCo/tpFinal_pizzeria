<?php
// Configuración
include_once "../../configuracion.php";
$session = new Session();
$iniciada = false;
$seguro = false;
if($session->validar()){
    $iniciada = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../lib/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="../lib/bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/login.js" defer></script>
    <script type="text/javascript" src="../js/registro.js" defer></script>
    <script src="../js/carrito.js" defer></script>

    <script src="../lib/md5.min.js"></script>
    <script src="../lib/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="../lib/jquery.validate.min.js"></script>


    <link rel="stylesheet" href="../lib/DataTables-1.13.1/css/dataTables.bootstrap5.min.css">
    
    <script src="../lib/DataTables-1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="../lib/DataTables-1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <title><?php echo $titulo ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php
// Navbar
include_once "navbarSitio.php";
?>