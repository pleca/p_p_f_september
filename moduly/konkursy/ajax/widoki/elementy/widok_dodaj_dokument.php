<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $bazaDanych = new main_BazaDanych();
    $konkursyMain = new KonkursyMain($bazaDanych);

    $nazwa = '';
    $opis = '';
    $konkurs_slownik_dokument_rodzaj_id = 1;
    $nazwa_pliku = 'Przegladaj...';
    $konkurs_slownik_dokument_rodzaj_nazwa = 'Regulamin';

?>
<div class=" konkursDokumentSzczegoly" data-element_id="">
        <div role="tabpanel" class="tab-pane active konkursDokumentOgolne" id="konkursDokumentOgolne">
            <div class="form-group margin_b_10">
                <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" placeholder="Nazwa" data-kolumna="nazwa" data-wartosc_domyslna="<?php echo $nazwa; ?>" value="<?php echo $nazwa; ?>">
            </div>
            <div class="form-group margin_b_10">
                <textarea type="text" class="form-control duzeMaleLiteryCyfry prm" placeholder="Opis" data-kolumna="opis" data-wartosc_domyslna="<?php echo $nazwa; ?>" ><?php echo $opis; ?></textarea>
            </div>
            <div class="form-group margin_b_10">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div data-kolumna="konkurs_slownik_dokument_rodzaj_id" data-wartosc_domyslna="<?php echo $konkurs_slownik_dokument_rodzaj_id; ?>" value="<?php echo $konkurs_slownik_dokument_rodzaj_id; ?>" class="dpUstawOpcjeNazwa attrValue prm wymagane float_l"><?php echo $konkurs_slownik_dokument_rodzaj_nazwa; ?></div>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <?php
                        $rodzajDokumentu = $bazaDanych->pobierzDane('wartosc, id', 'konkurs_slownik_dokument_rodzaj', 'czy_usuniety = 0');
                        while($poj_rodzajDokumentua = $rodzajDokumentu->fetch_object()){
                            echo '<li class="dpUstawOpcje" data-element_id="'.$poj_rodzajDokumentua->id.'">'.mb_ucfirst($poj_rodzajDokumentua->wartosc).'</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div id="przyciskUploadGrupaUpload" class="float_l btn btn-default margin_b_10">
                <span id="przyciskUploadGrupaNazwa"><?php echo $nazwa_pliku; ?></span>
                <input class="cursor_p" data-kolumna="nazwa_pliku" type="file" />
            </div>

            <button type="button" class="btn btn-success width_100 height_40 ZapiszDodajDokument">Dodaj</button>
        </div>
</div>