<?php

$societeManager = new SocieteManager;


?>
<div class="container">
    <form method="post">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">

                        <input type="checkbox" name="selectAll" id="selectAll" class="selectAll">

                    </th>
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
                        <td ><input class="checkitem" type="checkbox" name=checkitems[] value="<?= $facture->numero()?>"></td>
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
                          
                    
                                <button type="submit" class="btn btn-danger">Annuler</button>
                                <button type="submit" class="btn btn-primary mx-1">Envoyer</button>
             

                        </td>
                    </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </form>
</div>
<!-- <div>
    <form id="descriptionForm" name="descriptionForm" method="post">

        <h1 id="ee" class="text-center">Ajouter une raison </h1>
        <div class="d-flex justify-content-center">
            <textarea name="description" id="description" cols="30" rows="10" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;"></textarea>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <input type="hidden" id="rowDescription" name="rowDescription" value="">
            <button class="mx-2" class="btn btn-primary" type='button' name="ok" onclick="envoyerDescription()">Ok</button>
            <button class="btn btn-danger" type='button' onclick="annulerDescription()">Annuler</button>
        </div>

    </form>
</div> -->