<?php
class FactureManager extends Model
{
    static $bdd;
    public function getFactures()
    {
        $this->getBdd();
        return $this->getAll('facture', 'Facture');
    }
    public function getFacturesAttantes()
    {
        self::$bdd = $this->getBdd();
        try {
            $sql = "SELECT * from `facture` WHERE   `statutFacture`=:statut_facture";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(':statut_facture', 0, PDO::PARAM_STR);
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

        self::$bdd = $this->getBdd();
        try {
            $sql = "SELECT * from facture WHERE   `numeroFacture`=:numero_facture";
            $query = self::$bdd->prepare($sql);
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


        self::$bdd = $this->getBdd();
        try {
            $sql = "DELETE  FROM facture WHERE   `numeroFacture`=:numero_facture";
            $query = self::$bdd->prepare($sql);
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

        self::$bdd = $this->getBdd();
        try {
            $sql = "INSERT INTO `facture`(`numeroFacture`, `dateFacture`,`statutFacture`,  `montantFacture`, `fkSociete`)
            VALUES (:n_fact,:date_facture,:statut,:montant_facture,:fk_societe)";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":n_fact", $element->numero(), PDO::PARAM_STR);
            $query->bindValue(":date_facture", $element->date(), PDO::PARAM_STR);
            $query->bindValue(":montant_facture", $element->montant());
            $query->bindValue(":fk_societe", $element->fkSociete(), PDO::PARAM_INT);
            $query->bindValue(":statut", $element->statut(), PDO::PARAM_BOOL);
            $query->execute();
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
