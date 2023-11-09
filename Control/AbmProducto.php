<?php
class AbmProducto{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
      * @return Producto|null
     */
    private function cargarObjeto($param){
        $obj = null;

        if(

            array_key_exists('nombre',$param)
            and array_key_exists('detalle',$param)
            and array_key_exists('cantstock',$param)

        ){
            $obj = new Producto();

            $obj->cargar(null, $param["nombre"], $param["detalle"],  $param["cantstock"]);
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
            $obj = new Producto();
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
            $resp = array('resultado'=> false,'error'=> $elObjtTabla->getmensajeoperacion());
        }

        return $resp;

    }


    /**
     * Sube un archivo
     * @param array $param
     * @return boolean
     */
    public function subirArchivo($param){
        $dir = "../../../Control/Subidas/";
        $resp = false;

        if ($param['imagen']['imagen']['error'] <= 0 && $param['imagen']['imagen']['type'] == "image/jpeg") {
            if (copy($param['imagen']['imagen']['tmp_name'], $dir . md5($param["id"]). ".jpg")) {
                $resp = true;
            }
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

        if(isset($param["id"])){
            $where .= "AND idproducto = " . $param["id"];
        }

        if(isset($param["nombre"])){
            $where .= "AND pronombre LIKE '%" . $param["nombre"] . "%'";
        }

        $obj = new Producto();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    /**
     * Suma al stock
     * @param array $param ["id" => 1, "cantidad" => "1", "operacion" => "suma"|"resta"]
     * @return boolean
     */
    public function cambiarStock($param){
        $resp = false;

        if(isset($param["id"])){
            $resultado = $this->buscar($param);
        }

        if(isset($resultado) && count($resultado) > 0 && isset($param["cantidad"]) && isset($param["operacion"])){
            switch($param["operacion"]){
                case "suma":
                    $cantidad = $resultado[0]->getCantStock() + $param["cantidad"];
                    $resultado[0]->setCantStock($cantidad);
                    $resp = $resultado[0]->modificar();
                    break;
                case "resta":
                    $cantidad = $resultado[0]->getCantStock() - $param["cantidad"];
                    $resultado[0]->setCantStock($cantidad);
                    $resp = $resultado[0]->modificar();
                    break;
            }
        }

        return $resp;
    }

  }



?>
