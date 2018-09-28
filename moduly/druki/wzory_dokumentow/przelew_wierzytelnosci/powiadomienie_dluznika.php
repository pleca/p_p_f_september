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

$stopka = 'PG-2-14-F11/2016-12-21';
?>

    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php for ($i=1; $i<=$liczba_wlascicieli; $i++ ) { ?>

    <div class="pdf_strona">

        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>

            <p class="pdf_czerowny_napis margin_l_0 margin_b_10 font_w_700">CEDENT</p>
            <p class="pdf_czerowny_napis margin_l_0 margin_b_0 font_w_700"><?php echo ( $i != 1) ? 'WSPÓŁWŁAŚCICIEL:' : 'WŁAŚCICIEL:'; ?></p>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_20"><?php echo (${'klient_'.$i}['Nazwa'] == '') ? ${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko'] : ${'klient_'.$i}['Nazwa'].' '.${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko']; ?></div>
            <div class="clear_b"></div>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_10"><?php echo ${'klient_'.$i}['Ulica'].' '.${'klient_'.$i}['NrDomu'].' '.${'klient_'.$i}['NrMieszkania']; ?></div>
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0 text_a_right"><?php echo $umowa['Miasto']; ?>, dnia <?php echo $umowa['DataUmowy']; ?> r.</div>
            <div class="clear_b"></div>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_10"><?php echo ${'klient_'.$i}['KodPocztowy'].' '.${'klient_'.$i}['Miasto']; ?></div>
            <div class="clear_b"></div>

            <div class="form-group col-md-2 paddding_l_0 margin_t_10">
                <label class="pdf_duze_litery font_size_10 margin_b_0">NIP*</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Nip']; ?></div>
            </div>
            <div class="form-group col-md-2 paddding_l_0 margin_t_10">
                <label class="pdf_duze_litery font_size_10 margin_b_0">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Krs']; ?></div>
            </div>
            <div class="clear_b"></div>

            <p class="pdf_szary_napis margin_l_0 margin_b_10 font_w_700 margin_t_20">PEŁNOMOCNIK:</p>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_20"><?php echo (${'pelnomocnik_'.$i}['Nazwa'] == '') ? ${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa'].' '.${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko']; ?></div>
            <div class="clear_b"></div>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_10"><?php echo ${'pelnomocnik_'.$i}['Ulica'].' '.${'pelnomocnik_'.$i}['NrDomu'].' '.${'pelnomocnik_'.$i}['NrMieszkania']; ?></div>
            <div class="clear_b"></div>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0"><?php echo ${'pelnomocnik_'.$i}['KodPocztowy'].' '.${'pelnomocnik_'.$i}['Miasto']; ?></div>
            <div class="clear_b"></div>

            <p class="pdf_szary_napis margin_l_0 margin_b_10 font_w_700 margin_t_20">REPREZENTANT:</p>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0"><?php echo (${'reprezentant_'.$i}['Nazwa'] == '') ? ${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko'] : ${'reprezentant_'.$i}['Nazwa'].' '.${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko']; ?></div>
            <div class="clear_b"></div>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_10"><?php echo ${'reprezentant_'.$i}['Ulica'].' '.${'reprezentant_'.$i}['NrDomu'].' '.${'reprezentant_'.$i}['NrMieszkania']; ?></div>
            <div class="clear_b"></div>

            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0"><?php echo ${'reprezentant_'.$i}['KodPocztowy'].' '.${'reprezentant_'.$i}['Miasto']; ?></div>
            <div class="clear_b"></div>

            <div class="form-group col-md-2 paddding_l_0 margin_t_10">
                <label class="pdf_duze_litery font_size_10 margin_b_0">NIP*</label>
                <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Nip']; ?></div>
            </div>
            <div class="form-group col-md-2 paddding_l_0 margin_t_10">
                <label class="pdf_duze_litery font_size_10 margin_b_0">KRS/EDG</label>
                <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Krs']; ?></div>
            </div>
            <div class="clear_b"></div>

            <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_20 margin_b_0">
                <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                    <div class="text_a_right"><?php echo $umowa_dane['UbezpieczycielNazwa']; ?></div>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_0">
                <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                    <div class="text_a_right"><?php echo $umowa_dane['UbezpieczycielUlica'].' '.$umowa_dane['UbezpieczycielNrDomu'].' '.$umowa_dane['UbezpieczycielNrMieszkania']; ?></div>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_80">
                <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                    <div class="text_a_right"><?php echo $umowa_dane['UbezpieczycielKodPocztowy'].' '.$umowa_dane['UbezpieczycielMiasto']; ?></div>
                </div>
                <div class="clear_b"></div>
            </div>

            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">POWIADOMIENIE DŁUŻNIKA</p>
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">O PRZELEWIE WIERZYTELNOŚCI</p>

            <p class="col-md-12 margin_t_60">Zawiadamiam, że wszelkie wierzytelności, jakie przysługują mi od Państwa z tytułu odszkodowania za szkodę
            w pojeździe marki <span class="font_w_700"><?php echo $umowa_dane['Marka'].' '.$umowa_dane['Model']; ?></span>, nr rej. <span class="font_w_700"><?php echo $umowa_dane['NrRejestracyjny']; ?></span>, od <span class="font_w_700"><?php echo $umowa['UbezpieczycielNazwa'] ?></span>
            należnego w związku ze zdarzeniem z dnia <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span> (nr akt szkodowych <span class="font_w_700"><?php echo $umowa_dane['NumerAkt']; ?></span>)
            na podstawie umowy przelewu wierzytelności zawartej na podstawie ofety z dnia <span class="font_w_700"><?php echo $umowa['DataUmowy']; ?></span>,
            przeniosłem(am) na rzecz VOTUM S.A. wpisaną do rejestru przedsiębiorców przez Sąd Rejonowy dla Wrocławia-Fabrycznej we Wrocławiu, VI Wydział Gospodarczy Krajowego Rejestru Sądowego, pod numerem KRS 0000243252;
            posiadającą nadane numery: REGON 020136043-00023, NIP 899-25-49-057, oraz kapitał zakładowy 1.200.000,00 zł
            wpłacony w całości.</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center font_w_700">PODPIS CEDENTA (OSÓB DOKONUJĄCYCH CESJI)</p>
            </div>
            <div class="clear_b"></div>
        </div>

            <div class="pdf_strona_stopka col-md-12 margin_b_0">
                <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
                <p class="text_a_center margin_b_0">1/1</p>
            </div>
    </div>
<?php } ?>
