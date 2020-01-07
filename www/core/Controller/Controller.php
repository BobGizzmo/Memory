<?php
namespace Core\Controller;

class Controller {

    /**
     * @param String $template
     * @param Array $variables
     * @return view
     */
    protected function render(String $template, Array $variables=null) {
        
        extract($variables); //Extrait les variable contenu dans $variables
        
        //On affiche la vue
        return require_once ROOT.'/templates'.$template;
    }
    
    /**
     * @param String $table
     * @return void
     */
    protected function getTable(String $table) {
        $class = '\Src\Table\\' . ucfirst($table) . 'Table';
        $this->$table = new $class();
    }
}