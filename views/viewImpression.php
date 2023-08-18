 <?php
    // if (!empty($_POST)) {
    //     if (isset($_POST["checkitems"])) {
    //         $checkitems = $_POST["checkitems"];
    //         if (isset($_POST["deleteOrPrint"])) {
    //             $count = count($checkitems);
    //             if ($_POST["deleteOrPrint"] == 1) {
    //                 $factureManager = new FactureManager;
    //                 for ($i = 0; $i < $count; $i++) {
    //                     $id = $checkitems[$i];
    //                     $factureManager->deleteFacture($id);
    //                     //require "controllers/deleteFacture.php";
    //                 }
    //                 header("Location:impression");
    //             } else {
    //                 var_dump("dssd");
    //                 die;
    //                 // $_SESSION["checkitems"] = [
    //                 //     "checkitems" => $checkitems
    //                 // ];

    //                 // header("Location:pdf-print.php");
    //                 // exit();
    //             }
    //         }
    //     } else {
    //         echo ("il faus chocher au moin un row");
    //     }
    // }



    $societeManager = new SocieteManager;
    // $paiementManager = new PaiementManager;

    //Pagination
    // $nbr_elements_par_page = 10;
    // $nombre_de_page = ceil(count($printes) / $nbr_elements_par_page);

    ?>


<div class="d-flex justify-content-end mt-3 mx-3">
     <div id="serachForm">
         <label class="mx-2" for="site-search"><strong>Search avec Societe/N_fact</strong></label>
         <input class="search" type="search" id="search" name="site-search">
</div>
 </div>
 <div class="container">
     <form method="post" name="formImpression" id="formImpression">
         <table  class="table" id="tableImression"  class="tableImression">
             <thead>
                 <tr>
                     <th scope="col">
                         <input type="checkbox" name="selectAll" id="selectAll" class="selectAll">
                     </th>
                     <th scope="col">Id</th>
                     <th scope="col">Numero </th>
                     <th scope="col">Date</th>
                     <th scope="col">Societe</th>
                     <th scope="col">Banque</th>
                     <th scope="col">Montant</th>
                     <th scope="col"> </th>
                 </tr>
             </thead>
             <tbody class="tbody">

                 <?php
                    if ($factures) {
                        for ($i = 0; $i < count($factures); $i++) {

                            $fk_societe = (int) $factures[$i]->fkSociete();
                            $societe = $societeManager->getSociete($fk_societe);
                            $banque = $societe->getBanque();
                    ?>
                         <tr>
                             <td> <input class="checkitem" type="checkbox" name=checkitems[] value="<?= $factures[$i]->numero() ?>"></td>
                             <td scope="row">
                                 <p class="mx-2"><?= ($i + 1) ?></p>
                             </td>
                             <td ><input class="td-input row" value="<?= $factures[$i]->numero() ?>" type="text" id="numeroFacture" name="numeroFacture"></td>
                             <td ><input class="td-input" value="<?= $factures[$i]->date() ?>" type="date" id="dateFacture" name="dateFacture"></td>
                             <td >
                                 <select name="fkSociete" class="td-input" type="select">
                                     <option selected value=""><?= $societe->nom() ?></option>
                                     <?php foreach ($societes as $societe) : ?>

                                         <option value=<?= $societe->id() ?>><?= $societe->nom() ?></option>

                                     <?php endforeach ?>
                                 </select>
                             </td>
                             <td>
                                 <p class="banqueImpression"><?= $banque->nom() ?></p>
                             </td>
                             <td value="<?= $factures[$i]->numero() ?>">
                                 <input class="w-100  bg-olive td-input" type="number" step="0.01" min=1 id="m" name="montantFacture" value="<?= $factures[$i]->montant() ?>">
                             </td>
                             <td class="d-flex justify-content-center align-items-center">
                                 <button type="button" class="btn btn-danger deleteButton" style="height: 50%;" value="<?php echo ($factures[$i]->numero()) ?>">Delete</button>
                                 <button type="button" class="btn btn-primary printButton mx-1 " style="height: 50%;" value="<?php echo ($factures[$i]->numero()) ?>">Print</button>
                             </td>
                         </tr>

                 <?php }
                    } ?>

             </tbody>
         </table>
         <div class="mt-3"id="changeMsgDiv">
                 <h6 class="p-2" id="changeMsg"></h6>
         </div>
         <div>
             <button type="button" id="deleteManyImpressions" class="btn btn-danger">Delete</button>
             <button type="button" class="btn btn-primary" name="printManyImpressions" onclick="printFactures()">Print</button> 
         </div>

     </form>

</div>