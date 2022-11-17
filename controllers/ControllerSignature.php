<?php
require_once('views/View.php');
class ControllerSignature
{

    private $factureManager;
    private $view;

    public function __construct($url)
    {

        if (isset($url)) {

            if (count((array)$url) > 1) {

                throw new Exception('Page introuvable');
            } else {

                $this->signes();
            }
        } else {

            $this->signes();
        }
    }


    public function signes()
    {

        $this->factureManager = new FactureManager;
        $factures = $this->factureManager->getFactures();
        $this->view = new View('Signature');
        $this->view->generate(array('factures' => $factures));
    }
}
