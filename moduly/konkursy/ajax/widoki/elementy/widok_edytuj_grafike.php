<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $bazaDanych = new main_BazaDanych();
    $konkursyMain = new KonkursyMain($bazaDanych);

    $widokDane = $widokDane['grafika'];
?>
<div class="panelDodatkoweZdjecie konkursGrafikaSzczegoly" data-element_id="<?php echo $widokDane->id; ?>">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active dodatkoweZdjecieOgolne"><a href="#dodatkoweZdjecieOgolne" aria-controls="dodatkoweZdjecieOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
        <li role="presentation" class="dodatkoweZdjecieWidocznosc"><a href="#dodatkoweZdjecieWidocznosc" aria-controls="dodatkoweZdjecieWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active padding_10 dodatkoweZdjecieOgolne" id="dodatkoweZdjecieOgolne">
            <div class="form-group margin_b_10">
                <input type="text" class="form-control height_40 konkursDodatkoweZdjecieNazwa" placeholder="Nazwa" data-wartosc_domyslna="<?php echo $widokDane->nazwa; ?>" value="<?php echo $widokDane->nazwa; ?>">
            </div>
            <div class="konkursDodatkoweZdjecie">
                <?php echo $konkursyMain->pobierzZdjecie($widokDane->konkurs_id,$widokDane->nazwa_pliku,'width_100 height_auto'); ?>
            </div>
            <div data-rodzic_klasa="konkursDodatkoweZdjecie" class="float_l btn btn-default margin_t_10 przyciskUploadGrupaUpload konkursDodatkoweZdjecieUpload">
                <span class="przyciskUploadGrupaNazwa">Przeglądaj...</span>
                <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
            </div>
            <div class="clear_b"></div>
            <button type="button" data-tabela="konkurs_grafiki" data-element_id="<?php echo $widokDane->id; ?>" class="btn btn-success width_100 margin_t_10 height_40 konkursZapiszZmianyDodatkowaGrafike">Zapisz zmiany</button>
        </div>
        <div role="tabpanel" class="tab-pane padding_10 dodatkoweZdjecieWidocznosc" id="dodatkoweZdjecieWidocznosc">
            <div class="panel panel-default margin_b_0">
                <div class="panel-heading">Grupy użytkowników</div>
                <div class="panel-body padding_b_0 padding_r_0">
                    <?php
                        if($_SESSION['uzytkownik_grupa_id'] === '1'){
                            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0');
                        }else{
                            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0 AND id != 1');
                        }


                        $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','konkurs_grafiki_id_uzytkownik_grupy_id','konkurs_grafiki_id = '.$widokDane->id);
                        $listaGrupPrzyznanych_array = array();

                        if(!is_null($listaGrupPrzyznanych)){
                            while($poj_listaGrupPrzyznanych = $listaGrupPrzyznanych->fetch_object()){
                                array_push($listaGrupPrzyznanych_array, $poj_listaGrupPrzyznanych->uzytkownik_grupy_id);
                            }
                        }

                        while($poj_listaGrupUzytkownikow = $listaGrupUzytkownikow->fetch_object()){
                            echo '<div class=" col-md-4 col-xs-6 padding_l_0">';
                            echo '<div class="well well-sm margin_b_15">'.$poj_listaGrupUzytkownikow->nazwa.'<i class="fa fa-'.((in_array($poj_listaGrupUzytkownikow->id,$listaGrupPrzyznanych_array)) ? 'check-' : '' ).'square-o float_r konkursGrafikaDodajUprawnienieGrupy" data-element_id="'.$poj_listaGrupUzytkownikow->id.'" aria-hidden="true"></i></div>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>