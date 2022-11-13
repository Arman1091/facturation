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
                    <th scope="col">Numero Facture</th>
                    <th scope="col">Societe</th>
                    <th scope="col">Banque</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Date_cheque</th>
                    <th scope="col">N_cheque</th>
                    <th scope="col">Signer</th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($signes); $i++) {
                    $fk_soc = (int) $signes[$i]->FkSociete();
                    $societe = $societeManager->getSociete($fk_soc);


                ?>
                    <tr>
                        <td name="y<?= $i ?>"><input class="checkitem" type="checkbox" name=checkitems[] value="<?= $signes[$i]->numero() ?>"></td>
                        <th scope="row"><?= ($i + 1) ?></th>
                        <td><?= $signes[$i]->numero() ?></td>
                        <td><?= $societe->nom() ?></td>
                        <td>fdfdf</td>
                        <td><?= $signes[$i]->montant() ?></td>
                        <td>df</td>
                        <td><?= 25 ?></td>
                        <td>
                        
                                <input type="checkbox" id="tt" data-toggle="toggle" name="statut_check" data-onstyle="outline-primary" data-offstyle="outline-secondary" onchange="toggleCheckbox('form_check<?= $i ?>')">
                    
                        </td>
                        <td class="d-flex">
                          
                    
                                <button type="submit" class="btn btn-danger">Delete</button>
             

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