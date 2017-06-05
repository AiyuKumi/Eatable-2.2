<?php
  function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
        case 'login':
        require_once('models/login.php');
        $controller = new LoginController();
      break;
        case 'logout':
        $controller = new LogoutController();
      break;
	  case 'voorraad':
		// we need the model to query the database later in the controller
        require_once('models/voorraad.php');
        $controller = new VoorraadController();
      break;
	  case 'recept':
		// we need the model to query the database later in the controller
        require_once('models/recepten.php');
        $controller = new ReceptenController();
      break;
    }

    // call the action
    $controller->{ $action }();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array('pages' => ['home' ,'error'],
                        'login' => ['login' ,'error'],
                        'logout' => ['logout' ,'error'],
                        'voorraad' => ['index', 'save'],
			'recepten' => ['index', 'show']);

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>