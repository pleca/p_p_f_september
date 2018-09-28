<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();
    $bazaDanych = new main_BazaDanych();

    $powiadomienie_tmp = $widokDane['powiadomienie_dane'];

?>

<div class="powiadomienieDaneZawartosc">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#powiadomieniaOgolne" aria-controls="powiadomieniaOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
        <li role="presentation" class="zakladkaWidocznosc"><a href="#powiadomieniaWidocznosc" aria-controls="powiadomieniaWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="powiadomieniaOgolne">
            <div class="powiadomienieDane">
                <div class="well well-sm margin_b_10">
                    <i class="fa <?php echo (($powiadomienie_tmp->czy_usuniety == '0') ? 'fa-trash' : 'fa-undo' ); ?>  margin_r_10" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-tabela='powiadomienia' data-reakcja='<?php echo (($powiadomienie_tmp->czy_usuniety == '0') ? 'usun' : 'przywroc' ); ?>' data-element_id='<?php echo $powiadomienie_tmp->id; ?>' type='button' class='btn btn-danger usunTak usunPrzywrocElement'>TAK</button>"></i>
                    <?php echo $powiadomienie_tmp->nazwa; ?>
                    <i style="padding:4px;" class="float_r fa fa<?php echo (($powiadomienie_tmp->czy_aktywny == 1) ? '-check' : ''); ?>-square-o <?php echo (($powiadomienie_tmp->czy_aktywny == 1) ? 'zaznaczone' : ''); ?> powiadomienieAktywne attrValue update wymagane" aria-hidden="true" data-kolumna="czy_aktywny" data-wartosc_domyslna="<?php echo $powiadomienie_tmp->czy_aktywny; ?>" value="<?php echo $powiadomienie_tmp->czy_aktywny; ?>" ></i>
                </div>
                <?php
                    $powiadomienie_rodzaj_tmp = $bazaDanych->pobierzDane('nazwa', 'powiadomienia_rodzaj', 'id = '.$powiadomienie_tmp->powiadomienia_rodzaj_id);
                    $powiadomienie_rodzaj_tmp = $powiadomienie_rodzaj_tmp->fetch_object();
                ?>
                <input class="update wymagane" type="text" data-kolumna="nazwa" data-wartosc_domyslna="<?php echo $powiadomienie_tmp->nazwa; ?>" value="<?php echo $powiadomienie_tmp->nazwa; ?>" placeholder="Nazwa"/>
                <div class="dropdown col-md-3 padding_l_0">
                    <input class="ilosc_wyswietlen update wymagane" <?php echo (($powiadomienie_tmp->powiadomienia_rodzaj_id == 2) ? 'disabled' : '' ); ?> type="text" data-kolumna="ilosc_wyswietlen" data-wartosc_domyslna="<?php echo $powiadomienie_tmp->ilosc_wyswietlen; ?>" value="<?php echo $powiadomienie_tmp->ilosc_wyswietlen; ?>" placeholder="Ile wyswietleń"/>
                </div>
                <div class="dropdown col-md-3 padding_l_0">
                    <input class="kolejnosc_powiadomien update "type="text" data-kolumna="kolejnosc" data-wartosc_domyslna="<?php echo $powiadomienie_tmp->kolejnosc; ?>" value="<?php echo $powiadomienie_tmp->kolejnosc; ?>" placeholder="Kolejność"/>
                </div>
                <div class="dropdown col-md-6 padding_l_0 padding_r_0">
                    <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div data-kolumna="powiadomienia_rodzaj_id" data-wartosc_domyslna="<?php echo $powiadomienie_tmp->powiadomienia_rodzaj_id; ?>" value="<?php echo $powiadomienie_tmp->powiadomienia_rodzaj_id; ?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php echo $powiadomienie_rodzaj_tmp->nazwa; ?></div>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <?php
                        $powiadomienie_rodzaj = $bazaDanych->pobierzDane('nazwa, id', 'powiadomienia_rodzaj', 'czy_usuniety = 0');
                        while($poj_powiadomienie_rodzaj = $powiadomienie_rodzaj->fetch_object()){ ?>
                            <li class="dpUstawOpcje dpuoPowiadomienieSz" data-element_id="<?php echo $poj_powiadomienie_rodzaj->id; ?>"><?php echo mb_ucfirst($poj_powiadomienie_rodzaj->nazwa); ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="clear_b"></div>
                <div class="poZalogowaniuSz" style="display:<?php echo ($powiadomienie_tmp->powiadomienia_rodzaj_id == 1) ? 'block' : 'none' ?>"><i class="fa fa<?php echo (($powiadomienie_tmp->po_zalogowaniu == 1) ? '-check' : ''); ?>-square-o margin_b_10 powiadomieniePoZalogowaniu attrValue update" aria-hidden="true" data-kolumna="po_zalogowaniu" data-wartosc_domyslna="<?php echo $powiadomienie_tmp->po_zalogowaniu; ?>" value="<?php echo $powiadomienie_tmp->po_zalogowaniu; ?>" ></i>  Wyświetl powiadomienie jdnorazowo tylko po zalogowaniu</div>

                <textarea class="update editor prm wymagane " data-kolumna="tresc" name="editor" data-wartosc_domyslna="" placeholder="Wprowadź tekst..."><?php echo htmlspecialchars_decode($powiadomienie_tmp->tresc); ?></textarea>
                <button type="button" data-akcja="aktualizuj_powiadomienie" data-element_id="<?php echo $powiadomienie_tmp->id; ?>" data-klasa_rodzic="powiadomienieDane" data-tabela="powiadomienia" class="margin_t_10 btn btn-success zapiszZmianyAdministracja width_100">Zapisz zmiany</button>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane zakladkaWidocznosc powiadomieniaWidocznosc" id="powiadomieniaWidocznosc">
            <?php
                $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','powiadomienia_id_uzytkownik_grupy_id','powiadomienia_id = '.$powiadomienie_tmp->id);
                echo $zarzadzanieUzytkownikami->widocznoscGrupyUzytkownikow($listaGrupPrzyznanych, 'powiadomienia_id_uzytkownik_grupy_id', 'powiadomienia_id', $powiadomienie_tmp->id);

                $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','powiadomienia_id_uzytkownik_id','powiadomienia_id = '.$powiadomienie_tmp->id);
                echo $zarzadzanieUzytkownikami->widocznoscUzytkownikow($listaUzytkownikow, 'powiadomienia_id_uzytkownik_id','powiadomienia_id', $powiadomienie_tmp->id, 'edytuj_powiadomienie', true);
            ?>
        </div>
    </div>
</div>

