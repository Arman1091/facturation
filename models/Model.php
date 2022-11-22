<?php

abstract class Model
{
    private static $_bdd;
    //instancie la connexion a la bdd
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //récupére la connexion a la bdd
    protected function getBdd()
    {
        if (self::$_bdd == null) {
            self::setBdd();
        }
        return self::$_bdd;
    }

    protected function closeBdd()
    {
        if (self::$_bdd == null) {
            self::$_bdd = null;
        }
        return self::$_bdd;
    }
//récupérer tout les élements
    protected function getAll($table, $obj)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            foreach ($data as $value) {
                $var[] = new  $obj($value);
            }
            return $var;
        }
        $req->closeCursor();
    }
    //récupérer l'élement par id
    protected function getById($table, $obj, $id)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . "WHERE `id`=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            $var = new $obj($data);
            return $var;
        }
        $req->closeCursor();
    }
}
