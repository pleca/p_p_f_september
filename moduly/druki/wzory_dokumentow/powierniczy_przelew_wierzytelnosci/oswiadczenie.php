<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$klient = json_decode($_POST['klient'], true);


$stopka = 'PG-2-4-F18/2016-12-21';
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">


        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>

        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>
        <div class="form-group col-md-12">
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0"><?php echo $klient['Imie'].' '.$klient['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0"><?php echo $klient['Ulica'].' '.$klient['NrDomu'].' '.$klient['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0"><?php echo $klient['KodPocztowy'].' '.$klient['Miejscowosc']; ?></div>
        </div>


            <p class="margin_b_0 font_w_700 font_size_26 text_a_center margin_t_120">Oświadczenie</p>

        <label class="pdf_label_kratka pdf_czerowny_napis margin_l_20 margin_t_60">Ja niżej podpisany:</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza">

            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ I NAZWISKO</label>
                <div class="pdf_kratka"><?php echo $klient['Imie'].' '.$klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">LEGITYMUJĄCY SIĘ DOWODEM OSOBISTYM O SERII I NUMERZE</label>
                <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
            </div>
        </div>

        <label class="pdf_label_kratka pdf_czerowny_napis margin_l_20 margin_t_60">Oświadczam, że</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza">

            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">POJAZD (MARKA I MODEL)</label>
                <div class="pdf_kratka"><?php echo $umowa_dane['Marka'].' '.$umowa_dane['Model']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">O NR REJ.</label>
                <div class="pdf_kratka"><?php echo $umowa_dane['NrRejestracyjny']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <p class="font_size_16">nie miał uszkodzeń o charakterze kolizyjnym oraz żadnych innych uszkodzeń, w tym uszkodzeń elementów
                    lakierowanych, metalowych elementów nadwozia lub ramy pojazdu, z wyjątkiem ewentualnych śladów
                    związanych z normalną eksploatacją pojazdu przed dniem (data zdarzenia): <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span></p>
            </div>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_120 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center font_w_700">DATA I PODPIS</p>
            </div>
            <div class="clear_b"></div>
        </div>

            <div class="pdf_strona_stopka col-md-12 margin_b_0">
                <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
                <p class="text_a_center margin_b_0">1/1</p>
            </div>


    </div>
