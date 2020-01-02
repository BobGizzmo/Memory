<?php

require_once ROOT.'/core/Table/Table.php';

class ScoreTable extends Table{

    function __construct()
    {
        $this->table = 'best_record';
    }

    public function all() {
        return $this->query("SELECT * FROM $this->table", [], true);
    }

    public function getFiveLastScores() {
        return $this->query("SELECT * FROM $this->table ORDER BY timer LIMIT 5", [], true);
    }

}