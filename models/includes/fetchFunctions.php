<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');
});

 if (isset($_POST['chackFacture']) && !empty($_POST['chackFacture'])) {
     try {
         $numeroFacture = htmlspecialchars(strip_tags($_POST['chackFacture']));
         $factureManager = new FactureManager;
         $facture =$factureManager->getFacture($numeroFacture );
         $msg = "";
         if(!empty($facture)){
             $msg = "cette facture existe déjà";
         }
         echo $msg;
     } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();
         die();
     }
 }
 if (isset($_POST['change']) && !empty($_POST['change'])) {
    try {
        $socId= $_POST['change'];
        $societeManager = new SocieteManager;
        $societe =$societeManager->getSociete($socId);
        $banque =$societe->getBanque();
        if(!$banque){
         $arr = [
             "id" => 25,
        
         ];
         $x = json_encode($arr);
        
        echo $x ;
        } else{
            echo json_encode("sdsd");
        }
 
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}