<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $bazaDanych = new main_BazaDanych();
    $szkoleniaMain = new SzkoleniaMain();

    $element = $widokDane['element'];
    $id = $widokDane['id'];

    $miniatura_t = '';
    if (!empty($element->miniatura)) {
        $miniatura_t = $szkoleniaMain->pobierzMiniature('aktualnosci', $id, $element->miniatura);
    }

    $szkolenie = $bazaDanych->pobierzDane('*', 'szkolenia', 'id = '.$element->szkolenie_id);
    if($szkolenie) {
        $szkolenie = $szkolenie->fetch_object();
    }



?>
<div class="oknoEdycjiAktualnosciZawartosc">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#aktualnosciOgolne" aria-controls="aktualnosciOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
        <li role="presentation"><a href="#aktualnosciWidocznosc" aria-controls="aktualnosciWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>
    </ul>
    <div class="tab-content tabContentStyle">
        <div role="tabpanel" class="tab-pane active" id="aktualnosciOgolne">
            <div data-rodzic_klasa="oknoEdycjiAktualnosci" class="oknoEdycjiAktualnosci">
                <div class="oeaGrupaPola">
                    <input data-kolumna="nr_kolejnosci" placeholder="Nr kolejności" class="prm wymagane float_l oeaNrKolejnosci " type="text" value="<?php echo $element->nr_kolejnosci; ?>"/>
                    <input class="oeaTytul prm wymagane float_l" placeholder="Tytuł" data-kolumna="tytul" type="text" value="<?php echo $element->tytul; ?>"/>
                    <input data-kolumna="data_stop" placeholder="Data widoczności" class="prm wymagane float_l oeaDataWidocznosci dateTimePicker " value="<?php echo $element->data_stop; ?>"/>
                    <div class="clear_b"></div>
                </div>


                <div class="dropdown width_100 margin_b_20">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div data-kolumna="szkolenie_id" value="<?php echo ($element->szkolenie_id) ? $szkolenie->id : '0'; ?>" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l"><?php echo ($element->szkolenie_id) ? $szkolenie->nazwa : 'Brak'; ?></div>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                        <?php
                        $szkolenia_tmp = $bazaDanych->pobierzDane('*', 'szkolenia', 'czy_usuniety = 0 AND (szkolenia_slownik_status_id = 1 OR szkolenia_slownik_status_id = 2 OR szkolenia_slownik_status_id = 4)');

                        if(!is_null($szkolenia_tmp)){
                            while($poj_szkolenia = $szkolenia_tmp->fetch_object()){
                                echo '<li class="dpUstawOpcje" data-element_id="'.$poj_szkolenia->id.'">'.mb_ucfirst($poj_szkolenia->nazwa).'</li>';
                            }
                        }
                        ?>
                    </ul>
                 </div>
                <div class="clear_b"></div>


                <div class="miniaturaUploadImg"><?php echo $miniatura_t; ?></div>
                <div class="miniaturaUploagGrupa">
                    <div class="float_l miniaturaUpload btn btn-default margin_b_10"><span>Wybierz miniature</span><input data-kolumna="miniatura" class="miniaturaUploadPrzycisk "  type="file" name="miniatura"></div>
                    <i class="fa fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id='<?php echo $id; ?>' data-reakcja='usun' data-tabela='szkolenia_aktualnosci' type='button' class='btn btn-danger usunMiniaturaAktualnosc usunTak'>TAK</button>"></i>
                    <div class="clear_b"></div>
                </div>

                <textarea class="editor_prosty prm wymagane" data-kolumna="tresc" name="editor" placeholder="Wprowadź tekst..."><?php echo htmlspecialchars_decode($element->tresc); ?></textarea>
                <textarea class="zajawka prm" data-kolumna="zajawka" placeholder="Zajawka..."><?php echo htmlspecialchars_decode($element->zajawka); ?></textarea>

                <button type="button" data-akcja="aktualizuj_aktualnosc" data-element_id="<?php echo $id; ?>" data-tabela="szkolenia_aktualnosci" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane aktualnosciWidocznosc zakladkaWidocznosc" id="aktualnosciWidocznosc">
            <?php
                $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','szkolenia_aktualnosci_id_uzytkownik_grupy_id','szkolenia_aktualnosci_id = '.$element->id);
                echo $szkoleniaMain->widocznoscGrupyUzytkownikow($listaGrupPrzyznanych, 'szkolenia_aktualnosci_id_uzytkownik_grupy_id', 'szkolenia_aktualnosci_id', $element->id);

                $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','szkolenia_aktualnosci_id_uzytkownik_id','szkolenia_aktualnosci_id = '.$element->id);
                echo $szkoleniaMain->widocznoscUzytkownikow($listaUzytkownikow, 'szkolenia_aktualnosci_id_uzytkownik_id','szkolenia_aktualnosci_id', $element->id, 'edytuj_aktualnosc');
            ?>
        </div>
    </div>
</div>

