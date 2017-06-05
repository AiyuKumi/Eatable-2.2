<?php

class LogoutController {
 public function logout() {  
     
session_start();
// Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
setcookie('UserId', '', time() - 3600);
setcookie('UserName', '', time() - 3600);
  
session_unset();
session_destroy();
$_SESSION = array();

header('Location: index.php');
}
 
 public function error() {
        setcookie("UserId", "error");
        setcookie("UserName", "error"); 
      require_once('views/pages/error.php');
    }
}
?>