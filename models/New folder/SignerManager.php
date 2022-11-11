<?php
class SignerManager extends Model
{
    static $bdd;
    public function getArticles()
    {
        self::$bdd = $this->getBdd();
        return $this->getAllSigners();
    }
    private function getAllSigners()
    {
        try {
            $sql = "SELECT * from factue_historique WHERE `print`= :is_print AND `statut`=:statut ORDER BY id DESC";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":is_print", 1);
            $query->bindValue(":statut", 0);
            $query->execute();
            $signes = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($signes) {
                for ($i = 0; $i < count($signes); $i++) {

                    $var[] = new  Element($signes[$i]);
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
