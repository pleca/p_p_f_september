<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

$mainAdministracja = new AdministracjaMain();
$bazaDancyh = new main_BazaDanych();

$listaUprawnien = $bazaDancyh->pobierzDane('id, nazwa_grupy','uprawnienia_grupy','czy_usuniety = 0', 'nr_kolejnosci ASC');

while($poj_listaUprawnien = $listaUprawnien->fetch_object()){
    ?>
        <div class="cursor_p uprawnienieGrupaPojedyncze edytujUprawnienieGrupa col-md-4 padding_r_5 padding_b_5 padding_l_5 padding_t_5" data-element_id="<?php echo $poj_listaUprawnien->id; ?>">
            <div class="panel panel-default margin_b_0">
                <div class="panel-heading">
                    <?php echo $poj_listaUprawnien->nazwa_grupy; ?>
                    <i class="fa fa-pencil float_r "  aria-hidden="true"></i>
                </div>
            </div>
        </div>
    <?php
}
