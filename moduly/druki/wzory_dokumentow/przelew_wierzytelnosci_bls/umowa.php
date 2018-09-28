<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$liczba_wlascicieli = $_POST['liczba_wlascicieli'];

for($i=1; $i<=$liczba_wlascicieli; $i++) {
    ${'klient_'.$i} = json_decode($_POST['klient_'.$i], true);
    ${'pelnomocnik_'.$i} = json_decode($_POST['pelnomocnik_'.$i], true);
    ${'reprezentant_'.$i} = json_decode($_POST['reprezentant_'.$i], true);
}

//$klient = json_decode($_POST['klient'], true);
//$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
//$umowa_dane = json_decode($_POST['umowa_dane'], true);
//$lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
//$lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];



$stopka = 'PG-2-14-F7/2018-05-24';
//$stopka = 'PG-2-14-F7/2018-02-07';
$nr_strony = 1;
$strony = $liczba_wlascicieli+2;

?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek_bls">
        <div class="pdfs_przedstawiciel_dane">
            <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
        </div>
        <div class="pdfs_tytul_dokumentu pdf_tytul_bls">
            <p class="margin_b_0 font_w_700 font_size_22 text_a_center">UMOWA</p>
            <p class="margin_b_0 font_w_700 font_size_22 text_a_center">PRZELEWU WIERZYTELNOŚCI BLS</p>
            <p class="margin_b_0 font_w_700 font_size_22 text_a_center">NR:</p>
        </div>
        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>
    <p class="font_w_700 margin_t_20 margin_l_20">zawarta na podstawie oferty z dnia <?php echo $umowa['DataUmowy']; ?> r. pomiędzy:</p>
    <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CEDENTEM:</label>
    <div class="pdf_czerwona_kratka pdf_kratka_duza">
        <div class="form-group col-md-3 tlo_podtytulu_czerwone">
            <label class="pdf_duze_litery podtytul_formularza">WŁAŚCICIEL</label>
        </div>
        <!--<div class="form-group col-md-3 tlo_podtytulu_czerwone">
            <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
        </div>-->
        <div class="clear_b"></div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO</label>
            <div class="pdf_kratka"><?php echo ($klient_1['Nazwa'] == '') ? $klient_1['Imie'].' '.$klient_1['Nazwisko'] : $klient_1['Nazwa']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $klient_1['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $klient_1['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $klient_1['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $klient_1['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $klient_1['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($klient_1['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $klient_1['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 ">PESEL</label>
            <div class="pdf_kratka"><?php echo $klient_1['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">NIP</label>
            <div class="pdf_kratka"><?php echo $klient_1['Nip']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
            <div class="pdf_kratka"><?php echo $klient_1['Krs']; ?></div>
        </div>
        <div class="clear_b"></div>
        <!--            <div class="form-group col-md-3 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
        <div class="clear_b"></div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
            <div class="pdf_kratka"><?php echo $klient_1['DataUrodzenia']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">TELEFON KONTAKTOWY</label>
            <div class="pdf_kratka"><?php echo $klient_1['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">E-MAIL</label>
            <div class="pdf_kratka"><?php echo $klient_1['Mail']; ?></div>
        </div>

        <?php /*if ($umowa_dane['UmowaTypKlientaId'] == 1) { */?>

        <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
            <div class="pdf_kratka"><?php echo $klient_1['NazwaUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $klient_1['UlicaUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $klient_1['NrDomuUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $klient_1['NrMieszkaniaUS']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $klient_1['KodPocztowyUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $klient_1['MiastoUS']; ?></div>
        </div>

        <?php /*} */?>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI</label>
            <div class="pdf_kratka"><?php echo $klient_1['WielkoscUdzialu']; ?></div>
        </div>
        <div class="form-group col-md-8">
            <label class="pdf_duze_litery font_size_10 margin_t_20"></label>
        </div>
    </div>

    <?php if ($umowa_dane['UmowaTypKlientaId'] == 1 && isset($pelnomocnik_1['Id'])) { ?>

    <p class="font_w_700 col-md-12 margin_t_10 margin_b_10">reprezentowany przez:</p>
    <div class="pdf_szara_kratka pdf_kratka_duza">
        <div class="form-group col-md-3 tlo_podtytulu_szare">
            <label class="pdf_duze_litery podtytul_formularza">PEŁNOMOCNIK</label>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO</label>
            <div class="pdf_kratka"><?php echo ($pelnomocnik_1['Nazwa'] == '') ? $pelnomocnik_1['Imie'].' '.$pelnomocnik_1['Nazwisko'] : $pelnomocnik_1['Nazwa']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($pelnomocnik_1['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
            <div class="pdf_kratka width_30"><?php echo $pelnomocnik_1['DataUrodzenia']; ?></div>
        </div>
        <!--            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
        <div class="clear_b"></div>
        <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NazwaUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['UlicaUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrDomuUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrMieszkaniaUS']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['KodPocztowyUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['MiastoUS']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
        </div>
        <div class="form-group col-md-4">
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['WielkoscUdzialu']; ?></div>
        </div>
    </div>


    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
</div>

<!--STRONA DRUGA-->

<?php for ($i=2; $i<=$liczba_wlascicieli; $i++ ) {

    ?>


    <div class="pdf_strona">

        <div class="pdf_czerwona_kratka pdf_kratka_duza">
            <div class="form-group col-md-3 tlo_podtytulu_czerwone">
                <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
            </div>
            <!--<div class="form-group col-md-3 tlo_podtytulu_czerwone">
                <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
            </div>-->
            <div class="clear_b"></div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO</label>
                <div class="pdf_kratka"><?php echo ( ${'klient_'.$i}['Nazwa'] == '') ? ${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko'] : ${'klient_'.$i}['Nazwa']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Miasto']; ?></div>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'klient_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">NIP</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Nip']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Krs']; ?></div>
            </div>
            <!--                <div class="clear_b"></div>
                <div class="form-group col-md-3 margin_t_0">
                    <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                    <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
                </div>-->
            <div class="clear_b"></div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['DataUrodzenia']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">TELEFON KONTAKTOWY</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Telefon']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">E-MAIL</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Mail']; ?></div>
            </div>
            <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NazwaUS']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['UlicaUS']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrDomuUS']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrMieszkaniaUS']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['KodPocztowyUS']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['MiastoUS']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
            </div>
            <div class="form-group col-md-4">
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['WielkoscUdzialu']; ?></div>
            </div>
            <div class="form-group col-md-8">
                <label class="pdf_duze_litery font_size_10 margin_t_20"></label>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza">
            <div class="form-group col-md-3 tlo_podtytulu_szare">
                <label class="pdf_duze_litery podtytul_formularza">PEŁNOMOCNIK</label>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO</label>
                <div class="pdf_kratka"><?php echo (${'pelnomocnik_'.$i}['Nazwa'] == '') ? ${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Miasto']; ?></div>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'pelnomocnik_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
                <div class="pdf_kratka width_30"><?php echo ${'pelnomocnik_'.$i}['DataUrodzenia']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>
            <div class="clear_b"></div>
            <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NazwaUS']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['UlicaUS']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrDomuUS']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrMieszkaniaUS']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['KodPocztowyUS']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['MiastoUS']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
            </div>
            <div class="form-group col-md-4">
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['WielkoscUdzialu']; ?></div>
            </div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
    </div>
    </div>


<?php }
} else { ?>

    <p class="font_w_700 col-md-12 margin_t_10 margin_b_10">reprezentowany przez:</p>
    <div class="pdf_szara_kratka pdf_kratka_duza">
        <div class="form-group col-md-3 tlo_podtytulu_szare">
            <label class="pdf_duze_litery podtytul_formularza">PEŁNOMOCNIK</label>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">FIRMA PRZEDSIĘBIORCY</label>
            <div class="pdf_kratka"><?php echo ($pelnomocnik_1['Nazwa'] == '') ? $pelnomocnik_1['Imie'].' '.$pelnomocnik_1['Nazwisko'] : $pelnomocnik_1['Nazwa']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($pelnomocnik_1['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
            <div class="pdf_kratka width_30"><?php echo $pelnomocnik_1['DataUrodzenia']; ?></div>
        </div>
        <!--            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
        <div class="clear_b"></div>
        <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NazwaUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['UlicaUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrDomuUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['NrMieszkaniaUS']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['KodPocztowyUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['MiastoUS']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
        </div>
        <div class="form-group col-md-4">
            <div class="pdf_kratka"><?php echo $pelnomocnik_1['WielkoscUdzialu']; ?></div>
        </div>
    </div>

    <div class="pdf_szara_kratka pdf_kratka_duza">
        <div class="form-group col-md-3 tlo_podtytulu_szare">
            <label class="pdf_duze_litery podtytul_formularza">REPREZENTANT</label>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">FIRMA PRZEDSIĘBIORCY</label>
            <div class="pdf_kratka"><?php echo ($reprezentant_1['Nazwa'] == '') ? $reprezentant_1['Imie'].' '.$reprezentant_1['Nazwisko'] : $reprezentant_1['Nazwa']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($reprezentant_1['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
            <div class="pdf_kratka width_30"><?php echo $reprezentant_1['DataUrodzenia']; ?></div>
        </div>
        <!--            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
        <div class="clear_b"></div>
        <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['NazwaUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ULICA</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['UlicaUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['NrDomuUS']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['NrMieszkaniaUS']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['KodPocztowyUS']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
            <div class="pdf_kratka"><?php echo $reprezentant_1['MiastoUS']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
        </div>
        <div class="form-group col-md-4">
            <div class="pdf_kratka"><?php echo $reprezentant_1['WielkoscUdzialu']; ?></div>
        </div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
    </div>
    </div>

    <!--STRONA DRUGA-->

    <?php for ($i=2; $i<=$liczba_wlascicieli; $i++ ) {

        ?>


        <div class="pdf_strona">

            <div class="pdf_czerwona_kratka pdf_kratka_duza">
                <div class="form-group col-md-3 tlo_podtytulu_czerwone">
                    <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
                </div>
                <!--<div class="form-group col-md-3 tlo_podtytulu_czerwone">
                    <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
                </div>-->
                <div class="clear_b"></div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo ( ${'klient_'.$i}['Nazwa'] == '') ? ${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko'] : ${'klient_'.$i}['Nazwa']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Ulica']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrDomu']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrMieszkania']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['KodPocztowy']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Miasto']; ?></div>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-3">
                    <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'pelnomocnik_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Dowod']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Pesel']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">NIP</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Nip']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Krs']; ?></div>
                </div>
                <!--            <div class="clear_b"></div>
            <div class="form-group col-md-3 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
                <div class="clear_b"></div>
                <div class="form-group col-md-3">
                    <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['DataUrodzenia']; ?></div>
                </div>
                <div class="form-group col-md-3">
                    <label class="pdf_duze_litery font_size_10">TELEFON KONTAKTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Telefon']; ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label class="pdf_duze_litery font_size_10">E-MAIL</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Mail']; ?></div>
                </div>
                <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NazwaUS']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['UlicaUS']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrDomuUS']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrMieszkaniaUS']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['KodPocztowyUS']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['MiastoUS']; ?></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
                </div>
                <div class="form-group col-md-4">
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['WielkoscUdzialu']; ?></div>
                </div>
                <div class="form-group col-md-8">
                    <label class="pdf_duze_litery font_size_10 margin_t_20"></label>
                </div>
            </div>

            <div class="pdf_szara_kratka pdf_kratka_duza">
                <div class="form-group col-md-3 tlo_podtytulu_szare">
                    <label class="pdf_duze_litery podtytul_formularza">PEŁNOMOCNIK</label>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo (${'pelnomocnik_'.$i}['Nazwa'] == '') ? ${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Ulica']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrDomu']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrMieszkania']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['KodPocztowy']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Miasto']; ?></div>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'pelnomocnik_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Dowod']; ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
                    <div class="pdf_kratka width_30"><?php echo ${'pelnomocnik_'.$i}['DataUrodzenia']; ?></div>
                </div>
                <!--            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
                <div class="clear_b"></div>
                <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NazwaUS']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['UlicaUS']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrDomuUS']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrMieszkaniaUS']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['KodPocztowyUS']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['MiastoUS']; ?></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
                </div>
                <div class="form-group col-md-4">
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['WielkoscUdzialu']; ?></div>
                </div>
            </div>

            <div class="pdf_szara_kratka pdf_kratka_duza">
                <div class="form-group col-md-3 tlo_podtytulu_szare">
                    <label class="pdf_duze_litery podtytul_formularza">REPREZENTANT</label>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo (${'reprezentant_'.$i}['Nazwa'] == '') ? ${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Ulica']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NrDomu']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NrMieszkania']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['KodPocztowy']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Miasto']; ?></div>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'reprezentant_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Dowod']; ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
                    <div class="pdf_kratka width_30"><?php echo ${'reprezentant_'.$i}['DataUrodzenia']; ?></div>
                </div>
                <!--            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>-->
                <div class="clear_b"></div>
                <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY</p>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NazwaUS']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['UlicaUS']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NrDomuUS']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NrMieszkaniaUS']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['KodPocztowyUS']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['MiastoUS']; ?></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
                </div>
                <div class="form-group col-md-4">
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['WielkoscUdzialu']; ?></div>
                </div>
            </div>

            <div class="pdf_strona_stopka col-md-12 margin_b_0">
                <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
                <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
        </div>
        </div>


    <?php }
} ?>
<div class="pdf_strona">

    <label class="text_a_center col-md-12 margin_t_10">a</label>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CESJONARIUSZEM:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
        <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>, którą reprezentuje:
        <div class="form-group col-md-12 margin_t_10"><div class="pdf_kratka"></div></div>
    </div>

    <p class="col-md-12 margin_t_10">Strony zgodnie ustalają, co następuje:</p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_0">PRZEDMIOT UMOWY</label>
    <label class="text_a_center col-md-12 font_w_700">§ 1</label>
    <p class="margin_b_0">Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności z tytułu <span class="font_w_700"><?php echo $umowa_dane['TytulOgraniczeniaWartosc']; ?></span>, przysługujące Cedentowi od Ubezpieczyciela: <span class="font_w_700"><?php echo $umowa_dane['UbezpieczycielNazwa']; ?></span>
        a w przypadku, gdy szkoda podlega likwidacji z OC sprawcy, również wierzytelności przysługujące od sprawcy wypadku, w związku ze szkodą komunikacyjną z dnia <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span> (nr akt szkodowych <span class="font_w_700"><?php echo $umowa_dane['NumerAkt']; ?></span>)
        w wyniku której uszkodzeniu uległ pojazd marki <span class="font_w_700"><?php echo $umowa_dane['Marka'].' '.$umowa_dane['Model']; ?></span>, o nr rej. <span class="font_w_700"><?php echo $umowa_dane['NrRejestracyjny']; ?></span>, w części przekraczającej wysokość świadczenia pieniężnego zapłaconego przez Ubezpieczyciela
        na rzecz Cedenta z tytułu nabycia części tej wierzytelności do wysokości zapłaconej kwoty na podstawie umowy przelewu wierzytelności z dnia <span class="font_w_700"><?php echo $umowa['DataUmowy']; ?></span> w sprawie o numerze <span class="font_w_700"><?php echo $umowa['NumerSprawy']; ?></span>,
        a Cesjonariusz przyjmuje wierzytelności i zobowiązuje się do zapłaty na rzecz Cedenta ustalonej w umowie ceny.
    </p>
        <!--<p class="margin_b_0">Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności jakie przysługują Cedentowi z tytułu odszkodowania za szkodę w pojeździe marki
        <span class="font_w_700"><?php /*echo $umowa_dane['Marka'].' '.$umowa_dane['Model']; */?></span>, nr rej. <span class="font_w_700"><?php /*echo $umowa_dane['NrRejestracyjny']; */?></span>, od <span class="font_w_700"><?php /*echo $umowa_dane['UbezpieczycielNazwa']; */?></span>
            należnego w związku ze zdarzeniem z dnia <span class="font_w_700"><?php /*echo $umowa_dane['DataSzkody']; */?></span> (nr akt szkodowych <span class="font_w_700"><?php /*echo $umowa_dane['NumerAkt']; */?></span>), w części przekraczającej wysokość świadczenia pieniężnego
            zapłaconego przez ubezpieczyciela <?php /*echo $umowa_dane['NazwaUbezpieczyciela']; */?> zwanego dalej Ubezpieczycielem, na rzecz Cedenta z tytułu nabycia części tej wierzytelności do wysokości zapłaconej kwoty na podstawie umowy przelewu wierzytelności z dnia
            <?php /*echo $umowa['DataUmowy']; */?> w sprawie o numerze <?php /*echo $umowa['NumerSprawy']; */?>.
        </p>-->

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">WYNAGRODZENIE</label>
    <label class="text_a_center col-md-12 font_w_700">§ 2</label>
    <p class="margin_b_0">1. Cesjonariusz nabywa od Cedenta wierzytelność, o której mowa w § 1, za kwotę określoną w załączniku nr 1 do umowy.</p>
    <p class="margin_b_0">2. Informacja, o której mowa w ust. 1, stanowi tajemnicę handlową i nie podlega ujawnieniu bez zgody Cesjonariusza.</p>
    <p class="margin_b_0">3. Cesjonariusz zobowiązuje się do zapłaty kwoty, określonej w załączniku nr 1 do umowy, w terminie 7 dni roboczych od daty podpisania umowy przez Cesjonariusza na rachunek bankowy wskazany przez Cedenta lub w inny sposób, określony w załączniku nr 1 do umowy.</p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">OŚWIADCZENIA STRON</label>
    <label class="text_a_center col-md-12 font_w_700">§ 3</label>
    <p class="margin_b_0">1. Cedent oświadcza, że wierzytelność, o której mowa w mowa w § 1, została zaspokojona w części odpowiadającej kwocie <span class="font_w_700"><?php echo $umowa_dane['OtrzymanaKwotaWierzytelności']; ?></span> zł
        (słownie: <span class="font_w_700"><?php echo $umowa_dane['OtrzymanaKwotaWierzytelnościSlownie']; ?></span> złotych), zapłaconej przez Ubezpieczyciela na rzecz Cedenta z tytułu nabycia części tej wierzytelności na podstawie umowy przelewu.</p>
    <p class="margin_b_0">2. Cedent oświadcza, że z tytułu poniesionej szkody majątkowej, o której mowa w § 1 umowy, ponad kwotę zapłaconą przez Ubezpieczyciela z tytułu nabycia wierzytelności:</p>
    <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['UzyskanoOdszkodowanie'] == 0) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie uzyskał dodatkowych kwot odszkodowania,</p>
    <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['UzyskanoOdszkodowanie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> uzyskał dodatkowo odszkodowanie w łącznej kwocie <?php echo $umowa_dane['KwotaOdszkodowania']; ?> zł brutto (słownie: <?php echo $umowa_dane['KwotaOdszkodowaniaSlownie']; ?> złotych).</p>
    <p class="margin_b_0">3. Cedent oświadcza, że szkoda, o której mowa w § 1, miała miejsce w okolicznościach, o których zawiadomił ubezpieczyciela, oraz że nie toczyło się w związku z jej powstaniem postępowanie karne dotyczące doprowadzenia innej osoby do niekorzystnego rozporządzenia własnym lub cudzym mieniem za pomocą wprowadzenia jej w błąd (art. 286 kodeksu karnego) lub spowodowania zdarzenia będącego
        podstawą do wypłaty odszkodowania w celu uzyskania takiego odszkodowania z tytułu umowy ubezpieczenia (art. 298 kodeksu karnego).</p>
        <p class="margin_b_0">4. Cedent oświadcza, że koszty naprawy pojazdu w związku ze szkodą, o której mowa w § 1, nie zostały pokryte na podstawie przedstawienia Dłużnikowi rachunku lub faktury VAT lub innego dokumentu potwierdzającego wysokość kosztów naprawy. Koszty, o których mowa w zdaniu pierwszym, nie dotyczą holowania, najmu pojazdu zastępczego, parkowania, ani przedmiotów przewożonych w pojeździe,
            o którym mowa w § 1.</p>
        <p class="margin_b_0">5. Cedent oświadcza, że nie zrzekł się roszczeń przysługujących mu względem Dłużnika w związku ze szkodą, o której mowa w § 1,
            w tym w szczególności w wyniku zawarcia ugody lub innego porozumienia.</p>
        <p class="margin_b_0">6. Cedent oświadcza, że wierzytelność, o której mowa w § 1, przelewana na rzecz Cesjonariusza jest wolna od obciążeń, oraz że uprawnienie do jej zbycia na rzecz osób trzecich nie zostało wyłączone.</p>
        <p class="margin_b_0">7. Cedent oświadcza, że pojazd, o którym mowa w § 1 umowy, w dacie powstania szkody nie był przedmiotem współwłasności z osobą trzecią.</p>
        <p class="margin_b_0">8. Cedent oświadcza, że ujawnił Cesjonariuszowi wszelkie nienaprawione uszkodzenia, jakie pojazd posiadał przed powstaniem szkody komunikacyjnej, o której mowa § 1. Ponadto Cedent oświadcza, że pojazd ten bezpośrednio przed powstaniem szkody był dopuszczony do ruchu po drogach publicznych, o ile nie złożył Cesjonariuszowi przed zawarciem umowy odmiennego oświadczenia w formie pisemnej
            albo nie przedłożył dokumentów stwierdzających okoliczności przeciwne.</p>
        <p class="margin_b_0">9. Cedent oświadcza, że Dłużnik, o którym mowa w § 1, w dacie zawarcia umowy nie ma względem niego żadnej wymagalnej Wierzytelności podlegającej potrąceniu z wierzytelnościami, o których mowa w § 1.</p>
        <p class="margin_b_0">10. Cedent zobowiązuje się do sporządzenia pisemnego zawiadomienia dłużnika o przeniesieniu wierzytelności i złożenia go na ręce Cesjonariusza w celu przedłożenia Dłużnikowi. Cedent zobowiązuje się do tego, że nie cofnie złożonego oświadczenia.</p>
        <p class="margin_b_0">11. W przypadku uzyskania przez Cedenta od Dłużnika świadczenia tytułem spłaty wierzytelności, określonej w § 1, po podpisaniu przez Cedenta niniejszej umowy, Cedent zobowiązuje się do przekazania całości świadczenia na rachunek bankowy Cesjonariusza ING Bank Śląski S.A. 19 1050 1575 1000 0023 1250 6369 oraz powiadomić o tym Cesjonariusza na piśmie w terminie 7 dni roboczych od daty uzyskania świadczenia.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">DOKUMENTACJA DLA CESJONARIUSZA</label>
        <label class="text_a_center col-md-12 font_w_700">§ 4</label>
        <p class="margin_b_0">1. Cedent, w celu dochodzenia wierzytelności od Dłużnika, przekazuje Cesjonariuszowi następujące dokumenty:</p>
        <p class="margin_b_0">a) kopię wypełnionych stron karty pojazdu, o którym mowa w § 1, jeżeli została ona wydana;</p>
        <p class="margin_b_0">b) kopię dowodu rejestracyjnego pojazdu, o którym mowa w § 1;</p>
        <p class="margin_b_0">c) kopię umowy sprzedaży pojazdu, o którym mowa w § 1, jeżeli został on zbyty po powstaniu szkody, o której mowa w § 1;</p>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
        </div>
    </div>

    <div class="pdf_strona">
        <p class="margin_b_0">d) kosztorys wyceny szkody zawierający szczegółowy wykaz części podlegających wymianie lub naprawie, procedury naprawcze i czas ich wykonania oraz przyjęte ceny wyżej wymienionych, dotyczące szkody, o której mowa w § 1, wykonany na zlecenie lub przez Dłużnika, o którym mowa w § 1, jeżeli został wydany;</p>
        <p class="margin_b_0">e) wszelkie oświadczenia Dłużnika o przyznaniu odszkodowania z tytułu szkody, o której mowa w § 1, lub potwierdzenie wpływu odszkodowania wpłaconego na rachunek bankowy Cedenta bądź pokwitowanie jego odbioru;</p>
        <p class="margin_b_0">f) w przypadku, gdy wierzytelność przysługuje Cedentowi z tytułu ubezpieczenia AUTO-CASCO – kopię polisy oraz ogólnych warunków umowy ubezpieczenia, aktualnych na dzień zawarcia umowy;</p>
        <p class="margin_b_0">g) kopię umowy przelewu wierzytelności zawartej z Ubezpieczycielem, o której mowa w § 1, oraz potwierdzenie wpływu świadczenia pieniężnego zapłaconego przez Ubezpieczyciela na rachunek bankowy Cedenta z tytułu nabycia części wierzytelności, o której mowa w § 1, bądź pokwitowanie jego odbioru.</p>
        <p class="margin_b_0">2. Cesjonariusz zobowiązuje się do wykorzystania przekazanych mu dokumentów wyłącznie w celu realizacji umowy.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">POSTANOWIENIA KOŃCOWE</label>
        <label class="text_a_center col-md-12 font_w_700">§ 5</label>
        <p class="margin_b_0">1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.</p>
        <p class="margin_b_0">2. Umowa wraz z załącznikiem nr 1 została sporządzona w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze Stron</p>
        <p class="margin_b_0">3. Integralną częścią niniejszej umowy jest załącznik – Klauzule informacyjne dla Klienta.</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_10">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">VOTUM S.A.</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CEDENT <span class="font_size_8">(OSOBY DOKONUJĄCE CESJI)</span></p>
            </div>
            <div class="clear_b"></div>
        </div>


