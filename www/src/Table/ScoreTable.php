<?php
namespace Src\Table;

use Core\Table\Table;

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