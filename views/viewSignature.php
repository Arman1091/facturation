<?php
$societeManager = new SocieteManager;
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
                    <tr>
                        <td name="y<?= $i ?>"><input class="checkitem" type="checkbox" name=checkitems[] value="<?= $factures[$i]->numero()?>"></td>
                        <th scope="row"><?= ($i + 1) ?></th>
                        <td><?= $factures[$i]->numero()?></td>
                        <td><?= $factures[$i]->date()?></td>
                        <td><?= $societe->nom() ?></td>
                        <td><?= $banque->nom() ?></td>
                        <td><?= $factures[$i]->montant()?></td>
                        <td><input class="td-input " value=""type="text" id="numeroCheque" name="numeroCheque" ></td>
                        <td><input class="td-input"value="" type="date" id="dateCheque" name="dateCheque"></td>
                        <td>
                        
                                <input type="checkbox" id="tt" data-toggle="toggle" name="statut_check" data-onstyle="outline-primary" data-offstyle="outline-secondary" onchange="toggleCheckbox('form_check<?= $i ?>')">
                    
                        </td>
                        <td class="d-flex">
                          
                    
                                <button type="submit" class="btn btn-danger">Delete</button>
             

                        </td>
                    </tr>
                    <?php }
                    } ?>
            </tbody>
        </table>
        <div>
            <button type="submit" class="btn btn-primary" name="deleteOrPrint" value=0>Signer</button>
            <button type="submit" class="btn btn-danger" name="deleteOrPrint" value=1>Delete</button>
        </div>
    </form>
</div>