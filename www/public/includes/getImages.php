<?php

if($_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
    require_once 'images.php';

    $repertoire = '../assets/images/';
    $array = [];
    //On ouvre le répertoire contenant nos images et on affiche une erreur si il n'existe pas
    $folder = opendir($repertoire) or die("Erreur le repertoire $repertoire n'existe pas");

    //On boucle sur le contenu du répertoire
    while($fichier = @readdir($folder))
    {
        /*Si le nom du fichier commence par un "." ou si c'est la carte ? alors on passe
        au tour suivant sans aller plus loin*/
        if ($fichier[0] == "." || $fichier == "pointInterro.png") continue;

        $img = new Images();//Instanciation de l'objet Images
        //Application de donnée au attribut de l'objet via ces setter
        $img->setSrc('assets/images/'.$fichier);
        $img->setAlt('Image du jeu');
        array_push($array, $img);//On stock notre image dans le tableau "$array"
    }

    echo json_encode($array);//On encode le tableau en JSON pour que JS puisse le "lire"
}
else {
    header("HTTP/1.0 404 Not Found");
}