<?php
class ExpeditionManager extends Model
{
    static $bdd;

    public function getAllEnvois()
    {
        self::$bdd = $this->getBdd();
        try {
            $sql = "SELECT * from facture WHERE `statutFacture`=1 ";
            $query = self::$bdd->prepare($sql);
            $query->execute();
            $envois = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($envois) {
                for ($i = 0; $i < count($envois); $i++) {

                    $var[] = new  Facture($envois[$i]);
                }
                return $var;
             
            }
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
