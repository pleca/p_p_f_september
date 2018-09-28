<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
$lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];



$stopka = 'PG-2-14-F9/2017-02-14';
$nr_strony = 1;
$liczba_reprezentantow = 4;
//$strony = $liczba_reprezentantow

if ($liczba_reprezentantow == 1 || $liczba_reprezentantow == 0) {
    $strony = 2;
} else if ($liczba_reprezentantow%2) {
    $strony = intval($liczba_reprezentantow/2)+2;
} else {
    $strony = intval($liczba_reprezentantow/2)+1;
}
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
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">ANEKS</p>
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">DO UMOWY PRZELEWU WIERZYTELNOSCI</p>
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">NR: <?php echo '?DANE?'; ?></p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <p class="font_w_700 margin_t_60 margin_l_20">zawarta na podstawie oferty z dnia <?php echo $umowa['DataUmowy']; ?> r. pomiędzy:</p>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CEDENTEM:</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza">
            <div class="form-group col-md-3 tlo_podtytulu_szare">
                <label class="pdf_duze_litery podtytul_formularza">WŁAŚCICIEL</label>
            </div>
            <div class="form-group col-md-3 tlo_podtytulu_czerwone">
                <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20">SERIA I NR DOWODU OSOBISTEGO/ PASZPORTU</label>
                <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20 padding_t_10">NR PESEL</label>
                <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20">NIP* (*WYPEŁNIĆ TYLKO DLA PRZEDSIĘBIORSTWA)</label>
                <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20 padding_t_10">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo $klient['Mail']; ?></div>
            </div>
            <div class="form-group col-md-3 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">DATA URODZENIA</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">TELEFON KONTAKTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">E-MAIL</label>
                <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
            </div>
            <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY* <span class="font_size_12">(*DOTYCZY OSÓB FIZYCZNYCH)</span>:</p>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI*</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-8">
                <label class="pdf_duze_litery font_size_10 margin_t_20">(*WPISAĆ PROCENTOWO BĄDŹ UŁAMKIEM WIELKOŚĆ UDZIAŁU LUB POŁOWĘ PRAWA PRZYSŁUGUJĄCEGO
                    MAŁŻONKOM W RAMACH MAŁŻEŃSKIEGO MAJĄTKU WSPÓLNEGO)</label>
            </div>
        </div>

        <p class="font_w_700 col-md-12 margin_t_10 margin_b_10">reprezentowany przez:</p>
        <div class="pdf_szara_kratka pdf_kratka_duza">
            <div class="form-group col-md-3 tlo_podtytulu_szare">
                <label class="pdf_duze_litery podtytul_formularza">REPREZENTANT <?php echo $i+1; ?></label>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20">SERIA I NR DOWODU OSOBISTEGO/ PASZPORTU</label>
                <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-9 margin_t_8">
                <label class="pdf_duze_litery font_size_10">DATA URODZENIA* <span class="font_size_8">(*DOTYCZY OSÓB FIZYCZNYCH – WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ)</span></label>
                <div class="pdf_kratka width_30"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  PASZPORT</label>
            </div>
            <div class="clear_b"></div>
            <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY* <span class="font_size_12">(*DOTYCZY OSÓB FIZYCZNYCH – WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ)</span>:</p>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI*<span class="font_size_8">(*PROCENTOWO BĄDŹ UŁAMKIEM))</span></label>
            </div>
            <div class="form-group col-md-4">
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
        </div>
        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
        </div>
    </div>

<div class="pdf_strona">
<?php

