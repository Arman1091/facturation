<?php
class AccueilManager extends Model
{
    static $bdd;
    public function getArticles()
    {
        $this->getBdd();
        return $this->getAll('factue_historique', 'Element');
    }
    public function insertElement($element)
    {
        self::$bdd = $this->getBdd();
        $sql = "INSERT INTO `factue_historique`( `dateFact`, `dateCheque`, `fkSoc`, `nFact`, `montant`,`montantLettres`, `fkPaiement`, `nCheque`)
            VALUES (:date_fact,:date_cheque,:fk_soc,:n_fact,:montant,:montant_lettres,:paiementId,:n_cheque)";
        $query = self::$bdd->prepare($sql);
        $query->bindValue(":date_fact", $element->DateFact(), PDO::PARAM_STR);
        $query->bindValue(":date_cheque", $element->DateCheque(), PDO::PARAM_STR);
        $query->bindValue(":fk_soc", $element->FkSoc(), PDO::PARAM_INT);
        $query->bindValue(":n_fact", $element->NFact(), PDO::PARAM_STR);
        $query->bindValue(":montant", $element->Montant());
        $query->bindValue(":montant_lettres", $element->MontantLettres());
        $query->bindValue(':paiementId', $element->FkPaiement(), PDO::PARAM_INT);
        $query->bindValue(":n_cheque", $element->NCheque(), PDO::PARAM_STR);
        // $query->bindValue(':n_cheque', "xc", PDO::PARAM_STR);
        //$query->bindValue(':statut', false);
        // $query->bindValue(':date_depart', $_POST['SocieteId']);

        $query->execute();
    }
}
