<?php

abstract class Conexao{
    private static $instancia;
    // Impedir instanciação
    public function __construct(){

    }
// Impedir clonar
    public function __clone(){}

    public function __destruct(){
        foreach($this as $key=>$value)
        {
            unset($this->$key);
        }
    }
    //Impedir utilização do Unserialize
    public function __wakeup() { }

    private static $dbtype="mysql";
    private static $host="localhost";
    private static $port="3306";
    private static $user="root";
    private static $password="";
    private static $db="postoprovidencia";
    
    public static function getInstancia() {
        if(!isset(self::$instancia)) {
             try {
                    
                 
                 // Instânciado um novo objeto PDO informando o DSN e parâmetros de Array
                 self::$instancia=new PDO(self::$dbtype.":host=".self::$host.";port=".self::$port.";dbname=".self::$db,self::$user,self::$password);
                 
                 // Gerando um excessão do tipo PDOException com o código de erro
                 self::$instancia->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             
             } catch ( PDOException $excecao ){
                 echo $excecao->getMessage();
                 // Encerra aplicativo
                 exit();
             }
         }
         return self::$instancia;
        }

        
    public function disconnect(){
        $this->instancia=null;
    }
}

?>