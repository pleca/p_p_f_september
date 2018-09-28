<?php
    $listaKategori = $widokDane['listaKategori'];
?>

<div class="dane_film">
    <div class="col-md-2 padding_r_0 padding_l_0  form-group">
        <input type="text" class="form-control height_40 prm wymagane" value="" data-wartosc_domyslna="" data-kolumna="nr_kolejnosci" placeholder="Nr">
    </div>
    <div class="col-md-10 padding_r_0 margin_b_10  form-group">
        <input type="text" class="form-control height_40 prm wymagane" value="" data-wartosc_domyslna="" data-kolumna="tytul" placeholder="Tytuł">
    </div>
    <div class="clear_b"></div>
    <div class="filmMiniatura">

    </div>
    <div data-rodzic_klasa="filmMiniatura" class="btn btn-default margin_b_10 przyciskUploadGrupaUpload filmMiniaturaUpload">
        <span class="przyciskUploadGrupaNazwa">Wybierz miniature</span>
        <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
    </div>
    <div class="dropdown width_100 margin_b_10">
        <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <div data-kolumna="kategoria_id" data-wartosc_domyslna="" value="1" class="dpUstawOpcjeNazwa attrValue prm wymagane float_l">Ogólne</div>
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
        <span class="przyciskUploadGrupaNazwa filmNazwa">Wybierz film</span>
        <input class="cursor_p" accept="video/mp4,video/x-m4v,video/*" data-kolumna="r360" type="file" />
    </div>
    <button type="button" data-klasa_rodzic="dane_film" data-tabela="film" data-akcja="dodaj_film" class="btn btn-success width_100 zapiszZmianyFilm">Dodaj</button>
</div>