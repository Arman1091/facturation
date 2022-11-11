<?php
require_once('views/View.php');
class ControllerSigner
{
    private $signeManager;
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
        $this->signeManager = new SignerManager;
        $signes = $this->signeManager->getArticles();
        $this->view = new View('Signer');
        $this->view->generate(array('signes' => $signes));
    }
}
