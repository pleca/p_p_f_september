<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();
$konkursyMain = new KonkursyMain($bazaDanych);

$widokDane = $widokDane['konkurs'];

?>

<div class="konkursDane" data-element_id="<?php echo $widokDane->id; ?>">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active konkursOgolne"><a href="#konkursOgolne" aria-controls="konkursOgolne" role="tab" data-toggle="tab">Ogolne</a></li>
        <li role="presentation" class="konkursDokumenty"><a href="#konkursDokumenty" aria-controls="konkursDokumenty" role="tab" data-toggle="tab">Dokumenty</a></li>
        <li role="presentation" class="konkursWidocznosc"><a href="#konkursWidocznosc" aria-controls="konkursWidocznosc" role="tab" data-toggle="tab">Widocznosc</a></li>
        <li role="presentation" class="konkursDodatkoweGrafiki"><a href="#konkursDodatkoweGrafiki" aria-controls="konkursDodatkoweGrafiki" role="tab" data-toggle="tab">Dodatkowe grafiki</a></li>

    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active padding_10 konkursOgolne konkursOgolneDane" id="konkursOgolne">
            <div class="form-group margin_b_10">
                <div class="col-md-1 padding_l_0">
                    <input type="text" class="form-control height_40 prm wymagane poleLiczbowe" data-kolumna="nr_kolejnosci" placeholder="Nazwa" value="<?php echo $widokDane->nr_kolejnosci; ?>">
                </div>
                <div class="col-md-11 padding_r_0 padding_l_0">
                    <input type="text" class="form-control height_40 col-md-11 prm wymagane duzeMaleLiteryCyfry" data-kolumna="tytul" placeholder="Nazwa" value="<?php echo $widokDane->tytul; ?>">
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="width_100">
                <div class="col-md-6 padding_l_0 padding_r_5">
                    <div class="panel panel-default margin_b_10">
                        <div class="panel-heading">Miniatura</div>
                        <div class="panel-body">
                            <div class="konkursMiniatura">
                                <?php echo $konkursyMain->pobierzZdjecie($widokDane->id, $widokDane->miniatura, 'width_100 height_auto'); ?>
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
                        <div class="panel-heading">Pełne zdjęcie<i class="fa fa-trash float_r usunPelneZdjecieKosz" aria-hidden="true"></i></div>
                        <div class="panel-body">
                            <div class="konkursPelneZdjecie">
                                <?php
                                    if(!empty($widokDane->zdjecie_duze)){
                                        echo $konkursyMain->pobierzZdjecie($widokDane->id, $widokDane->zdjecie_duze, 'width_100 height_auto');
                                    }

                                ?>
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
                <textarea class="form-control prm editor_prosty duzeMaleLiteryCyfry" data-kolumna="opis" placeholder="Opis"><?php echo htmlspecialchars_decode($widokDane->opis); ?></textarea>
            </div>
            <button type="button" class="btn btn-success width_100 height_40 konkursZapiszZmiany">Zapisz zmiany</button>
        </div>
        <div role="tabpanel" class="tab-pane padding_10 konkursWidocznosc" id="konkursWidocznosc">
            <div class="panel panel-default margin_b_10 ">
                <div class="panel-heading">Grupy użytkowników</div>
                <div class="panel-body padding_b_0 padding_r_0">
                    <?php
                        if($_SESSION['uzytkownik_grupa_id'] === '1'){
                            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0');
                        }else{
                            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0 AND id != 1');
                        }


                        $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupa_id','konkurs_grupy','konkurs_id = '.$widokDane->id);
                        $listaGrupPrzyznanych_array = array();

                        if(!is_null($listaGrupPrzyznanych)){
                            while($poj_listaGrupPrzyznanych = $listaGrupPrzyznanych->fetch_object()){
                                array_push($listaGrupPrzyznanych_array, $poj_listaGrupPrzyznanych->uzytkownik_grupa_id);
                            }
                        }

                        while($poj_listaGrupUzytkownikow = $listaGrupUzytkownikow->fetch_object()){
                            echo '<div class=" col-md-3 col-xs-6 padding_l_0">';
                                echo '<div class="well well-sm margin_b_15">'.$poj_listaGrupUzytkownikow->nazwa.'<i class="fa fa-'.((in_array($poj_listaGrupUzytkownikow->id,$listaGrupPrzyznanych_array)) ? 'check-' : '' ).'square-o float_r konkursDodajUprawnienieGrupy" data-element_id="'.$poj_listaGrupUzytkownikow->id.'" aria-hidden="true"></i></div>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
            <div class="panel panel-default margin_b_0">
                <div class="panel-heading">Lista użytkowników<i class="fa fa-plus-square float_r widokDodajUprawnienieUzytkownik" aria-hidden="true"></i></div>
                <div class="panel-body">
                    <?php $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','konkurs_uzytkownik','konkurs_id = '.$widokDane->id); ?>
                    <table class="table table-striped tabela_lista_uzytkownikow">
                        <thead>
                            <tr>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-3">login</th>
                                <th class="col-md-3">Imie</th>
                                <th class="col-md-4">Nazwisko</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!is_null($listaUzytkownikow)){
                                    while($poj_listaUzytkownikow = $listaUzytkownikow->fetch_object()){
                                        $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko, login','uzytkownik','id = '.$poj_listaUzytkownikow->uzytkownik_id);
                                        $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();
                                        echo '<tr>';
                                            echo '<td class="col-md-1">'.$poj_listaUzytkownikow->uzytkownik_id.'</td>';
                                            echo '<td class="col-md-3">'.$uzytkownik_tmp->login.'</td>';
                                            echo '<td class="col-md-3">'.$uzytkownik_tmp->imie.'</td>';
                                            echo '<td class="col-md-4">'.$uzytkownik_tmp->nazwisko.'</td>';
                                            echo '<td class="">';
                                                echo '<i class="fa fa-trash float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$poj_listaUzytkownikow->uzytkownik_id.'\' data-reakcja=\'usun\' data-tabela=\'konkurs_uzytkownik\' type=\'button\' class=\'btn btn-danger usunTak dodajUsunUprawnienieUzytkownik\'>TAK</button>"></i>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane padding_10 konkursDokumenty" id="konkursDokumenty">

            <?php echo $konkursyMain->generujListeDokumentow($_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id'], $widokDane->id, true); ?>

        </div>
        <div role="tabpanel" class="tab-pane padding_10 konkursDodatkoweGrafiki" id="konkursDodatkoweGrafiki">
            <div id="konkursListaDodatkowychGrafik">
                <?php echo $konkursyMain->generujListeDodatkowychGrafik($widokDane->id); ?>
            </div>
            <div class="clear_b"></div>
        </div>
    </div>
</div>