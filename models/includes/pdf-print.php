<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once('../'.$class . '.php');
});

if (1==1) {
    try {

        $id= strip_tags(htmlspecialchars($_POST['socId']));
        $montantLettres = strip_tags(htmlspecialchars($_POST['montantLettres']));
        $montant = strip_tags(htmlspecialchars($_POST['montant']));

        $sociteManager = new SocieteManager;
       $societe = $sociteManager->getSociete($id);
      
          

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
