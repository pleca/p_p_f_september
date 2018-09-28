<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');


$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

    $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);

    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $TypSzkodyId = $umowa_dane_tmp->TypSzkodyId;
        $RodzajSzkodyId = $umowa_dane_tmp->RodzajSzkodyId;
        $TypZdarzeniaId = $umowa_dane_tmp->TypZdarzeniaId;

        $zdarzenie_dane_tmp = $bazaDanych->pobierzDane('*', 'umowaZdarzenie', 'Id=' . $umowa_dane_tmp->ZdarzenieId);

            if ($zdarzenie_dane_tmp) {
                $zdarzenie_dane_tmp = $zdarzenie_dane_tmp->fetch_object();

                $Data = $zdarzenie_dane_tmp->Data;
                $Godzina = $zdarzenie_dane_tmp->Godzina;
                $Miejscowosc = $zdarzenie_dane_tmp->Miejscowosc;

                $pojazd_a_dane_tmp = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id=' . $zdarzenie_dane_tmp->PojazdAId);
                if ($pojazd_a_dane_tmp) {
                    $pojazd_a_dane_tmp = $pojazd_a_dane_tmp->fetch_object();

                    $SprawcaPojazdA = $pojazd_a_dane_tmp->SprawcaPojazd;
                    $MarkaA = $pojazd_a_dane_tmp->Marka;
                    $ModelA = $pojazd_a_dane_tmp->Model;
                    $TypA = $pojazd_a_dane_tmp->Typ;
                    $NrRejestracyjnyA = $pojazd_a_dane_tmp->NrRejestracyjny;
                    $KrajRejestracjiA = $pojazd_a_dane_tmp->KrajRejestracji;
                    $NumerPolisyA = $pojazd_a_dane_tmp->NumerPolisy;
                    $KierujacyPojazdemA = $pojazd_a_dane_tmp->KierujacyPojazdem;
                    $PosiadaczPojazduA = $pojazd_a_dane_tmp->PosiadaczPojazdu;
                    $UbezpieczycielA = $pojazd_a_dane_tmp->Ubezpieczyciel;
                }

                $pojazd_b_dane_tmp = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id=' . $zdarzenie_dane_tmp->PojazdBId);
                if ($pojazd_b_dane_tmp) {
                    $pojazd_b_dane_tmp = $pojazd_b_dane_tmp->fetch_object();

                    $SprawcaPojazdB = $pojazd_b_dane_tmp->SprawcaPojazd;
                    $MarkaB = $pojazd_b_dane_tmp->Marka;
                    $ModelB = $pojazd_b_dane_tmp->Model;
                    $TypB = $pojazd_b_dane_tmp->Typ;
                    $NrRejestracyjnyB = $pojazd_b_dane_tmp->NrRejestracyjny;
                    $KrajRejestracjiB = $pojazd_b_dane_tmp->KrajRejestracji;
                    $NumerPolisyB = $pojazd_b_dane_tmp->NumerPolisy;
                    $KierujacyPojazdemB = $pojazd_b_dane_tmp->KierujacyPojazdem;
                    $PosiadaczPojazduB = $pojazd_b_dane_tmp->PosiadaczPojazdu;
                    $UbezpieczycielB = $pojazd_b_dane_tmp->Ubezpieczyciel;
                }

                //$StosunekAId = $zdarzenie_dane_tmp->StosunekAId;
                //$InnyStosunekDoA = $zdarzenie_dane_tmp->InnyStosunekDoA;
                //$StosunekBId = $zdarzenie_dane_tmp->StosunekBId;
                //$InnyStosunekDoB = $zdarzenie_dane_tmp->InnyStosunekDoB;

                $OpisZdarzenia = $zdarzenie_dane_tmp->OpisZdarzenia;
                $OpisObrazen = $zdarzenie_dane_tmp->OpisObrazen;

            }

    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneOZdarzeniuPopUp">

            <label class="margin_t_10 width_100 gray_background">INFORMACJE O ZDARZENIU</label>

            <label class="margin_t_10 width_100">Data, godzina i miejsce zdarzenia</label>
            <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Data; ?>" value="<?php echo $Data; ?>" data-kolumna="Data" type="text" class="update wymagane duzeMaleLiteryCyfry datePicker" placeholder="Data"></div>
            <div class="col-md-4 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $Godzina; ?>" value="<?php echo $Godzina; ?>" data-kolumna="Godzina" type="text" class="update wymagane duzeMaleLiteryCyfry timePicker" placeholder="Godzina"></div>
            <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $Miejscowosc; ?>" value="<?php echo $Miejscowosc; ?>" data-kolumna="Miejscowosc" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>
            <div class="clear_b"></div>

            <?php if ($TypZdarzeniaId == 1) { ?>

                <div class="col-md-12">
                    <label class="margin_t_10 float_l">Pojazd A (w którym znajdował się poszkodowany)</label>

                    <div class="zpg_opcja zpg_opcja_input float_r margin_t_10">
                        <i data-wartosc_domyslna="<?php echo $SprawcaPojazdA; ?>" value="<?php echo $SprawcaPojazdA; ?>" data-kolumna="SprawcaPojazdA" class="fa fa<?php echo ($SprawcaPojazdA == 1) ? '-check' : '' ; ?>-square-o fa-1 float_l attrValue margin_t_5" aria-hidden="true"></i>
                        <p class="float_l">pojazd sprawcy</p>
                    </div>
                </div>

            <div class="col-md-3 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $MarkaA; ?>" value="<?php echo $MarkaA; ?>" data-kolumna="MarkaA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Marka pojazdu"></div>
            <div class="col-md-3 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $ModelA; ?>" value="<?php echo $ModelA; ?>" data-kolumna="ModelA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Model pojazdu"></div>

                <?php

                $umowaSlownikTypPojazduAId = $bazaDanych->pobierzDane('*', 'umowaSlownikTypPojazdu', 'czy_usuniety=0');

                $umowaSlownikTypPojazduA = $bazaDanych->pobierzDane('*', 'umowaSlownikTypPojazdu', 'Id=' . $TypA);

                if($umowaSlownikTypPojazduA) {
                    $umowaSlownikTypPojazduA = $umowaSlownikTypPojazduA->fetch_object();
                }
                ?>

                <div class="col-md-3 sposobPlatnosci padding_r_10">
                    <div class="dropdown width_100">
                        <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><div data-kolumna="TypA" data-wartosc_domyslna="<?php echo ($TypA == '0' || $TypA == NULL) ? '0' : $TypA; ?>" value="<?php echo ($TypA == '0'  || $TypA == NULL) ? '0' : $TypA; ?>" class="dpUstawOpcjeNazwa attrValue update float_l"><?php echo ($TypA == "0" || $TypA == NULL) ? "TypPojazdu" : $umowaSlownikTypPojazduA->Wartosc; ?></div>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php
                            while($poj_umowaSlownikTypPojazduAId = $umowaSlownikTypPojazduAId->fetch_object()){
                                echo '<li class="dpUstawOpcje UmowaRodzajUprawnionegoOpcja" data-element_id="'.$poj_umowaSlownikTypPojazduAId->Id.'">'.mb_ucfirst($poj_umowaSlownikTypPojazduAId->Wartosc).'</li>';
                            }
                            ?>

                        </ul>
                    </div>
                </div>


            <!--<div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php /*echo $TypA; */?>" value="<?php /*echo $TypA; */?>" data-kolumna="TypA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Typ pojazdu"></div>-->
            <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrRejestracyjnyA; ?>" value="<?php echo $NrRejestracyjnyA; ?>" data-kolumna="NrRejestracyjnyA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr rejestracyjny"></div>
            <div class="clear_b"></div>
            <div class="col-md-6 inputPole padding_r_10 margin_t_10 "><input data-wartosc_domyslna="<?php echo $KrajRejestracjiA; ?>" value="<?php echo $KrajRejestracjiA; ?>" data-kolumna="KrajRejestracjiA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Kraj rejestracji pojazdu"></div>
            <div class="col-md-6 inputPole margin_t_10 "><input data-wartosc_domyslna="<?php echo $NumerPolisyA; ?>" value="<?php echo $NumerPolisyA; ?>" data-kolumna="NumerPolisyA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Numer polisy"></div>
            <div class="clear_b"></div>
            <div class="col-md-6 inputPole padding_r_10 margin_t_10 "><input data-wartosc_domyslna="<?php echo $KierujacyPojazdemA; ?>" value="<?php echo $KierujacyPojazdemA; ?>" data-kolumna="KierujacyPojazdemA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Kierujący pojazdem"></div>
            <div class="col-md-6 inputPole margin_t_10 "><input data-wartosc_domyslna="<?php echo $PosiadaczPojazduA; ?>" value="<?php echo $PosiadaczPojazduA; ?>" data-kolumna="PosiadaczPojazduA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Posiadacz pojazdu"></div>
            <div class="clear_b"></div>
            <div class="col-md-12 inputPole margin_t_10 "><input data-wartosc_domyslna="<?php echo $UbezpieczycielA; ?>" value="<?php echo $UbezpieczycielA; ?>" data-kolumna="UbezpieczycielA" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ubezpieczyciel posiadacza pojazdu"></div>
            <div class="clear_b"></div>

            <?php } ?>


                <div class="col-md-12">
                    <label class="margin_t_10 float_l">Pojazd B</label>

                    <div class="zpg_opcja zpg_opcja_input float_r margin_t_10">
                        <i data-wartosc_domyslna="<?php echo $SprawcaPojazdB; ?>" value="<?php echo $SprawcaPojazdB; ?>" data-kolumna="SprawcaPojazdB" class="fa fa<?php echo ($SprawcaPojazdB == 1) ? '-check' : '' ; ?>-square-o fa-1 float_l attrValue margin_t_5" aria-hidden="true"></i>
                        <p class="float_l">pojazd sprawcy</p>
                    </div>
                </div>

            <div class="col-md-3 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $MarkaB; ?>" value="<?php echo $MarkaB; ?>" data-kolumna="MarkaB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Marka pojazdu"></div>
            <div class="col-md-3 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $ModelB; ?>" value="<?php echo $ModelB; ?>" data-kolumna="ModelB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Model pojazdu"></div>

                <?php

                $umowaSlownikTypPojazduBId = $bazaDanych->pobierzDane('*', 'umowaSlownikTypPojazdu', 'czy_usuniety=0');

                $umowaSlownikTypPojazduB = $bazaDanych->pobierzDane('*', 'umowaSlownikTypPojazdu', 'Id=' . $TypB);

                if($umowaSlownikTypPojazduB) {
                    $umowaSlownikTypPojazduB = $umowaSlownikTypPojazduB->fetch_object();
                }
                ?>

                <div class="col-md-3 sposobPlatnosci padding_r_10">
                    <div class="dropdown width_100">
                        <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><div data-kolumna="TypB" data-wartosc_domyslna="<?php echo ($TypB == '0' || $TypB == NULL) ? '0' : $TypB; ?>" value="<?php echo ($TypB == '0'  || $TypB == NULL) ? '0' : $TypB; ?>" class="dpUstawOpcjeNazwa attrValue update float_l"><?php echo ($TypB == "0" || $TypB == NULL) ? "TypPojazdu" : $umowaSlownikTypPojazduB->Wartosc; ?></div>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php
                            while($poj_umowaSlownikTypPojazduBId = $umowaSlownikTypPojazduBId->fetch_object()){
                                echo '<li class="dpUstawOpcje UmowaRodzajUprawnionegoOpcja" data-element_id="'.$poj_umowaSlownikTypPojazduBId->Id.'">'.mb_ucfirst($poj_umowaSlownikTypPojazduBId->Wartosc).'</li>';
                            }
                            ?>

                        </ul>
                    </div>
                </div>

            <!--<div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php /*echo $TypB; */?>" value="<?php /*echo $TypB; */?>" data-kolumna="TypB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Typ pojazdu"></div>-->
            <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrRejestracyjnyB; ?>" value="<?php echo $NrRejestracyjnyB; ?>" data-kolumna="NrRejestracyjnyB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr rejestracyjny"></div>
            <div class="clear_b"></div>
            <div class="col-md-6 inputPole padding_r_10 margin_t_10 "><input data-wartosc_domyslna="<?php echo $KrajRejestracjiB; ?>" value="<?php echo $KrajRejestracjiB; ?>" data-kolumna="KrajRejestracjiB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Kraj rejestracji pojazdu"></div>
            <div class="col-md-6 inputPole margin_t_10 "><input data-wartosc_domyslna="<?php echo $NumerPolisyB; ?>" value="<?php echo $NumerPolisyB; ?>" data-kolumna="NumerPolisyB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Numer polisy"></div>
            <div class="clear_b"></div>
            <div class="col-md-6 inputPole padding_r_10 margin_t_10 "><input data-wartosc_domyslna="<?php echo $KierujacyPojazdemB; ?>" value="<?php echo $KierujacyPojazdemB; ?>" data-kolumna="KierujacyPojazdemB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Kierujący pojazdem"></div>
            <div class="col-md-6 inputPole margin_t_10 "><input data-wartosc_domyslna="<?php echo $PosiadaczPojazduB; ?>" value="<?php echo $PosiadaczPojazduB; ?>" data-kolumna="PosiadaczPojazduB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Posiadacz pojazdu"></div>
            <div class="clear_b"></div>
            <div class="col-md-12 inputPole margin_t_10 "><input data-wartosc_domyslna="<?php echo $UbezpieczycielB; ?>" value="<?php echo $UbezpieczycielB; ?>" data-kolumna="UbezpieczycielB" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ubezpieczyciel posiadacza pojazdu"></div>
            <div class="clear_b"></div>

            <?php /*if ($TypZdarzeniaId == 1) { */?><!--
            <label class="margin_t_10 width_100">Stosunek do kierującego pojazdem A</label>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php /*echo $StosunekAId; */?>" value="1" data-kolumna="StosunekAId" class="fa fa<?php /*echo ($StosunekAId == 1) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">obcy</p></div>
                <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php /*echo $StosunekAId; */?>" value="2" data-kolumna="StosunekAId" class="fa fa<?php /*echo ($StosunekAId == 2) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">rodzina</p></div>
                <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php /*echo $StosunekAId; */?>" value="3" data-kolumna="StosunekAId" class="fa fa<?php /*echo ($StosunekAId == 3) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">inny</p></div>
            </div>
            <div class="clear_b"></div>
            --><?php /*} */?>

            <?php /*if ($RodzajSzkodyId == 1) { */?><!--
            <label class="margin_t_10 width_100">Stosunek do kierującego pojazdem B</label>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php /*echo $StosunekBId; */?>" value="1" data-kolumna="StosunekBId" class="fa fa<?php /*echo ($StosunekBId == 1) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">obcy</p></div>
                <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php /*echo $StosunekBId; */?>" value="2" data-kolumna="StosunekBId" class="fa fa<?php /*echo ($StosunekBId == 2) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">rodzina</p></div>
                <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php /*echo $StosunekBId; */?>" value="3" data-kolumna="StosunekBId" class="fa fa<?php /*echo ($StosunekBId == 3) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">inny</p></div>
            </div>
            <div class="clear_b"></div>
            <?php /*} */?>

            <label class="margin_t_10 width_100 gray_background">OPIS WYPADKU</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content" id='textarea_content' rows="6" id="comment" data-kolumna="OpisZdarzenia" data-wartosc_domyslna="<?php /*echo $OpisZdarzenia; */?>"><?php /*echo $OpisZdarzenia; */?></textarea>
            </div>-->

            <?php if ($TypSzkodyId == 1) { ?>
            <label class="margin_t_10 width_100 gray_background">OPIS OBRAŻEŃ</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content policz_znaki" id='textarea_content' rows="6" data-liczba_znakow="315" id="comment" data-kolumna="OpisObrazen" data-wartosc_domyslna="<?php echo $OpisObrazen; ?>"><?php echo $OpisObrazen; ?></textarea>
                Pozostało znaków: <span class="pozostalo_znakow">315</span>
            </div>
            <?php } ?>

            <label class="margin_t_10 width_100 gray_background">OPIS ZDARZENIA</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content policz_znaki" id='textarea_content' rows="6" data-liczba_znakow="870" id="comment" data-kolumna="OpisZdarzenia" data-wartosc_domyslna="<?php echo $OpisZdarzenia; ?>"><?php echo $OpisZdarzenia; ?></textarea>
                Pozostało znaków: <span class="pozostalo_znakow">870</span>
            </div>

            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneOZdarzeniuPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaZdarzenie" data-ogolne="0" data-strona="2" data-akcja="<?php echo (!$zdarzenie_dane_tmp) ? 'dodaj_zdarzenie' : 'aktualizuj_zdarzenie'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
        </div>
