<?php
namespace Src\Controller;

use Src\Table\ScoreTable;
use Src\Services\ImageService;
use Core\Controller\Controller;

class GameController extends Controller{

    function __construct()
    {
        /* On instancie la class ScoreTable grâce à la méthode
        "getTable" de notre class parente "Controller */
        $this->getTable('Score');
    }

    public function indexAction() {
        //On instancie notre classe ImageService
        $service = new ImageService();
        /*On appelle sa méthode getImage pour récupérer les images de notre dossier 
        puis on les comptes grace à la méthode "count" de php */
        $nbImage = count($service->getImages());

        $scores = $this->Score->getFiveLastScores();//Récupère les 5 meilleurs scores

        /* On appelle la vue
        et on lui envoie les variables "nbImage" et "score" */
        return $this->render('/game/index.php', compact(['nbImage', 'scores']));
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
            $secureEntries = $this->Score->secureEntries($_POST);
            $this->Score->create($secureEntries);
            echo "Score bien enregistré !"; // On renvoie une string à JS
        }
    }
}