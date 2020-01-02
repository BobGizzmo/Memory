<?php

require_once ROOT.'/core/Controller/Controller.php';
require_once ROOT.'/src/Services/ImageService.php';
require_once ROOT.'/src/Table/ScoreTable.php';

class GameController extends Controller{

    public function indexAction() {
        //On instancie notre classe ImageService
        $service = new ImageService();
        /*On appelle sa méthode getImage pour récupérer les images de notre dossier 
        puis on les compte grace à la méthode "count" de php */
        $nbImage = count($service->getImages());

        $table = new ScoreTable();
        $scores = $table->getFiveLastScores();//Récupère les 5 meilleurs scores

        //On formate les timer de chaque score pour affichage
        foreach ($scores as $score) {
            $score->time = $this->getTimer($score->timer);
        }

        /* On appelle la vue
        et on lui envoie les variables "nbImage" et "score" */
        return $this->render('/game/index.php', compact(['nbImage', 'scores']));
    }
    
    /**
     * @param Int $timer
     * @return String
     */
    public function getTimer(Int $timer = null) {
        $t = $timer;
        $t = floor($t/1000);
        $m = floor($t/60);
        $sec = floor($t-$m*60);
        
        $string = !$m ? $sec." secondes" : $m." minutes et ".$sec." secondes";

        return $string;
    }

    //AJAX AJAX AJAX

    public function getImages() {
        $service = new ImageService();
        $images = $service->getImages();
        
        echo json_encode($images);//On encode le tableau en JSON pour que JS puisse le "lire"
        die;
    }

    public function createScore() {
        if(!empty($_POST)) {
            $table = new ScoreTable();
            $secureEntries = $table->secureEntries($_POST);
            $table->create($secureEntries);
            echo "Score bien enregistré !"; // On renvoie une string à JS
        }
    }
}