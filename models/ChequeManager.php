<?php
class ChequeManager extends Model
{
    // private $bdd;
    public function getCheques()
    {
        $this->getBdd();
        return $this->getAll('cheque', 'Cheque');
    }
    public function getChequesAttantes($col,$value)
    {
        try {
            $sql = "SELECT * from `cheque` WHERE   `$col`=:col";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(':col', $value, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if($data){
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
    public function getCheque($nCheque)
    {

        
        try {
            $sql = "SELECT * FROM cheque WHERE   `numeroCheque`=:numero_cheque";
            $query = $this->getBdd() ->prepare($sql);
            $query->bindValue(':numero_cheque', $nCheque, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $cheque = new Cheque($data);
                return $cheque;
            }
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    public function newCheque($element)
    {
        // $ncheque = $element['numero_cheque'];
        // $dateCheque = $element['date_cheque'];
        try {
            $sql = "INSERT INTO `cheque`(`numeroCheque`, `dateCheque`)
            VALUES (:n_cheque,:date_cheque)";
            $query = $this->getBdd()->prepare($sql);
            $query->bindValue(":n_cheque",  $element->numero() , PDO::PARAM_STR);
            $query->bindValue(":date_facture", $element->date(), PDO::PARAM_STR);
            $query->execute();
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}