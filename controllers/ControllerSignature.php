<?php
require_once('views/View.php');
class ControllerSignature
{

    private $signatureManager;
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

        $this->signatureManager = new SignatureManager;
        $signes = $this->signatureManager->getArticles();
        $this->view = new View('Signature');
        $this->view->generate(array('signes' => $signes));
    }
}
