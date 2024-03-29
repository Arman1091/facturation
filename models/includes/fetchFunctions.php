<?php
//chargement automatique classes
spl_autoload_register(function ($class) {
    require_once('../' . $class . '.php');
});

if (
    isset(
        $_POST['societe'],
        $_POST['numeroFacture'],
        $_POST['montantLettres'],
        $_POST['montant'],
        $_POST['dateFacture'],
        $_POST['statutSubmit'],
    ) &&
    !empty($_POST['societe'])  && !empty($_POST['numeroFacture']) && !empty($_POST['montantLettres']) 
    && !empty($_POST['montant']) && !empty($_POST['dateFacture'])
) {
    //protection des données
    try {
        $societe_id = htmlspecialchars(strip_tags($_POST['societe']));
        $numero_facture = htmlspecialchars(strip_tags($_POST['numeroFacture']));
        $montant = htmlspecialchars(strip_tags($_POST['montant']));
        $montant_lettres = htmlspecialchars(strip_tags($_POST['montantLettres']));
        $date_facture = htmlspecialchars(strip_tags($_POST['dateFacture']));
        $statut = htmlspecialchars(strip_tags($_POST['statutSubmit']));
        $instance = new Facture([
            "dateFacture" => $date_facture,
            "fkSociete" => $societe_id,
            "numeroFacture" =>  $numero_facture,
            "montantFacture" => $montant,
            "montantLettresFacture" => $montant_lettres,
            "statutFacture" => $statut
        ]);
        $msg ="";
        $factureManager = new FactureManager;
        if($factureManager->newFacture($instance)){
            if($statut){
                $msg = "impression/enregistrement effectué avec success";
            }else{
                $msg = "enregistrement effectué avec success";
            }
        } 
        echo $msg;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
if (isset($_POST['chackFacture']) && !empty($_POST['chackFacture'])) {
    try {
        //protection des données
        $numeroFacture = htmlspecialchars(strip_tags($_POST['chackFacture']));
        $factureManager = new FactureManager; //new objet de FactureManager
        $facture = $factureManager->getFacture($numeroFacture); //appel la methode getFacture()
        $msg = "";
        if (!empty($facture)) {
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
        $cheque = $chequeManager->getCheque($numeroCheque); //appel la methode getFacture()
        $msg = "";
        if (!empty($cheque)) {
            //ici on a déja une facture avec cette numero
            $msg = "cette cheque existe déjà";
        }
        echo $msg;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}


// if (isset($_POST['numeroCheque'] ,$_POST['dateCheque'],$_POST['fkFacture']) && !empty($_POST['numeroCheque']) && !empty($_POST['dateCheque']) && !empty($_POST['fkFacture'])) {
//     try {
//        //protection des données
//         $numeroCheque = htmlspecialchars(strip_tags($_POST['chackCheque']));
//         $dateCheque = htmlspecialchars(strip_tags($_POST['dateCheque']));
//         $fkFacture = htmlspecialchars(strip_tags($_POST['fkFacture']));
//         $chequeManager = new ChequeManager; //new objet de chequeManager
//         $chequeManager->newCheque($numeroCheque, $dateCheque ,$fkFacture);//crée nouvelle cheque
//         $msg = "";
//         if(!empty($cheque)){
//            //ici on a déja une facture avec cette numero
//             $msg = "cette cheque existe déjà";
//         }
//         echo $msg;
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//         die();
//     }
// }


if (
    isset($_POST['chequeAnnulation'], $_POST['chequeDescription'])
    && !empty($_POST['chequeAnnulation']) && !empty($_POST['chequeDescription'])
) {
    try {
        $nCheque = strip_tags($_POST['chequeAnnulation']);
        $description = strip_tags($_POST['chequeDescription']);
        $chequeManager = new ChequeManager;
        $msg = "";
        if ($chequeManager->annuler($nCheque, $description)) {
            $msg = "annulation éfectué";
        }
        echo $msg;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

if (isset($_POST['change']) && !empty($_POST['change'])) { //verification si tout les infos attendus sont présent

    try {
        $id = htmlspecialchars(strip_tags($_POST['change']));
        $_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
        $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql2 = 'SELECT bnq.courtNomBanque, bnq.adresseBanque,bnq.cpBanque, bnq.cpBanque,
                         bnq.villeBanque,bnq.telBanque FROM `societe` AS soc
                INNER JOIN `banque` AS bnq
                ON soc.fkBanque = bnq.id
                WHERE soc.id=:id';
        $req = $_bdd->prepare($sql2);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if ($data->countRow()) { //verifie si y'a un banque 
            $data_json = $data;
            echo ($data_json);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
