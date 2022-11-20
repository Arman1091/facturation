<?php
require_once('views/View.php');
class ControllerExpedition
{
    private $chequeManager;
    private $view;

    public function __construct($url)
    {

        $this->expedition();
    }


    public function expedition()
    {
        $this->chequeManager = new ChequeManager;
        $cheques = $this->chequeManager->getChequesAttantes("statutChequeSignature",1);
        $this->view = new View('Expedition');
        $this->view->generate(array('cheques' => $cheques));
    }
}
