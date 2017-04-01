<?php
  class VoorraadController {
    public function index() {
      // we store all the voorraaditems in a variable
      $voorraaditems = Voorraad::all(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	  $voorraadcategories = Voorraad::allCategories(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	  $voorraadeenheden = Voorraad::allEenheden(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	  $voorraadlocaties = Voorraad::allLocaties(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	  //$voorraaditem = $this->find();
	  $voorraaditem = Voorraad::find(isset($_GET['id']) ? $_GET['id'] : null);
      require_once('views/voorraad/index.php');
    }

	/* public function edit() {
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('voorraad', 'error');

      // we use the given id to get the right post
      $voorraaditem = voorraad::edit($_GET['id'], $_GET['categorie'],$_GET['product'],$_GET['hoeveelheid'],$_GET['eenheid'],$_GET['datum']);	  
      require_once('views/voorraad/index.php');
    } */
	
	 public function find() {
      // we expect a url of form ?controller=posts&action=show&id=x
      $voorraaditem = Voorraad::find(isset($_GET['id']) ? $_GET['id'] : null);
	  //$voorraad = Voorraad::find(isset($id) ? $id : null);
    } 
		
	// Niet gebruikt
    /* public function show() {
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('voorraad', 'error');

      // we use the given id to get the right post
      $voorraad = voorraad::find($_GET['id']);
      require_once('views/voorraad/show.php');
    } */
  }
?>