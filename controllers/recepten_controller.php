<?php

class ReceptenController {

    public function index() {
        // we store all the recipes in a variable
        $recepten = recept::all(isset($_COOKIE['UserId']) ? $_COOKIE['UserId'] : null);
        require_once('views/recepten/index.php');
    }

    public function show() {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id']))
            return call('recepten', 'error');

        // we use the given id to get the right post
        $recepten = recept::find($_GET['id']);
        require_once('views/recepten/show.php');
    }

}

?>