<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');
});

if (isset($_POST['socId'],$_POST['montantLettres'],$_POST['montant']) &&
    !empty($_POST['socId']) && !empty($_POST['montantLettres']) && !empty($_POST['montant'])) {
    try {

        $id= strip_tags(htmlspecialchars($_POST['socId']));
        $montantLettres = strip_tags(htmlspecialchars($_POST['montantLettres']));
        $montant = strip_tags(htmlspecialchars($_POST['montant']));

        $sociteManager = new SocieteManager;
        $societe = $sociteManager->getSociete($id);
        $banque = $societe->getBanque();
      
          
    
        echo '
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width:800px">
        <div class="row" style="width:800px;">
            <div class="col-8">
                <div>
                   <p id="montat_lettre" style="margin-left:50px">'. $montantLettres.'</p>
                </div>
                <div>
                <p id="societeNom">'.$societe->nom().'</p>
                </div>
                <div class="row d-flex justify-content-start">
                    <div class="col-6">
                        <p>'.$banque->adresse().'</p>
                        <p>'.$banque->cp().' '.$banque->ville().'</p>
                        <p> TEL: '.$banque->tel().'</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div>
                    <p id="somme_shifre" class="text-center"style="padding: 10px;">'.$montant.'</p>
                    <p>SAINT-PALAIS-SUR-MER</p>
                    <p>'.date("d/m/y").'</p>
                </div>
            </div>
        </div>
  </div>
        ';
  
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
