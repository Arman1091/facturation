<?php

$societeManager = new SocieteManager;


?>
<div class="container">
   <div class="serachForm mt-2 d-flex justify-content-end">
        <label class="mx-2" for="site-search"><strong>Search avec Societe/N_fact</strong></label>
         <input class="sitesearch" type="search" id="sitesearch" name="site-search">
   </div>
    <form method="post" class="mx-1">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">N°Facture</th>
                    <th scope="col">Date Facture</th>
                    <th scope="col">Societe</th>
                    <th scope="col">Banque</th>
                    <th scope="col">Montant</th>
                    <th scope="col">N°Cheque</th>
                    <th scope="col">Date Cheque</th>
                    <th scope="col">Signature</th>
                    <th scope="col"> </th>

                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($cheques)) {
                    for ($i = 0; $i < count($cheques); $i++) {
                        $facture = $cheques[$i]->getFacture();
                        $fkSoc =$facture->fkSociete();
                        $societe = $societeManager->getSociete($fkSoc);
                        $banque = $societe->getBanque();
                        // $paiementId = (int)$envois[$i]->FkPaiement();
                       
                        // $paiement = $paiementManager->getPaiement($paiementId);
                        // $arr = explode("_", $envois[$i]->NCheque());
                ?>
                   <tr>
                        <th scope="row"><?= ($i + 1) ?></th>
                        <td><?= $facture->numero()?></td>
                        <td><?= $facture->date()?></td>
                        <td><?= $societe->nom() ?></td>
                        <td><?= $banque->nom() ?></td>
                        <td><?= $facture->montant()?></td>
                        <td><?= $cheques[$i]->numero()?></td>
                        <td><?= $cheques[$i]->date()?></td>
                        <td>
                        <?= $cheques[$i]->dateSignature()?></td>
                        <td class="d-flex">
                          
                    
                                <button type="button" class="btn btn-danger" >Annuler</button>
                                <button type="button" class="btn btn-primary mx-1" onclick="envoyerExpedition('<?= $cheques[$i]->numero()?>')" >Envoyer</button>
             

                        </td>
                    </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </form>
</div>
 <div id="descriptionDiv" name="descriptionDiv" style="display:none">
        <h1 class="text-center">Ajouter une raison </h1>
        <div class="d-flex justify-content-center">
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <input type="hidden" id="rowDescription" name="rowDescription" value="">
            <button class="mx-2" class="btn btn-primary" type='button' name="ok" onclick="envoyerDescription()">Ok</button>
            <button class="btn btn-danger" type='button' onclick="annulerDescription()">Annuler</button>
        </div>
</div>
<div class="mt-3"id="msgDiv">
                 <h6 class="p-2" id="msg"></h6>
         </div>