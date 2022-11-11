<?php

require_once('views/View.php');
class ControllerEdit
{
    private $elementManager;
    private $printManager;
    private $view;

    public function __construct($url)
    {

        if (isset($url)) {

            if (count((array)$url) > 1) {

                throw new Exception('Page introuvable');
            } else {

                $this->element();
            }
        } else {

            $this->element();
        }
    }


    public function element()
    {
        $this->elementManager = new ElementManager;
        $element = $this->elementManager->getEditElement($_POST['rowId']);
        $this->view = new View('Edit');
        $this->view->generate(array('elementEdit' =>  $element));;
    }
}
