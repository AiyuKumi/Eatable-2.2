<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login {
    public $gebruikersnaam;
    public $gebruikerId;
    public $paswoord;   

    public function __construct($gebruikerId, $gebruikersnaam, $paswoord) {
      $this->gebruikerId = $gebruikerId;
      $this->gebruikersnaam = $gebruikersnaam;
      $this->paswoord  = $paswoord;   
    }
    
    
    public static function login($gebruikersnaam, $paswoord) {
     $db = Db::getInstance();
      // we make sure $id is an integer
	  if(!is_null($gebruikersnaam && !is_null($paswoord))){
		//$id = intval($id);
		$req = $db->prepare('SELECT * FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam AND paswoord = :paswoord');
		// the query was prepared, now we replace :id with our actual $id value
		$req->execute(array('gebruikersnaam' => $gebruikersnaam,
                                    'paswoord' => $paswoord) );
		$logingebruiker = $req->fetch();

		return new Login($logingebruiker['GebruikerId'],
                                    $logingebruiker['Gebruikersnaam'],
                                    $logingebruiker['Paswoord']
//                                    $logingebruiker['Voornaam'],
//                                    $logingebruiker['Achternaam'],
//                                    $logingebruiker['Email']
                                    );
	  } else return null;
}
}
?>