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
    
    public function __construct($voorraadId, $gebruikerid, $CategorieId, $Categorie, $Product, $Hoeveelheid, $EenheidId, $Eenheid, $LocatieId, $Locatie, $Datum) {
        $this->voorraadId = $voorraadId;
        $this->gebruikerid  = $gebruikerid;
        $this->categorieId = $CategorieId;
        $this->categorie = $Categorie;
        $this->product = $Product;
	$this->hoeveelheid = $Hoeveelheid;
	$this->eenheidId = $EenheidId;
        $this->eenheid = $Eenheid;
	$this->locatieId = $LocatieId;
        $this->locatie = $Locatie;
	$this->datum = $Datum;
    }

    public static function all($gebruikerid) {        
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT v.VoorraadId ,v.GebruikerId, vc.CategorieId, vc.Categorie, v.Product, v.Hoeveelheid, ve.EenheidId, ve.Eenheid, vl.LocatieId ,vl.Locatie, v.Datum '
                . 'FROM voorraad v '
                . 'INNER JOIN voorraadCategorie vc ON v.CategorieId = vc.CategorieId '
                . 'INNER JOIN voorraadLocatie vl ON v.LocatieId = vl.LocatieId '
                . 'INNER JOIN voorraadEenheid ve ON v.EenheidId = ve.EenheidId '
                . 'WHERE v.gebruikerid = :gebruikerid '
                . 'ORDER BY vc.Categorie, v.product');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach($req->fetchAll() as $voorraad) {
            $list[] = new Voorraad($voorraad['VoorraadId'],
		$voorraad['GebruikerId'], 
		$voorraad['CategorieId'],
                $voorraad['Categorie'],
		$voorraad['Product'],
		$voorraad['Hoeveelheid'],
                $voorraad['EenheidId'],
		$voorraad['Eenheid'],
                $voorraad['LocatieId'],
		$voorraad['Locatie'],
		$voorraad['Datum']);
        }
        return $list;
    }
	
    public static function allCategories($gebruikerid) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->prepare('SELECT DISTINCT vc.CategorieId, vc.Categorie '
              . 'FROM voorraadCategorie vc '
              . 'INNER JOIN voorraad v ON v.CategorieId = vc.CategorieId '
              . 'WHERE v.gebruikerid = :gebruikerid');
      $req->execute(array('gebruikerid' => $gebruikerid) );      
      // we create a list of Voorraad objects from the database results
      foreach($req->fetchAll() as $voorraadcatgorie) {
          $list[] = new VoorraadCategorie($voorraadcatgorie['CategorieId'],
                $voorraadcatgorie['Categorie']) ;
      }
      return $list;
    }
	 
    public static function allEenheden($gebruikerid) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->prepare('SELECT DISTINCT ve.EenheidId, ve.Eenheid '
              . 'FROM voorraadEenheid ve '
              . 'INNER JOIN voorraad v ON v.EenheidId = ve.EenheidId '
              . 'WHERE v.gebruikerid = :gebruikerid');
      $req->execute(array('gebruikerid' => $gebruikerid) ); 
      // we create a list of Voorraad objects from the database results
      foreach($req->fetchAll() as $voorraadeenheden) {
        $list[] = new VoorraadEenheid($voorraadeenheden['EenheidId'],
                $voorraadeenheden['Eenheid']);
      }
      return $list;
    }
	 
    public static function allLocaties($gebruikerid) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->prepare('SELECT DISTINCT vl.LocatieId, vl.Locatie '
              . 'FROM voorraadLocatie vl '
              . 'INNER JOIN voorraad v ON v.LocatieId = vl.LocatieId '
              . 'WHERE v.gebruikerid = :gebruikerid');
      $req->execute(array('gebruikerid' => $gebruikerid) );   
      // we create a list of Voorraad objects from the database results
      foreach($req->fetchAll() as $voorraadlocaties) {
        $list[] = new VoorraadLocatie($voorraadlocaties['LocatieId'],
                $voorraadlocaties['Locatie']);
      }
      return $list;
    }
	
    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
	  if(!is_null($id)){
		$id = intval($id);
                $req = $db->prepare('SELECT v.VoorraadId ,v.GebruikerId, vc.CategorieId, vc.Categorie, v.Product, v.Hoeveelheid, ve.EenheidId, ve.Eenheid, vl.LocatieId, vl.Locatie, v.Datum '
                . 'FROM voorraad v '
                . 'INNER JOIN voorraadCategorie vc ON v.CategorieId = vc.CategorieId '
                . 'INNER JOIN voorraadLocatie vl ON v.LocatieId = vl.LocatieId '
                . 'INNER JOIN voorraadEenheid ve ON v.EenheidId = ve.EenheidId '
                . 'WHERE VoorraadId = :id');
		// the query was prepared, now we replace :id with our actual $id value
		$req->execute(array('id' => $id));
		$voorraad = $req->fetch();
		return new Voorraad($voorraad['VoorraadId'],
			$voorraad['GebruikerId'], 
			$voorraad['CategorieId'],
                        $voorraad['Categorie'],
			$voorraad['Product'],
			$voorraad['Hoeveelheid'],
                        $voorraad['EenheidId'],
			$voorraad['Eenheid'],
			$voorraad['LocatieId'],
                        $voorraad['Locatie'],
			$voorraad['Datum']);
	  } else return null;
    }
	
    public static function save($id, $gebruikerId, $product, $categorieId, $hoeveelheid, $eenheidId, $locatieId, $datum) {
      $db = Db::getInstance();
      
//      list($y, $m, $d) = explode('-', $datum);
//        if(checkdate($m, $d, $y)) {
//            $datumchecked = $datum;
//        }elseif(!checkdate($m, $d, $y)) {
//            $datumchecked = null;            
//        }
        
      if(!is_null($id)){ //Id is not null, so we are editing a voorraaditem
        $id = intval($id);
        $req = $db->prepare('UPDATE voorraad 
				set categorieId=:categorieId,
				product=:product, 
				hoeveelheid=:hoev, 
				eenheid=:eenheid, 
				locatie=:locatie, 
				datum=:datum
				where voorraadid=:id');
      $req->execute(array('id' => $id, 'categorie' => $categorieId, 'product' => $product, 'hoeveelheid' => $hoev, 'eenheid' => $eenheid, 'locatie' => $locatie, 'datum' => $datum));

       }
        else { //Id is null, so we are creating a new voorraaditem
        $req = $db->prepare('INSERT INTO voorraad (GebruikerId, CategorieId, Product, Hoeveelheid, EenheidId, LocatieId, Datum) 
             VALUES (3, 20, "test4", 1, 20, 20, null)');	
//        VALUES (:gebruikerId, :categorieId, :product, :hoeveelheid, :eenheid, :locatie, :datum)');							
        $req->execute(array('gebruikerId' => $gebruikerId, 
            'categorieId' => $categorieId, 
            'product' => $product, 
            'hoeveelheid' => $hoeveelheid, 
            'eenheidId' => $eenheidId,
            'locatieId' => $locatieId, 
            'datum' => $datum));       
        }
        return null;
    }
    
 } //end class Voorraad
  
class VoorraadCategorie{    
    public $categorieId;
    public $categorie;
    
    public function __construct($CategorieId, $Categorie) {
        $this->categorieId = $CategorieId;
        $this->categorie = $Categorie;
    }
}
    
 class VoorraadLocatie{    
    public $locatieId;
    public $locatie;
    
    public function __construct($LocatieId, $Locatie) {
        $this->locatieId = $LocatieId;
        $this->locatie = $Locatie;
    }
}
    
class VoorraadEenheid{    
    public $eenheidId;
    public $eenheid;
    
    public function __construct($EenheidId, $Eenheid) {
        $this->eenheidId = $EenheidId;
        $this->eenheid = $Eenheid;
    }
}
?>