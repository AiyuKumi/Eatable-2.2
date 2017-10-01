

<div class="panel panel-default">
  <div class="panel-body">
    <div class="btn-group">       
        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
			Sorteer op
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="#">Categorie</a></li>
			<li><a href="#">Product</a></li>
			<li><a href="#">Datum: oudste eerst</a></li>
		</ul>
	</div>   
	<div class="btn-group">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Filter op voorraad
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li onclick="FilterOnHoeveelheid('Alles')"><a href="#">Alles</a></li>                       
			<li onclick="FilterOnHoeveelheid('InVoorraad')"><a href="#">Enkel in voorraad</a></li>
			<li onclick="FilterOnHoeveelheid('UitVoorraad')"><a href="#">Enkel uit voorraad</a></li>
		</ul>
	</div>
        <div class="btn-group">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Filter op locatie
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">                  
                    <?php foreach($voorraadlocaties as $locatie) { ?>
			<li onclick="FilterOnLocatie('<?php echo $locatie->locatie;?>')"><a href="#"><?php echo $locatie->locatie;?></a></li>
                    <?php } ?>                                      	
		</ul>					
	</div>
  </div>
</div>




<div class="row">
<div class="col-xs-12 col-sm-6 col-md-9">
    <table class="table table-striped" style="margin-left:30px;" id='VoorraadTable'>
				<tr>
					<th>Categorie</th>
					<th>Product</th>
					<th>Hoeveelheid</th>
					<th>Eenheid</th>
					<th>Locatie</th>
					<th>Datum</th>
					<th> </th>
					</tr>
				<?php foreach($voorraaditems as $voorraad) { ?>
				<tr>
					<td><?php echo $voorraad->categorie; ?></td>
					<td><a style="color:black; text-decoration: none;"  href="?controller=voorraad&action=index&id=<?php echo $voorraad->voorraadId; ?>" ><?php echo $voorraad->product; ?></a></td>
					<td <?php if($voorraad->hoeveelheid == 0){ echo" style= color:red ";}?> ><?php echo (float)$voorraad->hoeveelheid; ?></td>
					<td><?php echo $voorraad->eenheid; ?></td>
					<td><?php echo $voorraad->locatie; ?></td>
					<td><?php echo $voorraad->datum; ?></td>
                                        <td><button type="button" class="btn btn-default btn-sm"><!--Winkelkar-->
                                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                                        </button></td>
					<!--<td><a onClick=\"javascript:return confirm('Ben je zeker dat je <?php echo $voorraad->product; ?> wilt verwijderen?')\" href=../php/product_delete.php?id=" . $row["voorraadId"]. "><img src=../img/delete_icon.png></a> </td>-->
				</tr>
				<?php } ?>	
	</table>
</div>
</div>



<div class="row" id="VoorraadForm">
	<div class="col-xs-6 col-md-4">
		<div class="panel panel-default" style="position: fixed; right: 5%; top:170px;">
			<div class="panel-body" style="padding-top: 0px;; padding-bottom: 0px;"> 
				<form action="?controller=voorraad&action=save" method="post" id="add_voorraaditem">
                                    <div class="form-group">
						<input type="hidden" id="ProductId" name="Id" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->voorraadId;?><?php }?>">
					</div>
					<div class="form-group">
						<label for="Product">Product</label><br>
						<input type="text" id="Product" name="Product" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->product;?><?php }?>">
					</div>
					<div class="form-group">
						<label for="Categorie">Categorie: </label><br>
						<input list="Categorie" class="combobox" name="Categorie" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->categorie;?><?php }?>">	
                                                <datalist id="Categorie">                                     
							<?php foreach($voorraadcategories as $categorie) { ?>
								<option><?php echo $categorie->categorie; ?></option>
							<?php } ?>
                                                                
						</datalist>      
					</div>										
					<div class="form-group">
						<label for="Hoeveelheid">Hoeveelheid</label><br>
						<input type=number id="Hoeveelheid" name="Hoeveelheid" min="0" step="0.05" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->hoeveelheid;?><?php }?>">
					</div>
					<div class="form-group">
						<label for="Eenheid">Eenheid: </label><br>
						<input list="Eenheid" class="combobox" name="Eenheid" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->eenheid;?><?php }?>">	
						<datalist id="Eenheid">
							<?php foreach($voorraadeenheden as $eenheid) { ?>
								<option><?php echo $eenheid->eenheid; ?></option>
							<?php } ?>	
						</datalist>
					</div>
					<div class="form-group">
						<label for="Locatie">Locatie: </label><br>
						<input list="Locatie" class="combobox" name="Locatie" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->locatie;?><?php }?>">	
						<datalist id="Locatie">
							<?php foreach($voorraadlocaties as $locatie) { ?>
								<option><?php echo $locatie->locatie; ?></option>
							<?php } ?>	
						</datalist>
					</div>	
					<div class="form-group">
						<label for="Datum">Datum</label><br>
						<input type="date" name="Datum" id="Datum" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->datum;?><?php }?>">
					</div>
                                        <div >                                            
                                             <button type="submit" class="btn btn-success btn-sm" ><!--Opslaan-->
                                                 <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                             </button>
                                            <?php if($voorraaditem != null) { ?>
                                            <a onClick="javascript:return confirm('Ben je zeker dat je <?php echo $voorraaditem->product; ?> wilt verwijderen?')" href="?controller=voorraad&action=delete&id=<?php echo $voorraaditem->voorraadId; ?>" class="btn btn-danger btn-sm" role="button"><!--Verwijderen-->
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>                                               
                                            </a>                                            
                                            <a href="?controller=voorraad&action=index" class="btn btn-primary btn-sm" role="button"><!--Annuleren-->
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                               
                                            </a> 
                                            <?php } ?>
                                        </div>      
				</form>
                            
                            <div class="form-group">
						<label for="Boodschappenlijst">Boodschappenlijst: </label><br>
						<input list="Boodschappenlijst" class="combobox" name="Boodschappenlijst" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->eenheid;?><?php }?>">	
						<datalist id="Boodschappenlijst">
							<?php foreach($voorraadeenheden as $eenheid) { ?>
								<option><?php echo $eenheid->eenheid; ?></option>
							<?php } ?>	
						</datalist>
					</div>   
			</div>
		</div>
            
<!--            <div class="panel panel-default" style="position: fixed; right: 5%; top:20px">
			<div class="panel-body"> 
					<div class="form-group">
						<label for="Eenheid">Eenheid: </label><br>
						<input list="Eenheid" class="combobox" name="Eenheid" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->eenheid;?><?php }?>">	
						<datalist id="Eenheid">
							<?php foreach($voorraadeenheden as $eenheid) { ?>
								<option><?php echo $eenheid->eenheid; ?></option>
							<?php } ?>	
						</datalist>
					</div>                          
                        </div>
            </div>-->
            
	</div>
</div>
