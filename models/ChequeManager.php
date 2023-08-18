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
            $sql = "SELECT * from `cheque`
             WHERE  statutChequeExpedition  IS NULL
             AND descriptionCheque=''" ;
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
            //statutChequeExpedition =1, donc le cheque a été envoyé
            $sql = "UPDATE `cheque` 
                 SET `statutChequeExpedition`= 1,`dateChequeExpedition`=:dateExpedition 
                  WHERE `numeroCheque`=:numero_cheque";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_cheque', $nCheque, PDO::PARAM_STR);
            $query->bindValue(':dateExpedition', $date, PDO::PARAM_STR);
            $query->execute();
            if(($query->rowCount())>0){//quand l'envoi de l'expedition a ete bien enregistrer
                return true;
            }else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function annuler($numroCheque, $descriptionCheque)
    {
        try {
            $date = date('Y-m-d');//date now
            $nCheque = htmlspecialchars(strip_tags($numroCheque));
            $description= htmlspecialchars(strip_tags($descriptionCheque));
            $sql = "UPDATE `cheque` 
                 SET `statutChequeExpedition`= 0,`dateChequeExpedition`=:dateExpedition,`descriptionCheque`=:descriptionCheque WHERE `numeroCheque`=:numero_cheque";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':numero_cheque', $nCheque, PDO::PARAM_STR);
            $query->bindValue(':dateExpedition', $date, PDO::PARAM_STR);
            $query->bindValue(':descriptionCheque', $description, PDO::PARAM_STR);
            $query->execute();
            if(($query->rowCount())>0){//si l'annulation a ete fait
                return true;
            }else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function newCheque($numeroCheque, $dateCheque, $statutCheque, $description,$fkFacture)
    {
        try {
            $date = date('Y-m-d');
            $sql = 'INSERT INTO `cheque`(`numeroCheque`, `dateCheque`,`statutChequeSignature`, `dateChequeSignature`, `descriptionCheque`,`fkFacture`)
            VALUES (:n_cheque,:date_cheque,:statutChequeSignature,:dateChequeSignature,:descriptionCheque,:fkFacture)';
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(":n_cheque",  $numeroCheque, PDO::PARAM_STR);
            $query->bindValue(":date_cheque", $dateCheque, PDO::PARAM_STR);
            $query->bindValue(":statutChequeSignature",$statutCheque, PDO::PARAM_STR);
            $query->bindValue(":dateChequeSignature",  $date, PDO::PARAM_STR);
            $query->bindValue(":descriptionCheque", $description, PDO::PARAM_STR);
            $query->bindValue(":fkFacture", $fkFacture, PDO::PARAM_STR);
            
            $query->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
