

<div class="panel panel-default">
  <div class="panel-body">
    <label for="Categorie">Sorteer op: </label>
    <div class="btn-group">       
		<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<!--current selection -->Categorie
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="#">Categorie</a></li>
			<li><a href="#">Product</a></li>
			<li><a href="#">Datum: oudste eerst</a></li>
		</ul>
	</div>
    <label for="Categorie">Toon: </label>
	<div class="btn-group">
		<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<!--current selection -->Alles
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="#">Alles</a></li>
			<li><a href="#">Enkel in voorraad</a></li>
			<li><a href="#">Enkel uit voorraad</a></li>
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
		<div class="panel panel-default" style="position: fixed; right: 5%; top:170px">
			<div class="panel-body"> 
				<form >
					<div class="form-group">
						<label for="Product">Product</label><br>
						<input type="text" id="Product" name="Product" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->product;?><?php }?>">
					</div>
					<div class="form-group">
						<label for="Categorie">Categorie: </label><br>
						<input list="Categorie" class="combobox" name="Categorie" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->categorie;?><?php }?>">	
                                                <datalist id="Categorie">                                     
							<?php foreach($voorraadcategories as $categorie) { ?>
								<option data-value="<?php echo $categorie->categorieId; ?>"><?php echo $categorie->categorie; ?></option>
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
								<option data-value="<?php echo $eenheid->eenheidId; ?>"><?php echo $eenheid->eenheid; ?></option>
							<?php } ?>	
						</datalist>
					</div>
					<div class="form-group">
						<label for="Locatie">Locatie: </label><br>
						<input list="Locatie" class="combobox" name="Locatie" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->locatie;?><?php }?>">	
						<datalist id="Locatie">
							<?php foreach($voorraadlocaties as $locatie) { ?>
								<option data-value="<?php echo $locatie->locatieId; ?>"><?php echo $locatie->locatie; ?></option>
							<?php } ?>	
						</datalist>
					</div>	
					<div class="form-group">
						<label for="Datum">Datum</label><br>
						<input type="date" name="Datum" id="Datum" <?php if($voorraaditem != null) { ?> value="<?php echo $voorraaditem->datum;?><?php }?>">
					</div>
                                        <div >
                                            <button type="button" class="btn btn-success btn-sm" ><!--Opslaan-->
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                            </button>
                                            <?php if($voorraaditem != null) { ?>
                                            <button type="button" class="btn btn-danger btn-sm"><!--Verwijderen-->
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </button>
                                            <a href="?controller=voorraad&action=index" class="btn btn-primary btn-sm" role="button"><!--Annuleren-->
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                <a href="?controller=voorraad&action=index" ></a>
                                            </a> 
                                            <!--<a href="?controller=voorraad&action=index" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>-->
                                            <!--<input type="submit" name="KnopVerwijderen" id="KnopVerwijderen" value="Verwijderen"></br>-->
                                            <?php } ?>
                                        </div>      
				</form>
			</div>
		</div>
	</div>
</div>




