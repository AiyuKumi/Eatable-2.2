<DOCTYPE html>
<html lang="nl">
	<head>						
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Eatable</title>
		<link href="css/bootstrap.css" media="screen" rel="stylesheet" type="text/css">
		<link href="css/bootstrap-combobox.css" media="screen" rel="stylesheet" type="text/css">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<!--		
<script>
function updateForm(id) {
    if (id.length == 0) { 
        document.getElementById("VoorraadForm").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("VoorraadForm").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "?controller=voorraad&action=find&id=" + id, true);
        xmlhttp.send();
    }
  };
}
</script>--> 

<script type="text/javascript">   
 

</script>

	</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">Eatable</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
		   <li role="presentation"><a href="gerechten.php">Gerechten</a></li>
		   <li role="presentation"><a href='?controller=voorraad&action=index'>Voorraad</a></li>
		   <li role="presentation"><a href="menu.php">Menu</a></li>
		   <li role="presentation"><a href="boodschappen.php">Boodschappenlijst</a></li> 
      </ul>	  
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control">
        </div>
        <button type="submit" class="btn btn-default">Zoeken</button>
      </form>	  
	  <form class="navbar-form navbar-right" >  
		<div class="form-group">
			<!--<a href="profiel.php" class="navbar-link">Ingelogd als <?php echo" $login_session "?></a></li>-->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
			</button>
			<a class="btn btn-default" href="../php/logout.php" role="button">Uitloggen</a>
		</div>
	  </form>	  
    </div>
  </div>
</nav>


<?php require_once('routes.php'); ?>

    <footer>
      Copyright
    </footer>
	
	<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<!--<script src="js/dropdown.js" type="text/javascript"></script>	-->
	<script src="js/bootstrap-combobox.js" type="text/javascript"></script>
	<!--<script type="text/javascript">
      //<![CDATA[
        $(document).ready(function(){
          $('.combobox').combobox()
        });
      //]]>
	</script>-->
        <script src="js/maintainscroll.jquery.js" type="text/javascript"></script>
  <body>
<html>