<!--        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_0 margin_b_0"></div>-->
<!--        <p class="margin_b_0 font_size_10">Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz.U. z 2016 r., poz. 922 ze zm.) VOTUM informuje, że:</p>-->
<!--        <p class="margin_b_0 font_size_10">1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowej 56i,</p>-->
<!--        <p class="margin_b_0 font_size_10">2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom,-->
<!--            od których będą uzyskiwane informacje niezbędne do wykonania umowy i podmiotom, od których będą dochodzone roszczenia,</p>-->
<!--        <p class="margin_b_0 font_size_10">3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,</p>-->
<!--        <p class="margin_b_0 font_size_10">4. podanie VOTUM danych osobowych jest dobrowolne.</p>-->


        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CEDENT <span class="font_size_8">(OSOBY DOKONUJĄCE CESJI)</span></p>
            </div>
            <div class="clear_b"></div>
        </div>
        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
        </div>
    </div>

<div class="pdf_strona">
    <div class="">
        <div class="pdfs_tytu_doumentu_zalacznik">
            <p class="margin_b_0"></p>
            <p class="margin_b_30 margin_t_120 pdf_duze_litery font_w_70055">ZAŁĄCZNIK - Klauzula informacyjna dla klienta</p>
        </div>
        <div class="pdfs_logo margin_t_30"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>
    <p class="margin_b_30 margin_t_50 font_w_700">§1 Informacje</p>
    <ol class="roman">
        <li class="margin_b_10">VOTUM S.A. z siedzibą we Wrocławiu informuje, że w związku z obowiązkami wynikającymi z ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (RODO), dane osobowe podane przez Klienta w umowie i załącznikach do umowy, jak również dane uzyskane w trakcie jej wykonywania będą przetwarzane przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, wpisana do rejestru przedsiębiorców KRS pod numerem 0000243252 (dalej „Spółka”), która stanie się Administratorem tych danych.</li>
        <li class="margin_b_10">Uzyskanie informacji o procesach przetwarzania danych osobowych możliwe jest poprzez kontakt z Inspektorem Ochrony Danych w formie elektronicznej: e-mail iod@votum-sa.pl lub pisemnej: Inspektor Ochrony Danych, ul. Wyścigowa 56i, 53-012 Wrocław. </li>
        <li class="margin_b_10">Dane osobowe przetwarzane będą w następujących celach oraz na podstawie następujących przesłanek:
            <ol class="numerowanie">
                <li>Wykonie umowy na rzecz klienta, podstawą prawną jest art. 6 ust. 1 lit b RODO.</li>
                <li>Marketing usług własnych, wykorzystywane do tego celu będą środki komunikacji w tym telefon oraz email, podstawą prawną jest art. 6 ust. 1 lit. f) RODO.</li>
                <li>Zapewnienie prawidłowości podatkowych po wystawieniu faktury, podstawą prawna jest art. 6 ust. 1 lit. c) RODO uszczegółowienie w art. 70 §1 Ordynacji Podatkowej</li>
                <li>W przypadku wyrażenia dodatkowych zgód (art. 6 ust.1 lit a), dane osobowe będą przetwarzane w celu zaproponowania usług podmiotów powiązanych z VOTUM S.A wskazanym w §2 poniżej</li>
            </ol>
        </li>
        <li class="margin_b_10">Dane osobowe udostępnione będą bankom udzielającym kredytów indeksowanych bądź denominowanych do waluty obcej w związku z zastosowaną indeksacją oraz ubezpieczeń z nimi powiązanym, a w razie takiej potrzeby - organom państwowym.</li>
        <li class="margin_b_10">W zależności o celu przetwarzania dane osobowe Klienta będą przetwarzane przez następujący okres czasu:
            <ol class="numerowanie">
                <li>W związku z możliwością podniesienia roszczeń z kodeksu cywilnego, przez okres do 10 lat od momentu zakończenia umowy. </li>
                <li>W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu wniesienia sprzeciwu na marketing usług VOTUM S.A.</li>
                <li>W związku z wymogami ustawy, przez okres 5 lat + bieżący rok podatkowy od momenty wystawienia faktury</li>
                <li>W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu wniesienia sprzeciwu na marketing wskazanego podmiotu.</li>
            </ol>
        </li>
        <li class="margin_b_10">Klient ma prawo dostępu do swoich danych, ich sprostowania, usunięcia lub ograniczenia przetwarzania a także do wniesienia sprzeciwu wobec przetwarzania danych, w tym na marketing usług własnych VOTUM S.A. Klient jest uprawniony do cofnięcia wyrażonej zgody na przetwarzanie danych w każdym czasie, a także do wniesienia skargi w związku z przetwarzaniem danych do organu nadzorczego – Prezesa Urzędu Ochrony Danych Osobowych. </li>
        <li class="margin_b_10">Podanie danych jest dobrowolne jednakże niezbędne dla celów wykonania umowy.
            W przypadku braku podania danych lub niewyrażenia zgody na ich przetwarzanie, realizacja umowy może stać się niemożliwa.
        </li>
        <li class="margin_b_10">Dane osobowe wskazane w umowie, będą podlegały profilowaniu, które ma na celu dopasowanie i zaproponowanie Klientowi nowych usług. Każdorazowo przed podjęciem decyzji w tym przedmiocie dane osobowe będą weryfikowane przez pracownika VOTUM S.A.</li>
    </ol>
    <p class="margin_t_15">Oświadczam, że zapoznałem się z treścią informacji zawartych w §1</p>
    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 text_a_right">podpis Klienta/osoby działającej w imieniu Klienta</p>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"></div>
        <p class="text_a_center margin_b_0"></p>
    </div>
