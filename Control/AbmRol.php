<?php
class AbmRol{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con las variables instancias del objeto
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol|null
     */
    private function cargarObjeto($param){
        $obj = null;

        if(
            array_key_exists('roldescripcion',$param)
        ){
            $obj = new Rol();
        
            $obj->cargar(null, $param["roldescripcion"]);
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
            $obj = new Rol();
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
        $claves = ["id","roldescripcion"];
        $db = ["idrol", "roldescripcion"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $db[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new Rol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    /**
     * Da el permiso a un rol a acceder a una página
     * @param array
     * @return boolean
     */
    public function darPermiso($param){
        $resp = false;

        if($this->seteadosCamposClaves($param) && isset($param["idmenu"])){
            $objMenuRol = new MenuRol();
            $objMenuRol->cargarClaves($param["id"], $param["idmenu"]);
            if($objMenuRol->insertar()){
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * Da el permiso a un rol a acceder a una página
     * @param array
     * @return boolean
     */
    public function quitarPermiso($param){
        $resp = false;

        if($this->seteadosCamposClaves($param) && isset($param["idmenu"])){
            $objMenuRol = new MenuRol();
            $objMenuRol->cargarClaves($param["id"], $param["idmenu"]);
            if($objMenuRol->eliminar()){
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * Retorna todos sus obj menu a los que puede acceder
     * @param array $param
     * @return array|null
     */
    public function buscarPermisos($param){
        $where = " true ";
        $claves = ["id"];
        $clavesDB = ["idrol"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $clavesDB[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new MenuRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }





}


?>