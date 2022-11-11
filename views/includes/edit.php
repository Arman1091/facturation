<?php
require_once "../models/Element.php";
require_once "../models/Model.php";
require_once "../models/EditManager.php";
require_once "View.php";
require_once "viewEdit.php";
if (!empty($_POST)) {

    //On vérifie que tout les champs requis son remplis
    if (
        isset(
            $_POST['rowid'],
        ) &&
        !empty($_POST['rowid'])
    ) {
        if (!filter_var($_POST['rowid'], FILTER_VALIDATE_INT)) {
            die("Id est incorrect");
        }
        $rowId = $_POST['rowid'];
        $editManager = new EditManager;
        $printeEdite = $editManager->getEditPrinte($rowId);
        $view = new View('Accueil');

        $view->generate(array('printee' => $printeEdite));
    }
}
