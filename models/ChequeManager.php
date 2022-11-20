<?php
class ChequeManager extends Model
{
    // private $bdd;
    public function getCheques()
    {
        $this->getBdd();
        return $this->getAll('cheque', 'Cheque');
    }
    public function getChequesAttantes($col, $value)
    {
        try {
            $sql = "SELECT * from `cheque` WHERE   `$col`=:col AND statutChequeExpedition = 0" ;
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':col', $value, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                foreach ($data as $value) {
                    $var[] = new  Cheque($value);
                }
                return $var;
            }

            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function getChequesComplets()
    {
        try {
            $sql = "SELECT * from `cheque` WHERE  statutChequeExpedition  IS NOT NULL" ;
            $query = $this->getBdd()->prepare($sql);;
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                foreach ($data as $value) {
                    $cheques[] = new  Cheque($value);
                }
                return $cheques;
            }

            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function getCheque($nCheque)
    {
        try {
            $sql = "SELECT * FROM cheque WHERE   `numeroCheque`=:numero_cheque";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_cheque', $nCheque, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $cheque = new Cheque($data);
                return $cheque;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function expedier($nCheque)
    {
        try {
            $date = date('Y-m-d');
            $sql = "UPDATE `cheque` 
                 SET `statutChequeExpedition`= 1,`dateChequeExpedition`=:dateExpedition WHERE `numeroCheque`=:numero_cheque";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_cheque', $nCheque, PDO::PARAM_STR);
            $query->bindValue(':dateExpedition', $date, PDO::PARAM_STR);
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
    public function annuler($nCheque, $description)
    {
        $nCheque="xx001";
        try {
            $date = date('Y-m-d');
            $sql = "UPDATE `cheque` 
                 SET `statutChequeExpedition`= 0,`dateChequeExpedition`=:dateExpedition,`descriptionCheque`=:descriptionCheque WHERE `numeroCheque`=:numero_cheque";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_cheque', $nCheque, PDO::PARAM_STR);
            $query->bindValue(':dateExpedition', $date, PDO::PARAM_STR);
            $query->bindValue(':descriptionCheque', $description, PDO::PARAM_STR);
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
    public function newCheque($numeroCheque, $dateCheque, $fkFacture)
    {
        try {
            $sql = "INSERT INTO `cheque`(`numeroCheque`, `dateCheque`,`fkFacture`)
            VALUES (:n_cheque,:date_cheque)";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(":n_cheque",  $numeroCheque, PDO::PARAM_STR);
            $query->bindValue(":date_facture", $dateCheque, PDO::PARAM_STR);
            $query->bindValue(":fkFacture", $fkFacture, PDO::PARAM_STR);
            
            $query->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
