<?php

    $produkt = $widokDane['produkt'];
    $produktLogo = $widokDane['produktLogo'];


?>

<div class="col-md-4 padding_l_5 padding_r_5 padding_t_5 padding_b_5">
    <div class="panel panel-default margin_b_10 produktPojedynczy">
        <div class="panel-heading"><?php echo $produkt->tytul; ?><i class="fa fa-cart-plus float_r" aria-hidden="true"></i></div>
        <div class="panel-body">
            <?php echo $produktLogo; ?>
        </div>
    </div>
</div>

