<?php
  require_once('conn.php');
   
  if(!isset($_COOKIE["UserId"]))
  {      
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
        
        require_once('views/layout.php');
    }else{
        require_once('views/login/home.php');
    }
  }
  else{
      if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
      }else{          
      $controller = "pages";
      $action     = "home";
      }   
    require_once('views/layout.php');
  }
?>