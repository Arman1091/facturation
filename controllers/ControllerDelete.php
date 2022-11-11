<?php
require_once('views/View.php');
class ControllerDelete
{
    private $elementManager;

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
        $this->elementManager->DeleteElement($_POST['rowid']);
        // $this->printManager = new PrinteManager;
        // $printes = $this->printManager->getArticles();
        // require_once('ControllerPrinte.php');
        // $this->view = new View('Printe');
        // $this->view->generate(array('printes' => $printes));;
        header('Location:' . URL . 'printe');
    }
}
