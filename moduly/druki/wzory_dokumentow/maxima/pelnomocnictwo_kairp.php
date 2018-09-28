<?php
setlocale(LC_CTYPE, "pl_PL.UTF-8");

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
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

        <div class="pdf_strona_pierwsza_naglowek pdf_strona_pierwsza_naglowek_pouczenie margin_b_20">
            <div class="pdfs_logo_kairp"><img
                        src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp.png"/></div>
        </div>
        <p class="margin_b_0 margin_t_20 text_a_right">________________, dnia ________________ r.</p>
        <p class="margin_b_0 margin_t_60 pdf_duze_litery font_size_26 font_w_700 text_a_center">pełnomocnictwo</p>

        <p class="margin_t_60">Ja niżej
            podpisany/a <?php echo $klient['Imie']; ?>  <?php echo $klient['Nazwisko'];?>,
            <?php echo ($w_imieniu['Opis'] == 4 || empty($w_imieniu['Opis'])) ? '' : 'działając w imieniu własnym oraz jako przedstawiciel ustawowy ';
                  echo ($w_imieniu['Opis'] == 1) ? 'małoletniego/małoletniej* ' : '';
                  echo ($w_imieniu['Opis'] != 4) ? $w_imieniu['Imie'].' '.$w_imieniu['Nazwisko'] : '';
            ?>
            upoważniam samodzielnie adwokata Andrzeja Łebka i adw. Anielę Łebek z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu do prowadzenia sprawy
            ....................................... ......................................... ................................. .........................
            w związku ze zdarzeniem z dnia <?php echo $pozostale_informacje['Data']; ?> r. oraz do odbioru świadczenia. Pełnomocnictwo niniejsze zostaje udzielone na czas
            nieokreślony, ze skutkiem od dnia jego przyjęcia przez Pełnomocnika.</p>


        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_r float_r col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center font_w_700">PODPIS MOCODAWCY</p>
            </div>
            <div class="clear_b"></div>
        </div>


    <div class="pdf_podpisy_p col-md-12 paddding_l_0 paddding_r_0">
        <p class="margin_t_20 font_w_700">Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</p>
        <p class="">1. ____________________________________</p>
        <p class="">2. ____________________________________</p>
        <p class="">3. ____________________________________</p>
    </div>
        <div class="clear_b"></div>
        <p class="margin_b_0 font_w_700 margin_t_20">Wrocław, dnia _____________ r.</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center font_w_700">PODPIS PEŁNOMOCNIKA</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="col-md-1"></div>
            <div class="pdf_kreska col-md-10 margin_b_0 "></div>
            <div class="col-md-1"></div>
            <p class="font_w_700 col-md-12 text_a_center pdf_czerowny_napis pdf_duze_litery font_size_10 margin_b_0">
                kancelaria adwokatów i radców prawnych a. Łebek i wspólnicy spółka komandytowa</p>
            <p class="font_w_700 col-md-12 text_a_center font_size_10 margin_b_0 pdf_szary_napis">ul. Wyscigowa 56i;
                53-012 Wrocław, tel. +48 71 332 93 40, fax +48 71 332 93 43</p>
            <p class="font_w_700 col-md-12 text_a_center font_size_10 margin_b_0 pdf_szary_napis">e-mail:
                kancelaria@kairp-lebek.pl, www.kairp-lebek.pl</p>
            <p class="font_w_700 col-md-12 text_a_center font_size_10 margin_b_0 pdf_szary_napis">NIP: 899-25-79-696
                REGON: 020356170 KRS: 0000262469</p>


        </div>


    </div>

    <?php
}
?>