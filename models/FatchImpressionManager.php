<?php
 //chargement automatique classes
 spl_autoload_register(function ($class) {
    require_once( $class . '.php');
});

if (isset($_POST['search'])) {
    try {
        $searchValue = strip_tags($_POST['search']);
        $factureManager = new FactureManager;
        if (!empty($_POST['search'])) {
            $factures = $factureManager->getFacturesByFiltre(0,$searchValue);
        } else {
            $factures = $factureManager->getFacturesAttantes(0);
        }

        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

//update Impression row
if (
    isset($_POST['numeroFacture'], $_POST['editCol'], $_POST['editValue'])
    && !empty($_POST['numeroFacture']) && !empty($_POST['editCol']) && !empty($_POST['editValue'])
) {
    
    $numeroFacture = htmlspecialchars(strip_tags($_POST['numeroFacture']));
    $colName = htmlspecialchars(strip_tags($_POST['editCol']));
    $editValue = htmlspecialchars(strip_tags($_POST['editValue']));

    $factureManager = new FactureManager;
    if($factureManager->editFacture($numeroFacture, $colName, $editValue)){
        if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
            $searchValue = htmlspecialchars(strip_tags($_POST['searchValue']));
            $factures = $factureManager->getFacturesByFiltre(0 ,$searchValue);
        }
    }
}
if (isset($_POST['deleteRow']) && !empty($_POST['deleteRow'])) {
    try {
        $nFact = strip_tags($_POST['deleteRow']);
        $factureManager = new FactureManager;
        if($factureManager->deleteFacture($nFact)){
            $msg = "supression réussie";
        } else {
            $msg = "supression échouée";
        }
         if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
             $searchValue = htmlspecialchars(strip_tags($_POST['searchValue']));
             $factures = $factureManager->getFacturesByFiltre(0 ,$searchValue);
         }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

if (isset($_POST['deleteCheckItems']) && !empty($_POST['deleteCheckItems'])) {
    try {
        $data =$_POST['deleteCheckItems'];

        $factureManager = new FactureManager;
        for($i = 0; $i < count($data); $i++){
            $factureManager->deleteFacture($data[$i]);
        }
   
        if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
            $searchValue = htmlspecialchars(strip_tags($_POST['searchValue']));
            $factures = $factureManager->getFacturesByFiltre(0 ,$searchValue);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

// if(!isset($factures)){
//     $factureManager = new FactureManager;
//     $factures = $factureManager->getFacturesAttantes(0);
// }
$societeManager = new SocieteManager;
$societes = $societeManager->getSocietes();

$str = '';
$str.= '
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
             <tbody class="tbody">';

                
                    if (isset($factures)) {
                        for ($i = 0; $i < count($factures); $i++) {

                            $fk_societe = (int) $factures[$i]->fkSociete();
                            $societe = $societeManager->getSociete($fk_societe);
                            $banque = $societe->getBanque();
                 
                       $str.='  <tr>
                             <td> <input class="checkitem" type="checkbox" name=checkitems[] value="'. $factures[$i]->numero().'"></td>
                             <td scope="row">
                                 <p class="mx-2">'.($i + 1).'</p>
                             </td>
                             <td value="'. $factures[$i]->numero().'"><input class="td-input row" value="'. $factures[$i]->numero().'" type="text" id="numeroFacture" name="numeroFacture"></td>
                             <td><input class="td-input" value="'. $factures[$i]->date().'" type="date" id="dateFacture" name="dateFacture"></td>
                             <td>
                                 <select name="fkSociete" class="td-input" type="select">
                                     <option selected value="">'.$societe->nom().'</option>';
                                    foreach ($societes as $societe) {

                                        $str.=' <option value='.$societe->id().'>'.$societe->nom().'</option>';

                                    }
                        $str.=' </select>
                             </td>
                             <td>
                                 <p class="banqueImpression">'.$banque->nom().'</p>
                             </td>
                             <td value="'. $factures[$i]->numero().'">
                                 <input class="w-100  bg-olive td-input" type="number" step="0.01" min=1 id="m" name="montantFacture" value="'. $factures[$i]->montant().'">
                             </td>
                             <td class="d-flex justify-content-center align-items-center">
                             <button type="button" id="deleteManyImpressions" class="btn btn-danger" name="deleteOrPrint" value=1>Delete</button>
                             <button type="button" class="btn btn-primary" name="printManyImpressions" value=0>Print</button> 
                             </td>
                         </tr>';

                  }
                    } 
         $str.= '
             </tbody>
             <div class="mt-3"id="changeMsgDiv">
                 <h6 class="p-2" id="changeMsg"></h6>
            </div>';
            echo $str;