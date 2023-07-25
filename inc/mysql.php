<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
date_default_timezone_set("America/Asuncion");
class DataBase extends MySQLi{

    private $link;
    private $result;
    private $sql;
    private $lastError;
    private $resultSize;
    private static $connection;
    private static $sqlQueries;
    private static $totalQueries;
    private $lastErrorCode;

    // Desarrollo
    const DB_NAME = 'api_db';
    const DB_USER = 'root';
    const DB_PSW  = '';
    const DB_HOST = 'localhost';
    const DB_PORT = '3306';

    // Producción
    // const DB_NAME = 'api_db';
    // const DB_USER = 'root';
    // const DB_PSW  = '';
    // const DB_HOST = 'localhost';
    // const DB_PORT = '3306';

    
    public function log_db_errors($code, $error, $query)
    {

        $message = date('Y-m-d H:i:s')."\r\n";
        $message .= 'Query: '. htmlentities($query)."\r\n";
        $message .= 'Error Code: ' . $code."\r\n";
        $message .= 'Error: ' . $error."\r\n";
        $message .= "---------------------------------------------------"."\r\n";
        
        file_put_contents("errores_bd.txt", $message, FILE_APPEND);
    }
    
    public static function conectar(){
        if (is_null(self::$connection)) {
            self::$connection = new DataBase();
            self::$connection->set_charset("utf8");
        }
        return self::$connection;
    }

    private function __construct(){
        $this->link = parent::__construct(self::DB_HOST, self::DB_USER, self::DB_PSW, self::DB_NAME, self::DB_PORT);
        if($this->connect_errno == 0){
            self::$totalQueries = 0;
            self::$sqlQueries = array();
        }
        else {
            $this->log_db_errors($this->connect_errno, $this->connect_error, "Error en la conexion");
            echo 'Error en la conexion: ' . $this->connect_error;
        }
    }
    
    // Escape the string get ready to insert or update
    public function clearText($sql) {
        $sql = trim($sql);
        return mysqli::real_escape_string($sql);
    }
    
    private function execute(){
        if(!($this->result = $this->query($this->sql))){
            $this->lastError = $this->error;
            $this->lastErrorCode = $this->errno;
            $this->log_db_errors($this->lastErrorCode, $this->lastError, $this->sql);
            return false;
        }
        self::$sqlQueries[] = $this->sql;
        self::$totalQueries++;
        $this->resultSize = $this->result->num_rows;
        return true;
    }

    public function alter(){
        if(!($this->result = $this->query($this->sql))){
            $this->lastError = $this->error;
            $this->lastErrorCode = $this->errno;
            $this->log_db_errors($this->lastErrorCode, $this->lastError, $this->sql);
            return false;
        }
        self::$sqlQueries[] = $this->sql;
        self::$totalQueries++;
        $this->resultSize = $this->result->num_rows;
        return true;
    }

    public function loadObjectList(){
        if (!$this->execute()){
            return null;
        }
        $resultSet = array();
        while ($objectRow = $this->result->fetch_object()){
            $resultSet[] = $objectRow;
        }
      //  $this->result->close();
        return $resultSet;  
    }
    
    public function loadObject(){
        if ($this->execute()){
            if ($object = $this->result->fetch_object()){
              //  $this->result->close();
                return $object;
            }
            else return null;
        }
        else return false;
    }
    
   public function setQuery($sql){
        if(empty($sql)){
            return false;
        }
        $this->sql = $sql;
        
        if(!preg_match("/(^\s+select)|(^select)/i", $sql)) {
			$usuario = $_SESSION['usuario'];
			$sql_clean = $this->clearText(trim(preg_replace('/\s+/', ' ', $sql)));
			//$message = date('Y-m-d H:i:s')."|".$sql_clean."\r\n";
			//file_put_contents("querys.txt", $message, FILE_APPEND);
			$mysqli = DataBase::conectar();
			$mysqli->query("INSERT INTO auditoria(fecha, query, usuario) VALUES (NOW(),'$sql_clean','$usuario')");
		}
		return true;
    }

    public function getTotalQueries(){
        return self::$totalQueries;
    }
    
    public function getSQLQueries(){
        return self::$sqlQueries;
    }
    
    public function getError(){
            $sms   = $this->lastError;
        if(strlen(stristr($this->lastError,'foreign key constraint fails')) > 0){
            $sms  = 'El registro se encuentra relacionado.';
        }
        if(strlen(stristr($this->lastError,'Entrada duplicada')) > 0){
            $sms  = 'Registro duplicado, ya existe.';
        }

        return $sms;
    }
    
    public function getErrorCode(){
        return $this->lastErrorCode;
    }

    public function getAffectedRows(){
        return $this->resultSize;
    }
    
    public function getLastID(){
        return $this->insert_id;
    }
    
    function __destruct(){
       $this->close();
    }
}

?>
