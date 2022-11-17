<?php
try {

if (!empty($_POST['search'])) {
    $sql="";
    $sql .= "SELECT  * FROM 
            facture AS fact 
            INNER JOIN `societe` AS soc
            ON fact.fkSociete = soc.id
            INNER JOIN `banque` AS bnq
            ON soc.fkBanque = bnq.id";
if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
    $sql .= "WHERE fact.numeroFacture LIKE '%$searchValue%'";
    $sql .= "OR soc.nomSociete LIKE '%$searchValue%'";
}

}

$query = $_bdd->prepare($sql);
$query->execute();
$datas = $query->fetchAll(PDO::FETCH_ASSOC);
// return $datas.count();
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
die();
}