<?php

if (isset($_POST['change']) && !empty($_POST['change'])) { //verification si tout les infos attendus sont présent
    try {
        $id = htmlspecialchars(strip_tags( $_POST['change']));
        $_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
        $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql2 = 'SELECT bnq.courtNomBanque, bnq.adresseBanque,bnq.cpBanque, bnq.cpBanque,
                         bnq.villeBanque,bnq.telBanque FROM `societe` AS soc
                INNER JOIN `banque` AS bnq
                ON soc.fkBanque = bnq.id
                WHERE soc.id=:id';
        $req = $_bdd->prepare($sql2);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $data_json = json_encode(($data));
        echo ( $data_json);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}