<?php
require_once('views/View.php');
class ControllerExpedition
{
    private $expeditionManager;
    private $view;

    public function __construct($url)
    {

        if (isset($url)) {

            if (count((array)$url) > 1) {

                throw new Exception('Page introuvable');
            } else {

                $this->envois();
            }
        } else {

            $this->envois();
        }
    }


    public function envois()
    {
        $this->envoiManager = new EnvoiManager;
        $envois = $this->envoiManager->getAllEnvois();
        $this->view = new View('Envoi');
        $this->view->generate(array('envois' => $envois));
    }
}
