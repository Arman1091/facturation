<?php

class View
{
    private $file;
    private $_t;

    public function __construct($action)
    {
        $this->file = 'views/view' . $action . '.php';
    }
    //genére et affiche la vue
    public function generate($data)
    {


        //partie specifice de la vue
        $content = $this->generateFile($this->file, $data);

        //template
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }
    //genere un fichier vue  et ronvoie la résultat produit
    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception('Fichier ' . $file . ' introuvable');
        }
    }
}
