<?php

//Récupération des valeur de notre fichier .env
getScores('SELECT * FROM best_record ORDER BY timer LIMIT 5', []);

if(!empty($_POST)) {
    //Récupération et sécurisation des données envoyées par JS AJAX
    $username = htmlspecialchars($_POST["username"]);
    $timer = htmlspecialchars($_POST["timer"]);

    getScores('INSERT INTO best_record SET username = ?, timer = ?', [$username, $timer], true);
}

function getPDO() {

    $dbname = getenv('MYSQL_DATABASE');
    $dbuser = getenv('MYSQL_USER');
    $dbpassword = getenv('MYSQL_PASSWORD');
    $dbcontainer = getenv('CONTAINER_MYSQL');
    
    try {
        $pdo = new \PDO("mysql:host=$dbcontainer;dbname=$dbname", $dbuser, $dbpassword);
        return $pdo;

    } catch(\PDOException $e) {
        //echo $e;
        echo "Une erreur est survenue, <br />feuille de scores introuvable";
    }
}

function getScores($sql, $params, $ajax=false) {

        $pdo = getPDO();

        $req = $pdo->prepare($sql);
        $req->execute($params);

        if($ajax) {
            $req->closeCursor();
            echo "Score bien enregistré !";
        }
        else {
            if(strrpos($sql, "SELECT") == 0) {
                $scores = $req->fetchAll();
                $req->closeCursor();
                return $scores;
            }
        }
}

function getTimer($timer) {
    $t = $timer;
    $t = floor($t/1000);
    $m = floor($t/60);
    $sec = floor($t-$m*60);
    
    $string = !$m ? $sec." secondes" : $m." minutes et ".$sec." secondes";

    return $string;
}

