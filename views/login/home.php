<!DOCTYPE html>
<html>
	<head>				
		<meta name="language" content="nl" />
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--<link href="css/style.css" rel="stylesheet" type="text/css">-->
		<title>Login Ons Kookboek</title>
		<link href="css/bootstrap.css" media="screen" rel="stylesheet" type="text/css">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
<div class="col-md-offset-2 col-md-8" style="margin-top:20px">
<div class="panel panel-primary">
  <div class="panel-heading text-center">
    <h3 class="panel-title">Login Ons Kookboek</h3>
  </div>
  <div class="panel-body">	

      <form class="form-horizontal" action="?controller=login&action=login" method="post"><!--?controller=login&action=login--><!--?controller=voorraad&action=index&id=26-->
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Gebruikernaam</label>
		 <div class="col-sm-10">
			<input type="text" class="form-control" id="username" name="username" placeholder="Jane Doe">
		</div>
  </div>
 <!-- <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
    </div>
  </div>-->
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Wachtwoord</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Herinner me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Log in</button>
    </div>
  </div>
</form>	
</div>
</div>
</div>	
</body>
</html>