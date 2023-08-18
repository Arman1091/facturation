<?php
$societeManager = new SocieteManager;
?>
<div class="container">
    <div id="serachForm" class="d-flex justify-content-end mt-2">
         <label class="mx-2" for="site-search"><strong>Search avec Societe/N_fact</strong></label>
         <input class="sitesearch" type="search" id="sitesearch" name="site-search">
    </div>
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
                <th scope="col">Expedition</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($cheques); $i++) {
                $facture = $cheques[$i]->getFacture();
                $fk_soc = $facture ->fkSociete();
                $societe = $societeManager->getSociete($fk_soc);
                $banque = $societe->getBanque();
            ?>

                <tr>
                    <th scope="row"><?= ($i + 1) ?></th>
                    <td><?= $facture->numero() ?></td>
                    <td><?= $facture->date() ?></td>
                    <td><?= $societe->nom() ?></td>
                    <td><?= $banque->nom() ?></td>
                    <td><?= $facture->montant() ?></td>
                    <td><?= $cheques[$i]->numero()?></td>
                    <td><?= $cheques[$i]->date()?></td>
                    <td><?= $cheques[$i]->dateSignature()?></td>
                    <td><?= $cheques[$i]->dateExpedition()?></td>
                    <td>
                        <?php if ($cheques[$i]->statutExpedition()) { ?>

                            <span>
                                <img src="assets/icons/succer.png" alt="" style="width:45px ;"> 
                            </span>
                        <?php  } elseif($cheques[$i]->statutExpedition() !==NULL) { 
                            ?>
                            <h1></h1>
                            <span>
                                <img src="assets/icons/annulation.png" alt="" style="width:28px ;" onmouseover="afficherDescription('divDescription<?= $i ?>')" onmouseout="desafficherDescription('divDescription<?= $i ?>')"> 
                            </span>
                                <div class="mt-2">
                                     <p id="divDescription<?= $i ?>" class="text-danger" style="display: none;"><?= $cheques[$i]->description() ?></p>
                                 </div> 

                        <?php } ?>



                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>