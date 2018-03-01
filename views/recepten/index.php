


<div class="col-md-8" >


    <?php foreach ($recepten as $recept) { ?>
        <div class="col-md-4">
            <div class="panel panel-default" style="height: 200px;">
                <a href="?controller=recepten&action=show&id=<?php echo $recept->receptId; ?>" style="text-decoration: none" >
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $recept->titel; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="thumbnail">                      
                        <img src="imgs/recepten/<?php echo $recept->afbeelding; ?>" alt="..." style="max-width: 242px; max-height: 120px;">                                          
                    </div>
                </div>
                </a>
            </div>	
        </div>	
    <?php } ?> 

</div>

<div class="col-md-4">
    <ul class="list-group">
        <?php foreach ($recepten as $recept) { ?>
        <a href="?controller=recepten&action=show&id=<?php echo $recept->receptId; ?>" style="text-decoration: none" >
            <li class="list-group-item"><?php echo $recept->titel; ?></li>
        </a>
            <?php } ?>

    </ul>
</div>

