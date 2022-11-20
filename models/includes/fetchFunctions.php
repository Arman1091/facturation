<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');
});

 if (isset($_POST['chackFacture']) && !empty($_POST['chackFacture'])) {
     try {
        //protection des données
         $numeroFacture = htmlspecialchars(strip_tags($_POST['chackFacture']));
         $factureManager = new FactureManager; //new objet de FactureManager
         $facture = $factureManager->getFacture($numeroFacture );//appel la methode getFacture()
         $msg = "";
         if(!empty($facture)){
            //ici on a déja une facture avec cette numero
             $msg = "cette facture existe déjà";
         }
         echo $msg;
     } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();
         die();
     }
 }
 if (isset($_POST['chackCheque']) && !empty($_POST['chackCheque'])) {
    try {
       //protection des données
        $numeroCheque = htmlspecialchars(strip_tags($_POST['chackCheque']));
        $chequeManager = new ChequeManager; //new objet de FactureManager
        $cheque= $chequeManager->getCheque($numeroCheque  );//appel la methode getFacture()
        $msg = "";
        if(!empty($cheque)){
           //ici on a déja une facture avec cette numero
            $msg = "cette cheque existe déjà";
        }
        echo $msg;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}


if (isset($_POST['numeroCheque'] ,$_POST['dateCheque'],$_POST['fkFacture']) && !empty($_POST['numeroCheque']) && !empty($_POST['dateCheque']) && !empty($_POST['fkFacture'])) {
    try {
       //protection des données
        $numeroCheque = htmlspecialchars(strip_tags($_POST['chackCheque']));
        $dateCheque = htmlspecialchars(strip_tags($_POST['dateCheque']));
        $fkFacture = htmlspecialchars(strip_tags($_POST['fkFacture']));
        $chequeManager = new ChequeManager; //new objet de chequeManager
        $chequeManager->newCheque($numeroCheque, $dateCheque ,$fkFacture);//crée nouvelle cheque
        $msg = "";
        if(!empty($cheque)){
           //ici on a déja une facture avec cette numero
            $msg = "cette cheque existe déjà";
        }
        echo $msg;
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
        }
        echo $msg;
     
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
if (isset($_POST['chequeAnnulation'],$_POST['chequeDescription']) 
    && !empty($_POST['chequeAnnulation']) && !empty($_POST['chequeDescription'])) {
    try {
        $nCheque= strip_tags( $_POST['chequeAnnulation']);
        $description = strip_tags( $_POST['chequeDescription']);
        $chequeManager = new ChequeManager;
        $msg ="";
        if($chequeManager->annuler($nCheque, $description)){
            $msg = "annulation éfectué";
        }
        echo $msg;
     
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}