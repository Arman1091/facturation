<?php
$societeManager = new SocieteManager;
?>
<div class="container">
<div class="d-flex justify-content-end mt-3 mx-3">
            <div id="serachForm">
                <label class="mx-2" for="search-signature"><strong>Search avec Societe/N°Facture</strong></label>

                <input class="search-signature" type="search" id="search-signature" name="site-search">
             </div>


 </div>
 
        <table class="table-signature" id="tableSignature">
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
                </tr>
            </thead>
            <tbody class="tbodySignature">
                <?php       
                if ($factures) {
                    for ($i = 0; $i < count($factures); $i++) {
                        $fk_societe = (int) $factures[$i]->fkSociete();
                        $societe = $societeManager->getSociete($fk_societe);
                        $banque = $societe->getBanque();?>
                        <tr id ='tr<?= $i ?>'>
                            <td scope="row"><?= ($i + 1) ?></td>
                            <td><?= $factures[$i]->numero()?></td>
                            <td><?= $factures[$i]->date()?></td>
                            <td><?= $societe->nom() ?></td>
                            <td><?= $banque->nom() ?></td>
                            <td><?= $factures[$i]->montant()?></td>
                            <td>
                                <input class="td-input numeroCheque" type="text" name="numeroCheque" >
                                <small class="text-danger msg-cheque"></small>
                            </td>
                            <td>
                                <input class="td-input" type="date" class="dateCheque" name="dateCheque">
                            </td>
                            <td>
                                <input type="checkbox" class="checkBoxSignature" data-toggle="toggle" name="statut_check" data-onstyle="outline-primary" data-offstyle="outline-secondary" onchange="toggleCheckbox('tr<?= $i ?>')">
                            </td>
                            <td class="d-flex">      
                                <button type="submit" class="btn btn-danger" onclick="descriptionSignature('tr<?= $i ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
        <div class="mt-3"id="msgDiv">
                 <h6 class="p-2" id="msg"></h6>
         </div>
         <div id="descriptionSignatureDiv" name="descriptionDiv" style="display: none;" >
            <h1 class="text-center">Ajouter une raison </h1>
            <div class="d-flex justify-content-center">
                <textarea name="description" id="descriptionSignatureTextarea" cols="30" rows="10"></textarea>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <input type="hidden" id="signatureHiddenValue" name="rowDescription">
                <button class="mx-2" class="btn btn-primary" type='button' name="ok" onclick="envoyerSignatureDescription()">Ok</button>
                <button class="btn btn-danger" type='button' onclick="annulerSignatureDescription()">Annuler</button>
            </div>
         </div>
         
</div>