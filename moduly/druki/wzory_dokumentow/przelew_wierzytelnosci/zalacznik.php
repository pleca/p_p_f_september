<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$liczba_wlascicieli = $_POST['liczba_wlascicieli'];
$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);

for($i=1; $i<=$liczba_wlascicieli; $i++) {
    ${'klient_'.$i} = json_decode($_POST['klient_'.$i], true);
    ${'pelnomocnik_'.$i} = json_decode($_POST['pelnomocnik_'.$i], true);
    ${'reprezentant_'.$i} = json_decode($_POST['reprezentant_'.$i], true);
}

$stopka = 'PG-2-14-F10/2016-12-21';
$nr_strony = 1;
$strony = $liczba_wlascicieli

?>

    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php for ($i=1; $i<=$liczba_wlascicieli; $i++ ) { ?>

    <div class="pdf_strona">
        <div class="pdf_strona_pierwsza_naglowek">
            <div class="pdfs_przedstawiciel_dane">
                <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
                <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
                <div class="pdf_kratka"><?php echo $umowa['KodJednostki']; ?></div>
                <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">KOD JEDNOSTKI</p>
                <div class="pdf_kratka"><?php echo $umowa['KonsultantId']; ?></div>
                <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">KOD KONSULTANTA</p>
            </div>
            <div class="pdfs_tytu_dokumentu pdf_tytul_cesja">
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">ZAŁĄCZNIK NR 1 DO</p>
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">UMOWY PRZELEWU WIERZYTELNOŚCI</p>
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">NR: </p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <p class="font_w_700 margin_t_60 margin_l_20">zawarta na podstawie oferty z dnia <?php echo $umowa['DataUmowy']; ?> r. pomiędzy:</p>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CEDENTEM:</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza">
            <div class="form-group col-md-3 tlo_podtytulu_czerwone">
                <label class="pdf_duze_litery podtytul_formularza"><?php echo ( $i != 1) ? 'WSPÓŁWŁAŚCICIEL' : 'WŁAŚCICIEL'; ?></label>
            </div>
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
        </div>

        <p class="font_w_700 col-md-12 margin_t_10 margin_b_10">reprezentowany przez:</p>

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
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'pelnomocnik_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">NIP</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Nip']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Krs']; ?></div>
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
            <div class="form-group col-md-3">
                <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'reprezentant_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">NIP</label>
                <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Nip']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Krs']; ?></div>
            </div>
        </div>

        <label class="text_a_center col-md-12 margin_t_10">a</label>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">CESJONARIUSZEM:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
            VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93
            403, e-mail: dok@votum-sa.pl,
            zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru
            Sądowego pod numerem
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>,
            którą reprezentuje:
            <div class="form-group col-md-12 margin_t_20">
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?><?php echo $klient['Nazwisko']; ?></div>
            </div>
        </div>

        <label class="text_a_center col-md-12 font_w_700 margin_t_20">§ 1</label>
        <p class="margin_b_0">1. Cenę wierzytelności, przewidzianą w § 2 ust 1. umowy, ustala się na kwotę <span class="font_w_700"><?php echo $umowa_dane['KwotaOdkupienia']; ?></span> zł (słownie: <span class="font_w_700"><?php echo $umowa_dane['KwotaOdkupieniaSlownie']; ?></span>
            ) w tym kwotę <span class="font_w_700"><?php echo $umowa_dane['ZaliczkaNaPodatek']; ?></span> zł (<span class="font_w_700"><?php echo ($umowa_dane['UmowaTypKlientaId'] == 2 || $umowa_dane['UmowaTypKlientaId'] == 3) ? $umowa_dane['UmowaTypKlienta'] : 'słownie: '.$umowa_dane['ZaliczkaNaPodatekSlownie'];  ?></span>) zaliczki na podatek dochodowy w obowiązującej wysokości 18%,
            co daje do zapłaty kwotę <span class="font_w_700"><?php echo $umowa_dane['KwotaDoZaplaty']; ?></span> zł (słownie: <span class="font_w_700"><?php echo $umowa_dane['KwotaDoZaplatySlownie']; ?></span>).</p>
        <p class="margin_b_0">2. Cesjonariusz wyliczy i odprowadzi do właściwego Urzędu Skarbowego zaliczkę na podatek dochodowy, o której mowa w ust. 1
            i prześle Cedentowi stosowny PIT w terminie do ostatniego dnia lutego roku następującego po roku zawarcia umowy.</p>


        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">1/2</div>
        </p>
    </div>
    </div>

    <div class="pdf_strona">

        <p class="margin_b_0">3. Cena wskazana w ust. 1 zostanie zapłacona:</p>
        <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> na rachunek bankowy nr: <span class="font_w_700"><?php echo $wynagrodzenie['WynagdorzenieNumer']; ?></span></p>
        <p class="margin_b_0">Należący do: <span class="font_w_700"><?php echo ($wynagrodzenie['SposobPlatnosciId'] == 2) ? $wynagrodzenie['WynagdorzenieImie'].' '.$wynagrodzenie['WynagdorzenieNazwisko'].', '.$wynagrodzenie['WynagdorzenieUlica'].' '.$wynagrodzenie['WynagdorzenieNrDomu'].' '.$wynagrodzenie['WynagdorzenieNrMieszkania'].', '.$wynagrodzenie['WynagdorzenieKodPocztowy'].' '.$wynagrodzenie['WynagdorzenieMiasto']: ''; ?></span></p>

        <p class="margin_b_0 margin_t_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przekazem pocztowym na rzecz: <span class="font_w_700"><?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? $wynagrodzenie['WynagdorzenieImie'].' '.$wynagrodzenie['WynagdorzenieNazwisko'] : ''; ?></span></p>
        <p class="margin_b_0"><?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? $wynagrodzenie['WynagdorzenieUlica'].' '.$wynagrodzenie['WynagdorzenieNrDomu'].' '.$wynagrodzenie['WynagdorzenieNrMieszkania'].', '.$wynagrodzenie['WynagdorzenieKodPocztowy'].' '.$wynagrodzenie['WynagdorzenieMiasto'] : ''; ?></span></p>

        <p class="margin_b_0">4. Załącznik stanowi integralną część umowy.</p>


        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">VOTUM S.A.</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CEDENT <span class="font_size_8">(OSOBY DOKONUJĄCE CESJI POWIERNICZEJ)</span>
                </p>
            </div>
            <div class="clear_b"></div>
        </div>


        <p class="margin_b_0 margin_t_20 margin_b_10"><span class="font_w_700">Oświadczenie*</span>(*Wypełnić, jeżeli dokumenty zostały podpisane w obecności Przedstawiciela)</p>
        <p class="">Ja niżej podpisany, jako pełnomocnik Cesjonariusza - VOTUM S.A., oświadczam, iż podpisy Cedenta - osób dokonujących cesji
            na wszystkich dokumentach, w tym na umowie, załącznikach do umowy, powiadomieniu dłużnika o przelewie wierzytelności,
            pełnomocnictwie, zostały złożone w mojej obecności własnoręcznie przez Cedenta - osoby dokonujące cesji.</p>

        <div class="form-group col-md-6 padding_l_0">
            <div class="pdf_kratka"><?php echo $umowa['ImiePrzedstawiciela'].' '.$umowa['NazwiskoPrzedstawiciela']; ?></div>
            <label class="pdf_duze_litery font_size_10 no_bold">IMIĘ I NAZWISKO PRZEDSTAWICIELA (WYPEŁNIĆ DRUKOWANYMI LITERAMI)</label>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CZYTELNY PODPIS PRZEDSTAWICIELA
                </p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">2/2</div>
        </p>
    </div>
    </div>
<?php } ?>