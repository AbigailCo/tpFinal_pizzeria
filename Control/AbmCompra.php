<?php
class AbmCompra{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con las variables instancias del objeto
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol|null
     */
    private function cargarObjeto($param){
        $obj = null;

        if(
            array_key_exists('idusuario',$param)
        ){
            $obj = new Compra();

            $objUs = new Usuario;
            $objUs->buscar($param["idusuario"]);
        
            $obj->cargar(null,"NOW()", $objUs);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol|null
     */
    private function cargarObjetoConClave($param){
        $obj = null;

        if(isset($param['id'])){
            $obj = new Compra();
            $obj->buscar($param["id"]);
        }
        return $obj;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['id']))
            $resp = true;
        return $resp;
    }

    /**
     * Permite dar de alta un objeto
     * @param array $param
     */
    public function alta($param){
        $resp = array();
        $elObjtTabla = $this->cargarObjeto($param);

        if ($elObjtTabla!=null and $elObjtTabla->insertar()){
            $resp = array('resultado'=> true,'error'=>'', 'obj' => $elObjtTabla);
        }else {
            $resp = array('resultado'=> false,'error'=> $elObjtTabla->getMensajeOperacion());
        }
    
        return $resp;

    }
    /**
     * Permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjetoConClave($param);
            if ($elObjtTabla!=null and $elObjtTabla->eliminar()){
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            $elObjtTabla->setId($param["id"]);
            if($elObjtTabla!=null and $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        $claves = ["id","cofecha", "idusuario"];
        $db = ["idcompra","cofecha", "idusuario"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $db[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new Compra();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    /**
     * Retorna el carrito de un usuario
     * @param array $param
     * @return Compra|null
     */
    public function retornarCarrito($param){
        $resultado = null;

        if(isset($param["idusuario"])){
            $obj = new Usuario;
            $obj->buscar($param["idusuario"]);

            $objCo = new Compra;
            $objCo->setObjUsuario($obj);
            $resultado = $objCo->buscarCarrito();
        }

        return $resultado;
    }


    // Cambios de estado

    /**
     * Cambia el estado de una compra
     * @param array $param
     * @return boolean
     */
    public function cambiarEstado($param){
        $resp = false;

        if($this->seteadosCamposClaves($param) && isset($param["idcompraestadotipo"]) && $this->finalizarEstado($param)){
            $objCompraEstado = new CompraEstado;
            $objCompraEstado->cargarClaves($param["id"],$param["idcompraestadotipo"]);

            if($objCompraEstado->insertar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Agrega el estado inicial de una compra
     * @param array $param
     * @return boolean
     */
    public function estadoInicial($param){
        $resp = false;

        if($this->seteadosCamposClaves($param)){
            $estadoInicial = 1;

            $objCompraEstado = new CompraEstado;
            $objCompraEstado->cargarClaves($param["id"], $estadoInicial);

            if($objCompraEstado->insertar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Finaliza el estado anterior
     * @param array $param
     * @return boolean
     */
    public function finalizarEstado($param){
        $resp = false;

        if($this->seteadosCamposClaves($param)){
            // Revisar si existe una compra estado que esté activa
            $objCompraEstado = new CompraEstado();
            $arreglo = $objCompraEstado->listar("idcompra = " . $param["id"] . " AND cefechafin = '0000-00-00 00:00:00'");
            
            if(isset($arreglo) && count($arreglo) > 0 && $arreglo[0]->finalizar()){
                $resp = true;
            }
        }
        return $resp;

    }

    /**
     * Dado el id de una compra, obtiene su estado
     * @param array $param
     * @return array|null
     */
    public function buscarEstado($param){
        $where = " true ";
        $claves = ["id", "idcompraestadotipo", "fechafin"];
        $db = ["idcompra","idcompraestadotipo", "cefechafin"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $db[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new CompraEstado();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    /**
     * Agrega un item
     * @param array
     * @return boolean
     */
    public function agregarItem($param){
        $resp = false;

        if($this->seteadosCamposClaves($param) && isset($param["idproducto"]) && isset($param["cantidad"])){
            $objCompraItem = new CompraItem();
            $objCompraItem->cargarClaves($param["id"], $param["idproducto"]);
            $objCompraItem->setCantidad($param["cantidad"]);
            if($objCompraItem->insertar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica un item
     * @param array
     * @return boolean
     */
    public function modificarItem($param){
        $resp = false;

        if(isset($param["idcompraitem"]) && isset($param["cantidad"])){
            $objCompraItem = new CompraItem();
            $objCompraItem->buscar($param["idcompraitem"]);
            $objCompraItem->setCantidad($param["cantidad"]);
            if($objCompraItem->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Elimina un item
     * @param array
     * @return boolean
     */
    public function eliminarItem($param){
        $resp = false;

        if(isset($param["idcompraitem"])){
            $objCompraItem = new CompraItem();
            $objCompraItem->buscar($param["idcompraitem"]);
            if($objCompraItem->eliminar()){
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * Retorna todos sus obj item
     * @param array $param
     * @return array|null
     */
    public function buscarItems($param){
        $where = " true ";
        $claves = ["id", "idcompraitem", "idproducto"];
        $db = ["idcompra", "idcompraitem", "idproducto"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $db[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new CompraItem();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }





}


?>