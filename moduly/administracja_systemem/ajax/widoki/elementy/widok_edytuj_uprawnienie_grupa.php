<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $administracjaMain = new AdministracjaMain();
    $bazaDanych = new main_BazaDanych();

    $element_id = $widokDane['elementId'];

    $uprawnienie_grupa_tmp = $bazaDanych->pobierzDane('*','uprawnienia_grupy','id = '.$element_id);
    $uprawnienie_grupa_tmp = $uprawnienie_grupa_tmp->fetch_object();

?>

<div class="uprawnieniaGrupaZawartosc">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#uprawnieniaGrupaogolne" aria-controls="uprawnieniaGrupaogolne" role="tab" data-toggle="tab">Ogólne</a></li>
        <li role="presentation" class="uprawnieniaGrupaListaUprawnien"><a href="#uprawnieniaGrupaListaUprawnien" aria-controls="uprawnieniaGrupaListaUprawnien" role="tab" data-toggle="tab">Lista uprawnień</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active uprawnieniaGrupaogolneDane" id="uprawnieniaGrupaogolne">
            <div class="col-md-2 padding_l_0 padding_r_0">
                <label class="width_100 control-label ">Kolejność</label>
                <input type="text" class="height_40 update wymagane width_100 text-center" data-wartosc_domyslna="<?php echo $uprawnienie_grupa_tmp->nr_kolejnosci; ?>" data-kolumna="nr_kolejnosci" placeholder="Kolejność" value="<?php echo $uprawnienie_grupa_tmp->nr_kolejnosci; ?>">
            </div>
            <div class="col-md-10 padding_r_0">
                <label class="width_100 control-label">Nazwa</label>
                <input type="text" class="height_40 update wymagane width_100" data-wartosc_domyslna="<?php echo $uprawnienie_grupa_tmp->nazwa_grupy; ?>" data-kolumna="nazwa_grupy" placeholder="Nazwa" value="<?php echo $uprawnienie_grupa_tmp->nazwa_grupy; ?>">
            </div>
            <div class="col-md-6 padding_l_0 padding_r_0">
                <label class="width_100 control-label">Nazwa skrócona</label>
                <input type="text" class="height_40 update wymagane width_100" data-wartosc_domyslna="<?php echo $uprawnienie_grupa_tmp->nazwa_krotka; ?>" data-kolumna="nazwa_krotka" placeholder="Nazwa skrócona" value="<?php echo $uprawnienie_grupa_tmp->nazwa_krotka; ?>">
            </div>
            <div class="col-md-6 padding_r_0">
                <label class="width_100 control-label">Ikona(fontAwsome)</label>
                <input type="text" class="height_40 update wymagane width_100" data-wartosc_domyslna="<?php echo $uprawnienie_grupa_tmp->ikona; ?>" data-kolumna="ikona" placeholder="Ikona" value="<?php echo $uprawnienie_grupa_tmp->ikona; ?>">
            </div>
            <div class="clear_b"></div>
            <button type="button" class="btn btn-success width_100 height_40 zapiszZmianyUprawnieniaGrupyZU" data-tabela="uprawnienia_grupy" data-akcja="uprawnienia_zapisz_zmiany" data-rodzic="uprawnieniaGrupaogolneDane" data-element_id="<?php echo $uprawnienie_grupa_tmp->id; ?>">Zapisz zmiany</button>
        </div>
        <div role="tabpanel" class="tab-pane uprawnieniaGrupaListaUprawnien" id="uprawnieniaGrupaListaUprawnien">
            <?php
                $lista_uprawnien_grupy = $bazaDanych->pobierzDane('*','uprawnienia','czy_usuniety = 0 AND id_grupy = '.$uprawnienie_grupa_tmp->id,'nr_kolejnosci ASC');

                while($poj_lug = $lista_uprawnien_grupy->fetch_object()){
                    ?>
                        <div class="uprawnienieGrupyPojedyncze cursor_p col-md-6 padding_r_5 padding_b_5 padding_l_5 padding_t_5 edytujUprawnienieGrupy"  data-element_id="<?php echo $poj_lug->id; ?>">
                            <div class="panel panel-default margin_b_0">
                                <div class="panel-heading">
                                    <?php echo $poj_lug->nazwa_uprawnienia; ?>
                                    <i class="fa fa-pencil float_r " aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
            <div class="clear_b"></div>
        </div>
    </div>
</div>