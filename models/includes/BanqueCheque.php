<?php

class  BanqueCheque extends Model
{
    static $bdd;

    function getBanqueCheque($fk_soc, $fk_banque)
    {
        self::$bdd = $this->getBdd();
        try {
            $sql = "SELECT * FROM banque
                    INNER JOIN cheque ON banque.id = cheque.fk_banque
                    WHERE banque.id=:banque_id AND cheque.fk_soc=:fk_soc";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":fk_soc", $fk_soc, PDO::PARAM_INT);
            $query->bindValue(":banque_id",  $fk_banque, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    function instertBanqueCheque($fk_soc, $fk_banque)
    {
        self::$bdd = $this->getBdd();
        try {

            $sql = "INSERT INTO `cheque`( `fk_soc`, `fk_banque`,`n_cheque`) 
            VALUES (:fk_soc,:fk_banque,:n_cheque)";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":fk_soc", $fk_soc, PDO::PARAM_INT);
            $query->bindValue(":fk_banque", $fk_banque, PDO::PARAM_INT);
            $query->bindValue(":n_cheque", 0, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
