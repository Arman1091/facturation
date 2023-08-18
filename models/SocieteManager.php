<?php

class SocieteManager extends Model
{
    static $bdd;
    public function getSocietes()
    {
 
      
         $this->getBdd();
 

        return $this->getAll('societe ', 'Societe');
    }
    public function getSociete($id)
    {
        $this->getBdd();
        return $this->getById('societe ', 'Societe', $id);
    }
       //récupére la connexion a la bdd
      public function getBddSociete()
       {
           if (self::$bdd == null) {
               self::$bdd = $this->getBdd();
           }
           return self::$bdd;
       }
}
