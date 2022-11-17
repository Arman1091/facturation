<?php
class Societe
{
    private $id;
    private $nom;
    private $fkBanque;
    private $societeManager;
    static $bdd;
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

    //get la banque par id de la societe
    public function getBanque(){
        try {
            $this->societeManager = new SocieteManager;
            self::$bdd=$this->societeManager->getBddSociete();
            $sql = 'SELECT * FROM `societe` AS soc
                    INNER JOIN `banque` AS bnq
                    ON soc.fkBanque = bnq.id
                    WHERE soc.id=:id';
            $req = self::$bdd->prepare($sql);
            $req->bindValue(':id', $this->id(), PDO::PARAM_INT);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
           if(isset($data)){
            $banque = new Banque($data);
            return $banque;
           }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}
