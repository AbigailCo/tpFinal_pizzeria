<?php
class UsuarioRol extends BaseDatos{
    private $objRol;
    private $objUsuario;
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
        $this->objUsuario = new Usuario();
        $this->mensajeOperacion = null;
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Carga datos al objeto
     * @param object $objRol
     * @param object $objUsuario
     */
    public function cargar($objRol, $objUsuario){
        $this->setObjRol($objRol);
        $this->setObjUsuario($objUsuario);
    }
    /**
     * Carga claves al objeto
     * @param int $idRol
     * @param int $idUsuario
     */
    public function cargarClaves($idRol, $idUsuario){
        $objRol = $this->getObjRol();
        $objUsuario = $this->getObjUsuario();

        $objRol->setId($idRol);
        $objUsuario->setId($idUsuario);

        $this->setObjRol($objRol);
        $this->setObjUsuario($objUsuario);
    }
    public function getObjRol(){
        return $this->objRol;
    }
    public function setObjRol($objRol){
        $this->objRol = $objRol;
    }
    public function getObjUsuario(){
        return $this->objUsuario;
    }
    public function setObjUsuario($objUsuario){
        $this->objUsuario = $objUsuario;
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
     * Busca si un usuario tiene un rol
     * @param int $idRol
     * @param int $idUsuario
     * @return boolean true si encontro, false caso contrario
     */
    public function buscar($idRol, $idUsuario){
        $encontro = false;

        $consulta = "SELECT * FROM usuariorol WHERE idusuario = '" . $idUsuario . "' AND
        idrol = '" . $idRol . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    // Rol
                    $objRol = new Rol();
                    $objRol->buscar($fila["idrol"]);

                    // Usuario
                    $objUsuario = new Usuario();
                    $objUsuario->buscar($fila["idusuario"]);
                    
                    $this->cargar(
                        $objRol,
                        $objUsuario
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("usuariorol->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuariorol->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista los usuarios y sus roles de la base de datos
     * @param string $condicion (opcional)
     * @return array|null
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM usuariorol";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objUsuarioRol = new UsuarioRol();
                    $objUsuarioRol->buscar($fila["idrol"], $fila["idusuario"]);

                    array_push($arreglo, $objUsuarioRol);
                }
            }else{$this->setMensajeOperacion("usuariorol->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuariorol->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta los datos del objeto UsuarioRol actual a la base de datos.
     * @return boolean true si se concretó, false caso contrario
     */
    public function insertar(){
        $seConcreto = false;

        $consulta = "INSERT INTO usuariorol(idrol, idusuario)
        VALUES ('". $this->getObjRol()->getId() . "','". $this->getObjUsuario()->getId() ."');";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;

            }else{$this->setMensajeOperacion("usuariorol->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuariorol->insertar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Elimina el objeto actual de la base de datos
     * @return boolean true si se concretó, false caso contrario
     */
    public function eliminar(){
        $seConcreto = false;

        $consulta = "DELETE FROM usuariorol WHERE idusuario = '" . $this->getObjUsuario()->getId() ."'
        AND idrol = '" . $this->getObjRol()->getId() . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("usuariorol->eliminar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuariorol->eliminar: ".$this->getError());}

        return $seConcreto;
    }


}


?>