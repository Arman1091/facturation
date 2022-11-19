<?php
class BanqueManager extends Model
{
    public function getBanques()
    {
        $this->getBdd();
        return $this->getAll('banque ', 'Banque');
    }


     public function getBanque($id)
     {
         $this->getBdd();
         return $this->getById('banque ', 'Banque', $id);
     }

}
