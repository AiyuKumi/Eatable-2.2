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
                . 'WHERE r.gebruikerid = :gebruikerid ');
        $req->execute(array('gebruikerid' => $gebruikerid));
        // we create a list of Voorraad objects from the database results
        foreach ($req->fetchAll() as $recept) {
            $list[] = new Recept($recept['ReceptId'], $recept['GebruikerId'], $recept['Titel'], $recept['Bereidingstijd'], $recept['AantalPersonen'], $recept['Bereiding'], $recept['Opmerking'], $recept['Bron'], $recept['Afbeelding']);
        }
        return $list;
    }

}

//end class Voorraad
?>