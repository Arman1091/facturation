<?php
class Cheque
{
    private $numero;
    private $date;
    private $statutSignature;
    private $dateSignature;
    private $statutExpedition;
    private $dateExpedition;
    private $description;
    private $fkFacture;
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
    public function setNumeroCheque($n_cheque)
    {
        if (is_string($n_cheque)) {
            $this->numero = $n_cheque;
        }
    }
    public function setDateCheque($date_cheque)
    {
        $this->date = $date_cheque;
    }

    public function setStatutChequeSignature($statut_signature)
    {
        $this->statutSignature = $statut_signature;
    }
    public function setDateChequeSignature($date_signature)
    {
        $this->dateSignature = $date_signature;
    }
    public function setStatutChequeExpedition($statut_expedition)
    {
        $this->statutExpedition = $statut_expedition;
    }
    public function setDateChequeExpedition($date_sexpedition)
    {
        $this->dateExpedition = $date_sexpedition;
    }
    public function setDescriptionCheque($description)
    {
        $this->description = $description;
    }
    public function setFkFacture($fk_factture)
    {
        $this->fkFacture = $fk_factture;
    }
    //getter

    public function numero()
    {
        return $this->numero;
    }
    public function date()
    {
        return $this->date;
    }

    public function statutSignature()
    {
        return $this->statutSignature;
    }
    public function dateSignature()
    {
        return $this->dateSignature;
    }
    public function statutExpedition()
    {
        return $this->statutExpedition;
    }
    public function dateExpedition()
    {
        return $this->dateExpedition;
    }
    public function description()
    {
        return $this->description;
    }
    public function fkFacture()
    {
        return $this->fkFacture;
    }
}
