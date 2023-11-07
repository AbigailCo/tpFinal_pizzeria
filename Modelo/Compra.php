<?php
class Compra extends BaseDatos{
    private $id;
    private $coFecha;
    private $objUsuario;
    private $mensajeOperacion;

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
        $this->coFecha = "0000-00-00 00:00:00";
        $this->objUsuario = new Usuario();
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Carga datos a un objeto
     */
    public function cargar($id, $coFecha, $objUsuario){
        $this->setId($id);
        $this->setCoFecha($coFecha);
        $this->setObjUsuario($objUsuario);
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getCoFecha(){
        return $this->coFecha;
    }
    public function setCoFecha($coFecha){
        $this->coFecha = $coFecha;
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
     * Busca una compra por id.
     * Coloca su datos al objeto actual.
     * @param int $id
     * @return boolean
     */
    public function buscar($id){
        $encontro = false;
        $consulta = "SELECT * FROM compra WHERE idcompra = '" . $id . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    $objUsuario = new Usuario();
                    $objUsuario->buscar($fila["idusuario"]);

                    $this->cargar(
                        $fila["idcompra"],
                        $fila["cofecha"],
                        $objUsuario
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("compra->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista compras de la base de datos
     * @param string $condicion (opcional)
     * @return array|null
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM compra";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objCompra = new Compra();
                    $objCompra->buscar($fila["idcompra"]);
                    array_push($arreglo, $objCompra);
                }
            }else{$this->setMensajeOperacion("compra->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta una compra a la db
     * @return boolean
     */
    public function insertar(){
        $resp = null;
        $resultado = false;

        $consulta = "INSERT INTO compra(cofecha, idusuario)
        VALUES (NOW(), ". $this->getObjUsuario()->getId() .");";

        if($this->Iniciar()){
            $resp = $this->Ejecutar($consulta);
            if ($resp) {
                $this->setId($resp);
                $resultado = true;
            }else{$this->setmensajeoperacion("compra->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->insertar: ".$this->getError());}

        return $resultado;
    }

    /**
     * Modifica los datos de una compra
     * @return boolean
     */
    public function modificar(){
        $seConcreto = false;

        $consulta = "UPDATE compra SET idusuario = '" . $this->getObjUsuario()->getId() . "' WHERE idcompra = '" . $this->getId(). "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("compra->modificar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->modificar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Elimina una compra de la db
     * @return boolean
     */
    public function eliminar(){
        $seConcreto = false;

        $consulta = "DELETE FROM compra WHERE idcompra = '" . $this->getId() ."'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("compra->eliminar: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->eliminar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Obtiene la compra activa en estado carrito
     * @return Compra|null
     */
    public function buscarCarrito(){
        $resultado = null;

        $consulta = "SELECT * FROM compra INNER JOIN compraestado ON compraestado.idcompra = compra.idcompra
        WHERE idusuario = ".$this->getObjUsuario()->getId() ." AND idcompraestadotipo = 1 AND cefechafin = '0000-00-00 00:00:00';";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    $resultado = new Compra();
                    $resultado->buscar($fila["idcompra"]);
                }
            }else{$this->setMensajeOperacion("compra->buscarCarrito: ".$this->getError());}
        }else{$this->setMensajeOperacion("compra->buscarCarrito: ".$this->getError());}

        return $resultado;
    }
}
?>