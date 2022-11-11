<?php

$societeManager = new SocieteManager;
$paiementManager = new PaiementManager;

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
                    <th scope="col">Date_cheque</th>
                    <th scope="col">Societe</th>
                    <th scope="col">N_fact</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Mode de paiement</th>
                    <th scope="col">N_cheque</th>
                    <th scope="col">Signée</th>

                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($envois)) {
                    for ($i = 0; $i < count($envois); $i++) {
                        $fk_soc = (int) $envois[$i]->FkSoc();
                        $paiementId = (int)$envois[$i]->FkPaiement();
                        $societe = $societeManager->getSociete($fk_soc);
                        $paiement = $paiementManager->getPaiement($paiementId);
                        $arr = explode("_", $envois[$i]->NCheque());
                ?>

                        <tr>
                            <td name="y<?= $i ?>"><input class="checkitem" type="checkbox" name=checkitems[] value="<?= $envois[$i]->id() ?>"></td>
                            <th scope="row"><?= ($i + 1) ?></th>
                            <td><?= $envois[$i]->DateCheque() ?></td>
                            <td><?= $societe->nom() ?></td>
                            <td><?= $envois[$i]->NFact() ?></td>
                            <td><?= $envois[$i]->Montant() ?></td>
                            <td><?= $paiement->type() ?></td>
                            <td><?= $envois[$i]->NCheque() ?></td>
                            <td>
                                <input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary">
                                <span><?= $envois[$i]->DateSigner() ?></span>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="rowId" value=" <?= $envois[$i]->id() ?>">
                                    <button class="btn btn-primary" type='submit' name="envayer">Envayer</button>
                                    <button class="btn btn-danger" type='button' name="annuler" value=<?= $envois[$i]->id() ?> onclick="description(<?= $envois[$i]->id() ?>)">Annuler</button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </form>
</div>
<div>
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
</div>