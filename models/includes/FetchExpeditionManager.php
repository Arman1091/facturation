<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');
});


if (isset($_POST['search'])) {
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
    isset($_POST['chequeAnnulation'], $_POST['motif'])
    && !empty($_POST['chequeAnnulation']) && !empty($_POST['motif'])) 
    {

    $numeroCheque = htmlspecialchars(strip_tags($_POST['chequeAnnulation']));
    $description = htmlspecialchars($_POST['motif']); 
    $chequeManager = new ChequeManager; //new objet de chequeManager
    $chequeManager->annuler($numeroCheque, $description );
    $cheques = $chequeManager->getChequesComplets();
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

if (isset($_POST['chequeExpedition']) && !empty($_POST['chequeExpedition'])) {

    try {
        $nCheque= strip_tags( $_POST['chequeExpedition']);
        $chequeManager = new ChequeManager;
        $msg ="";
        if($chequeManager->expedier($nCheque)){
            $msg = "expedition éfectué";
            $factureManager = new FactureManager;
            $factures = $factureManager->getFacturesAttantes(1,0);
        }
        echo $msg;
     
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

$str = ''; 
$societeManager = new SocieteManager;
if (isset($cheques)) {
    for ($i = 0; $i < count($cheques); $i++) {
        $facture = $cheques[$i]->getFacture();
        $fkSoc =$facture->fkSociete();
        $societe = $societeManager->getSociete($fkSoc);
        $banque = $societe->getBanque();

   $str.= '<tr class="tr'.$i.'">
        <th scope="row">'.($i + 1).'</th>
        <td>'. $facture->numero().'</td>
        <td>'.$facture->date().'</td>
        <td>'.$societe->nom().'</td>
        <td>'.$banque->nom().'</td>
        <td>'.$facture->montant().'</td>
        <td>'.$cheques[$i]->numero().'</td>
        <td>'.$cheques[$i]->date().'</td>
        <td>'.$cheques[$i]->dateSignature().'</td>
        <td class="d-flex">
            <button type="button" class="btn btn-danger" onclick="annulerExpedition("tr'.$i.'")" >Annuler</button>
            <button type="button" class="btn btn-primary mx-1" onclick="envoyerExpedition("tr'.$i.'")" >Envoyer</button>
        </td>
    </tr>';
 }
} 
 echo $str;