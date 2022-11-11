<?php
class ElementManager extends Model
{
    static $bdd;
    public function getEditElement($id)
    {
        $this->getBdd();
        return $this->getById('factue_historique  ', 'Element', $id);
    }

    public function DeleteElement($id)
    {
        self::$bdd = $this->getBdd();
        try {
            $sql = " DELETE FROM `factue_historique` WHERE id=:id";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function UpdateElement(
        $date_facture,
        $date_cheque,
        $fk_soc,
        $n_facture,
        $montant,
        $montant_lettres,
        $paiement,
        $n_cheque,
        $rowId
    ) {
        self::$bdd = $this->getBdd();
        try {

            $sql = "UPDATE `factue_historique` SET `dateFact`=:date_fact,`dateCheque`=:date_cheque,`fkSoc`=:fk_soc,
        `nFact`=:n_fact,`montant`=:montant,
`montantLettres`=:montantLettres,`fkPaiement`=:paiementId,`nCheque`=:n_cheque WHERE id=:rowId ";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":date_fact", $date_facture, PDO::PARAM_STR);
            $query->bindValue(":date_cheque", $date_cheque, PDO::PARAM_STR);
            $query->bindValue(":fk_soc",  $fk_soc, PDO::PARAM_INT);
            $query->bindValue(":n_fact", $n_facture, PDO::PARAM_STR);
            $query->bindValue(":montant", $montant, PDO::PARAM_STR);
            $query->bindValue(":montantLettres", $montant_lettres);
            $query->bindValue(':paiementId',  $paiement, PDO::PARAM_INT);
            $query->bindValue(":n_cheque", $n_cheque, PDO::PARAM_STR);
            $query->bindValue(':rowId',  $rowId, PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
