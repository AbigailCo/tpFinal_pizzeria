<?php
class Usuario extends BaseDatos{
    private $id;
    private $nombre;
    private $pass;
    private $mail;
    private $deshabilitado;
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
        $this->id = null;
        $this->nombre = null;
        $this->pass = null;
        $this->mail = null;
        $this->deshabilitado = null;
        $this->mensajeOperacion = null;
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Carga datos al objeto
     * @param int $id
     * @param string $nombre
     * @param string $pass
     * @param string $mail
     * @param string|null $deshabilitado
     */
    public function cargar($id, $nombre, $pass, $mail, $deshabilitado){
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setPass($pass);
        $this->setMail($mail);
        $this->setDeshabilitado($deshabilitado);
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getPass(){
        return $this->pass;
    }
    public function setPass($pass){
        $this->pass = $pass;
    }
    public function getMail(){
        return $this->mail;
    }
    public function setMail($mail){
        $this->mail = $mail;
    }
    public function getDeshabilitado(){
        return $this->deshabilitado;
    }
    public function setDeshabilitado($deshabilitado){
        $this->deshabilitado = $deshabilitado;
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
     * Busca un usuario por id
     * Sus datos son colocados en el objeto
     * @param string $id
     * @return boolean true si encontro, false caso contrario
     */
    public function buscar($id){
        $encontro = false;
        $consulta = "SELECT * FROM usuario WHERE idusuario = '" . $id . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    $this->cargar(
                        $id,
                        $fila["usnombre"],
                        $fila["uspass"],
                        $fila["usmail"],
                        $fila["usdeshabilitado"]
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("usuario->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuario->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista usuarios de la base de datos
     * @param string $condicion (opcional)
     * @return array|null colección de usuarios o null si no hay ninguno
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM usuario";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objUsuario = new Usuario();
                    $objUsuario->cargar(
                        $fila["idusuario"],
                        $fila["usnombre"],
                        $fila["uspass"],
                        $fila["usmail"],
                        $fila["usdeshabilitado"]
                    );
                    array_push($arreglo, $objUsuario);
                }
            }else{$this->setMensajeOperacion("usuario->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuario->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta los datos del objeto Usuario actual a la base de datos.
     * @return boolean true si se concretó, false caso contrario
     */
    public function insertar(){
        $resp = null;
        $resultado = false;

        $consulta = "INSERT INTO usuario(usnombre, uspass, usmail, usdeshabilitado)
        VALUES ('". $this->getNombre()."','".$this->getPass()."','".$this->getMail()."',
        '". $this->getDeshabilitado() . "');";

        if($this->Iniciar()){
            $resp = $this->Ejecutar($consulta);
            if ($resp) {
                $this->setId($resp);
                $resultado = true;
            }else{$this->setmensajeoperacion("usuario->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuario->insertar: ".$this->getError());}

        return $resultado;
    }

    /**
     * Modifica los datos de la usuario, colocando los del objeto actual
     * @return boolean true si se concretó, false caso contrario
     */
    public function modificar(){
        $seConcreto = false;
        $pass = "";

        
        if($this->getPass() != NULL && $this->getPass() != "" && $this->getPass() != "null"){
            $pass  = "uspass = '" . $this->getPass() . "',";
        }
        

        $consulta = "UPDATE usuario SET usnombre = '" . $this->getNombre() . "',". $pass. "
        usmail = '" . $this->getMail() . "', usdeshabilitado = ". $this->getDeshabilitado() ." WHERE idusuario = '" . $this->getId(). "'";


        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("usuario->modificar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuario->modificar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Elimina el objeto actual de la base de datos
     * @return boolean true si se concretó, false caso contrario
     */
    public function eliminar(){
        $seConcreto = false;

        $consulta = "DELETE FROM usuario WHERE idusuario = '" . $this->getId() ."'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("usuario->eliminar: ".$this->getError());}
        }else{$this->setMensajeOperacion("usuario->eliminar: ".$this->getError());}

        return $seConcreto;
    }
}


?>