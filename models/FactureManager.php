<?php
class FactureManager extends Model
{
    public function getFactures()
    {
        $this->getBdd();
        return $this->getAll('facture', 'Facture');
    }
    public function getFacturesAttantes($statut)
    {
        try {
            $sql = "SELECT * from `facture` WHERE   `statutFacture`=:statut_facture";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':statut_facture', $statut, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if($data){
                foreach ($data as $value) {
            
                    $var[] = new  Facture($value);
                }
            
                return $var;
            }
         
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function getFacture($nFact)
    {

        try {
            $sql = "SELECT * from facture WHERE   `numeroFacture`=:numero_facture";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_facture', $nFact, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $var = new Facture($data);
                return $var;
            }
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function deleteFacture($nFact)
    {

        try {
            $sql = "DELETE  FROM facture WHERE   `numeroFacture`=:numero_facture";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_facture', $nFact, PDO::PARAM_STR);
            $query->execute(); 
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function newFacture($element)
    {

        try {
            $sql = "INSERT INTO `facture`(`numeroFacture`, `dateFacture`,`statutFacture`,  `montantFacture`,`montantLettresFacture`, `fkSociete`)
            VALUES (:n_fact,:date_facture,:statut,:montant_facture,:montant_lettres_facture,:fk_societe)";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(":n_fact", $element->numero(), PDO::PARAM_STR);
            $query->bindValue(":date_facture", $element->date(), PDO::PARAM_STR);
            $query->bindValue(":montant_facture", $element->montant());
            $query->bindValue(":montant_lettres_facture", $element->getMontantLettres());
            $query->bindValue(":fk_societe", $element->fkSociete(), PDO::PARAM_INT);
            $query->bindValue(":statut", $element->statut(), PDO::PARAM_BOOL);
            $query->execute();
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function getFactureBdd(){
        return $this->getBdd();
    }
}
