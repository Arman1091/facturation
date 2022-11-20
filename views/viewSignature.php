<?php
$societeManager = new SocieteManager;
?>
<div class="container">
<div class="d-flex justify-content-end mt-3 mx-3">
            <div id="serachForm">
                <label class="mx-2" for="site-search"><strong>Search avec Societe/N_fact</strong></label>

                <input class="sitesearch" type="search" id="sitesearch" name="site-search">
</div>


        </div>
        <table class="table table-sm" id="tableSignature">
            <thead>
                <tr>
                    <th scope="col">N°Facture</th>
                    <th scope="col">Date Facture</th>
                    <th scope="col">Societe</th>
                    <th scope="col">Banque</th>
                    <th scope="col">Montant</th>
                    <th scope="col">N°Cheque</th>
                    <th scope="col">Montant Cheque</th>
                    <th scope="col">Signature</th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                <?php       
                if ($factures) {
                        for ($i = 0; $i < count($factures); $i++) {

                            $fk_societe = (int) $factures[$i]->fkSociete();
                            $societe = $societeManager->getSociete($fk_societe);
                            $banque = $societe->getBanque();

                    

                ?>
                    <tr class= "tr<?= $i ?>">
                        <td><?= $factures[$i]->numero()?></td>
                        <td><?= $factures[$i]->date()?></td>
                        <td><?= $societe->nom() ?></td>
                        <td><?= $banque->nom() ?></td>
                        <td><?= $factures[$i]->montant()?></td>
                        <td>
                            <input class="td-input" type="text" id="numeroCheque" name="numeroCheque" >
                            <small class="text-danger"></small>
                        </td>
                        <td><input class="td-input"value="" type="date" class="dateCheque" name="dateCheque"></td>
                        <td>
                                <input type="checkbox" class="checkBoxSignature" data-toggle="toggle" name="statut_check" data-onstyle="outline-primary" data-offstyle="outline-secondary" onchange="toggleCheckbox('tr<?= $i ?>')">
                    
                        </td>
                        <td class="d-flex">
                          
                    
                                <button type="submit" class="btn btn-danger">Delete</button>


                        </td>
                    </tr>
                    <?php }
                    } ?>
            </tbody>
        </table>
        
        <div class="mt-3"id="msgDiv">
                 <h6 class="p-2" id="msg"></h6>
         </div>

</div>