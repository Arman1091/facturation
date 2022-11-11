<?php
class Societe
{
    private $id;
    private $nom;
    private $fkBanque;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    //hydratation
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $methode = 'set' . ucfirst($key);
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    //setters

    public function setNomSociete($nom)
    {
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function setFkBanque($fk_banque)
    {
        $fk_banque = (int)$fk_banque;
        if ($fk_banque > 0) {
            $this->fkBanque = $fk_banque;
        }
    }
    //getter


    public function nom()
    {
        return $this->nom;
    }
    public function id()
    {
        return $this->id;
    }
    public function fkBanque()
    {
        return $this->fkBanque;
    }
}
