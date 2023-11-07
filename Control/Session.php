<?php
class Session{
    /**
     * Clase constructor
     * @return boolean
     */
    public function __construct()
    {
        $resp = false;
        if(session_start()){
            $resp = true;
        }
        return $resp;
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados
     * @param string $nombreUsuario
     * @param string $psw
     * @return array
     */
    public function iniciar($nombreUsuario, $psw){
        $resp = false;

        $where = ["nombre" => $nombreUsuario, "pass" => $psw, "deshabilitado" => "0000-00-00 00:00:00"];
        $abmUsuario = new AbmUsuario();
        $arreglo = $abmUsuario->buscar($where);

        if(!is_null($arreglo)){
            $_SESSION["idusuario"] = $arreglo[0]->getId();
            $resp = true;
        }

        return $resp;
    }

    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false
     * @return 
     */
    public function validar(){
        $resp = false;
        if($this->activa() && isset($_SESSION["idusuario"])){
            $resp = true;
        }

        return $resp;
    }

    /**
     * Devuelve true o false si la sesión está activa o no
     * @return boolean
     */
    public function activa(){
        $resp = false;
        if(session_status() == PHP_SESSION_ACTIVE){
            $resp = true;
        }

        return $resp;
    }

    /**
     * Devuelve el usuario logeado
     * @return Usuario
     */
    public function getUsuario(){
        $objResultado = null;

        $abmUsuario = new AbmUsuario();
        $where = ["id" => $_SESSION["idusuario"]];
        $arreglo = $abmUsuario->buscar($where);

        $objResultado = $arreglo[0];

        return $objResultado;
    }

    /**
     * Devuelve los roles del usuario logeado
     * @return array
     */
    public function getRol(){
        $_SESSION["roles"] = array();

        $where = ["id" => $_SESSION["idusuario"]];
        $abmUsuario = new AbmUsuario();
        $arregloObjRoles = $abmUsuario->buscarRoles($where);

        foreach($arregloObjRoles as $rol){
            array_push($_SESSION["roles"], $rol->getObjRol()->getRolDescripcion());
        }

        return $_SESSION["roles"];
    }

    /**
     * Revisa si el usuario tiene permisos para entrar a una página
     * @return boolean
     */
    public function tienePermiso(){
        $resp = false;

        $ruta = $_SERVER['PHP_SELF'];
        $ruta = explode("/" ,$ruta);
        $rutaStr = "../";
        $rutaStr .= $ruta[count($ruta)-2] . "/";
        $rutaStr .= $ruta[count($ruta)-1];

        $objMenuRol = new MenuRol();
        if($objMenuRol->verificarPermiso($_SESSION["idusuario"],$rutaStr)){
            $resp = true;
        }

        return $resp;
    }

    /**
     * Cierra la sesión actual
     */
    public function cerrar(){
        session_unset();
        session_destroy();
    }
}


?>