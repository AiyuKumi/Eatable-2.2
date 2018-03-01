<?php

class Recept {

    public $receptId;
    public $gebruikerId;
    public $titel;
    public $bereidingstijd;
    public $aantalPersonen;
    public $bereiding;
    public $opmerking;
    public $bron;
    public $afbeelding;

    public function __construct($receptId, $gebruikerId, $titel, $bereidingstijd, $aantalPersonen, $bereiding, $opmerking, $bron, $afbeelding) {
        $this->receptId = $receptId;
        $this->gebruikerId = $gebruikerId;
        $this->titel = $titel;
        $this->bereidingstijd = $bereidingstijd;
        $this->aantalPersonen = $aantalPersonen;
        $this->bereiding = $bereiding;
        $this->opmerking = $opmerking;
        $this->bron = $bron;
        $this->afbeelding = $afbeelding;
    }

    public static function all($gebruikerid) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT r.ReceptId ,r.GebruikerId, r.Titel, r.Bereidingstijd, r.AantalPersonen, r.Bereiding, r.Opmerking, r.Bron, r.Afbeelding '
                . 'FROM recept r '
                . 'WHERE r.gebruikerid = :gebruikerid '
                . 'ORDER BY r.Titel');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $recept) {
            $list[] = new Recept($recept['ReceptId'], 
                    $recept['GebruikerId'], 
                    $recept['Titel'], 
                    $recept['Bereidingstijd'], 
                    $recept['AantalPersonen'], 
                    $recept['Bereiding'], 
                    $recept['Opmerking'], 
                    $recept['Bron'], 
                    $recept['Afbeelding']);
        }
        return $list;
    }
    
    public static function findRecept($gebruikerid, $receptId) {
        $db = Db::getInstance();
        $req = $db->prepare('SELECT r.ReceptId ,r.GebruikerId, r.Titel, r.Bereidingstijd, r.AantalPersonen, r.Bereiding, r.Opmerking, r.Bron, r.Afbeelding '
                . 'FROM recept r '
                . 'WHERE r.gebruikerid = :gebruikerid '
                . 'AND r.receptId = :receptId');
        $req->execute(array('gebruikerid' => $gebruikerid, 'receptId' => $receptId));
        // we create a list of Voorraad objects from the database results
        $recept = $req->fetch();
            return new Recept($recept['ReceptId'], 
                    $recept['GebruikerId'], 
                    $recept['Titel'], 
                    $recept['Bereidingstijd'], 
                    $recept['AantalPersonen'], 
                    $recept['Bereiding'], 
                    $recept['Opmerking'], 
                    $recept['Bron'], 
                    $recept['Afbeelding']);
    }
    
    public static function findCategories($gebruikerid, $receptId) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT rc.Categorie, rc.CategorieId  '
                . 'FROM recept r '
                . 'INNER JOIN recept2receptCategorie r2c on r2c.ReceptId = r.ReceptId '
                . 'INNER JOIN receptCategorie rc on rc.CategorieId = r2c.CategorieId '
                . 'WHERE r.gebruikerid = :gebruikerid '
                . 'AND r.receptId = :receptId');        
        $req->execute(array('gebruikerid' => $gebruikerid, 'receptId' => $receptId));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $categories) {
            $list[] =  new Categorie( 
                    $categories['Categorie'], 
                    $categories['CategorieId']);
        }
        return $list;
    }
    
    public static function findIngredienten($gebruikerid, $receptId) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT ri.ingredientId, ri.receptId, ri.hoeveelheid, ri.eenheid, ri.extra, ri.product  '
                . 'FROM recept r '
                . 'INNER JOIN receptIngredient ri on ri.ReceptId = r.receptId '
                . 'WHERE r.gebruikerid = :gebruikerid '
                . 'AND r.receptId = :receptId');        
        $req->execute(array('gebruikerid' => $gebruikerid, 'receptId' => $receptId));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $ingredienten) {
            $list[] =  new Ingredient( 
                    $ingredienten['ingredientId'], 
                    $ingredienten['receptId'],
                    $ingredienten['hoeveelheid'],
                    $ingredienten['eenheid'],
                    $ingredienten['extra'],
                    $ingredienten['product']);
        }
        return $list;
    }
}

//end class Voorraad

class Categorie {

    public $categorieId;
    public $categorie;

    public function __construct($Categorie, $CategorieId) {
        $this->categorieId = $CategorieId;
        $this->categorie = $Categorie;
    }

}

class Ingredient {

    public $ingredientId;
    public $receptId;
    public $hoeveelheid;
    public $eenheid;
    public $extra;
    public $product;

    public function __construct($ingredientId, $receptId, $hoeveelheid, $eenheid, $extra, $product) {
        $this->ingredientId = $ingredientId;
        $this->receptId = $receptId;
        $this->hoeveelheid = $hoeveelheid;
        $this->eenheid = $eenheid;
        $this->extra = $extra;
        $this->product = $product;
    }

}
?>