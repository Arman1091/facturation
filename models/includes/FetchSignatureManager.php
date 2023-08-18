<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');
});


if (isset($_POST['searchSignature'])) {
    //ici $_POST['search'] exist
    try {
        $searchValue = htmlspecialchars(strip_tags($_POST['searchSignature']));
        $factureManager = new FactureManager;
        if (!empty($_POST['searchSignature'])) {
            //value n'est pas vide
            $factures = $factureManager->getFacturesByFiltre(1,0,$searchValue);
        } else {
            //value est  vide
            $factures = $factureManager->getFacturesAttantes(1,0);
        }  
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
};

if (
    isset($_POST['numeroCheque'], $_POST['dateCheque'], $_POST['numeroFacture'],)
    && !empty($_POST['numeroCheque'])  && !empty($_POST['numeroFacture'])&& !empty($_POST['dateCheque'])
) {

    $numeroCheque = htmlspecialchars(strip_tags($_POST['numeroCheque']));
    $numeroFacture = htmlspecialchars(strip_tags($_POST['numeroFacture']));
    $dateCheque = htmlspecialchars($_POST['dateCheque']);
    $description = ""; 
    $statutSignatuer = 1;//c'est la creation avec signature
    $chequeManager = new ChequeManager; //new objet de chequeManager
    $factureManager = new FactureManager;
    $chequeManager->newCheque($numeroCheque, $dateCheque ,$statutSignatuer ,
                              $description ,$numeroFacture);//crée nouvelle cheque
    $factureManager->editFacture($numeroFacture,'statutChequeFacture', 1);
    $factures = $factureManager->getFacturesAttantes(1,0);
}

if (
    isset($_POST['numero_cheque'], $_POST['date_cheque'], $_POST['numero_facture'], $_POST['motif'])
    && !empty($_POST['numero_cheque'])  && !empty($_POST['numero_facture']) && !empty($_POST['date_cheque'])
    && !empty($_POST['motif'])) {

    $numeroCheque = htmlspecialchars(strip_tags($_POST['numero_cheque']));
    $numeroFacture = htmlspecialchars(strip_tags($_POST['numero_facture']));
    $dateCheque = htmlspecialchars($_POST['date_cheque']);
    $description = htmlspecialchars($_POST['motif']); 
    $statutSignatuer = 0;//c'est la creation avec signature
    $chequeManager = new ChequeManager; //new objet de chequeManager
    $factureManager = new FactureManager;
    $chequeManager->newCheque($numeroCheque, $dateCheque ,$statutSignatuer ,
                              $description ,$numeroFacture);//crée nouvelle cheque
    $factureManager->editFacture($numeroFacture,'statutChequeFacture', 1);
    $factures = $factureManager->getFacturesAttantes(1,0);
}


if (isset($_POST['deleteRow']) && !empty($_POST['deleteRow'])) {
    try {
        //protection des données
        $nFact = strip_tags($_POST['deleteRow']);
        $factureManager = new FactureManager;//un ictance fe Facture Manager
        if($factureManager->deleteFacture($nFact)){
            $msg = "supression réussie";//supresion réussie
        } else {
            $msg = "supression échouée";//supresion échouée
        }
         if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
            //ici la value de recherche n'est pad vide
             $searchValue = htmlspecialchars(strip_tags($_POST['searchValue']));
            //  récupération les factures filtrés
             $factures = $factureManager->getFacturesByFiltre(1,0,$searchValue);
         }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}




if (isset($_POST['deleteCheckItems']) && !empty($_POST['deleteCheckItems'])) {
    try {
        $data =$_POST['deleteCheckItems'];

        $factureManager = new FactureManager;
        for($i = 0; $i < count($data); $i++){
            $factureManager->deleteFacture($data[$i]);
        }
   
        if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
            $searchValue = htmlspecialchars(strip_tags($_POST['searchValue']));
            $factures = $factureManager->getFacturesByFiltre(1,0,$searchValue);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
if (isset($_POST['changPrintsStatus']) && !empty($_POST['changPrintsStatus'])) {
    try {
        //$_POST['changPrintsStatus'] exist
        $data =$_POST['changPrintsStatus'];
        $factureManager = new FactureManager;
        for($i = 0; $i < count($data); $i++){
            //pour tout les facture on change le statut
            $numroFacture = $data[$i];
            $factureManager->editFacture($numroFacture,"statutFacture",1);  
        }
        //recuperation des facture non imprimées
        $factures = $factureManager->getFacturesAttantes(1,0);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

if(!isset($factures)){ 
    $factureManager = new FactureManager;
    $factures = $factureManager->getFacturesAttantes(1,0);
}
$societeManager = new SocieteManager;
$societes = $societeManager->getSocietes();

$str = ''; 
if ($factures) {
    for ($i = 0; $i < count($factures); $i++) {
        $fk_societe = (int) $factures[$i]->fkSociete();
        $societe = $societeManager->getSociete($fk_societe);
        $banque = $societe->getBanque();
        $str.= '<tr>
            <td>'. ($i + 1).'</td>
            <td>'.$factures[$i]->numero().'</td>
            <td>'.$factures[$i]->date().'</td>
            <td>'.$societe->nom().'</td>
            <td>'.$banque->nom().'</td>
            <td>'.$factures[$i]->montant().'</td>
            <td>
                <input class="td-input" type="text" id="numeroCheque" name="numeroCheque" >
                <small class="text-danger"></small>
            </td>
            <td>
                <input class="td-input" type="date" class="dateCheque" name="dateCheque">
            </td>
            <td>
            <input type="checkbox" class="checkBoxSignature" data-toggle="toggle" name="statut_check" data-onstyle="outline-primary" data-offstyle="outline-secondary" onchange="toggleCheckbox("'.$i.'")">
            </td>
            <td class="d-flex">      
                <button type="submit" class="btn btn-danger" onclick="descriptionSignature("'.$factures[$i]->numero().'")">Delete</button>
            </td>
        </tr>';
    }
} ;
            echo $str;