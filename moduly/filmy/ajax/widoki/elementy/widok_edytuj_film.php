<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();
$filmyMain = new FilmyMain($bazaDanych);

$filmDane = $widokDane['filmDane'];
$listaKategori = $widokDane['listaKategori'];
?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active filmOgolne"><a href="#filmOgolne" aria-controls="filmOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
    <li role="presentation" class="filmWidocznosc zakladkaWidocznosc"><a href="#filmWidocznosc" aria-controls="filmWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>
</ul>
<div class="tab-content tabContentStyle filmEdytuj">
    <div role="tabpanel" class="tab-pane active filmOgolne" id="filmOgolne">
        <div class="dane_film">
            <div class="col-md-2 padding_r_0 padding_l_0 margin_b_10 form-group">
                <input type="text" class="form-control height_40 prm wymagane" value="<?php echo $filmDane->nr_kolejnosci; ?>" data-wartosc_domyslna="<?php echo $filmDane->nr_kolejnosci; ?>" data-kolumna="nr_kolejnosci" placeholder="Nr">
            </div>
            <div class="col-md-10 padding_r_0 margin_b_10 form-group">
                <input type="text" class="form-control height_40 prm wymagane" value="<?php echo $filmDane->tytul; ?>" data-wartosc_domyslna="<?php echo $filmDane->tytul; ?>" data-kolumna="tytul" placeholder="Tytuł">
            </div>
            <div class="clear_b"></div>
            <div class="filmMiniatura">
                <?php
                    echo $filmyMain->pobierzZdjecie($filmDane->id, $filmDane->miniatura, 'width_100 height_auto margin_b_10');
                ?>
            </div>
            <div data-rodzic_klasa="filmMiniatura" class="btn btn-default margin_b_10 przyciskUploadGrupaUpload filmMiniaturaUpload">
                <span class="przyciskUploadGrupaNazwa">Wybierz miniature</span>
                <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
            </div>
            <div class="dropdown width_100 margin_b_10">
                <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php
                        $kategoria_tmp = $bazaDanych->pobierzDane('wartosc','film_kategoria','id = '.$filmDane->kategoria_id);
                        $kategoria_tmp = $kategoria_tmp->fetch_object();
                    ?>
                    <div data-kolumna="kategoria_id" data-wartosc_domyslna="<?php echo $filmDane->kategoria_id; ?>" value="<?php echo $filmDane->kategoria_id; ?>" class="dpUstawOpcjeNazwa attrValue prm wymagane float_l"><?php echo $kategoria_tmp->wartosc; ?></div>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    foreach($listaKategori as $lk){
                        echo '<li class="dpUstawOpcje" data-element_id="'.$lk['id'].'">'.mb_ucfirst($lk['wartosc']).'</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="float_l btn btn-default margin_b_10 przyciskUploadGrupaUpload filmPoleUpload">
                <span class="przyciskUploadGrupaNazwa filmNazwa"><?php echo $filmDane->r360; ?></span>
                <input class="cursor_p" accept="video/mp4,video/x-m4v,video/*" data-kolumna="r360" type="file" />
            </div>
            <button type="button" data-klasa_rodzic="dane_film" data-tabela="film" data-akcja="zapisz_zmiany_film" data-element_id="<?php echo $filmDane->id; ?>" class="btn btn-success width_100 zapiszZmianyFilm">Zapisz zmiany</button>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane filmWidocznosc zakladkaWidocznosc" id="filmWidocznosc">
        <?php
            $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','film_grupy','film_id = '.$filmDane->id);
            echo $filmyMain->widocznoscGrupyUzytkownikow($listaGrupPrzyznanych, 'film_grupy', 'film_id', $filmDane->id);

            $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','film_uzytkownik','film_id = '.$filmDane->id);
            echo $filmyMain->widocznoscUzytkownikow($listaUzytkownikow, 'film_uzytkownik','film_id', $filmDane->id, 'wyswietl_edytuj_film');
        ?>
    </div>
</div>
