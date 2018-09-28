<?php
    $listaKategorii = $widokDane['listaKategorii'];
?>

<div class="produktDane">
    <div class="form-group margin_b_10">
        <div class="col-md-2 padding_l_0">
            <label>Magazyn</label>
            <input type="text" class="form-control height_40 prm wymagane " data-kolumna="stan_magazynu" placeholder="Ile szt." value="">
        </div>
        <div class="col-md-2 padding_l_0">
            <label>Cena szt.</label>
            <input type="text" class="form-control height_40 prm wymagane " data-kolumna="kwota" placeholder="Cena szt." value="">
        </div>
        <div class="col-md-8 padding_l_0">
            <label>Kategoria produktu</label>
            <div class="dropdown width_100">
                <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <div data-kolumna="sklep_kategorie_id" data-wartosc_domyslna="" value="" class="dpUstawOpcjeNazwa attrValue wymagane prm float_l ">Wybierz kategorię</div>
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                        foreach($listaKategorii as $id => $value){
                            ?>
                                <li class="dpUstawOpcje" data-element_id="<?php echo $id; ?>"><?php echo $value; ?></li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="form-group margin_b_10">
        <div class="col-md-12 padding_r_0 padding_l_0">
            <label>Nazwa</label>
            <input type="text" class="form-control height_40 prm wymagane " data-kolumna="tytul" placeholder="Nazwa" value="">
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="" value="0" data-kolumna="ilosc_bez_ograniczen" class="fa fa-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">Ilość bez ograniczeń</p></div>
        <div class="clear_b"></div>
    </div>

    <div class="zaznaczPoleGrupa margin_b_10">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="" value="1" data-kolumna="wymagana_zgoda_dyrektora" class="fa fa-check-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">Wymagana zgoda dyrektora</p></div>
        <div class="clear_b"></div>
    </div>

    <div class="panel panel-default margin_b_10">
        <div class="panel-heading">Miniatura</div>
        <div class="panel-body">
            <div class="produktMiniatura">

            </div>
            <div data-rodzic_klasa="produktMiniatura" class="float_l btn btn-default przyciskUploadGrupaUpload produktMiniaturaUpload">
                <span id="przyciskUploadGrupaNazwa" class="przyciskUploadGrupaNazwa">Przeglądaj...</span>
                <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
            </div>
        </div>
    </div>

    <div class="form-group margin_b_10">
        <textarea class="form-control prm editor_prosty duzeMaleLiteryCyfry" data-kolumna="opis" placeholder="Opis"></textarea>
    </div>

    <button type="button" class="btn btn-success width_100 zapiszNowyProdukt">Dodaj nowy</button>

</div>