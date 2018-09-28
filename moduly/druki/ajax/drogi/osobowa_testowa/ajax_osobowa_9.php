<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

$DataUmowy = '';
$Miasto = '';
$ProcentWynagrodzenia = '';
$DataPouczenia = '';
$MiastoPouczenia = '';
$JednostkaId = '';
$KonsultantId = '';

$umowaJednostkaId = $bazaDanych->pobierzDane('*', 'umowaSlownikKodJednostki', 'czy_usuniety=0');

if($akcja == 'edytuj' ){

    $element_id = explode('-',$element_id);

    $umowa_dane_ogolne = $bazaDanych->pobierzDane('*', 'umowa', 'Id = ' . $element_id[0]);
    $umowa_dane_ogolne = $umowa_dane_ogolne->fetch_object();

    $umowa_procent = $bazaDanych->pobierzDane('ProcentWynagrodzenia', 'umowa' . mb_ucfirst($droga), 'Id = ' . $element_id[2]);

    if ($umowa_procent) {
        $umowa_procent = $umowa_procent->fetch_object();
    }

    $umowaSlownikJednostkaId = $bazaDanych->pobierzDane('*', 'umowaSlownikKodJednostki', 'Id=' . $umowa_dane_ogolne->JednostkaId);
    $umowaSlownikJednostkaId = $umowaSlownikJednostkaId->fetch_object();

    $DataUmowy = $umowa_dane_ogolne->DataUmowy;
    $Miasto = $umowa_dane_ogolne->Miasto;
    $DataPouczenia = $umowa_dane_ogolne->DataPouczenia;
    $MiastoPouczenia = $umowa_dane_ogolne->MiastoPouczenia;

    $JednostkaId = $umowa_dane_ogolne->JednostkaId;
    $KonsultantId = $umowa_dane_ogolne->KonsultantId;

    $ProcentWynagrodzenia = ($umowa_procent->ProcentWynagrodzenia == '') ? '' : $umowa_procent->ProcentWynagrodzenia;

        $umowa_dane_osobowa = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = ' . $element_id[2]);
        $umowa_dane_osobowa = $umowa_dane_osobowa->fetch_object();

        $umowaSlownikTypUmowyOsobowejNazwa = $bazaDanych->pobierzDane('Wartosc', 'umowaSlownikUmowaOsobowaTyp', 'Id=' . $umowa_dane_osobowa->UmowaOsobowaTypId);
        $umowaSlownikTypUmowyOsobowejNazwa = $umowaSlownikTypUmowyOsobowejNazwa->fetch_object();

        if ($umowa_dane_osobowa->TypSzkodyId == 2) {
            $umowaTypNazwa = $bazaDanych->pobierzDane('*', 'umowaSlownikUmowaOsobowaTyp', 'Smierciowa=1');
        } else if ($umowa_dane_osobowa->TypSzkodyId == 1) {
            $umowaTypNazwa = $bazaDanych->pobierzDane('*', 'umowaSlownikUmowaOsobowaTyp', 'Obrazenia=1');
        } else {
            $umowaTypNazwa = $bazaDanych->pobierzDane('*', 'umowaSlownikUmowaOsobowaTyp', 'Id!=0');
        }

        //$umowaTypNazwa = $bazaDanych->pobierzDane('*', 'umowaSlownikUmowaOsobowaTyp', 'Id!=0');

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}

?>
<div class="daneStronyUmowyPopUp">

    <label class="margin_t_10 width_100 gray_background">PODSTAWOWE DANE DO UMOWY</label>

    <label class="margin_t_10 width_100">Data, miejsce umowy i procent wynagrodzenia:</label>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Miasto; ?>" value="<?php echo $Miasto; ?>" data-kolumna="Miasto" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość umowy"></div>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $DataUmowy; ?>" value="<?php echo $DataUmowy; ?>" data-kolumna="DataUmowy" type="text" maxlength="10" class="update datePicker" placeholder="Data umowy"></div>
    <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $ProcentWynagrodzenia; ?>" value="<?php echo $ProcentWynagrodzenia; ?>" data-kolumna="ProcentWynagrodzenia" type="text" maxlength="2" data-wartosc_maks="35" class="update poleLiczbowe wynagrodzenieProcent"  placeholder="% wynagrodzenia"></div>


    <label class=" width_100 margin_t_10">Kod jednostki oraz kod konsultanta</label>

    <div class="col-md-4 inputPole padding_r_10">
        <div class="dropdown width_100">
            <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <div data-kolumna="JednostkaId" data-wartosc_domyslna="" value="<?php echo ($umowa_dane_ogolne->JednostkaId == '1') ? '1' : $umowa_dane_ogolne->JednostkaId; ?>" class="dpUstawOpcjeNazwa attrValue update float_l ""><?php echo ( $umowa_dane_ogolne->JednostkaId == '1') ? 'Brak' : $umowaSlownikJednostkaId->Wartosc; ; ?></div>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                while($poj_umowaJednostkaId = $umowaJednostkaId->fetch_object()){
                    echo '<li class="dpUstawOpcje typKlientaOpcja" data-element_id="'.$poj_umowaJednostkaId->Id.'">'.mb_ucfirst($poj_umowaJednostkaId->Wartosc).'</li>';
                }
                ?>
            </ul>
        </div>
    </div>


<div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $KonsultantId; ?>" value="<?php echo $KonsultantId; ?>" data-kolumna="KonsultantId" type="text" class="update duzeMaleLiteryCyfry" placeholder="Kod konsultanta"></div>



<div class="clear_b"></div>
    <label class=" width_100 margin_t_10">Wybierz typ umowy:</label>

        <div class="drukUmowy">
            <div class="dropdown width_100">
                <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <div data-kolumna="UmowaOsobowaTypId" data-wartosc_domyslna="<?php echo $umowa_dane_ogolne->UmowaTypId?>" value="<?php echo ($umowa_dane_ogolne->UmowaTypId == '5') ? '5' : $umowa_dane_ogolne->UmowaTypId; ; ?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php echo ($umowa_dane_osobowa->UmowaOsobowaTypId == '5') ? 'Brak' : $umowaSlownikTypUmowyOsobowejNazwa->Wartosc; ; ?></div>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    while($poj_umowaSlownikUmowaOsobowaTyp = $umowaTypNazwa->fetch_object()){
                        echo '<li class="dpUstawOpcje typKlientaOpcja" data-element_id="'.$poj_umowaSlownikUmowaOsobowaTyp->Id.'">'.mb_ucfirst($poj_umowaSlownikUmowaOsobowaTyp->Wartosc).'</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>



    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowa" data-strona="9" data-ogolne="0" data-akcja="aktualizuj_dodatkowe_informacje" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>


</div>