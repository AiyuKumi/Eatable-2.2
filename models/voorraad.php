<?php
  class Voorraad {
    public $voorraadId;
    public $gebruikerId;
    public $CategorieId;
    public $Product;
    public $Hoeveelheid;
    public $Eenheid;
    public $Locatie;
    public $Datum;

    public function __construct($voorraadId, $gebruikerid, $CategorieId, $Product, $Hoeveelheid, $Eenheid, $Locatie, $Datum) {
        $this->voorraadId = $voorraadId;
        $this->gebruikerid  = $gebruikerid;
        $this->categorieId = $CategorieId;
        $this->product = $Product;
	$this->hoeveelheid = $Hoeveelheid;
	$this->eenheid = $Eenheid;
	$this->locatie = $Locatie;
	$this->datum = $Datum;
    }

    public static function all($gebruikerid) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT v.VoorraadId ,v.GebruikerId, vc.Categorie, v.Product, v.Hoeveelheid, v.Eenheid, v.Locatie, v.Datum FROM voorraad v INNER JOIN voorraadCategorie vc ON v.CategorieId=vc.CategorieId WHERE v.gebruikerid = :gebruikerid ORDER BY vc.Categorie');
        $req->execute(array('gebruikerid' => $gebruikerid) );
        // we create a list of Voorraad objects from the database results
        foreach($req->fetchAll() as $voorraad) {
            $list[] = new Voorraad($voorraad['VoorraadId'],
		$voorraad['GebruikerId'], 
		$voorraad['Categorie'],
		$voorraad['Product'],
		$voorraad['Hoeveelheid'],
		$voorraad['Eenheid'],
		$voorraad['Locatie'],
		$voorraad['Datum']);
        }
        return $list;
    }
	
    public static function allCategories() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT DISTINCT CategorieId, Categorie FROM voorraadCategorie');
      // we create a list of Voorraad objects from the database results
      foreach($req->fetchAll() as $voorraadcatgorie) {
        $list[] = $voorraadcatgorie['Categorie'];
      }
      return $list;
    }
	 
    public static function allEenheden() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT DISTINCT Eenheid FROM voorraad');

      // we create a list of Voorraad objects from the database results
      foreach($req->fetchAll() as $voorraadeenheden) {
        $list[] = $voorraadeenheden['Eenheid'];
      }
      return $list;
    }
	 
    public static function allLocaties() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT DISTINCT Locatie FROM voorraad');

      // we create a list of Voorraad objects from the database results
      foreach($req->fetchAll() as $voorraadlocaties) {
        $list[] = $voorraadlocaties['Locatie'];
      }
      return $list;
    }
	
    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
	  if(!is_null($id)){
		$id = intval($id);
		$req = $db->prepare('SELECT * FROM voorraad WHERE VoorraadId = :id');
		// the query was prepared, now we replace :id with our actual $id value
		$req->execute(array('id' => $id));
		$voorraad = $req->fetch();

		return new Voorraad($voorraad['VoorraadId'],
						  $voorraad['GebruikerId'], 
						  $voorraad['CategorieId'],
						  $voorraad['Product'],
						  $voorraad['Hoeveelheid'],
						  $voorraad['Eenheid'],
						  $voorraad['Locatie'],
						  $voorraad['Datum']);
	  } else return null;
    }
	
    public static function edit($id, $categorieId, $product, $hoev, $eenheid, $locatie, $datum) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('UPDATE voorraad 
							set categorieId=:categorieId,
							product=:product, 
							hoeveelheid=:hoev, 
							eenheid=:eenheid, 
							locatie=:locatie, 
							datum=:datum
							where voorraadid=:id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id, 'categorie' => $categorieId, 'product' => $product, 'hoeveelheid' => $hoev, 'eenheid' => $eenheid, 'locatie' => $locatie, 'datum' => $datum));
      $post = $req->fetch();

      return new Voorraad($voorraad['VoorraadId'],
						  $voorraad['GebruikerId'], 
						  $voorraad['CategorieId'],
						  $voorraad['Product'],
						  $voorraad['Hoeveelheid'],
						  $voorraad['Eenheid'],
						  $voorraad['Locatie'],
						  $voorraad['Datum']);
    }
  }
?>