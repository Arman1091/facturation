<?php
class EditManager extends Model
{
    static $bdd;
    public function getEditElement($id)
    {
        $this->getBdd();
        return $this->getById('factue_historique  ', 'Element', $id);
    }

    public function DeleteElement($id)
    {
        self::$bdd = $this->getBdd();
        try {
            $sql = " DELETE FROM `factue_historique` WHERE id=:id";
            $query = self::$bdd->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
