<?php

class Base
{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct ()
    { 
        // conexion con la base de datos
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname.";";
        $option = [
            PDO::ATTR_ERRMODE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn,$this->user,$this->pass,$option);
            $this->dbh->exec("set names utf8");
            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } catch (PDOException $e) {

            $this->error = $e->getMessage();
            exit($this->error);
        }


    }

    
    public function query($sql)
    {
       return $this->stmt = $this->dbh->prepare($sql);
    }


    public function bind($parametro,$valor,$tipo = null)
    {
      if(is_null($tipo)){
         switch(true){
            case is_int($valor):
                $tipo = PDO::PARAM_INT;
                break;
            case is_bool($valor):
                $tipo = PDO::PARAM_BOOL;
                break;
            case is_null($valor):
                $tipo = PDO::PARAM_NULL;
                break;
            default;
                $tipo = PDO::PARAM_STR;
         }

         return $this->stmt->bindValue($parametro,$valor,$tipo);
      }
    }


    public function execute()
    {
       return $this->stmt->execute();
    }


    public function registers()
    {
       $this->stmt->execute();
       return $this->stmt->fetchAll();
    }


    public function register()
    {
        $this->stmt->execute();
        return $this->stmt->fetch();
    }


    public function rowCount()
    {

        $this->stmt->execute();
        return $this->stmt->rowCount();
    }
    
}


?>