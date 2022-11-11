<?php

if (isset($_POST['deleteRow']) && !empty($_POST['deleteRow'])) {

    try {
        $_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
        $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "DELETE  FROM facture WHERE   `numeroFacture`=:numero_facture";
        $query = $_bdd->prepare($sql);
        $query->bindValue(':numero_facture', $_POST['deleteRow'], PDO::PARAM_STR);
        $query->execute(); 
        $query->closeCursor();
       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

}
