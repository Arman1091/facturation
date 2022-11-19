<?php
$_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

if (isset($_POST['search'])) {
    $searchValue = strip_tags($_POST['search']);
    try {

        if (!empty($_POST['search'])) {
            $sql = "SELECT  * FROM 
                facture AS fact 
                INNER JOIN `societe` AS soc
                ON fact.fkSociete = soc.id
                INNER JOIN `banque` AS bnq
                ON soc.fkBanque = bnq.id
                HERE fact.numeroFacture LIKE '%$searchValue%'";
                     } else {
                         $sql = "SELECT  * FROM 
                 facture AS fact 
                 INNER JOIN `societe` AS soc
                 ON fact.fkSociete = soc.id
                 INNER JOIN `banque` AS bnq
                 ON soc.fkBanque = bnq.id";
        }

        $query = $_bdd->prepare($sql);
        $query->execute();
        $datas = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $data_json[] = ($data);
            }

            echo (json_encode($data_json));
        } else {
            echo "aucun resultat";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}

if (isset($_POST['deleteRow']) && !empty($_POST['deleteRow'])) {
   try {
       $sql = "DELETE  FROM facture WHERE   `numeroFacture`=:numero_facture";
       $query = $_bdd->prepare($sql);
       $query->bindValue(':numero_facture', $_POST['deleteRow'], PDO::PARAM_STR);
       $query->execute();
    //    $query->closeCursor();
    //    if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
    //    }
   } catch (PDOException $e) {
       echo "Error: " . $e->getMessage();
       die();
   }
 
}




// if (isset($_POST['page'], $_POST['query'])&& !empty($_POST['page']) && !empty($_POST['query'])
// ) {

//     $limit = 10;
//     $page = 1;
//     if ($_POST['page'] > 1) {
//         $start = (($_POST['page'] - 1) * $limit);
//         $page = $_POST['page'];
//     } else {
//         $start = 0;
//     }

//     try {
//         $sql = "SELECT *FROM `facture`";


//         $query = $_bdd->prepare($sql);
//         $query->bindValue(":colName",  $editValue);
//         $query->bindValue(":nFact", $numeroFacture, PDO::PARAM_STR);
//         $query->execute();
//         $query->closeCursor();
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//         die();
//     }
// }


echo('
<thead>
    <tr>
        <th scope="co
            <input type="checkbox" name="selectAll" id="selectAll" class="selectAl
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
<tbody>
    <tr>
        <td > <input  class="checkitem" type="checkbox" name=checkitems[] value="d"></td>
        <td  scope="row"><p class="mx-2"><?= (1) ?></p></td>
        <td value="d>"><input class="td-input row" value="d"type="text" id="numeroFacture" name="numeroFacture" ></td>
        <td value="<d?>"><input class="td-input"value="d" type="text" id="dateFacture" name="dateFacture"></td>
        <td value="x">
            <select name="fkSociete"class="td-input">
                <option selected value="">ddd</option>
               
            </select>
        </td>
        <td >"sdsydgsdgsdgsgdsd" </td>
        <td value="d>">
            <input class="w-100  bg-olive td-input" type="number" step="0.01" min=1 id="m" name="montantFacture">
        </td>
        <td class="d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-danger deleteButton " style="height: 50%;" value="<?php echo ($factures[$i]->numero()) ?>">Delete</button>
            <button type="button" class="btn btn-primary printButton mx-1 " style="height: 50%;" value="<?php echo ($factures[$i]->numero()) ?>">Print</button>
        </td>
    </tr>
</tbody>





');
