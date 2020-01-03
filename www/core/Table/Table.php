<?php
namespace Core\Table;

use Core\Database\MysqlDatabase;

class Table {

    protected $table;
    private $pdo;

    public function getPDO() {
        $database = new MysqlDatabase(getenv('CONTAINER_MYSQL'),
                                getenv('MYSQL_DATABASE'),
                                getenv('MYSQL_USER'),
                                getenv('MYSQL_PASSWORD'));
                                
        $this->pdo = $database->getPdo();
    }

    public function query(String $sql, Array $params=null, Bool $fetchable = false) :?Array 
    {

        $this->getPDO();

        $class_name = str_replace('Table', 'Entity', get_class($this));

        $req = $this->pdo->prepare($sql);
        $req->execute($params);
        
        if($fetchable) {
            $req->setFetchMode(\PDO::FETCH_CLASS, $class_name);
            $response = $req->fetchAll();
            return $response;
        }
        return null;
    }

    public function create(Array $params) {

        $sql_parts = [];
        $attributes = [];
        foreach ($params as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }

        $sql_part = implode(',', $sql_parts);// arg1 = ?, arg2 = ?

        //INSERT INTO une table SET arg1 = ?, arg2 = ?
        //$attributes = [valeurArg1, valeurArg2]
        return $this->query("INSERT INTO $this->table SET $sql_part", $attributes);
    }

    public function secureEntries(Array $entries) :Array
    {

        $escapeEntries = [];
        //On boucle sur les entrées et on les sécurises
        foreach ($entries as $key => $value) {
            if(!is_int($value)) {
                $value = htmlspecialchars($value);
            }
            $escapeEntries[$key] = $value;
        }

        return $escapeEntries;
    }
}