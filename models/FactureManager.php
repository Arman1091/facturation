<?php
class FactureManager extends Model
{
    public function getFactures()
    {
        $this->getBdd();
        return $this->getAll('facture', 'Facture');
    }
    public function getFacturesAttantes($statut, $statutCheque)
    {
        try {
            $sql = "SELECT * from `facture` 
                    WHERE   `statutFacture`=:statut_facture
                    AND `statutChequeFacture`=:statut_cheque";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':statut_facture', $statut, PDO::PARAM_STR);
            $query->bindValue(':statut_cheque', $statutCheque, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if($data){ //si il y'a yne facture
                foreach ($data as $value) {
                    $factures[] = new  Facture($value);
                }
                return $factures;
            }     
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

    public function getFacturesByFiltre($statut,$statutCheque,$filtreValue){
        try {
            // requête SQL qui nous permettent récupérer toutes les factures qui ont 
            // un statut comme $statut , et le value avec qui on doit filtrer c'est le filtre value
            $filtreValue = htmlspecialchars(strip_tags($filtreValue));
                $sql = "SELECT  fact.numeroFacture, fact.dateFacture, fact.montantFacture,
                                fact.montantLettresFacture, fact.statutFacture, fact.fkSociete
                        FROM  facture AS fact 
                        INNER JOIN `societe` AS soc
                        ON fact.fkSociete = soc.id
                        INNER JOIN `banque` AS bnq
                        ON soc.fkBanque = bnq.id
                WHERE (fact.numeroFacture LIKE '%$filtreValue%'
                OR soc.nomSociete LIKE '%$filtreValue%') 
                AND fact.statutFacture = :statut AND fact.statutChequeFacture = :statutCheque";
            
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':statut', $statut, PDO::PARAM_STR);
            $query->bindValue(':statutCheque', $statutCheque, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if($data){//si y'a des Factures
                foreach ($data as $value) {
                    $factures[] = new  Facture($value);//creation une tableau des Facture
                }
                return $factures; //return
            }  
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
            if ($data) {//verification si facture exist 
                $var = new Facture($data); //new object de la Facture
                return $var;
            }
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function editFacture($nFact,$editCol,$editValue)
    {
        try {
            $colName= $editCol;
            $sql = "UPDATE `facture` SET " . $colName . "=:colName
            WHERE `numeroFacture`=:numeroFact";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numeroFact', $nFact, PDO::PARAM_STR);
            $query->bindValue(':colName', $editValue);
            $query->execute();
            if(($query->rowCount())>0){ //on verifié si la modification a ete fait
                return true;
            }else {
                return false;
            }
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
            if(($query->rowCount())>0){ 
                return true;
            }else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function getFactureBdd(){
        return $this->getBdd();
    }
}
