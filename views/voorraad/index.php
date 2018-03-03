

<div class="panel panel-default">
    <div class="panel-body">
        <div class="btn-group" style="width: 170px;">    
            <label>Sorteer op</label><br>
           <select class="selectpicker" id="sortList" data-style="btn-success" style="width: 160px;">
            <option>Categorie</option>
            <option>Product</option>
            <option>Datum: oudste eerst</option>
        </select>
        </div>
        <div class="btn-group" style="width: 170px;"> 
        <label>Filter op voorraad</label><br>
        <select class="selectpicker" id="hoeveelheidList" data-style="btn-success" style="width: 160px;">
            <option>Alles</option>
            <option>Enkel in voorraad</option>
            <option>Enkel uit voorraad</option>
        </select>
        </div>
        <div class="btn-group" style="width: 170px;"> 
        <label>Filter op locatie</label><br>
        <select class="selectpicker" id="locatieList" data-style="btn-success" style="width: 160px;">
            <option>Alles</option>
            <?php foreach ($voorraadlocaties as $locatie) { ?>
                    <option><?php echo $locatie->locatie; ?></option>
                <?php } ?>  
        </select>
        </div>
        <div class="btn-group" style="width: 170px;"> 
        <label>Filter op afdeling</label><br>
        <select class="selectpicker" id="voedingList" data-style="btn-success" style="width: 160px;">
            <option>Voeding</option>                       
            <option>Niet-Voeding</option>
            <option>Alles</option>
        </select>
        </div>
        <a onClick="setCookies();return false;" href="#" class="btn btn-primary btn-sm" role="button">
            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>                                               
        </a>     
        
        <div class="btn-group" style="width: 170px; margin-left:30px;"> 
                    <label for="Boodschappenlijst">Boodschappenlijst: </label><br>
                    <input list="Boodschappenlijst" class="combobox" name="Boodschappenlijst" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->eenheid; ?><?php } ?>">	
                    <datalist id="Boodschappenlijst">
                        <?php foreach ($voorraadeenheden as $eenheid) { ?>
                            <option><?php echo $eenheid->eenheid; ?></option>
                        <?php } ?>	
                    </datalist>
                </div>         
        
        <a onClick="printDiv();return false;" href="#" class="btn btn-primary btn-sm pull-right" role="button">
            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>                                               
        </a>  
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
                <th style="display:none;">IsVoeding</th>
                <th></th>
                <th id='dontShowOnPrint'> </th>
            </tr>
            <?php foreach ($voorraaditems as $voorraad) { ?>
                <tr>
                    <td><?php echo $voorraad->categorie; ?></td>
                    <td><a style="color:black; text-decoration: none;"  href="?controller=voorraad&action=index&id=<?php echo $voorraad->voorraadId; ?>" ><?php echo $voorraad->product; ?></a></td>
                    <td <?php if ($voorraad->hoeveelheid == 0) {
                echo" style= color:red ";
            } ?> ><?php echo (float) $voorraad->hoeveelheid; ?></td>
                    <td><?php echo $voorraad->eenheid; ?></td>
                    <td><?php echo $voorraad->locatie; ?></td>
                    <td><?php echo $voorraad->datum; ?></td>
                    <td style="display:none;"><?php echo $voorraad->isVoeding; ?></td>
                    <td>
                        <!--<?php foreach ($voorraadrecept as $recept) { if (in_array($voorraad->product, $recept->product)) { ?>
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>//<?php  }} ?>      -->                 
                    </td>
                    <td id='dontShowOnPrint'><button type="button" class="btn btn-default btn-sm"><!--Winkelkar-->
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                    </button></td>					
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
                        <input type="hidden" id="ProductId" name="Id" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->voorraadId; ?><?php } ?>">
                    </div>
                    <div class="form-group">
                        <label for="Product">Product</label><br>
                        <input type="text" id="Product" name="Product" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->product; ?><?php } ?>">
                    </div>
                    <div class="form-group">
                        <label for="Categorie">Categorie: </label><br>
                        <input list="Categorie" class="combobox" name="Categorie" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->categorie; ?><?php } ?>">	
                        <datalist id="Categorie">                                     
                            <?php foreach ($voorraadcategories as $categorie) { ?>
                                <option><?php echo $categorie->categorie; ?></option>
<?php } ?>                                                                
                        </datalist>      
                    </div>										
                    <div class="form-group">
                        <label for="Hoeveelheid">Hoeveelheid</label><br>
                        <input type=number id="Hoeveelheid" name="Hoeveelheid" min="0" step="0.05" 
                            <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->hoeveelheid; ?><?php } ?>" onChange="resetValues(this.value);">
                    </div>
                    <div class="form-group">
                        <label for="Eenheid">Eenheid: </label><br>
                        <input list="Eenheid" class="combobox" name="Eenheid" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->eenheid; ?><?php } ?>">	
                        <datalist id="Eenheid">
                            <?php foreach ($voorraadeenheden as $eenheid) { ?>
                                <option><?php echo $eenheid->eenheid; ?></option>
<?php } ?>	
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="Locatie">Locatie: </label><br>
                        <input list="Locatie" class="combobox" name="Locatie" id="LocatieId" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->locatie; ?><?php } ?>">	
                        <datalist id="Locatie">
                            <?php foreach ($voorraadlocaties as $locatie) { ?>
                                <option><?php echo $locatie->locatie; ?></option>
<?php } ?>	
                        </datalist>
                    </div>	
                    <div class="form-group">
                        <label for="Datum">Datum</label><br>
                        <input type="date" name="Datum" id="Datum" <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->datum; ?><?php } ?>">
                    </div>
                    <div class="form-group">
                        <label for="IsVoeding" style="margin-right: 5px">Voeding</label>
                        <input type="checkbox" name="IsVoeding" id="IsVoeding" value="1" checked <?php if ($voorraaditem != null) { ?> value="<?php echo $voorraaditem->isVoeding; ?><?php } ?>">
                    </div>
                    <div >                                            
                        <button type="submit" class="btn btn-success btn-sm" ><!--Opslaan-->
                            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                        </button>
<?php if ($voorraaditem != null) { ?>
                            <a onClick="javascript:return confirm('Ben je zeker dat je <?php echo $voorraaditem->product; ?> wilt verwijderen?')" href="?controller=voorraad&action=delete&id=<?php echo $voorraaditem->voorraadId; ?>" class="btn btn-danger btn-sm" role="button"><!--Verwijderen-->
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>                                               
                            </a>                                            
                            <a href="?controller=voorraad&action=index" class="btn btn-primary btn-sm" role="button"><!--Annuleren-->
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                               
                            </a> 
<?php } ?>
                    </div>      
                </form>

               
            </div>
        </div>                        
    </div>
</div>
