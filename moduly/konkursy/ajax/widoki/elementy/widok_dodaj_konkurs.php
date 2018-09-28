<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

?>
<div class="konkursDane" data-element_id="">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active konkursOgolne"><a href="#konkursOgolne" aria-controls="konkursOgolne" role="tab" data-toggle="tab">Ogolne</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active padding_10 konkursOgolne konkursOgolneDane" id="konkursOgolne">
            <div class="form-group margin_b_10">
                <div class="col-md-1 padding_l_0">
                    <input type="text" class="form-control height_40 prm wymagane poleLiczbowe" data-kolumna="nr_kolejnosci" placeholder="Nr" value="0">
                </div>
                <div class="col-md-11 padding_r_0 padding_l_0">
                    <input type="text" class="form-control height_40 col-md-11 prm wymagane duzeMaleLiteryCyfry" data-kolumna="tytul" placeholder="Nazwa" value="">
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="width_100">
                <div class="col-md-6 padding_l_0 padding_r_5">
                    <div class="panel panel-default margin_b_10">
                        <div class="panel-heading">Miniatura</div>
                        <div class="panel-body">
                            <div class="konkursMiniatura">

                            </div>
                            <div data-rodzic_klasa="konkursMiniatura" class="float_l btn btn-default margin_t_10 przyciskUploadGrupaUpload konkursMiniaturaUpload">
                                <span class="przyciskUploadGrupaNazwa">Przeglądaj...</span>
                                <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 padding_r_0 padding_l_5">
                    <div class="panel panel-default margin_b_10">
                        <div class="panel-heading">Pełne zdjęcie</div>
                        <div class="panel-body">
                            <div class="konkursPelneZdjecie">

                            </div>
                            <div data-rodzic_klasa="konkursPelneZdjecie" class="float_l btn btn-default margin_t_10 przyciskUploadGrupaUpload konkursPelneZdjecieUpload">
                                <span class="przyciskUploadGrupaNazwa">Przeglądaj...</span>
                                <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="form-group margin_b_10">
                <textarea class="form-control prm editor_prosty duzeMaleLiteryCyfry" data-kolumna="opis" placeholder="Opis"></textarea>
            </div>
            <button type="button" class="btn btn-success width_100 height_40 konkursDodajNowy">Dodaj konkurs</button>
        </div>


    </div>
</div>