for ($i=2; $i<=$liczba_reprezentantow; $i++) {
    ?>


        <div class="pdf_szara_kratka pdf_kratka_duza">
            <div class="form-group col-md-3 tlo_podtytulu_szare">
                <label class="pdf_duze_litery podtytul_formularza">REPREZENTANT <?php echo $i; ?></label>
            </div>
            <div class="form-group col-md-3 tlo_podtytulu_czerwone">
                <label class="pdf_duze_litery podtytul_formularza">WSPÓŁWŁAŚCICIEL</label>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?><?php echo $klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20">SERIA I NR DOWODU OSOBISTEGO/
                    PASZPORTU</label>
                <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20 padding_t_10">NR PESEL</label>
                <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20">NIP* (*WYPEŁNIĆ TYLKO DLA
                    PRZEDSIĘBIORSTWA)</label>
                <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10 wysokosc_20 padding_t_10">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo $klient['Mail']; ?></div>
            </div>
            <div class="form-group col-md-3 margin_t_0">
                <label class="pdf_duze_litery font_size_10"><span
                            class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked'; ?>"
                            aria-hidden="true"></span> DOWÓD OSOBISTY</label>
                <label class="pdf_duze_litery font_size_10"><span
                            class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked'; ?>"
                            aria-hidden="true"></span> PASZPORT</label>
            </div>
            <div class="clear_b"></div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">DATA URODZENIA* <span class="font_size_8">(*DOTYCZY WSPÓŁWŁAŚCICIELI WIERZYTELNOŚCI/WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ)</span></label>
                <div class="pdf_kratka width_30"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">TELEFON KONTAKTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">E-MAIL</label>
                <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
            </div>
            <p class="pdf_duze_litery font_w_700 col-md-12 margin_b_4">URZĄD SKARBOWY* <span
                        class="font_size_10">(*DOTYCZY WSPÓŁWŁAŚCICIELI WIERZYTELNOŚCI/WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ)</span>:
            </p>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">PEŁNA NAZWA URZĘDU SKARBOWEGO</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?><?php echo $klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ULICA</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI/ W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-8">
                <label class="pdf_duze_litery font_size_10 margin_t_30">(*WPISAĆ PROCENTOWO BĄDŹ UŁAMKIEM
                    WIELKOŚĆ
                    UDZIAŁU LUB POŁOWĘ PRAWA PRZYSŁUGUJĄCEGO
                    MAŁŻONKOM W RAMACH MAŁŻEŃSKIEGO MAJĄTKU WSPÓLNEGO)</label>
            </div>
        </div>

    <?php

    if ($i%2) {
       ?>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/<?php echo $strony; ?></div></p>
    </div>
</div>
<div class="pdf_strona">

    <?php


    }

}
if ($liczba_reprezentantow%2 != 1) {
    ?>

<label class="text_a_center col-md-12 margin_t_10">a</label>
            <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CESJONARIUSZEM:</label>
            <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
                zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
<span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>, którą reprezentuje:
                <div class="form-group col-md-12 margin_t_10">
                    <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
</div>
</div>

<p class="col-md-12 margin_t_10">Strony zgodnie ustalają, co następuje:</p>

<label class="text_a_center col-md-12 font_w_700">§ 1</label>
<p class="margin_b_0">Strony, niniejszym aneksem zmieniają treść §1 Umowy z dnia <span class="font_w_700"><?php echo '?DANE?'; ?></span> r. nadając mu brzmienie: </p>
    <p class="margin_b_0 margin_t_10">„Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności przysługujące Cedentowi z tytułu: (należy zaznaczyć właściwe
        pole)
        <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> utraty wartości handlowej pojazdu,
        <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> kosztów naprawy pojazdu,
        <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wypożyczenia pojazdu zastępczego,
        <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> szkody całkowitej
        w pojeździe, od <span class="font_w_700"><?php echo '?DANE?'; ?></span> zwanego dalej Dłużnikiem, w związku ze szkodą komunikacyjną z
        dnia <span class="font_w_700"><?php echo '?DANE?'; ?></span> r. (nr akt szkodowych: <span class="font_w_700"><?php echo '?DANE?'; ?></span>), w wyniku której uszkodzeniu uległ pojazd marki
        <span class="font_w_700"><?php echo '?DANE?'; ?></span> o nr rej. <span class="font_w_700"><?php echo '?DANE?'; ?></span>.”</p>

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


    <?php
    } else {
    ?>

        <label class="text_a_center col-md-12 margin_t_10">a</label>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CESJONARIUSZEM:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
            VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
            zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>, którą reprezentuje:
            <div class="form-group col-md-12 margin_t_10">
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
            </div>
        </div>

        <p class="col-md-12 margin_t_10">Strony zgodnie ustalają, co następuje:</p>

        <label class="text_a_center col-md-12 font_w_700">§ 1</label>
        <p class="margin_b_0">Strony, niniejszym aneksem zmieniają treść §1 Umowy z dnia <span class="font_w_700"><?php echo '?DANE?'; ?></span> r. nadając mu brzmienie: </p>
        <p class="margin_b_0 margin_t_10">„Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności przysługujące Cedentowi z tytułu: (należy zaznaczyć właściwe
            pole)
            <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> utraty wartości handlowej pojazdu,
            <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> kosztów naprawy pojazdu,
            <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wypożyczenia pojazdu zastępczego,
            <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> szkody całkowitej
            w pojeździe, od <span class="font_w_700"><?php echo '?DANE?'; ?></span> zwanego dalej Dłużnikiem, w związku ze szkodą komunikacyjną z
            dnia <span class="font_w_700"><?php echo '?DANE?'; ?></span> r. (nr akt szkodowych: <span class="font_w_700"><?php echo '?DANE?'; ?></span>), w wyniku której uszkodzeniu uległ pojazd marki
            <span class="font_w_700"><?php echo '?DANE?'; ?></span> o nr rej. <span class="font_w_700"><?php echo '?DANE?'; ?></span>.”</p>

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

<?php } ?>
