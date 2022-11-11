<?php
$societeManager = new SocieteManager;
$paiementManager = new PaiementManager;
?>
<div class="container">
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">

                    <input type="checkbox" name="selectAll" id="selectAll" class="selectAll">

                </th>
                <th scope="col">Id</th>
                <th scope="col">Date_cheque</th>
                <th scope="col">Societe</th>
                <th scope="col">N_fact</th>
                <th scope="col">Montant</th>
                <th scope="col">Mode de paiement</th>
                <th scope="col">N_cheque</th>
                <th scope="col">Signée</th>
                <th scope="col">Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($elementsHistorique); $i++) {
                $fk_soc = (int) $elementsHistorique[$i]->FkSoc();
                $paiementId = (int)$elementsHistorique[$i]->FkPaiement();
                $societe = $societeManager->getSociete($fk_soc);
                $paiement = $paiementManager->getPaiement($paiementId);
                $arr = explode("_", $elementsHistorique[$i]->NCheque());
            ?>

                <tr>
                    <td name="y<?= $i ?>"><input class="checkitem" type="checkbox" name=checkitems[] value="<?= $elementsHistorique[$i]->id() ?>"></td>
                    <th scope="row"><?= ($i + 1) ?></th>
                    <td><?= $elementsHistorique[$i]->DateCheque() ?></td>
                    <td><?= $societe->nom() ?></td>
                    <td><?= $elementsHistorique[$i]->NFact() ?></td>
                    <td><?= $elementsHistorique[$i]->Montant() ?></td>
                    <td><?= $paiement->type() ?></td>
                    <td><?= $arr[1] ?></td>
                    <td>
                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary">
                        <span><?= $elementsHistorique[$i]->DateSigner() ?></span>
                    </td>
                    <td>
                        <?php if ($elementsHistorique[$i]->EnvoyerAnnuler() == 0) { ?>

                            <span>
                                <img src="assets/icons/succer.png" alt="" style="width:45px ;"> <?= $elementsHistorique[$i]->DateDepart() ?>
                            </span>
                        <?php  } else { ?>
                            <span>
                                <img src="assets/icons//annulation.png" alt="" style="width:28px ;" onmouseover="afficherDescription('divDescription<?= $i ?>')" onmouseout="desafficherDescription('divDescription<?= $i ?>')"> <?= $elementsHistorique[$i]->DateDepart() ?>
                            </span>
                            <div class="mt-2">
                                <p id="divDescription<?= $i ?>" class="text-danger" style="display: none;"><?= $elementsHistorique[$i]->Description() ?></p>
                            </div>

                        <?php } ?>



                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>