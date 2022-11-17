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
   WHERE fact.numeroFacture LIKE '%$searchValue%'";
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
    require("getCountRowImpression.php");
   } catch (PDOException $e) {
       echo "Error: " . $e->getMessage();
       die();
   }
 
}
if (isset($_POST['societes'])) {

    try {
        $sql = "SELECT * FROM societe";
        $query = $_bdd->prepare($sql);
        $query->execute();
        $societes = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($societes)) {
            foreach ($societes as $societe) {
                $data_json[] = ($societe);
            }
        }
        echo (json_encode($data_json));
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
if (
    isset($_POST['numeroFacture'], $_POST['editCol'], $_POST['editValue'])
    && !empty($_POST['numeroFacture']) && !empty($_POST['editCol']) && !empty($_POST['editValue'])
) {

    $editCole = $_POST['editCol'];
    $numeroFacture = $_POST['numeroFacture'];
    $editValue = $_POST['editValue'];
    try {
        $sql = "UPDATE `facture` SET " . $editCole . "=:colName
        WHERE `numeroFacture`=:nFact";


        $query = $_bdd->prepare($sql);
        $query->bindValue(":colName",  $editValue);
        $query->bindValue(":nFact", $numeroFacture, PDO::PARAM_STR);
        $query->execute();
        $query->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}


if (isset($_POST['page'], $_POST['query'])&& !empty($_POST['page']) && !empty($_POST['query'])
) {

    $limit = 10;
    $page = 1;
    if ($_POST['page'] > 1) {
        $start = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
    } else {
        $start = 0;
    }

    try {
        $sql = "SELECT *FROM `facture`";


        $query = $_bdd->prepare($sql);
        $query->bindValue(":colName",  $editValue);
        $query->bindValue(":nFact", $numeroFacture, PDO::PARAM_STR);
        $query->execute();
        $query->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}


echo('
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
    <td>
        <button type="button" class="btn btn-danger deleteButton" style="height: 60%;" value="s">Delete</button>
    </td>
</tr>





');
