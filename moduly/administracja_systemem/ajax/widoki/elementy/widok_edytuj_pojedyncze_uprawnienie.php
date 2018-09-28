<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();
    $bazaDanych = new main_BazaDanych();

    $uprawnienie_tmp = $widokDane['uprawnienieDane'];

?>

<div class="uprawnieniaPojedynczeZawartosc">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#uprawnieniaPojedynczeogolne" aria-controls="uprawnieniaPojedynczeogolne" role="tab" data-toggle="tab">Ogólne</a></li>
        <li role="presentation" class="zakladkaWidocznosc"><a href="#uprawnieniaPojedynczeListaUprawnien" aria-controls="uprawnieniaPojedynczeListaUprawnien" role="tab" data-toggle="tab">Lista przyznanych uprawnień</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active uprawnieniaPojedynczeogolne" id="uprawnieniaPojedynczeogolne">
            <div class="col-md-2 padding_l_0 padding_r_0 form-group">
                <label class="width_100 control-label ">Kolejność</label>
                <input type="text" class="height_40 update wymagane width_100 text-center form-control" data-wartosc_domyslna="<?php echo $uprawnienie_tmp->nr_kolejnosci; ?>" data-kolumna="nr_kolejnosci" placeholder="Kolejność" value="<?php echo $uprawnienie_tmp->nr_kolejnosci; ?>">
            </div>
            <div class="col-md-10 padding_r_0 form-group">
                <label class="width_100 control-label">Nazwa</label>
                <input type="text" class="height_40 update wymagane width_100 form-control" data-wartosc_domyslna="<?php echo $uprawnienie_tmp->nazwa_uprawnienia; ?>" data-kolumna="nazwa_uprawnienia" placeholder="Nazwa" value="<?php echo $uprawnienie_tmp->nazwa_uprawnienia; ?>">
            </div>
            <div class="clear_b"></div>
            <button type="button" class="btn btn-success width_100 height_40 zapiszZmianyUprawnieniaGrupyPojedyncze" data-rodzic="uprawnieniaPojedynczeogolne" data-grupa_id="<?php echo $uprawnienie_tmp->id_grupy; ?>" data-element_id="<?php echo $uprawnienie_tmp->id; ?>">Zapisz zmiany</button>
        </div>
        <div role="tabpanel" class="tab-pane zakladkaWidocznosc uprawnieniaPojedynczeListaUprawnien" id="uprawnieniaPojedynczeListaUprawnien">
            <?php
                $listaUzytkownikow = $bazaDanych->pobierzDane('id_uzytkownika','uzytkownik_uprawnienie','id_uprawnienia = '.$uprawnienie_tmp->id);
                echo $zarzadzanieUzytkownikami->widocznoscUzytkownikow($listaUzytkownikow, 'uzytkownik_uprawnienie','id_uprawnienia', $uprawnienie_tmp->id, 'wyswietl_edytuj_uprawnienie_grupy');
            ?>
        </div>
    </div>
</div>
