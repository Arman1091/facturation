<?php
require_once('views/View.php');
class ControllerSignature
{

    private $factureManager;
    private $view;

    public function __construct($url)
    {
        $this->signature();
    }


    public function signature()
    {
        $this->factureManager = new FactureManager;
        $factures = $this->factureManager->getFacturesAttantes(1,0);
        $this->view = new View('Signature');
        $this->view->generate(array('factures' => $factures));
    }
}
