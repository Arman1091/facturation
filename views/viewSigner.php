<?php

$societeManager = new SocieteManager;
$paiementManager = new PaiementManager;
?>
<div class="container">
    <form action="" method="post">
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
                    <th scope="col">Signer</th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($signes); $i++) {
                    $fk_soc = (int) $signes[$i]->FkSoc();
                    $paiementId = (int)$signes[$i]->FkPaiement();
                    $societe = $societeManager->getSociete($fk_soc);
                    $paiement = $paiementManager->getPaiement($paiementId);
                    $arr = explode("_", $signes[$i]->NCheque());

                ?>
                    <tr>
                        <td name="y<?= $i ?>"><input class="checkitem" type="checkbox" name=checkitems[] value="<?= $signes[$i]->id() ?>"></td>
                        <th scope="row"><?= ($i + 1) ?></th>
                        <td><?= $signes[$i]->DateCheque() ?></td>
                        <td><?= $societe->nom() ?></td>
                        <td><?= $signes[$i]->NFact() ?></td>
                        <td><?= $signes[$i]->Montant() ?></td>
                        <td><?= $paiement->type() ?></td>
                        <td><?= 25 ?></td>
                        <td>
                            <form method="post" id='form_check<?= $i ?>' name="form_check">
                                <input type="hidden" name="rowId" value=<?= $signes[$i]->id() ?>>
                                <input type="hidden" name="fk_soc" value=<?= $signes[$i]->FkSoc() ?>>
                                <input type="hidden" name="banque_court" value=<?= $arr[0] ?>>
                                <input type="hidden" name="n_cheque" value=<?= $arr[1] ?>>
                                <input type="checkbox" id="tt" data-toggle="toggle" name="statut_check" data-onstyle="outline-primary" data-offstyle="outline-secondary" onchange="toggleCheckbox('form_check<?= $i ?>')">
                            </form>
                        </td>
                        <td class="d-flex">
                            <form action="delete.php" method="post">
                                <input type="hidden" name="rowid" value="<?= $signes[$i]->id() ?>">
                                <a href="" type="button" class="btn btn-secondary">Edit</a>
                            </form>
                            <form class="mx-1" action="delete.php" method="post">
                                <input type="hidden" name="rowid" value="<?= $signes[$i]->id() ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
            <button type="submit" class="btn btn-primary" name="deleteOrPrint" value=0>Signer</button>
            <button type="submit" class="btn btn-danger" name="deleteOrPrint" value=1>Delete</button>
        </div>
    </form>
</div>