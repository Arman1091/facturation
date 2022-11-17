<?php
if (isset($_POST['chackFacture']) && !empty($_POST['chackFacture'])) {
    try {
        $numeroFacture = htmlentities($_POST['chackFacture']);

        $_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
        $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql2 = 'SELECT * FROM facture
                WHERE numeroFacture=:nFact';
        $req = $_bdd->prepare($sql2);
        $req->bindValue(':nFact', $numeroFacture, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $msg ="";
        if(!empty($data)){
            $msg = "cette facture existe déjà";
        }
        echo $msg;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
