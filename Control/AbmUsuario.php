<?php
class AbmUsuario{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjeto($param){
        $obj = null;

        if(
            array_key_exists('nombre',$param)
            and array_key_exists('pass',$param)
            and array_key_exists('mail', $param)
            and array_key_exists('deshabilitado', $param)
        ){
            $obj = new Usuario();
        
            $obj->cargar(null, $param["nombre"],$param["pass"],$param["mail"],$param["deshabilitado"]);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjetoConClave($param){
        $obj = null;

        if(isset($param['id']) ){
            $obj = new Usuario();
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
        $claves = ["id","nombre","pass","mail","deshabilitado"];
        $db = ["idusuario", "usnombre", "uspass", "usmail", "usdeshabilitado"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $db[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new Usuario();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

    /**
     * Revisa si ya existe un mismo mail o usuario en la db
     * @param array $param
     * @return boolean
     */
    public function revisar($param){
        $resp = false;

        if(isset($param["nombre"]) && isset($param["mail"])){
            $objM = new Usuario();
            $resultado = $objM->listar("usnombre = '" . $param["nombre"] . "' OR usmail = '" . $param["mail"] . "'");
            if(isset($param["id"])){
                if(isset($resultado) && count($resultado) > 0 && $resultado[0]->getId() != $param["id"]){
                    $resp = true;
                }
            }else{
                if(isset($resultado) && count($resultado) > 0){
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    /**
     * Le otorga un rol al usuario
     * @param array $param
     * @return boolean
     */
    public function darRol($param){
        $resp = false;

        if($this->seteadosCamposClaves($param) && isset($param["idrol"])){
            $objUsuarioRol = new UsuarioRol();
            $objUsuarioRol->cargarClaves($param["idrol"], $param["id"]);
            if($objUsuarioRol->insertar()){
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * Le quita un rol al usuario
     * @param array $param
     * @return boolean
     */
    public function quitarRol($param){
        $resp = false;
 
         if($this->seteadosCamposClaves($param) && isset($param["idrol"])){
             $objUsuarioRol = new UsuarioRol();
             $objUsuarioRol->cargarClaves($param["idrol"], $param["id"]);
             if($objUsuarioRol->eliminar()){
                 $resp = true;
             }
         }
 
         return $resp;
     }

    /**
     * Retorna los roles de un usuario
     * @param array $param
     * @return array
     */
    public function buscarRoles($param){
        $where = " true ";
        $claves = ["id"];
        $clavesDB = ["idusuario"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $clavesDB[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
 

}


?>