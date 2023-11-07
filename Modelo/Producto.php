<?php
class Producto extends BaseDatos{
    private $id;
    private $nombre;
    private $detalle;
    private $cantStock;
    private $mensajeOperacion;

    // precio
    // imagen

    /////////////////////////////
    // CONSTRUCTOR //
    /////////////////////////////

    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->id = -1;
        $this->nombre = "";
        $this->detalle = "";
        $this->cantStock = 0;
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Carga datos al producto actual
     * @param int $id
     * @param string $nombre
     * @param string $detalle
     * @param int $cantStock
     */
    public function cargar($id, $nombre, $detalle, $cantStock){
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDetalle($detalle);
        $this->setCantStock($cantStock);
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
    public function getDetalle(){
        return $this->detalle;
    }
    public function setDetalle($detalle){
        $this->detalle = $detalle;
    }
    public function getCantStock(){
        return $this->cantStock;
    }
    public function setCantStock($cantStock){
        $this->cantStock = $cantStock;
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
     * Busca una producto por id.
     * Coloca su datos al objeto actual.
     * @param int $id
     * @return boolean
     */
    public function buscar($id){
        $encontro = false;
        $consulta = "SELECT * FROM producto WHERE idproducto = '" . $id . "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                if($fila = $this->Registro()){
                    $this->cargar(
                        $fila["idproducto"],
                        $fila["pronombre"],
                        $fila["prodetalle"],
                        $fila["procantstock"]
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("producto->buscar: ".$this->getError());}
        }else{$this->setMensajeOperacion("producto->buscar: ".$this->getError());}

        return $encontro;
    }

    /**
     * Lista productos de la base de datos
     * @param string $condicion (opcional)
     * @return array|null
     */
    public function listar($condicion = ""){
        $arreglo = null;
        $consulta = "SELECT * FROM producto";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $arreglo = [];
                while($fila = $this->Registro()){
                    $objProducto = new Producto();
                    $objProducto->cargar(
                        $fila["idproducto"],
                        $fila["pronombre"],
                        $fila["prodetalle"],
                        $fila["procantstock"]
                    );

                    array_push($arreglo, $objProducto);
                }
            }else{$this->setMensajeOperacion("producto->listar: ".$this->getError());}
        }else{$this->setMensajeOperacion("producto->listar: ".$this->getError());}

        return $arreglo;
    }

    /**
     * Inserta un producto a la db
     * @return boolean
     */
    public function insertar(){
        $resp = null;
        $resultado = false;

        $consulta = "INSERT INTO producto(pronombre, prodetalle, procantstock)
        VALUES ('". $this->getNombre() ."','". $this->getDetalle() ."',". $this->getCantStock() .");";

        if($this->Iniciar()){
            $resp = $this->Ejecutar($consulta);
            if ($resp) {
                $this->setId($resp);
                $resultado = true;
            }else{$this->setmensajeoperacion("producto->insertar: ".$this->getError());}
        }else{$this->setMensajeOperacion("producto->insertar: ".$this->getError());}

        return $resultado;
    }

    /**
     * Modifica los datos de un producto
     * @return boolean
     */
    public function modificar(){
        $seConcreto = false;

        $consulta = "UPDATE producto SET pronombre = '". $this->getNombre() ."',
        prodetalle = '". $this->getDetalle() ."',
        procantstock = '". $this->getCantStock() ."'
        WHERE idproducto = '" . $this->getid(). "'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("producto->modificar: ".$this->getError());}
        }else{$this->setMensajeOperacion("producto->modificar: ".$this->getError());}

        return $seConcreto;
    }

    /**
     * Elimina un producto de la db
     * @return boolean
     */
    public function eliminar(){
        $seConcreto = false;

        $consulta = "DELETE FROM producto WHERE idproducto = '" . $this->getId() ."'";

        if($this->Iniciar()){
            if($this->Ejecutar($consulta)){
                $seConcreto = true;
            }else{$this->setMensajeOperacion("producto->eliminar: ".$this->getError());}
        }else{$this->setMensajeOperacion("producto->eliminar: ".$this->getError());}

        return $seConcreto;
    }
}


?>