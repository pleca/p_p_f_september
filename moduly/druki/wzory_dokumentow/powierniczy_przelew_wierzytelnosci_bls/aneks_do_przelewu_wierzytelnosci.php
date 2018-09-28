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


$stopka = 'PG-2-14-F23/2016-12-21';
$nr_strony = 1;
$strony = $liczba_wlascicieli+1;

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
            <div class="pdfs_tytu_dokumentu pdf_tytul_bls">
                <p class="margin_b_0 font_w_700 font_size_20 text_a_center">ANEKS</p>
                <p class="margin_b_0 font_w_700 font_size_20 text_a_center">DO UMOWY PRZELEWU WIERZYTELNOSCI BLS</p>
                <p class="margin_b_0 font_w_700 font_size_20 text_a_center">NR</p>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo ($klient_1['Nazwa'] == '') ? $klient_1['Imie'].' '.$klient_1['Nazwisko'] : $klient_1['Nazwa'].' '.$klient_1['Imie'].' '.$klient_1['Nazwisko']; ?></div>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo ($pelnomocnik_1['Nazwa'] == '') ? $pelnomocnik_1['Imie'].' '.$pelnomocnik_1['Nazwisko'] : $pelnomocnik_1['Nazwa'].' '.$pelnomocnik_1['Imie'].' '.$pelnomocnik_1['Nazwisko']; ?></div>
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
                    <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo ( ${'klient_'.$i}['Nazwa'] == '') ? ${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko'] : ${'klient_'.$i}['Nazwa'].' '.${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko']; ?></div>
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
                    <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo (${'pelnomocnik_'.$i}['Nazwa'] == '') ? ${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa'].' '.${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko']; ?></div>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo ($pelnomocnik_1['Nazwa'] == '') ? $pelnomocnik_1['Imie'].' '.$pelnomocnik_1['Nazwisko'] : $pelnomocnik_1['Nazwa'].' '.$pelnomocnik_1['Imie'].' '.$pelnomocnik_1['Nazwisko']; ?></div>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo ($reprezentant_1['Nazwa'] == '') ? $reprezentant_1['Imie'].' '.$reprezentant_1['Nazwisko'] : $reprezentant_1['Nazwa'].' '.$reprezentant_1['Imie'].' '.$reprezentant_1['Nazwisko']; ?></div>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo ( ${'klient_'.$i}['Nazwa'] == '') ? ${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko'] : ${'klient_'.$i}['Nazwa'].' '.${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko']; ?></div>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo (${'pelnomocnik_'.$i}['Nazwa'] == '') ? ${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa'].' '.${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko']; ?></div>
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
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo (${'reprezentant_'.$i}['Nazwa'] == '') ? ${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa'].' '.${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko']; ?></div>
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
            <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
                zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
<span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>, którą reprezentuje:
                <div class="form-group col-md-12 margin_t_10">
                    <div class="pdf_kratka"></div>
</div>
</div>

<p class="col-md-12 margin_t_10">Strony zgodnie ustalają, co następuje:</p>

<label class="text_a_center col-md-12 font_w_700">§ 1</label>
<p class="margin_b_0">Strony, niniejszym aneksem zmieniają treść §1 Umowy z dnia <span class="font_w_700"><?php echo $umowa['DataUmowy']; ?></span> r. nadając mu brzmienie: </p>
    <p class="margin_b_0 margin_t_10">„Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności przysługujące Cedentowi z tytułu: (należy zaznaczyć właściwe
        pole)
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['TytulOgraniczeniaId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> utraty wartości handlowej pojazdu,
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['TytulOgraniczeniaId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> kosztów naprawy pojazdu,
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['TytulOgraniczeniaId'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wypożyczenia pojazdu zastępczego,
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['TytulOgraniczeniaId'] == 4) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> szkody całkowitej
        w pojeździe, od <span class="font_w_700"><?php echo $umowa_dane['UbezpieczycielNazwa']; ?></span> zwanego dalej Dłużnikiem, w związku ze szkodą komunikacyjną z
        dnia <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span> r. (nr akt szkodowych: <span class="font_w_700"><?php echo $umowa_dane['NumerAkt']; ?></span>), w wyniku której uszkodzeniu uległ pojazd marki
        <span class="font_w_700"><?php echo $umowa_dane['Marka'].' '.$umowa_dane['Model']; ?></span> o nr rej. <span class="font_w_700"><?php echo $umowa_dane['NrRejestracyjny']; ?></span>.”</p>

<label class="text_a_center col-md-12 font_w_700">§ 2</label>
<p class="margin_b_0">1. W pozostałym zakresie Umowa pozostaje bez zmian.</p>
<p class="margin_b_0">2. Postanowienia aneksu wchodzą w życie z chwilą jego podpisania przez obie strony Umowy.</p>

<label class="text_a_center col-md-12 font_w_700">§ 3</label>
<p class="margin_b_0">Aneks sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze Stron.</p>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_50 margin_b_20">
        <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery">VOTUM</p>
        </div>
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CEDENT (OSOBY DOKONUJĄCE CESJI)</p>
        </div>
        <div class="clear_b"></div>
    </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
        </div>
    </div>

