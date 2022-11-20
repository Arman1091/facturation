<?php
require_once('views/View.php');
class ControllerHistorique
{
    private $chequeManager;
    private $view;

    public function __construct($url)
    {
        $this->historique();
    }


    public function historique()
    {
        $this->chequeManager= new ChequeManager;
        $cheques = $this->chequeManager->getChequesComplets();
        $this->view = new View('Historique');
        $this->view->generate(array('cheques' => $cheques));
    }
}
