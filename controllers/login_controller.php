<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 class LoginController {

     public function login() {  

        $gebruiker = Login::login(isset($_POST['username'])? $_POST['username'] : null,
                                  isset($_POST['password'])? $_POST['password'] : null);
        if(isset($gebruiker)){
         setcookie("UserId", $gebruiker->gebruikerId);
         setcookie("UserName", $gebruiker->gebruikersnaam);          
        header('Location: index.php');
        }else{
          Login::error();
        }                       
    }
    
    public function error() {
        setcookie("UserId", "error");
         setcookie("UserName", "error"); 
      require_once('views/pages/error.php');
    }
 } 
    ?>