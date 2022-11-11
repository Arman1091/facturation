<?php
class SocieteManager extends Model
{
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
}
