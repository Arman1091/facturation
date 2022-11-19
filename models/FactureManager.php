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
                    $factures[] = new  Facture($value);
                }
                return $factures;
            }     
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }

    public function getFacturesByFiltre($statut,$filtreValue){
        try {
                $sql = "SELECT  fact.numeroFacture, fact.dateFacture, fact.montantFacture,
                                fact.montantLettresFacture, fact.statutFacture, fact.fkSociete
                        FROM  facture AS fact 
                        INNER JOIN `societe` AS soc
                        ON fact.fkSociete = soc.id
                        INNER JOIN `banque` AS bnq
                        ON soc.fkBanque = bnq.id
                WHERE (fact.numeroFacture LIKE '%$filtreValue%'
                OR soc.nomSociete LIKE '%$filtreValue%') 
                AND fact.statutFacture=:statut";
            
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':statut', $statut, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if($data){
                foreach ($data as $value) {
                    $factures[] = new  Facture($value);
                }
                return $factures;
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
    public function editFacture($nFact,$editCol,$editValue)
    {
        try {
            $x= $editCol;
            $sql = "UPDATE `facture` SET " . $x . "=:colName
            WHERE `numeroFacture`=:numeroFact";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numeroFact', $nFact, PDO::PARAM_STR);
            $query->bindValue(':colName', $editValue);
            $query->execute();
            if(($query->rowCount())>0){
                return true;
            }else {
                return false;
            }
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    //suppresion facture
    public function deleteFacture($nFact)
    {
        try {
            $sql = "DELETE  FROM facture WHERE   `numeroFacture`=:numero_facture";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_facture', $nFact, PDO::PARAM_STR);
            $query->execute(); 
            if($query->rowCount() > 0){
                return true;
            } else {
                return false;
            }
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    //création facture
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
