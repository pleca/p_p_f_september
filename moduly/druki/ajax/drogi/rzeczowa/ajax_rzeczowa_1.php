<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

$DataUmowy = '';
$Miasto = '';
$ProcentWynagrodzenia = '';
$DataPouczenia = '';
$MiastoPouczenia = '';
//$JednostkaId = '';
$JednostkaNumer = '';
$KonsultantId = '';

//$umowaJednostkaId = $bazaDanych->pobierzDane('*', 'umowaSlownikKodJednostki', 'czy_usuniety=0');

if($akcja == 'edytuj') {
    $element_id = explode('-', $element_id);

    $umowa_dane_ogolne = $bazaDanych->pobierzDane('*', 'umowa', 'Id = ' . $element_id[0]);
    $umowa_dane_ogolne = $umowa_dane_ogolne->fetch_object();

    $umowa_procent = $bazaDanych->pobierzDane('ProcentWynagrodzenia', 'umowa' . mb_ucfirst($droga), 'Id = ' . $element_id[2]);

    if ($umowa_procent) {
        $umowa_procent = $umowa_procent->fetch_object();
    }

/*    $umowaSlownikJednostkaId = $bazaDanych->pobierzDane('*', 'umowaSlownikKodJednostki', 'Id=' . $umowa_dane_ogolne->JednostkaId);
    $umowaSlownikJednostkaId = $umowaSlownikJednostkaId->fetch_object();*/

    $DataUmowy = $umowa_dane_ogolne->DataUmowy;
    $Miasto = $umowa_dane_ogolne->Miasto;
    $DataPouczenia = $umowa_dane_ogolne->DataPouczenia;
    $MiastoPouczenia = $umowa_dane_ogolne->MiastoPouczenia;

    //$JednostkaId = $umowa_dane_ogolne->JednostkaId;
    $JednostkaNumer = $umowa_dane_ogolne->JednostkaNumer;
    $KonsultantId = $umowa_dane_ogolne->KonsultantId;

    $ProcentWynagrodzenia = ($umowa_procent->ProcentWynagrodzenia == '') ? '' : $umowa_procent->ProcentWynagrodzenia;


        $umowa_dane_rzeczowa = $bazaDanych->pobierzDane('*', 'umowaRzeczowa', 'Id = ' . $element_id[2]);
        $umowa_dane_rzeczowa = $umowa_dane_rzeczowa->fetch_object();

        $umowaSlownikTypUmowyRzeczowejNazwa = $bazaDanych->pobierzDane('Wartosc', 'umowaSlownikUmowaRzeczowaTyp', 'Id=' . $umowa_dane_rzeczowa->UmowaRzeczowaTypId);
        $umowaSlownikTypUmowyRzeczowejNazwa = $umowaSlownikTypUmowyRzeczowejNazwa->fetch_object();

        $umowaTypNazwa = $bazaDanych->pobierzDane('*', 'umowaSlownikUmowaRzeczowaTyp', 'czy_usuniety=0');

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}

?>
<div class="daneStronyUmowyPopUp">
    <label class=" width_100">Data, miejsce umowy</label>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Miasto; ?>" value="<?php echo $Miasto; ?>" data-kolumna="Miasto" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość umowy"></div>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $DataUmowy; ?>" value="<?php echo $DataUmowy; ?>" data-kolumna="DataUmowy" type="text" maxlength="10" class="update datePicker" placeholder="Data umowy"></div>
<!--    <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php /*echo $ProcentWynagrodzenia; */?>" value="<?php /*echo $ProcentWynagrodzenia; */?>" data-kolumna="ProcentWynagrodzenia" type="text" maxlength="2" data-wartosc_maks="35" class="update poleLiczbowe wynagrodzenieProcent"  placeholder="% wynagrodzenia"></div>-->

    <label class=" width_100 margin_t_10">Kod jednostki oraz kod konsultanta</label>

<!--    <div class="col-md-4 inputPole padding_r_10">
        <div class="dropdown width_100">
            <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <div data-kolumna="JednostkaId" data-wartosc_domyslna="" value="<?php /*echo ($umowa_dane_ogolne->JednostkaId == '1') ? '1' : $umowa_dane_ogolne->JednostkaId; */?>" class="dpUstawOpcjeNazwa attrValue update float_l ""><?php /*echo ( $umowa_dane_ogolne->JednostkaId == '1') ? 'Brak' : $umowaSlownikJednostkaId->Wartosc; ; */?></div>
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
/*                while($poj_umowaJednostkaId = $umowaJednostkaId->fetch_object()){
                    echo '<li class="dpUstawOpcje typKlientaOpcja" data-element_id="'.$poj_umowaJednostkaId->Id.'">'.mb_ucfirst($poj_umowaJednostkaId->Wartosc).'</li>';
                }
                */?>
            </ul>
        </div>
    </div>-->

<div class="col-md-4 inputPole padding_r_10"><input id="autocomplete" data-wartosc_domyslna="<?php echo $JednostkaNumer; ?>" value="<?php echo $JednostkaNumer; ?>" data-kolumna="JednostkaNumer" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Kod jednostki"></div>
<div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $KonsultantId; ?>" value="<?php echo $KonsultantId; ?>" data-kolumna="KonsultantId" type="text" class="update duzeMaleLiteryCyfry" placeholder="Kod konsultanta"></div>


    <div class="clear_b"></div>
    <label class=" width_100 margin_t_10">Wybierz typ umowy</label>

        <div class="drukUmowy">
            <div class="dropdown width_100">
                <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <div data-kolumna="UmowaRzeczowaTypId" data-wartosc_domyslna="" value="<?php echo ($umowa_dane_ogolne->UmowaTypId == '') ? '6' : $umowa_dane_ogolne->UmowaTypId; ; ?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php echo ($UmowaTypKlientaId == '6') ? 'Brak' : $umowaSlownikTypUmowyRzeczowejNazwa->Wartosc; ; ?></div>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    while($poj_umowaSlownikUmowaRzeczowaTyp = $umowaTypNazwa->fetch_object()){
                        echo '<li class="dpUstawOpcje typKlientaOpcja" data-element_id="'.$poj_umowaSlownikUmowaRzeczowaTyp->Id.'">'.mb_ucfirst($poj_umowaSlownikUmowaRzeczowaTyp->Wartosc).'</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>



    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowa" data-strona="1" data-ogolne="0" data-akcja="aktualizuj_dodatkowe_informacje" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>


</div>