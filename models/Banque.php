<?php
class Banque
{
    private $id;
    private $nom;
    private $nomCourt;
    private $adresse;
    private $cp;
    private $ville;
    private $tel;

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
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->id = $id;
        }
    }
    public function setNomBanque($nom)
    {
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }
    public function setCourtNomBanque($nom_court)
    {
        if (is_string($nom_court)) {
            $this->nomCourt = $nom_court;
        }
    }
    public function setAdresseBanque($adress_banque)
    {
        if (is_string($adress_banque)) {
            $this->adresse = $adress_banque;
        }
    }
    public function setCpBanque($cp_banque)
    {
        $cp_banque = (int)$cp_banque;
        if ($cp_banque > 0) {
            $this->cp = $cp_banque;
        }
    }
    public function setVilleBanque($ville_banque)
    {
        if (is_string($ville_banque)) {
            $this->ville = $ville_banque;
        }
    }
    public function setTelBanque($tel_banque)
    {
        if (is_string($tel_banque)) {
            $this->tel = $tel_banque;
        }
    }





    //getter

    public function id()
    {
        return $this->id;
    }
    public function nom()
    {
        return $this->nom;
    }
    public function nomCourt()
    {
        return $this->nomCourt;
    }
    public function adresse()
    {
        return $this->adresse;
    }
    public function cp()
    {
        return $this->cp;
    }
    public function ville()
    {
        return $this->ville;
    }
    public function tel()
    {
        return $this->tel;
    }
}
