<?php
class AbmMenu{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu|null
     */
    private function cargarObjeto($param){
        $obj = null;

        if(
            array_key_exists('id',$param)
            and array_key_exists('nombre',$param)
            and array_key_exists('descripcion', $param)
            and array_key_exists('deshabilitado', $param)
        ){
            $obj = new Menu();
            if($param["idpadre"] <> null){
                $objPadre = new Menu();
                $objPadre->buscar($param["idpadre"]);
                $param["idpadre"] = $objPadre;
            }
        
            $obj->cargar(null, $param["nombre"], $param["descripcion"], $param["idpadre"], $param["deshabilitado"]);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu|null
     */
    private function cargarObjetoConClave($param){
        $obj = null;

        if(isset($param['id']) ){
            $obj = new Menu();
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

            $elObjtTabla->setDeshabilitado("NOW()");

            if ($elObjtTabla!=null and $elObjtTabla->modificar()){
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
        $claves = ["id","nombre","descripcion","idpadre","deshabilitado"];
        $db = ["idmenu", "menombre", "medescripcion", "idpadre", "medeshabilitado"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $db[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new Menu();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }
}


?>