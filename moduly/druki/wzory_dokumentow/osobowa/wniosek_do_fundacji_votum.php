<?php
setlocale(LC_CTYPE, "pl_PL.UTF-8");

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$wniosek_do_fundacji = json_decode($_POST['wniosek_do_fundacji'], true);
$nieruchomosci = json_decode($_POST['nieruchomosci'], true);
$dochod = json_decode($_POST['dochod'], true);
$poszkodowany = json_decode($_POST['poszkodowany'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);
$uprawniony = json_decode($_POST['uprawniony'], true);


//$stopka = 'PG-2-21-F2/2017-01-02';
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>



    <div class="pdf_strona">

        <div class="pdf_strona_pierwsza_naglowek_pouczenie margin_t_80">
            <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_fundacja.jpg"/></div>
        </div>

        <p class="margin_b_0 margin_t_0 pdf_duze_litery font_size_26 font_w_700 text_a_center">WNIOSEK DO FUNDACJI VOTUM</p>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_20">
            <p class="font_size_12 font_w_700">Wnioskodawca:</p>
            <p class="font_size_12">
                Imię i nazwisko: <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Imie'].' '.$klient['Nazwisko'] : $uprawniony['Imie'].' '.$uprawniony['Nazwisko']; ?>
                PESEL: <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Pesel'] : $uprawniony['Pesel']; ?>
            </p>
            <p class="font_size_12">
                seria i numer dowodu osobistego: <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Dowod'] : $uprawniony['Dowod']; ?>
            </p>

            <p class="font_size_12 font_w_700 margon_t_10">
                Beneficjent –
                <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 1) ? 'ubezwłasnowolniony całkowicie' : ''; ?>
                <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 2) ? 'małoletni' : ''; ?>
            </p>
            <p class="font_size_12">
                Imię i nazwisko: <?php echo $poszkodowany['Imie'].' '.$poszkodowany['Nazwisko'];?>
                Data urodzenia: . . . . . . . . . . . . . . . . . . . . .
            </p>
            <p class="font_size_12">
                PESEL: <?php echo $poszkodowany['Pesel'];?>
                Stopień pokrewieństwa: <?php echo $pozostale_informacje['StopienPokrewienstwa'];?>
            </p>

            <p class="font_size_12 font_w_700">Adres zamieszkania:</p>
            <p class="font_size_12">
                Miejscowość: <?php echo $poszkodowany['Miasto'];?>
                kod pocztowy: <?php echo $poszkodowany['KodPocztowy'];?>
            </p>
            <p class="font_size_12">
                ul: <?php echo $poszkodowany['Ulica'];?>
                nr domu/nr mieszkania: <?php echo $poszkodowany['NrDomu'].' '.$poszkodowany['NrMieszkania'];?>
            </p>
            <p class="font_size_12">
                tel.: <?php echo $poszkodowany['Telefon'];?>
                e-mail: <?php echo $poszkodowany['Mail'];?>
            </p>

            <p class="font_size_12"><span class="font_w_700">Opis przypadku:</span></p>
            <p class="font_size_12"><?php echo $wniosek_do_fundacji['OpisPrzypadku']; ?></p>

            <p class="font_size_12 font_w_700">Wnioskuję o*:</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['Turnus'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> dofinansowanie turnusu rehabilitacyjnego w <?php echo ($wniosek_do_fundacji['Turnus'] == 1) ? $wniosek_do_fundacji['MiejsceTurnusu'] : '__________________'; ?></p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['Rehabilitacja'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> dofinansowanie rehabilitacji w domu</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['Proteza'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> dofinansowanie zakupu protezy</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['Sprzet'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> dofinansowanie zakupu sprzętu rehabilitacyjnego</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['Wozek'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> dofinansowanie zakupu wózka inwalidzkiego</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['PomocRodzinie'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> pomoc rodzinie z tytułu trudnej sytuacji materialnej powstałej na skutek utraty osoby bliskiej w wypadku</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['InneDofinansowanie'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> inne, jakie? <?php echo ($wniosek_do_fundacji['InneDofinansowanie'] == 1) ? $wniosek_do_fundacji['InneOpis'] : '__________________'; ?>.</p>
            <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($wniosek_do_fundacji['UdostepnienieRachunku'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> udostepnienie rachunku Fundacji w celu gromadzenia darowizn celowych i odpisów 1%</p>


<!--            <p class="font_size_12">Wyrażam zgodę na przetwarzanie moich/reprezentowanego przez mnie małoletniego/ubezwłasnowolnionego całkowicie** danych osobowych, w tym danych o stanie zdrowia,-->
<!--                przez Fundację VOTUM w celu realizacji zadań statutowych Fundacji, zgodnie z Ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz.U. z 2014 roku, poz. 1182 ze zm.).</p>-->
<!---->
<!--            <div class="col-md-12 padding_l_40 padding_r_40 margin_t_60">-->
<!--                <div class="float_r center">-->
<!--                    _______________________________________<br>-->
<!--                    <p class="font_size_12">data, miejscowość i podpis Wnioskodawcy</p>-->
<!--                </div>-->
<!--                <div class="clear_b odstep"></div>-->
<!--            </div>-->

            <p class="font_size_12">Wyrażam zgodę na wgląd przez reprezentanta, bądź upoważnionego pracownika Fundacji VOTUM do dokumentacji mojej sprawy zgromadzonej przez VOTUM S.A., w tym
                dokumentacji medycznej, wyłącznie w celu skompletowania informacji niezbędnych do weryfikacji niniejszego wniosku.</p>

            <div class="col-md-12 padding_l_40 padding_r_40 margin_t_60">
                <div class="float_r center">
                    _______________________________________<br>
                    <p class="font_size_12">data, miejscowość i podpis Wnioskodawcy</p>
                </div>
                <div class="clear_b odstep"></div>
            </div>

            <p class="font_size_12 margin_b_0">* Postaw X przy wybranej pozycji. Możesz wybrać więcej niż jedną pozycję z listy.</p>
            <p class="font_size_12">** Niepotrzebne skreślić.</p>

            <div class="ramka_small">
                <p class="font_size_12 font_w_700 padding_l_10 padding_t_10">Wymagane załączniki:</p>
                <p class="font_size_12 padding_l_10 margin_b_0">1. Zaświadczenie lekarskie o stanie zdrowia + dokumentacja medyczna z dotychczasowego leczenia</p>
                <p class="font_size_12 padding_l_10 margin_b_0">2. Oświadczenie o stanie majątkowym + kserokopia ostatniej deklaracji podatkowej PIT</p>
                <p class="font_size_12 padding_l_10 margin_b_0">3. Notatka policyjna z wypadku lub dokumentacja z sądu</p>
            </div>

            <p class="font_size_12 font_w_700 margin_t_10">Poprawnie wypełniony formularz z załącznikami można przesłać pocztą na adres Fundacji VOTUM, faksem lub w formie załącznika na skrzynkę e-mail.</p>

        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_40 padding_l_40 padding_r_40">
            <div class="pdf_kreska col-md-12 margin_b_0"></div>
            <div class="col-md-12 margin_t_20">
                <p class="text_a_center font_size_10 margin_b_0">Fundacja VOTUM Organizacja Pożytku Publicznego, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71 33 93 531, fax 71 33 93 403, e-mail: biuro@fundacjavotum.org, www.fundacjavotum.org,</p>
                <p class="text_a_center font_size_10">REGON: 020458864, NIP:899-25-92-805, KRS:0000272272, BANK: 32 1500 1067 1210 6008 3182 0000</p>
            </div>

        </div>
    </div>

<div class="pdf_strona">

    <div class="pdf_strona_pierwsza_naglowek_pouczenie margin_t_80">
        <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_fundacja.jpg"/></div>
    </div>

    <p class="margin_b_0 margin_t_0 pdf_duze_litery font_size_18 font_w_700 text_a_center">OŚWIADCZENIE O STANEI MAJĄTKOWYM, SYTUACJI MATERIALNEJ I RODZINNEJ BENEFICJENTA</p>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_20">

        <p class="font_size_12"><span class="font_w_700">Wnioskodawca:</span><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Imie'].' '.$klient['Nazwisko'] : $uprawniony['Imie'].' '.$uprawniony['Nazwisko']; ?></p>
        <p class="font_size_12"><span class="font_w_700">Beneficjent:</span><?php echo $poszkodowany['Imie'].' '.$poszkodowany['Nazwisko'];?></p>

        <p class="font_size_12"><span class="font_w_700">Osoby pozostające we wspólnym gospodarstwie domowym z Beneficjentem (stopień pokrewieństwa):</span></p>
        <p class="font_size_12"><?php echo $wniosek_do_fundacji['OsobyWGospodarstwie']; ?></p>

        <p class="font_size_12 font_red margin_t_30"><span class="font_w_700 font_red">Poniższe informacje należy podać zarówno w odniesieniu do Beneficjenta, jak i osób pozostających z nim we wspólnym gospodarstwie domowym.</span></p>

        <p class="font_size_12 margin_t_30"><span class="font_w_700">Posiadane nieruchomości (dom, mieszkanie, działka [m2]):</span></p>
        <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($nieruchomosci['Dom'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> dom o powierzchni <?php echo ($nieruchomosci['Dom'] == 1) ? $nieruchomosci['PowierzchniaDomu'] : '________________'; ?> właściciel: <?php echo ($nieruchomosci['WlascicielDomu'] == 1) ? $nieruchomosci['Dom'] : '________________'; ?></p>
        <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($nieruchomosci['Mieszkanie'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> mieszkanie o powierzchni <?php echo ($nieruchomosci['Mieszkanie'] == 1) ? $nieruchomosci['PowierzchniaMieszkania'] : '________________'; ?> właściciel: <?php echo ($nieruchomosci['Mieszkanie'] == 1) ? $nieruchomosci['WlascicielMieszkania'] : '________________'; ?></p>
        <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($nieruchomosci['DzialkaRolna'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> działkę rolną o powierzchni <?php echo ($nieruchomosci['DzialkaRolna'] == 1) ? $nieruchomosci['PowierzchniaDzialkiRolnej'] : '________________'; ?> właściciel: <?php echo ($nieruchomosci['DzialkaRolna'] == 1) ? $nieruchomosci['WlascicielDzialkiRolnej'] : '________________'; ?></p>
        <p class="font_size_12"><span class="glyphicon glyphicon<?php echo ($nieruchomosci['DzialkaBudowlana'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> działkę budowlaną o powierzchni <?php echo ($nieruchomosci['DzialkaBudowlana'] == 1) ? $nieruchomosci['PowierzchniaDzialkiBudowlanej'] : '________________'; ?> właściciel: <?php echo ($nieruchomosci['DzialkaBudowlana'] == 1) ? $nieruchomosci['WlascicielDzialkiBudowlanej'] : '________________'; ?></p>

        <p class="font_size_12 margin_t_30"><span class="font_w_700">Osoby pozostające we wspólnym gospodarstwie domowym z Beneficjentem (stopień pokrewieństwa):</span></p>
        <p class="font_size_12"><?php echo $wniosek_do_fundacji['Zasoby']; ?></p>


        <p class="font_size_12 margin_t_30"><span class="font_w_700">Opis dochodów i źródeł utrzymania wraz z podaniem kwot i osób, których dotyczą:</span></p>
        <p class="font_size_12">1. Wynagrodzenia za pracę: <?php echo $dochod['Wynagrodzenie']; ?></p>
        <p class="font_size_12">2. Dochody z tytułu powadzonej działalności gospodarczej/ rolniczej: <?php echo $dochod['Dzialalnosc']; ?></p>
        <p class="font_size_12">3. Renty: <?php echo $dochod['Renta']; ?></p>
        <p class="font_size_12">4. Emerytury: <?php echo $dochod['Emerytura']; ?></p>
        <p class="font_size_12">5. Zasiłki: <?php echo $dochod['Zasilek']; ?></p>
        <p class="font_size_12">6. Świadczenia socjalne i pielęgnacyjne: <?php echo $dochod['Socjal']; ?></p>
        <p class="font_size_12">7. Alimenty: <?php echo $dochod['Alimenty']; ?></p>

        <p class="font_size_12 margin_t_30"><span class="font_w_700">Średni miesięczny dochód netto na osobę w rodzinie: <?php echo ($dochod['SredniDochod'] != '')? $dochod['SredniDochod'] : '______________'; ?> zł</span></p>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_60">
            <div class="float_r center">
                _______________________________________<br>
                <p class="font_size_12">data, miejscowość i podpis Wnioskodawcy</p>
            </div>
            <div class="clear_b odstep"></div>
        </div>

    </div>

    <div class="pdf_strona_stopka col-md-12 margin_b_40 padding_l_40 padding_r_40">
        <div class="pdf_kreska col-md-12 margin_b_0"></div>
        <div class="col-md-12 margin_t_20">
            <p class="text_a_center font_size_10 margin_b_0">Fundacja VOTUM Organizacja Pożytku Publicznego, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71 33 93 531, fax 71 33 93 403, e-mail: biuro@fundacjavotum.org, www.fundacjavotum.org,</p>
            <p class="text_a_center font_size_10">REGON: 020458864, NIP:899-25-92-805, KRS:0000272272, BANK: 32 1500 1067 1210 6008 3182 0000</p>
        </div>

    </div>
</div>
