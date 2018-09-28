<?php
setlocale(LC_CTYPE, "pl_PL.UTF-8");

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$uprawniony = json_decode($_POST['uprawniony'], true);
$w_imieniu = json_decode($_POST['w_imieniu'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);

$stopka = 'PG-2-21-F2/2017-01-02';
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php
for ($i = 0; $i < 2; $i++) {
    ?>
    <div class="pdf_strona">

        <div class="pdf_strona_pierwsza_naglowek_pouczenie margin_t_80">
            <div class="date_place padding_l_40">
                <p class="margin_b_0 margin_t_40 text_a_left"><?php echo $umowa['Miasto'] ?>, dnia <?php echo $umowa['DataUmowy'] ?> r.</p>
                <!--<p class="margin_b_0 margin_t_20 text_a_left">dnia <?php /*echo $umowa['DataUmowy'] */?> r.</p>-->
            </div>
            <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp.png"/></div>
        </div>

        <p class="margin_b_0 margin_t_60 pdf_duze_litery font_size_26 font_w_700 text_a_center">PEŁNOMOCNICTWO</p>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">

            <p class="margin_t_60 line_height_28">Ja niżej podpisany/a
                <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0 || empty($pozostale_informacje['UmowaRodzajUprawnionegoId'])) ? $klient['Imie'].' '.$klient['Nazwisko'] : $uprawniony['Imie'].' '.$uprawniony['Nazwisko']; ?>,
                <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0 || empty($pozostale_informacje['UmowaRodzajUprawnionegoId'])) ? ' działając w imieniu własnym ' : ' działając w imieniu własnym oraz jako przedstawiciel ';
                      echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 2) ? 'małoletniego/małoletniej* ' : '';
                      echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4) ? $klient['Imie'].' '.$klient['Nazwisko'] : '';
                ?>
                upoważniam . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu
                do prowadzenia sprawy . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                w związku ze zdarzeniem z dnia <?php echo $pozostale_informacje['Data']; ?> r. oraz do odbioru świadczenia. Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony,
                ze skutkiem od dnia jego przyjęcia przez Pełnomocnika.</p>


        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_60">
            <div class="float_r center">
                _______________________________________<br>
                podpis mocodawcy
            </div>
            <div class="clear_b odstep"></div>
        </div>


        <div class="pdf_podpisy_p col-md-12 paddding_l_0 paddding_r_0">
            <p class="margin_t_20 line_height_28">Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</p>
            <p class="line_height_28">1. _______________________________________________________________________________________________________</p>
            <p class="line_height_28">2. _______________________________________________________________________________________________________</p>
            <p class="line_height_28">3. _______________________________________________________________________________________________________</p>
        </div>
            <div class="clear_b"></div>
            <p class="margin_b_0 margin_t_20">Wrocław, dnia <?php echo $umowa['DataUmowy'] ?> r.</p>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_60">
            <div class="float_l center">
                _______________________________________<br>
                        podpis pełnomocnika
            </div>
            <div class="clear_b odstep"></div>
        </div>
    </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_40 padding_l_40 padding_r_40">
            <div class="pdf_kreska col-md-12 margin_b_0"></div>
            <div class="col-md-6 padding_l_40 margin_t_40">
                <p class="font_size_18 font_w_700 font_red">www.lebekiwspolnicy.pl</p>
                <p class="font_size_12 ">biuro@lebekiwspolnicy.pl</p>
            </div>
            <div class="col-md-6 padding_r_40 text_a_right margin_t_40">
                <p class="font_size_18 font_w_700 font_red">tel. 71 339 36 00</p>
                <p class="font_size_12">fax: 71 339 36 43</p>
            </div>
        </div>

    </div>

    <?php
}
?>