</div>
<div class="pdf_strona pdf_strona_zalacznik">
    <div class="pdfs_logo margin_t_30"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    <p class="margin_b_30 margin_t_50 font_w_700">§2 Zgody Klienta</p>
    <ol class="roman">
        <li class="margin_b_10">Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym podmiotom
            <ol class="numerowanie">
                <li class="margin_b_10"><b>DSA Investment S.A.</b>Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty produktów finansowych i ubezpieczeń osobowych: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li class="margin_b_10">
                <li><b>Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k.</b> Golikówka 6, 30-723 Kraków, KRS: 0000290430  , w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDanePCRF'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDanePCRF'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>Fundacja VOTUM</b> ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneFundacja'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneFundacja'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>AUTOVOTUM S.A.</b> ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty usług wynajmu pojazdów zastępczych; <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneAutovotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneAutovotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>Biuro Ekspertyz Procesowych sp. z o.o.</b> Aleja Wiśniowa 47, 53-126 Wrocław, KRS:  0000565095, w zakresie danych teleadresowych w celu sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe. <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneBEP'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneBEP'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
            </ol>
        </li>
        <li class="margin_b_10">Wyrażam zgodę na wykonywanie następujących czynności przez:
            <ol class="numerowanie">
                <li class="margin_b_10"><b>DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,</b>
                    <ol class="numerowanie_alfabet_male">
                        <li class="margin_b_10">Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                        <li class="margin_b_10">Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                    </ol>
                </li>
                <li class="margin_b_10"><b>VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,  </b>
                    <ol class="numerowanie_alfabet_male">
                        <li class="margin_b_10">przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z 	ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfVotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfVotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                        <li class="margin_b_10">przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu 	automatycznych 	systemów wywołują¬cych w rozumieniu ustawy z dn.16.07.2004 r. Prawo 	telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 	1907): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingVotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingVotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
    </ol>
    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 text_a_right">podpis Klienta/osoby działającej w imieniu Klienta</p>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"></div>
        <p class="text_a_center margin_b_0"></p>
    </div>
</div>
