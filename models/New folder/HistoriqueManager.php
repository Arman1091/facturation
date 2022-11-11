<?php
class HistoriqueManager extends Model
{
    static $bdd;
    public function getHistoriques()
    {
        self::$bdd = $this->getBdd();
        try {
            $sql = "SELECT * from factue_historique WHERE   `envoyerAnnuler` IS NOT NULL ";
            $query = self::$bdd->prepare($sql);
            $query->execute();
            $elements = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($elements) {
                for ($i = 0; $i < count($elements); $i++) {

                    $var[] = new  Element($elements[$i]);
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
