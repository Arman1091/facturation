<?php 
$_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
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
        $msg="";
        if(!empty($query)){
            $msg = "succes";
        }
        echo $msg;
        $query->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
$_bdd =null;