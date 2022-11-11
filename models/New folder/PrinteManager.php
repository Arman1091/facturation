<?php
class PrinteManager extends Model
{
    static $bdd;
    public function getArticles()
    {
        self::$bdd = $this->getBdd();
        return $this->getAllPrinte();
    }
    private function getAllPrinte()
    {
        try {
            $sql = "SELECT * from factue_historique WHERE `print`= :is_print AND `statut`=:statut ORDER BY id DESC";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":is_print", 0);
            $query->bindValue(":statut", 0);
            $query->execute();
            $printes = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($printes) {
                for ($i = 0; $i < count($printes); $i++) {

                    $var[] = new  Element($printes[$i]);
                }
                return $var;
            }
            return false;;
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
