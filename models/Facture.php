<?php
class Facture
{
    private $numero;
    private $date;
    private $statut ;
    private $montant;
    private $montantLettres;
    private $fkSociete;
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
    public function setNumeroFacture($n_fact)
    {
        if (is_string($n_fact)) {
            $this->numero = $n_fact;
        }
    }
    public function setDateFacture($date_fact)
    {
        $this->date = $date_fact;
    }
    public function setFkSociete($fk_soc)
    {
        $fk_soc = (int) $fk_soc;
        if ($fk_soc > 0) {
            $this->fkSociete = $fk_soc;
        }
    }

    public function setMontantFacture($montant)
    {
        $montant = (float) $montant;
        if ($montant  > 0) {
            $this->montant = $montant;
        }
    }
    public function setMontantLettresFacture($montant_lettres)
    {
        if (is_string($montant_lettres)) {
            $this->montantLettres = $montant_lettres;
        }
    }

    public function setStatutFacture($statut)
    {
        $this->statut = $statut;
    }

    //getter

    public function numero()
    {
        return  $this->numero;
    }
    public function date()
    {
        return $this->date;
    }

    public function fkSociete()
    {
        return  $this->fkSociete;
    }


    public function montant()
    {
        return $this->montant;
    }
    public function getMontantLettres()
    {
        return $this->montantLettres;
    }
    public function statut()
    {
        return $this->statut;
    }
}
