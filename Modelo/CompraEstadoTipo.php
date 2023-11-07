
<?php
class CompraEstadoTipo extends BaseDatos{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeOperacion;


    /**
     * Clase constructora
     */
    public function __construct()
    {
        parent::__construct();
        $this->idcompraestadotipo = null;
        $this->cetdescripcion = null;
        $this->cetdetalle = null;
        $this->mensajeOperacion = null;
    }

    /**
     * Carga datos al objeto
     * @param int $idcompraestadotipo
     * @param string $cetdescripcion
     * @param string $cetdetalle
     */
    public function cargar($idcompraestadotipo, $cetdescripcion, $cetdetalle ){
        $this->setIdcet($idcompraestadotipo);
        $this->setCetdescripcion($cetdescripcion);
        $this->setCetdetalle($cetdetalle);
    }

    // Getters y setters

    public function getIdcet(){
        return $this->idcompraestadotipo;
    }
    public function setIdcet($idcompraestadotipo){
        $this->idcompraestadotipo = $idcompraestadotipo;
    }
    public function getCetdescripcion(){
        return $this->cetdescripcion;
    }
    public function setCetdescripcion($cetdescripcion){
        $this->cetdescripcion = $cetdescripcion;
    }
    public function getCetdetalle(){
        return $this->cetdetalle;
    }
    public function setCetdetalle($cetdetalle){
        $this->cetdetalle = $cetdetalle;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }
    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }


    // Métodos de interacción con la db

    /**
     * Busca un Compraestadotipo por id
     * Sus datos son colocados en el objeto
     * @param string $idcompraestadotipo
     * @return boolean true si encontro, false caso contrario
     */
    public function buscar($idcompraestadotipo){
        $encontro = false;
        $consulta = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = '" . $idcompraestadotipo . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    $this->cargar(
                        $idcompraestadotipo,
                        $fila["cetdescripcion"],
                        $fila["cetdetalle"]
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("compraestadotipo->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestadotipo->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista compraestadotipo de la base de datos
     * @param string $condicion (opcional)
     * @return array|null colección de usuarios o null si no hay ninguno
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM compraestadotipo";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objCompraestadotipo = new CompraEstadoTipo();
                    $objCompraestadotipo->cargar($fila["idcompraestadotipo"],$fila["cetdescripcion"],$fila["cetdetalle"]);
                    array_push($arreglo, $objCompraestadotipo);
                }
            }else{$this->setMensajeOperacion("compraestadotipo->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestadotipo->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta los datos del objeto Usuario actual a la base de datos.
     * @return boolean true si se concretó, false caso contrario
     */
    public function insertar(){
        $resp = null;
        $resultado = false;

        $consulta = "INSERT INTO compraestadotipo(cetdescripcion, cetdetalle)
        VALUES ('". $this->getCetdescripcion()."','". $this->getCetdetalle()."');";

        if($this->Iniciar()){
            $resp = $this->Ejecutar($consulta);
            if ($resp) {
                $this->setIdcet($resp);
                $resultado = true;
            }else{$this->setmensajeoperacion("compraestadotipo->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestadotipo->insertar: ".$this->getError());}

        return $resultado;
    }

    /**
     * Modifica los datos de la usuario, colocando los del objeto actual
     * @return boolean true si se concretó, false caso contrario
     */
    public function modificar(){
        $seConcreto = false;

        $consulta = "UPDATE compraestadotipo SET cetdescripcion = '" . $this->getCetdescripcion(). "', cetdetalle = '". $this->getCetdetalle() ."' WHERE idcompraestadotipo = '" . $this->getIdcet(). "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("idcompraestadotipo->modificar: ".$this->getError());}
        }else{$this->setMensajeOperacion("idcompraestadotipo->modificar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Elimina el objeto actual de la base de datos
     * @return boolean true si se concretó, false caso contrario
     */
    public function eliminar(){
        $seConcreto = false;

        $consulta = "DELETE FROM compraestadotipo WHERE idcompraestadotipo = '" . $this->getIdcet() ."'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("compraestadotipo->eliminar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestadotipo->eliminar: ".$this->getError());}

        return $seConcreto;
    }
}


?>
