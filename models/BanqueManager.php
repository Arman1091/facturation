<?php
class BanqueManager extends Model
{
    private static $bdd;
    public function getArticles()
    {
        $this->getBdd();
        return $this->getAll('banque ', 'Banque');
    }


     public function getBanque($id)
     {
         $this->getBdd();
         return $this->getById('banque ', 'Banque', $id);
     }
    // public function getBanqueByNomeCourt($nom_court)
    // {
    //     $bdd = $this->getBdd();
    //     try {
    //         $sql = "SELECT * FROM `banque` WHERE `nom_court`=:nom_court";
    //         $query = $bdd->prepare($sql);
    //         $query->bindValue(":nom_court", $nom_court, PDO::PARAM_STR);
    //         $query->execute();
    //         $banque = $query->fetch(PDO::FETCH_ASSOC);
    //         $var = new Banque($banque);
    //         return $var;
    //         $query->closeCursor();
    //         return $banque;
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //         die();
    //     }
    // }
}
