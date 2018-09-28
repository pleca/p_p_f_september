<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();
$filmyMain = new FilmyMain($bazaDanych);

$podcastDane = $widokDane['podcastDane'];

?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active podcastOgolne"><a href="#podcastOgolne" aria-controls="podcastOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
    <li role="presentation" class="podcastTagi"><a href="#podcastTagi" aria-controls="podcastTagi" role="tab" data-toggle="tab">Tagi</a></li>
    <li role="presentation" class="podcastWidocznosc zakladkaWidocznosc"><a href="#podcastWidocznosc" aria-controls="podcastWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>
</ul>
<div class="tab-content tabContentStyle podcastEdytuj">
    <div role="tabpanel" class="tab-pane active podcastOgolne" id="podcastOgolne">
        <div class="dane_podcast">
            <div class="well well-sm margin_b_10">
                <p class="margin_b_0">liczba wyświetleń - <?php echo $podcastDane->liczba_odtworzen; ?></p>
                <p class="margin_b_0">liczba pobrań - <?php echo $podcastDane->liczba_pobran; ?></p>
            </div>
            <div class="col-md-9 form-group margin_b_10 padding_l_0">
                <input type="text" class="form-control height_40 prm wymagane" value="<?php echo $podcastDane->tytul; ?>" data-wartosc_domyslna="<?php echo $podcastDane->tytul; ?>" data-kolumna="tytul" placeholder="Tytuł">
            </div>
            <div class="col-md-3 form-group margin_b_10 padding_l_0 padding_r_0">
                <input type="text" class="form-control height_40 prm wymagane datePicker" value="<?php echo $podcastDane->data_dodania; ?>" data-wartosc_domyslna="<?php echo $podcastDane->data_dodania; ?>" data-kolumna="data_dodania" placeholder="Data dodania">
            </div>
            <div class="clear_b"></div>
            <div class="width_100 form-group margin_b_10">
                <textarea type="text" class="form-control prm wymagane" data-wartosc_domyslna="<?php echo $podcastDane->opis; ?>" data-kolumna="opis" placeholder="Opis..."><?php echo $podcastDane->opis; ?></textarea>
            </div>
            <div class="clear_b"></div>
            <div class="float_l btn btn-default margin_b_10 przyciskUploadGrupaUpload podcastPoleUpload">
                <span class="przyciskUploadGrupaNazwa podcastNazwa"><?php echo $podcastDane->plik; ?></span>
                <input class="cursor_p" accept=".mp3,audio/*" data-kolumna="plik" type="file" />
            </div>
            <button type="button" data-klasa_rodzic="dane_podcast" data-tabela="podcasty" data-element_id="<?php echo $podcastDane->id; ?>" data-akcja="zapisz_zmiany_podcast" class="btn btn-success width_100 zapiszZmianyPodcast">Zapisz zmiany</button>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane podcastTagi" id="podcastTagi">

        <div class="col-md-12 padding_r_0 padding_l_0">
            <div class="form-group padding_l_0 col-md-8 margin_b_10">
                <input type="text" class="form-control width_100 height_40 tagNazwa" placeholder="Nazwa tagu">
            </div>
            <button type="button" data-reakcja="dodaj" data-element_id="<?php echo $podcastDane->id; ?>" class="btn btn-success col-md-4 height_40 dodajUsunTag">Dodaj</button>
            <div class="clear_b"></div>
        </div>
        <div class="col-md-12 padding_r_0 padding_l_0">
            <?php
                echo $filmyMain->wygenerujChmurkeTagow(false, $podcastDane->id, 'Lista przypisanych tagów');
            ?>
        </div>
        <div class="clear_b"></div>
    </div>
    <div role="tabpanel" class="tab-pane podcastWidocznosc zakladkaWidocznosc" id="podcastWidocznosc">
        <?php
            $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','podcasty_id_uzytkownik_grupy_id','podcasty_id = '.$podcastDane->id);
            echo $filmyMain->widocznoscGrupyUzytkownikow($listaGrupPrzyznanych, 'podcasty_id_uzytkownik_grupy_id', 'podcasty_id', $podcastDane->id);

            $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','podcasty_id_uzytkownik_id','podcasty_id = '.$podcastDane->id);
            echo $filmyMain->widocznoscUzytkownikow($listaUzytkownikow, 'podcasty_id_uzytkownik_id','podcasty_id', $podcastDane->id, 'wyswietl_edytuj_podcast');
        ?>
    </div>
</div>
