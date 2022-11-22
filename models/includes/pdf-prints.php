<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');//inclure des fichier par des class
});

if (isset($_POST['printCheckItems']) 
    && !empty($_POST['printCheckItems']))  {
    try {

        $data = $_POST['printCheckItems'];
        $sociteManager = new SocieteManager;//inctance de la class SociteManager
        $factureManager = new FactureManager;
        for($i = 0; $i < count($data); $i++){
            $facture = $factureManager->getFacture($data[$i]);
            $societe = $sociteManager->getSociete($facture ->fkSociete());// get societe par id
        
        echo '
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width:800px">
            <div class="row" style="width:800px;">
                <div class="col-8">
                    <div>
                       <p id="montat_lettre" style="margin-left:50px">'. $facture->getMontantLettres().'</p>
                    </div>
                    <div>
                    <p id="societeNom">'.$societe->nom().'</p>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-6">
                            <p>ETOILS SECOURS</p>
                            <p>120 RUE LUCIEN DEVAUX</p>
                            <p>17420 SAINT-PALAIS-SUR-MER</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <p id="somme_shifre" class="text-center"style="padding: 10px;">'.$facture->getMontantLettres().'</p>
                        <p>SAINT-PALAIS-SUR-MER</p>
                        <p>'.date("d/m/y").'</p>
                    </div>
                </div>
            </div>
         </div> 
         <div class="html2pdf__page-break"></div>
         ';
    }
  
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
