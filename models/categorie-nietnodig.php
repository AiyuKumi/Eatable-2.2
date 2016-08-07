<?php
  class Categorie {
    // they are public so that we can access them using $post->author directly
    public $categorieId;
    public $categorie;

    public function __construct($categorieId, $categorie) {
      $this->categorieId = $categorieId;
      $this->categorie  = $categorie;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM categorie');

      // we create a list of categorie objects from the database results
      foreach($req->fetchAll() as $categorie) {
        $list[] = new Voorraad($categorie['CategorieId'],
							   $categorie['Categorie']);
      }

      return $list;
    }
	
	 public static function allRecept2Categorie($receptId) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT categorie.* FROM categorie, recept2categorie, recept 
						WHERE categorie.categorieId = recept2categorie.categorieId
						AND recept2categorie.receptId = :receptId');

      // we create a list of categorie objects from the database results
      foreach($req->fetchAll() as $categorie) {
        $list[] = new Voorraad($categorie['CategorieId'],
							   $categorie['Categorie']);
      }

      return $list;
    }
	
    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM categorie WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $post = $req->fetch();

      return new Categorie($categorie['CategorieId'], 
						  $categorie['Categorie']);
    }
  }
?>