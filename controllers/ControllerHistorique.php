<?php
require_once('views/View.php');
class ControllerHistorique
{
    private $historiqueManager;
    private $view;

    public function __construct($url)
    {

        if (isset($url)) {

            if (count((array)$url) > 1) {

                throw new Exception('Page introuvable');
            } else {

                $this->historiques();
            }
        } else {

            $this->historiques();
        }
    }


    public function historiques()
    {
        $this->historiqueManager = new HistoriqueManager;
        $elementsHistorique = $this->historiqueManager->getHistoriques();
        $this->view = new View('Historique');
        $this->view->generate(array('elementsHistorique' =>  $elementsHistorique));
    }
}
