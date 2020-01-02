<?php
require_once ROOT.'/src/Entity/ImagesEntity.php';

class ImageService {

    public function getImages($repertoire = 'assets/images/') {
        $array = [];
        //On ouvre le répertoire contenant nos images et on affiche une erreur si il n'existe pas
        $folder = opendir($repertoire) or die("Erreur le repertoire $repertoire n'existe pas");

        //On boucle sur le contenu du répertoire
        while($fichier = @readdir($folder))
        {
            /*Si le nom du fichier commence par un "." ou si c'est la carte ? alors on passe
            au tour suivant sans aller plus loin*/
            if ($fichier[0] == "." || $fichier == "pointInterro.png") continue;

            $img = new ImagesEntity();//Instanciation de l'objet Images
            //Application de donnée au attribut de l'objet via ces setter
            $img->setSrc('assets/images/'.$fichier);
            $img->setAlt('Image du jeu');
            array_push($array, $img);//On stock notre image dans le tableau "$array"
        }
        return $array;
    }
}