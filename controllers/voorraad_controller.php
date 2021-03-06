<?php
  class VoorraadController {
    public function index() {
        // we store all the voorraaditems in a variable
        $voorraaditems = Voorraad::all(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	$voorraadcategories = Voorraad::allCategories(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	$voorraadeenheden = Voorraad::allEenheden(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	$voorraadlocaties = Voorraad::allLocaties(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
  //      $voorraadrecept = Voorraad::recept(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
	$voorraaditem = Voorraad::find(isset($_GET['id']) ? $_GET['id'] : null);
        require_once('views/voorraad/index.php');
    }
    
    public function save() {
        // we store all the voorraaditems in a variable
        $voorraaditems = Voorraad::save(
                isset($_POST['Id']) ? $_POST['Id'] : null,
                isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null,
                isset($_POST['Product']) ? $_POST['Product'] : null,
                isset($_POST['Categorie']) ? $_POST['Categorie'] : null,
                isset($_POST['Hoeveelheid']) ? $_POST['Hoeveelheid'] : null,
                isset($_POST['Eenheid']) ? $_POST['Eenheid'] : null,
                isset($_POST['Locatie']) ? $_POST['Locatie'] : null,
                isset($_POST['Datum']) ? $_POST['Datum'] : null,
                isset($_POST['IsVoeding']) ? $_POST['IsVoeding'] : null);
        header('Location: index.php?controller=voorraad&action=index');
    }	
    
    public function delete() {
        // we store all the voorraaditems in a variable
        $voorraaditems = Voorraad::delete(
                isset($_GET['id']) ? $_GET['id'] : null,
                isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);       
        header('Location: index.php?controller=voorraad&action=index');
    }	
		
  }
?>