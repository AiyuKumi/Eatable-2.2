
<div class="page-header">
    <h1 style="margin-left:30px;"><?php echo $recept->titel; ?></h1>
</div>
<div class="row">
    <div class="col-md-6">
        <?php if($categories != null && count($categories) > 0){;?>
        <div class="panel panel-default">
            <div class="panel-heading">Categorie</div>
            <div class="panel-body">
                <?php foreach ($categories as $categorie) { ?>
                    <option><?php echo $categorie->categorie; ?></option>
                <?php } ?>        
            </div>
        </div>
        <?php } ?>
        <?php if ($recept->aantalPersonen != null and $recept->aantalPersonen != 0){;?>
        <div class="panel panel-default">
            <div class="panel-heading">Aantal personen</div>
            <div class="panel-body">
                <?php echo $recept->aantalPersonen; ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($recept->bereidingstijd != null and $recept->bereidingstijd != ''){;?>
        <div class="panel panel-default">
            <div class="panel-heading">Bereidingstijd</div>
            <div class="panel-body">
                <?php echo $recept->bereidingstijd; ?>
            </div>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">Bereiding</div>
            <div class="panel-body">
                <?php echo $recept->bereiding; ?>
            </div>
        </div>
         <?php if ($recept->opmerking != null and $recept->opmerking != ''){;?>
        <div class="panel panel-default">
            <div class="panel-heading">Opmerking</div>
            <div class="panel-body">
                <?php echo $recept->opmerking; ?>
            </div>
        </div>
        <?php } ?>
         <?php if ($recept->bron != null and $recept->bron != ''){;?>
        <div class="panel panel-default">
            <div class="panel-heading">Bron</div>
            <div class="panel-body">
                <?php echo $recept->bron; ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default"> 
            <div class="panel-body">
                <div class="thumbnail">                      
                    <img src="imgs/recepten/<?php echo $recept->afbeelding; ?>" alt="..." style="max-width: 640px; max-height: 360px;">                                  
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">           
            <?php foreach ($ingredienten as $ingredient) { ?>
                <tr>
                    <td><?php if($ingredient->hoeveelheid != 0){ echo (float) $ingredient->hoeveelheid;} else {echo '';}?></td>
                    <td><?php echo $ingredient->eenheid; ?></td>
                    <td <?php echo $ingredient->extra; ?></td>
                    <td><?php echo $ingredient->product; ?></td>                  					
                </tr>
            <?php } ?>	
        </table>                                                   
            </div>
        </div>
    </div>
</div>
</div>

