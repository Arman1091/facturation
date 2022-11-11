<?php 

try {
    $nFact="fg";
    $_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
    $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $sql = "DELETE From facture WHERE   `numeroFacture`=:numero_facture";
    $query = $_bdd->prepare($sql);
    $query->bindValue(':numero_facture', $nFact, PDO::PARAM_STR);
    $query->execute(); 
    $query->closeCursor();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}