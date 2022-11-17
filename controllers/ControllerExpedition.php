<?php
require_once('views/View.php');
class ControllerExpedition
{
    private $chequeManager;
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
        $this->chequeManager = new ChequeManager;
        $cheques = $this->chequeManager->getChequesAttantes("statutChequeSignature",0);
        $this->view = new View('Expedition');
        $this->view->generate(array('cheques' => $cheques));
    }
}
