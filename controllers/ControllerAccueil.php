<?php

require_once('views/View.php');
require_once('models/includes/functions.php');
class ControllerAccueil
{
    private $societeManager;
    private $view;

    public function __construct($url)
    {
        $this->accueil();

    }


    private function accueil()
    {
  
        $this->societeManager = new SocieteManager;

        
        $societes = $this->societeManager->getSocietes();
        usort($societes, 'cmp');
        $this->view = new View('Accueil');
        $this->view->generate(array(
            'societes' => $societes,
        ));
    }
}
