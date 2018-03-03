<?php

class Voorraad {

    public $voorraadId;
    public $gebruikerId;
    public $CategorieId;
    public $Categorie;
    public $Product;
    public $Hoeveelheid;
    public $EenheidId;
    public $Eenheid;
    public $LocatieId;
    public $Locatie;
    public $Datum;
    public $IsVoeding;

    public function __construct($voorraadId, $gebruikerid, $CategorieId, $Categorie, $Product, $Hoeveelheid, $EenheidId, $Eenheid, $LocatieId, $Locatie, $Datum, $IsVoeding) {
        $this->voorraadId = $voorraadId;
        $this->gebruikerid = $gebruikerid;
        $this->categorieId = $CategorieId;
        $this->categorie = $Categorie;
        $this->product = $Product;
        $this->hoeveelheid = $Hoeveelheid;
        $this->eenheidId = $EenheidId;
        $this->eenheid = $Eenheid;
        $this->locatieId = $LocatieId;
        $this->locatie = $Locatie;
        $this->datum = $Datum;
        $this->isVoeding = $IsVoeding;
    }

    public static function all($gebruikerid) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT v.VoorraadId ,v.GebruikerId, vc.CategorieId, vc.Categorie, v.Product, v.Hoeveelheid, ve.EenheidId, ve.Eenheid, vl.LocatieId ,vl.Locatie, v.Datum, v.IsVoeding '
                . 'FROM voorraad v '
                . 'LEFT JOIN voorraadCategorie vc ON v.CategorieId = vc.CategorieId '
                . 'LEFT JOIN voorraadLocatie vl ON v.LocatieId = vl.LocatieId '
                . 'LEFT JOIN voorraadEenheid ve ON v.EenheidId = ve.EenheidId '
                . 'WHERE v.gebruikerid = :gebruikerid '
                . 'ORDER BY vc.Categorie, v.product');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $voorraad) {
            $list[] = new Voorraad($voorraad['VoorraadId'], $voorraad['GebruikerId'], $voorraad['CategorieId'], $voorraad['Categorie'], $voorraad['Product'], $voorraad['Hoeveelheid'], $voorraad['EenheidId'], $voorraad['Eenheid'], $voorraad['LocatieId'], $voorraad['Locatie'], $voorraad['Datum'], $voorraad['IsVoeding']);
        }
              
        return $list;
    }
    
     public static function recept($gebruikerid) {
        $list = [];
//        $db = Db::getInstance();
//        $req = $db->prepare('SELECT r.ReceptId ,r.GebruikerId, r.Titel, ri.IngredientId, ri.Hoeveelheid, ri.Eenheid, ri.Extra, ri.Product '
//                . 'FROM recept r '
//                . 'LEFT JOIN receptIngredient ri ON r.receptId = ri.receptId '
//                . 'WHERE r.gebruikerid = :gebruikerid ');
//        $req->execute(array('gebruikerid' => $gebruikerid));
//        // we create a list of Voorraad objects from the database results
//        foreach ($req->fetchAll() as $recept) {
//            $list[] = new Recept($recept['ReceptId'], $recept['GebruikerId'], $recept['Titel'], $recept['IngredientId'], $recept['Hoeveelheid'], $recept['Eenheid'], $recept['Extra'], $recept['Product']);
//        }
//        return $list;
//    }
           return $list;    
     }

    public static function allCategories($gebruikerid) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT DISTINCT vc.CategorieId, vc.Categorie '
                . 'FROM voorraadCategorie vc '
                . 'WHERE vc.gebruikerid = :gebruikerid '
                . 'Order by 2');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $voorraadcatgorie) {
            $list[] = new VoorraadCategorie($voorraadcatgorie['CategorieId'], $voorraadcatgorie['Categorie']);
        }
        return $list;
    }

    public static function allEenheden($gebruikerid) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT DISTINCT ve.EenheidId, ve.Eenheid '
                . 'FROM voorraadEenheid ve '
                . 'WHERE ve.gebruikerid = :gebruikerid '
                . 'ORDER BY 2');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $voorraadeenheden) {
            $list[] = new VoorraadEenheid($voorraadeenheden['EenheidId'], $voorraadeenheden['Eenheid']);
        }
        return $list;
    }

    public static function allLocaties($gebruikerid) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT DISTINCT vl.LocatieId, vl.Locatie '
                . 'FROM voorraadLocatie vl '
                . 'WHERE vl.gebruikerid = :gebruikerid '
                . 'Order by 2');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $voorraadlocaties) {
            $list[] = new VoorraadLocatie($voorraadlocaties['LocatieId'], $voorraadlocaties['Locatie']);
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        if (!is_null($id)) {
            $id = intval($id);
            $req = $db->prepare('SELECT v.VoorraadId ,v.GebruikerId, vc.CategorieId, vc.Categorie, v.Product, v.Hoeveelheid, ve.EenheidId, ve.Eenheid, vl.LocatieId, vl.Locatie, v.Datum, v.IsVoeding '
                    . 'FROM voorraad v '
                    . 'LEFT JOIN voorraadCategorie vc ON v.CategorieId = vc.CategorieId '
                    . 'LEFT JOIN voorraadLocatie vl ON v.LocatieId = vl.LocatieId '
                    . 'LEFT JOIN voorraadEenheid ve ON v.EenheidId = ve.EenheidId '
                    . 'WHERE VoorraadId = :id');
            // the query was prepared, now we replace :id with our actual $id value
            $req->execute(array('id' => $id));
            $voorraad = $req->fetch();
            return new Voorraad($voorraad['VoorraadId'], $voorraad['GebruikerId'], $voorraad['CategorieId'], $voorraad['Categorie'], $voorraad['Product'], $voorraad['Hoeveelheid'], $voorraad['EenheidId'], $voorraad['Eenheid'], $voorraad['LocatieId'], $voorraad['Locatie'], $voorraad['Datum'], $voorraad['IsVoeding']);
        } else
            return null;
    }

    public static function save($id, $gebruikerId, $product, $categorie, $hoev, $eenheid, $locatie, $datum, $isVoeding) {
        $db = Db::getInstance();

        if ($datum !== null) {
            list($y, $m, $d) = explode('-', $datum);
            if (checkdate($m, $d, $y)) {
                $time = strtotime($datum);
                $datumchecked = date('y-m-d', $time);
            } elseif (!checkdate($m, $d, $y)) {
                $datumchecked = null;
            }
        } else {
            $datumchecked = null;
        }

        if ($hoev === null) {
            $hoeveelheid = null;
        } else {
            $hoeveelheid = $hoev;
        }

        // Get the id from the selected categorie
        // If a new categorie is entered (does not exist in database), add it
        if (!is_null($categorie)) {
            $req = $db->prepare('SELECT vc.CategorieId '
                    . 'FROM voorraadCategorie vc '
                    . 'WHERE vc.gebruikerid = :gebruikerId '
                    . 'AND vc.Categorie = :categorie');
            $req->execute(array('categorie' => $categorie, 'gebruikerId' => intval($gebruikerId)));
            $result = $req->fetch();
            $categorieId = $result['CategorieId'];
            if (is_null($categorieId)) {
                $req = $db->prepare('INSERT INTO voorraadCategorie (Categorie, GebruikerId) 
                    VALUES (:categorie, :gebruikerId)');
                $req->execute(array('categorie' => $categorie, 'gebruikerId' => intval($gebruikerId)));

                $req2 = $db->prepare('SELECT vc.CategorieId '
                        . 'FROM voorraadCategorie vc '
                        . 'WHERE vc.gebruikerid = :gebruikerId '
                        . 'AND vc.Categorie = :categorie');
                $req2->execute(array('categorie' => $categorie, 'gebruikerId' => intval($gebruikerId)));
                $result = $req2->fetch();
                $categorieId = $result['CategorieId'];
            }
        };

        if (!is_null($eenheid)) {
            $req = $db->prepare('SELECT ve.EenheidId '
                    . 'FROM voorraadEenheid ve '
                    . 'WHERE ve.gebruikerid = :gebruikerId '
                    . 'AND ve.Eenheid = :eenheid');
            $req->execute(array('eenheid' => $eenheid, 'gebruikerId' => intval($gebruikerId)));
            $result = $req->fetch();
            $eenheidId = $result['EenheidId'];
            if (is_null($eenheidId)) {
                $req = $db->prepare('INSERT INTO voorraadEenheid (Eenheid, GebruikerId) 
                    VALUES (:eenheid, :gebruikerId)');
                $req->execute(array('eenheid' => $eenheid, 'gebruikerId' => intval($gebruikerId)));

                $req2 = $db->prepare('SELECT ve.EenheidId '
                        . 'FROM voorraadEenheid ve '
                        . 'WHERE ve.gebruikerid = :gebruikerId '
                        . 'AND ve.Eenheid = :eenheid');
                $req2->execute(array('eenheid' => $eenheid, 'gebruikerId' => intval($gebruikerId)));
                $result = $req2->fetch();
                $eenheidId = $result['EenheidId'];
            }
        };

        if (!is_null($locatie)) {
            $req = $db->prepare('SELECT vl.LocatieId '
                    . 'FROM voorraadLocatie vl '
                    . 'WHERE vl.gebruikerid = :gebruikerId '
                    . 'AND vl.Locatie = :locatie');
            $req->execute(array('locatie' => $locatie, 'gebruikerId' => intval($gebruikerId)));
            $result = $req->fetch();
            $locatieId = $result['LocatieId'];
        if (is_null($locatieId)) {
                $req = $db->prepare('INSERT INTO voorraadLocatie (Locatie, GebruikerId) 
                    VALUES (:locatie, :gebruikerId)');
                $req->execute(array('locatie' => $locatie, 'gebruikerId' => intval($gebruikerId)));

                $req2 = $db->prepare('SELECT vl.LocatieId '
                        . 'FROM voorraadLocatie vl '
                        . 'WHERE vl.gebruikerid = :gebruikerId '  
                        . 'AND vl.Locatie = :locatie');
                $req2->execute(array('locatie' => $locatie, 'gebruikerId' => intval($gebruikerId)));
                $result = $req2->fetch();
                $locatieId = $result['LocatieId'];
            }
        };

        if ($id != null) { //Id is not null, so we are editing a voorraaditem
            $id = intval($id);
            $req = $db->prepare('UPDATE voorraad 
				set categorieId=:categorie,
				product=:product, 
				hoeveelheid=:hoev, 
				eenheidId=:eenheid, 
				locatieId=:locatie, 
				datum=:datum,
                                isVoeding=:isVoeding 
				where voorraadid=:id');
            $req->execute(array('id' => intval($id),
                'categorie' => isset($categorieId) ? intval($categorieId) : null,
                'product' => $product,
                'hoev' => isset($hoeveelheid) ? floatval($hoeveelheid) : null,
                'eenheid' => isset($eenheidId) ? intval($eenheidId) : null,
                'locatie' => isset($locatieId) ? intval($locatieId) : null,
                'datum' => $datumchecked,
                'isVoeding' => isset($isVoeding) ? intval($isVoeding) : 0));
        } else { //Id is null, so we are creating a new voorraaditem
            $req = $db->prepare('INSERT INTO voorraad (GebruikerId, CategorieId, Product, Hoeveelheid, EenheidId, LocatieId, Datum, IsVoeding) 	
            VALUES (:gebruikerId, :categorieId, :product, :hoev, :eenheidId, :locatieId, :datum, :isVoeding)');
            $req->execute(array('gebruikerId' => intval($gebruikerId),
                'categorieId' => isset($categorieId) ? intval($categorieId) : null,
                'product' => $product,
                'hoev' => isset($hoeveelheid) ? floatval($hoeveelheid) : null,
                'eenheidId' => isset($eenheidId) ? intval($eenheidId) : null,
                'locatieId' => isset($locatieId) ? intval($locatieId) : null,
                'datum' => $datumchecked,
                'isVoeding' => isset($isVoeding) ? intval($isVoeding) : 0));
        }
        return null;
    }

    public static function delete($id, $gebruikerId) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        if (!is_null($id)) {
            $id = intval($id);
            $req = $db->prepare('DELETE '
                    . 'FROM voorraad '
                    . 'WHERE VoorraadId = :id AND Gebruikerid = :gebruikerId ');
            // the query was prepared, now we replace :id with our actual $id value
            $req->execute(array('id' => intval($id), 'gebruikerId' => intval($gebruikerId)));
        }
        return null;
    }

}

//end class Voorraad

class VoorraadCategorie {

    public $categorieId;
    public $categorie;

    public function __construct($CategorieId, $Categorie) {
        $this->categorieId = $CategorieId;
        $this->categorie = $Categorie;
    }

}

class VoorraadLocatie {

    public $locatieId;
    public $locatie;

    public function __construct($LocatieId, $Locatie) {
        $this->locatieId = $LocatieId;
        $this->locatie = $Locatie;
    }

}

class VoorraadEenheid {

    public $eenheidId;
    public $eenheid;

    public function __construct($EenheidId, $Eenheid) {
        $this->eenheidId = $EenheidId;
        $this->eenheid = $Eenheid;
    }

}

class Recept {

    public $receptId;
    public $gebruikerId;
    public $titel;
    public $ingredientid;
    public $hoeveelheid;
    public $eenheid;
    public $extra;
    public $product;

    public function __construct($receptId, $gebruikerId, $titel, $ingredientid, $hoeveelheid, $eenheid, $extra, $product) {
        $this->receptId = $receptId;
        $this->gebruikerId = $gebruikerId;
        $this->titel = $titel;
        $this->ingredientid = $ingredientid;
        $this->hoeveelheid = $hoeveelheid;
        $this->eenheid = $eenheid;
        $this->extra = $extra;
        $this->product = $product;
    }

}

?>