<?php
try {

    $sql = "SELECT  * FROM societe";
$query = $_bdd->prepare($sql);
$query->execute();
$sicietes = $query->fetchAll(PDO::FETCH_ASSOC);
// return $datas.count();
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
die();
}