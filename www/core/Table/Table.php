<?php
require_once ROOT.'/core/Database/MysqlDatabase.php';

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

    public function query($sql, $params=null, $fetchable = false) {

        $this->getPDO();

        $req = $this->pdo->prepare($sql);
        $req->execute($params);
        
        if($fetchable) {
            $req->setFetchMode(PDO::FETCH_OBJ);
            $response = $req->fetchAll();
            return $response;
        }
    }

    public function create($params) {

        $sql_parts = [];
        $attributes = [];
        foreach ($params as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }

        $sql_part = implode(',', $sql_parts);// arg1 = ?, arg2 = ?

        //INSERT INTO une table SET arg1 = ?, arg2 = ?
        //$attributes = [valeurArg1, valeurArg2]
        $this->query("INSERT INTO $this->table SET $sql_part", $attributes);
    }

    public function secureEntries($entries) {

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