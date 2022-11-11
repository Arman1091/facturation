<?php

require_once('views/View.php');
require_once('models/includes/functions.php');
class ControllerAccueil
{
    private $societeManager;
    private $view;

    public function __construct($url)
    {
        if (isset($url)) {

            if (count((array)$url) > 1) {

                throw new Exception('Page introuvable');
            } else {

                $this->societes();
            }
        } else {

            $this->societes();
        }
    }


    private function societes()
    {
        $this->societeManager = new SocieteManager;
        $societes = $this->societeManager->getSocietes();
        usort($societes, 'cmp');
        $this->view = new View('Accueil');
        $this->view->generate(array(
            'societes' => $societes,
        ));
        // require_once 'views/viewsAccuil.php';
    }
}
