<?php
class BaseDatos extends PDO {
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
  	private $debug;
  	private $conec;
  	private $indice;
    private $error;
  	private $resultado;

    /////////////////////////////
    // CONSTRUCTOR //
    /////////////////////////////
    
    /**
     * Crea una conexión con la base de datos
     */
    public function __construct(){
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database ='bdpizzeria';
        $this->user = 'root';
        $this->pass = '';
        $this->debug = true;
        $this->error ="";
        $this->sql ="";
        $this->indice =0;
        
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        try {
           parent::__construct( $dns, $this->user, $this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
           $this->conec=true;
        }catch (PDOException $e) {
            $this->sql = $e->getMessage();
            $this->conec=false;
        }
    }

    /////////////////////////////
    // SET Y GET //
    /////////////////////////////

    /**
     * Retorna true si la conexión con el servidor se pudo establecer y false en caso contrario.
     * @return boolean
     */
    public function Iniciar(){
        return $this->getConec();
    }
    public function getConec(){
        return $this->conec;
    }   
    public function getDebug(){
        return $this->debug;
    }
    public function setDebug($debug){
        $this->debug = $debug;
    }
    public function getError(){
        return "\n".$this->error;
    }
    public function setError($e){
        $this->error = $e;
    }
    public function getSQL(){
        return "\n".$this->sql;
    }
    public function setSQL($e){
        return "\n".$this->sql = $e;
    }
    private function setIndice ($valor){
        $this->indice = $valor;
    }
    private function getIndice (){
        return $this->indice;
    }
    private function setResultado($valor){
        $this->resultado = $valor; 
    }
    private function getResultado(){
       return $this->resultado;
    }
    
    /////////////////////////////
    // INTERACCIÓN CON LA BASE //
    /////////////////////////////
    
    /**
     * Ejecuta una consulta SQL
     * @param string $sql
     * @return int
     */
    public function Ejecutar($sql){
        $this->setError("");
        $this->setSQL($sql);

        if (stristr($sql,"insert")){ 
                $resp =  $this->EjecutarInsert($sql);
        }
        if (stristr($sql,"update")OR stristr($sql,"delete")){
                $resp =  $this->EjecutarDeleteUpdate($sql);
        }
        if (stristr($sql,"select")){
            $resp =  $this->EjecutarSelect($sql);
        }

        return $resp;
    }
   
    /**
     * Ejecuta un insert
     * Si se inserta en una tabla que tiene una columna autoincrement se retorna el id con el que se inserto el registro
     * Caso contrario se retorna -1
     * @param string $sql
     * @return int
     */
    private function EjecutarInsert($sql){
        $resultado=parent::query($sql);
        if(!$resultado){
            $this->analizarDebug();
            $id=0;
        }else{
            $id =  $this->lastInsertId(); 
            if ($id==0){
                $id=-1;
            }
            
        }
        return $id;
    }
    
    /**
     * Ejecuta un delete o un update
     * Devuelve la cantidad de filas afectadas por la ejecucion SQL. Si el valor es <0 no se pudo realizar la operación
     * @param string $sql
     * @return int
     */
    private function EjecutarDeleteUpdate($sql){
        $cantFilas =-1;
        $resultado=parent::query($sql);
        if(!$resultado){
            $this->analizarDebug();
        }else{
            $cantFilas =  $resultado->rowCount();
            
        }
        return $cantFilas;
    }
    
    /**
     * Ejecuta un select
     * Devuelve la cantidad de filas afectadas por la ejecucion SQL.
     * @param string $sql
     * @return int
     */
    private function EjecutarSelect($sql){
        $cant = -1;
        $resultado=parent::query($sql);
        if(!$resultado){
            $this->analizarDebug();
        }else {
            
            $arregloResult = $resultado->fetchAll();
            $cant = count($arregloResult);
            $this->setIndice(0);
            $this->setResultado($arregloResult);
        }
        return $cant;
    }


    /**
     * Devuelve un registro retornado por la ejecucion de una consulta.
     * El puntero se despleza al siguiente registro de la consulta.
     * @return array
     */
    public function Registro() {
        $filaActual = false;
        $indiceActual = $this->getIndice();
        if ($indiceActual>=0) {
            $filas = $this->getResultado();
            if($indiceActual<count($filas)){
                $filaActual =  $filas[$indiceActual];
                    $indiceActual++;
                    $this->setIndice($indiceActual);
            }else {
                $this->setIndice(-1);
            }   
        }
        return $filaActual;
    }

    /////////////////////////////
    // OTROS //
    /////////////////////////////
    
    /**
     * Esta funcion si esta seteado la variable instancia $this->debug visualiza el debug
     */
    private function analizarDebug(){
        $e = $this->errorInfo();
        $this->setError($e);
        if($this->getDebug()){
            echo "<pre>";
            print_r($e);
            echo "</pre>";
        }
    }
} 