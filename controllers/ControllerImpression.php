<?php

require_once('views/View.php');
class ControllerImpression
{

    private $impressionManager;
    private $societeManager;
    private $view;

    public function __construct($url)
    {
        $this->impression();
    }


    public function impression()
    {
        $this->impressionManager = new FactureManager;
        $this->societeManager = new SocieteManager;
        $factures = $this->impressionManager->getFacturesAttantes(0 ,0);
        $societes = $this->societeManager->getSocietes();
        $this->view = new View('Impression');
        $this->view->generate(array('factures' => $factures,
                                    'societes' => $societes,));
    }
}
