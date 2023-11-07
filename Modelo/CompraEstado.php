<?php
class CompraEstado extends BaseDatos{
    private $id;
    private $objCompra;
    private $objCompraEstadoTipo;
    private $fechaIni;
    private $fechaFin;

    /////////////////////////////
    // CONSTRUCTOR //
    /////////////////////////////

    /**
     * Método constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->id = -1;
        $this->objCompra = new Compra();
        $this->objCompraEstadoTipo = new CompraEstadoTipo();
        $this->fechaIni = "NOW()";
        $this->fechaFin = "0000-00-00";
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Carga datos a un objeto
     */
    public function cargar($id, $objCompra, $objCompraEstadoTipo, $fechaIni, $fechaFin){
        $this->setId($id);
        $this->setObjCompra($objCompra);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
        $this->setFechaIni($fechaIni);
        $this->setFechaFin($fechaFin);
    }
    /**
     * Carga claves al objeto
     * @param int $idCompra
     * @param int $idUsuario
     */
    public function cargarClaves($idCompra, $idCompraEstadoTipo){
        $objCompraEstadoTipo = $this->getObjCompraEstadoTipo();
        $objCompra = $this->getObjCompra();

        $objCompraEstadoTipo->setIdcet($idCompraEstadoTipo);
        $objCompra->setId($idCompra);

        $this->setObjCompra($objCompra);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getObjCompra(){
        return $this->objCompra;
    }
    public function setObjCompra($objCompra){
        $this->objCompra = $objCompra;
    }
    public function getObjCompraEstadoTipo(){
        return $this->objCompraEstadoTipo;
    }
    public function setObjCompraEstadoTipo($objCompraEstadoTipo){
        $this->objCompraEstadoTipo = $objCompraEstadoTipo;
    }
    public function getFechaIni(){
        return $this->fechaIni;
    }
    public function setFechaIni($fechaIni){
        $this->fechaIni = $fechaIni;
    }
    public function getFechaFin(){
        return $this->fechaFin;
    }
    public function setFechaFin($fechaFin){
        $this->fechaFin = $fechaFin;
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
     * Busca una compra por id.
     * Coloca su datos al objeto actual.
     * @param int $id
     * @return boolean
     */
    public function buscar($id){
        $encontro = false;
        $consulta = "SELECT * FROM compraestado WHERE idcompraestado = '" . $id . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    $objCompra = new Compra();
                    $objCompra->buscar($fila["idcompra"]);
                    $objCompraEstadoTipo = new CompraEstadoTipo();
                    $objCompraEstadoTipo->buscar($fila["idcompraestadotipo"]);

                    $this->cargar(
                        $fila["idcompraestado"],
                        $objCompra,
                        $objCompraEstadoTipo,
                        $fila["cefechaini"],
                        $fila["cefechafin"]
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("compraestado->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestado->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista compras de la base de datos
     * @param string $condicion (opcional)
     * @return array|null
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM compraestado";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objCompraEstado = new CompraEstado();
                    $objCompraEstado->buscar($fila["idcompraestado"]);
                    array_push($arreglo, $objCompraEstado);
                }
            }else{$this->setMensajeOperacion("compraestado->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestado->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta una compra a la db
     * @return boolean
     */
    public function insertar(){
        $resp = null;
        $resultado = false;

        $consulta = "INSERT INTO compraestado(idcompra, idcompraestadotipo, cefechaini, cefechafin)
        VALUES ('".$this->getObjCompra()->getId()."','". $this->getObjCompraEstadoTipo()->getIdcet() ."', NOW(), '0000/00/00');";

        if($this->Iniciar()){
            $resp = $this->Ejecutar($consulta);
            if ($resp) {
                $this->setId($resp);
                $resultado = true;
            }else{$this->setmensajeoperacion("compraestado->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compraestado->insertar: ".$this->getError());}

        return $resultado;
    }

    /**
     * Elimina los datos de una compraestado
     * @return boolean
     */
    public function eliminar(){
        return false;
    }

    /**
     * Modifica una compraestado de la db
     * @return boolean
     */
    public function modificar(){
        return false;
    }

    /**
     * Finaliza un estado
     * @return boolean
     */
    public function finalizar(){
        $seConcreto = false;

        $consulta = "UPDATE compraestado SET cefechafin = NOW() WHERE idcompraestado = '" . $this->getId(). "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("compra->modificar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->modificar: ".$this->getError());}

        return $seConcreto;
    }
}
?>