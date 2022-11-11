<?php

require_once('views/View.php');
class ControllerImpression
{

    private $impressionManager;
    private $societeManager;
    private $view;

    public function __construct($url)
    {

        if (isset($url)) {

            if (count((array)$url) > 1) {

                throw new Exception('Page introuvable');
            } else {

                $this->printes();
            }
        } else {

            $this->printes();
        }
    }


    public function printes()
    {
        $this->impressionManager = new FactureManager;
        $this->societeManager = new SocieteManager;
        $factures = $this->impressionManager->getFacturesAttantes();
        $societes = $this->societeManager->getSocietes();
        $this->view = new View('Impression');
        $this->view->generate(array('factures' => $factures,
                                    'societes' => $societes,));
    }
}
