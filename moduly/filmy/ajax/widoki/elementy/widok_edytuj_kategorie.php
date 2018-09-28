<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $bazaDanych = new main_BazaDanych();
    $filmyMain = new FilmyMain($bazaDanych);

    $kategoriaDane = $widokDane['kategoriaDane'];
?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active kategoriaOgolne"><a href="#kategoriaOgolne" aria-controls="kategoriaOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
    <li role="presentation" class="kategoriaWidocznosc zakladkaWidocznosc"><a href="#kategoriaWidocznosc" aria-controls="kategoriaWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>
</ul>
<div class="tab-content tabContentStyle">
    <div role="tabpanel" class="tab-pane active kategoriaOgolne" id="kategoriaOgolne">
        <div class="dane_kategoria_film">
            <div class="col-md-2 padding_r_0 padding_l_0 form-group">
                <input type="text" class="form-control height_40 update wymagane" value="<?php echo $kategoriaDane->nr_kolejnosci; ?>" data-wartosc_domyslna="<?php echo $kategoriaDane->nr_kolejnosci; ?>" data-kolumna="nr_kolejnosci" placeholder="Nr">
            </div>
            <div class="col-md-10 padding_r_0 margin_b_10 form-group">
                <input type="text" class="form-control height_40 update wymagane" value="<?php echo $kategoriaDane->wartosc; ?>" data-wartosc_domyslna="<?php echo $kategoriaDane->wartosc; ?>" data-kolumna="wartosc" placeholder="Nazwa">
            </div>
            <button type="button" data-element_id="<?php echo $kategoriaDane->id; ?>" data-klasa_rodzic="dane_kategoria_film" data-tabela="film_kategoria" data-akcja="zapisz_kategorie_filmu" class="btn btn-success width_100 zapiszZmianyFilm">Zapisz zmiany</button>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane kategoriaWidocznosc zakladkaWidocznosc" id="kategoriaWidocznosc">
        <?php
            $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','film_kategoria_id_uzytkownik_grupy_id','film_kategoria_id = '.$kategoriaDane->id);
            echo $filmyMain->widocznoscGrupyUzytkownikow($listaGrupPrzyznanych, 'film_kategoria_id_uzytkownik_grupy_id', 'film_kategoria_id', $kategoriaDane->id);

            $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','film_kategoria_id_uzytkownik_id','film_kategoria_id = '.$kategoriaDane->id);
            echo $filmyMain->widocznoscUzytkownikow($listaUzytkownikow, 'film_kategoria_id_uzytkownik_id','film_kategoria_id', $kategoriaDane->id, 'wyswietl_edytuj_kategorie_filmu');
        ?>
    </div>
</div>
