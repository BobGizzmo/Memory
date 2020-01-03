<?php
namespace Core\Database;

class MysqlDatabase {

    
    private $dbContainer;
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $pdo;

    function __construct($dbContainer, $dbName, $dbUser, $dbPassword)
    {
        $this->dbContainer = $dbContainer;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
    }

    public function getPdo() {
        if($this->pdo === null) {
            try {
                $pdo = new \PDO("mysql:host=$this->dbContainer;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
        
            } catch(\PDOException $e) {
                //echo $e;
                echo "Une erreur est survenue, <br />feuille de scores introuvable";
            }
        }
        return $this->pdo;
    }
}