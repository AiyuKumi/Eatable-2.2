<?php
  class ReceptController {
    public function index() {
      // we store all the recipes in a variable
      $recepten = recept::all();
      require_once('views/recept/index.php');
    }

    public function show() {
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('recepten', 'error');

      // we use the given id to get the right post
      $recepten = recept::find($_GET['id']);
      require_once('views/recept/show.php');
    }
  }
?>