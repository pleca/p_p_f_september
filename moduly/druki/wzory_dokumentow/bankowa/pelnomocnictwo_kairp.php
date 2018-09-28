<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$lista_klientow = json_decode($_POST['lista_klientow']);
$umowa_dane = json_decode($_POST['umowa_dane']);
$umowa = json_decode($_POST['umowa'], true);

$stopka = 'PG-2-21-F2/2017-01-02';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php
    for($i=0;$i<count($lista_klientow);$i++) {
        ?>
            <div class="pdf_strona">

                <div class="pdf_strona_pierwsza_naglowek pdf_strona_pierwsza_naglowek_pouczenie margin_b_20">
                    <div class="pdfs_logo_kairp"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp.png"/></div>
                </div>
                <p class="margin_b_0 margin_t_20 text_a_right"><?php echo $umowa['Miasto']; ?>, dnia <?php echo $umowa['DataUmowy']; ?> r.</p>
                <p class="margin_b_0 margin_t_60 pdf_duze_litery font_size_26 font_w_700 text_a_center">pełnomocnictwo</p>

                <p class="margin_t_60">Ja niżej podpisany/a <?php echo $lista_klientow[$i]->Imie.' '.$lista_klientow[$i]->Nazwisko; ?> upoważniam
                    _______________________________________________________________ z Kancelarii Adwokatów
                    i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu do prowadzenia sprawy przeciwko
                    __________________________________________________ o zapłatę. Pełnomocnictwo obejmuje
                    umocowanie do podejmowania wszelkich związanych ze sprawą czynności zarówno w postępowaniu przed
                    sądami powszechnymi wszystkich instancji, złożenia wniosku o zawezwanie do próby ugodowej oraz negocjowania
                    i zawarcia ugody, a także prowadzenia negocjacji pozasądowych oraz uprawnienie do odbioru świadczenia.
                    Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze skutkiem od dnia jego przyjęcia
                    przez Pełnomocnika.</p>

                <p class="margin_t_20">Ponadto, na podstawie art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r.
                    poz. 1988), upoważniam zarówno bank, a także Rzecznika Finansowego do ujawnienia i przekazania wszystkich
                    informacji objętych tajemnicą bankową mojemu pełnomocnikowi, w zakresie niezbędnym do wykonania
                    wszelkich czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego
                    w związku z wniesionym wnioskiem w wyżej wymienionej sprawie.</p>

                <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
                    <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                        <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center font_w_700">PODPIS MOCODAWCY</p>
                    </div>
                    <div class="clear_b"></div>
                </div>

                <p class="margin_t_20">Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</p>
                <p class="">1. __________________________________________________________________________________________________________</p>
                <p class="">2. __________________________________________________________________________________________________________</p>
                <p class="">3. __________________________________________________________________________________________________________</p>

                <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
                    <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                        Wrocław, dnia _________________ r.
                    </div>
                    <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                        <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center font_w_700">PODPIS PEŁNOMOCNIKA</p>
                    </div>
                    <div class="clear_b"></div>
                </div>

                <div class="pdf_strona_stopka col-md-12 margin_b_0">
                    <div class="col-md-1"></div><div class="pdf_kreska col-md-10 margin_b_0 "></div><div class="col-md-1"></div>
                    <p class="font_w_700 col-md-12 text_a_center pdf_czerowny_napis pdf_duze_litery font_size_10 margin_b_0">kancelaria adwokatów i radców prawnych a. Łebek i wspólnicy spółka komandytowa</p>
                    <p class="font_w_700 col-md-12 text_a_center font_size_10 margin_b_0 pdf_szary_napis">ul. Wyscigowa 56i; 53-012 Wrocław, tel. +48 71 332 93 40, fax +48 71 332 93 43</p>
                    <p class="font_w_700 col-md-12 text_a_center font_size_10 margin_b_0 pdf_szary_napis">e-mail: kancelaria@kairp-lebek.pl, www.kairp-lebek.pl</p>
                    <p class="font_w_700 col-md-12 text_a_center font_size_10 margin_b_0 pdf_szary_napis">NIP: 899-25-79-696 REGON: 020356170 KRS: 0000262469</p>


                </div>


            </div>

        <?php
    }
?>