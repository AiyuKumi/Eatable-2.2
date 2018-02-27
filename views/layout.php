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

            <script>
                function setCookies(){
                    var hoev = $("#hoeveelheidList").val();
                    setCookie("filterHoeveelheid", hoev, 1);
                    
                    var loc = $("#locatieList").val();
                    setCookie("filterLocatie", loc, 1);
                    
                    var voed = $("#voedingList").val();
                    setCookie("filterVoeding", voed, 1);
                    
                    var sort = $("#sortList").val();
                    setCookie("sortColumn", sort, 1);
                    
                    FilterAndSort();                 
                }
                
                function setCookie(cname, cvalue, exdays) {
                    var d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    var expires = "expires="+d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }
                
                function getCookie(cname) {
                    var name = cname + "=";
                    var ca = document.cookie.split(';');
                    for(var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                           c = c.substring(1);
                        }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                     }
                    return "";
                }
                
                function FilterAndSort()
                {
                    // Declare variables 
                    var table, rows, row, columnHoeveelheid, i, toFilterHoev, toFilterVoed;
                    table = document.getElementById("VoorraadTable");                   
                    rows = table.getElementsByTagName("tr");
                    
                    var filterHoeveelheid = getCookie("filterHoeveelheid");
                    var filterLocatie = getCookie("filterLocatie");
                    var sort = getCookie("sortColumn");
                    var filterVoeding = getCookie("filterVoeding");
                                      
                            if(filterHoeveelheid === "Enkel in voorraad" || filterHoeveelheid === "Alles" )
                            {
                                toFilterHoev = 1;
                            } else {
                                   toFilterHoev = 0;
                                }
                                
                                if(filterVoeding === "Voeding" || filterVoeding === "Alles" )
                            {
                                toFilterVoed = 1;
                            } else {
                                    toFilterVoed = 0;
                                }
                                
                    var toFilterLocatie = filterLocatie;

                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 1; i < rows.length; i++) {
                        row = rows[i];
                                            
                        if (row) {
                            var columnHoeveelheid = row.getElementsByTagName("td")[2];
                            var columnLocatie = row.getElementsByTagName("td")[4];
                            var columnVoeding = row.getElementsByTagName("td")[6];
                            
                            if ((columnLocatie.innerHTML === toFilterLocatie.toString() || toFilterLocatie.toString() === 'Alles')
                                    && (columnVoeding.innerHTML === toFilterVoed.toString())
                                    && ((Number(columnHoeveelheid.innerHTML) > 0 && toFilterHoev === 1) || (toFilterHoev === 0 && Number(columnHoeveelheid.innerHTML) === 0) )
                                    )
                            {
                                row.style.display = "";
                            } else {
                                row.style.display = "none";
                            }                           
                        }                       
                    }
                    
                    sortTable(sort);
                }
                      
                function sortTable(column) {
                
                    var table, rows, switching, i, x, y, shouldSwitch;
                    table = document.getElementById("VoorraadTable");
                    switching = true;
                    /*Make a loop that will continue until
                     no switching has been done:*/
                    while (switching) {
                        //start by saying: no switching is done:
                        switching = false;
                        rows = table.getElementsByTagName("tr");
                        /*Loop through all table rows (except the
                         first, which contains table headers):*/
                        for (i = 1; i < (rows.length - 1); i++) {
                            //start by saying there should be no switching:
                            shouldSwitch = false;
                            /*Get the two elements you want to compare,
                             one from current row and one from the next:*/
                            if (column === 'Product') {
                                x = rows[i].getElementsByTagName("TD")[1];
                                y = rows[i + 1].getElementsByTagName("TD")[1];
                            }
                            if (column === 'Categorie') {
                                x = rows[i].getElementsByTagName("TD")[0];
                                y = rows[i + 1].getElementsByTagName("TD")[0];
                            }
                            if (column === 'Datum') {
                                x = rows[i].getElementsByTagName("TD")[5];
                                y = rows[i + 1].getElementsByTagName("TD")[5];
                            }

                            //check if the two rows should switch place:
                            if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                                //if so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        }
                        if (shouldSwitch) {
                            /*If a switch has been marked, make the switch
                             and mark that a switch has been done:*/
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                }              

                function printDiv() {
                    var divToPrint = document.getElementById('VoorraadTable');
                    newWin = window.open("");
                    newWin.document.write("<style type=\"text/css\">#dontShowOnPrint{ display:none; }</style>");
                    newWin.document.write(divToPrint.outerHTML);
                    newWin.print();
                    newWin.close();
                }

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
                            <li role="presentation"><a href='?controller=recepten&action=index'>Gerechten</a></li>
                            <li role="presentation"><a href='?controller=voorraad&action=index'>Voorraad</a></li>
                            <li role="presentation"><a href="menu.php">Menu</a></li>
                            <li role="presentation"><a href="boodschappen.php">Boodschappenlijst</a></li> 
                        </ul>	  
                        <!--      <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                  <input type="text" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-default">Zoeken</button>
                              </form>	  -->
                        <form class="navbar-form navbar-right" >  
                            <div class="form-group">
                                    <!--<a href="profiel.php" class="navbar-link">Ingelogd als <?php echo" $login_session " ?></a></li>-->
                                <a href="profiel.php" class="navbar-link">Ingelogd als 
                                    <?php if (isset($_COOKIE["UserName"])) {
                                        echo $_COOKIE["UserName"];
                                    } ?>
                                </a>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                                </button>
                                <a class="btn btn-default" href="?controller=logout&action=logout" role="button">Uitloggen</a>
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
            <!--<script src="js/bootstrap-combobox.js" type="text/javascript"></script>-->
            <!--<script type="text/javascript">
          //<![CDATA[
            $(document).ready(function(){
              $('.combobox').combobox()
            });
          //]]>
            </script>-->
            <script src="js/maintainscroll.jquery.js" type="text/javascript"></script>
            <script src="js/datalist.js" type="text/javascript"></script>
            <!--<script src="js/bootstrap-select.js" type="text/javascript"></script>-->
        <body>
        <html>