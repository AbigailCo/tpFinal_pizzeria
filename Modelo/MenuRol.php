<?php
class MenuRol extends BaseDatos{
    private $objRol;
    private $objMenu;
    private $mensajeOperacion;

    /////////////////////////////
    // CONSTRUCTOR //
    /////////////////////////////

    /**
     * Clase constructora
     */
    public function __construct()
    {
        parent::__construct();
        $this->objRol = new Rol();
        $this->objMenu = new Menu();
        $this->mensajeOperacion = null;
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Carga datos al objeto
     * @param object $objRol
     * @param object $objMenu
     */
    public function cargar($objRol, $objMenu){
        $this->setObjRol($objRol);
        $this->setObjMenu($objMenu);
    }
    /**
     * Carga claves al objeto
     * @param int $idRol
     * @param int $idMenu
     */
    public function cargarClaves($idRol, $idMenu){
        $objRol = $this->getObjRol();
        $objMenu = $this->getObjMenu();

        $objRol->setId($idRol);
        $objMenu->setId($idMenu);

        $this->setObjRol($objRol);
        $this->setObjMenu($objMenu);
    }
    public function getObjRol(){
        return $this->objRol;
    }
    public function setObjRol($objRol){
        $this->objRol = $objRol;
    }
    public function getObjMenu(){
        return $this->objMenu;
    }
    public function setObjMenu($objMenu){
        $this->objMenu = $objMenu;
    }
    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }
    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

    /////////////////////////////
    // INTERACCIÓN CON LA DB //
    /////////////////////////////

    /**
     * Busca si un rol tiene permisos para acceder a ese menu
     * @param int $idRol
     * @param int $idMenu
     * @return boolean true si encontro, false caso contrario
     */
    public function buscar($idRol, $idMenu){
        $encontro = false;

        $consulta = "SELECT * FROM menurol WHERE idmenu = '" . $idMenu . "' AND
        idrol = '" . $idRol . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    // Rol
                    $objRol = new Rol();
                    $objRol->buscar($fila["idrol"]);

                    // Menu
                    $objMenu = new Menu();
                    $objMenu->buscar($fila["idmenu"]);
                    
                    $this->cargar(
                        $objRol,
                        $objMenu
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("menurol->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("menurol->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista los usuarios y sus roles de la base de datos
     * @param string $condicion (opcional)
     * @return array|null
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM menurol";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objMenuRol = new MenuRol();
                    $objMenuRol->buscar($fila["idrol"], $fila["idmenu"]);

                    array_push($arreglo, $objMenuRol);
                }
            }else{$this->setMensajeOperacion("menurol->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("menurol->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta los datos del objeto menurol actual a la base de datos.
     * @return boolean true si se concretó, false caso contrario
     */
    public function insertar(){
        $seConcreto = false;

        $consulta = "INSERT INTO menurol(idrol, idmenu)
        VALUES ('". $this->getObjRol()->getId() . "','". $this->getObjMenu()->getId() ."');";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;

            }else{$this->setMensajeOperacion("menurol->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("menurol->insertar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Elimina el objeto actual de la base de datos
     * @return boolean true si se concretó, false caso contrario
     */
    public function eliminar(){
        $seConcreto = false;

        $consulta = "DELETE FROM menurol WHERE idmenu = '" . $this->getObjMenu()->getId() ."'
        AND idrol = '" . $this->getObjRol()->getId() . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("menurol->eliminar: ".$this->getError());}
        }else{$this->setMensajeOperacion("menurol->eliminar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Verifica si tiene un permiso
     * @param int $idUsuario
     * @param array $pagEnlace
     * @return boolean
     */
    public function verificarPermiso($idUsuario, $pagEnlace){
        $encontro = false;

        $consulta = "SELECT idusuario, menurol.idrol, menu.idmenu, medescripcion FROM menurol
        INNER JOIN usuariorol ON menurol.idrol = usuariorol.idrol
        INNER JOIN menu ON menu.idmenu = menurol.idmenu
        WHERE idusuario = ". $idUsuario ." AND medescripcion = '". $pagEnlace ."';";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($this->Registro()){
                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("menurol->verificarPermiso: ".$this->getError());}
        }else{$this->setMensajeOperacion("menurol->verificarPermiso: ".$this->getError());}

        return $encontro;
    }


}


?>