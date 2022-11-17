 <?php
    if (!empty($_POST)) {
        if (isset($_POST["checkitems"])) {
            $checkitems = $_POST["checkitems"];
            if (isset($_POST["deleteOrPrint"])) {
                $count = count($checkitems);
                if ($_POST["deleteOrPrint"] == 1) {
                    $factureManager = new FactureManager;
                    for ($i = 0; $i < $count; $i++) {
                        $id = $checkitems[$i];
                        $factureManager->deleteFacture($id);
                        //require "controllers/deleteFacture.php";
                    }
                    header("Location:" . URL . "impression");
                } else {
                    var_dump("dssd");
                    die;
                    // $_SESSION["checkitems"] = [
                    //     "checkitems" => $checkitems
                    // ];

                    // header("Location:pdf-print.php");
                    // exit();
                }
            }
        } else {
            echo ("il faus chocher au moin un row");
        }
    }



    $societeManager = new SocieteManager;
    // $paiementManager = new PaiementManager;

    //Pagination
    // $nbr_elements_par_page = 10;
    // $nombre_de_page = ceil(count($printes) / $nbr_elements_par_page);

    ?> 


 <div class="d-flex justify-content-end mt-3 mx-3">
     <form action="" method="post" id="serachForm">
         <label class="mx-2" for="site-search"><strong>Search avec Societe/N_fact</strong></label>

         <input class="search" type="search" id="search" name="site-search">
     </form>

 </div>
 <div class="container">
     <form method="post" name="formImpression" id="formImpression">
         <table class="table table-sm" id="attTable">
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
             <tbody class="tbody" >

                 <?php
                    if ($factures) {
                        for ($i = 0; $i < count($factures); $i++) {

                            $fk_societe = (int) $factures[$i]->fkSociete();
                            $societe = $societeManager->getSociete($fk_societe);
                            $banque = $societe->getBanque();

                    ?>
                         <tr>
                             <td > <input  class="checkitem" type="checkbox" name=checkitems[] value="<?= $factures[$i]->numero() ?>"></td>
                             <td  scope="row"><p class="mx-2"><?= ($i + 1) ?></p></td>
                             <td value="<?= $factures[$i]->numero() ?>"><input class="td-input row" value="<?= $factures[$i]->numero() ?>"type="text" id="numeroFacture" name="numeroFacture" ></td>
                             <td value="<?= $factures[$i]->numero() ?>"><input class="td-input"value="<?= $factures[$i]->date() ?>" type="date" id="dateFacture" name="dateFacture"></td>
                             <td value="x">
                                 <select name="fkSociete"class="td-input">
                                     <option selected value=""><?= $societe->nom() ?></option>
                                     <?php foreach ($societes as $societe) : ?>

                                         <option value=<?= $societe->id() ?>><?= $societe->nom() ?></option>

                                     <?php endforeach ?>
                                 </select>
                             </td>
                             <td ><?= $banque->nom() ?></td>
                             <td value="<?= $factures[$i]->numero() ?>">
                                 <input class="w-100  bg-olive td-input" type="number" step="0.01" min=1 id="m" name="montantFacture" value="<?= $factures[$i]->montant() ?>">
                             </td>
                             <td>
                                 <button type="button" class="btn btn-danger deleteButton" style="height: 60%;" value="<?php echo ($factures[$i]->numero()) ?>">Delete</button>
                             </td>
                         </tr>
                       
                 <?php }
                    } ?>

             </tbody>

         </table>
         <div>
             <button type="submit" class="btn btn-danger" name="deleteOrPrint" value=1>Delete</button>
             <button type="submit" class="btn btn-primary" name="deleteOrPrint" value=0>Print</button>
         </div>
         <div id="pagination" class="d-flex justify-content-center">
        <?php
        echo "<a href=''><<</a>&nbsp";
        for ($i = 1; $i <= 3; $i++) {
            echo "<a href=''>$i</a>&nbsp";
        }
        echo "<a href=''>>></a>&nbsp";
        ?>
     </form>

   
    </div> 
 </div>