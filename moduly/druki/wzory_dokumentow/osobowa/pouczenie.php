<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);

$stopka = 'PG-2-23-F2/2017-10-01';
?>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css"/>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css"/>


<div class="pdf_strona">


    <div class="pdf_strona_pierwsza_naglowek_pouczenie margin_t_80">
        <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
            <p class="margin_b_0 font_w_700 font_size_16 text_a_center" >POUCZENIE O PRAWIE ODSTĄPIENIA OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA</p>
        </div>
        <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>
    </div>


    <div class="szary_box szary_box_ramka_czerw text_a_center">
        <p class="text_a_center font_size_10 font_w_700">Potwierdzam otrzymanie pouczenia wraz z wzorem oświadczenia o odstąpieniu od umowy o treści zgodnej z zamieszczonym poniżej wzorem.</p>
        <div class="form-group col-md-4 margin_t_5">

        </div>
        <div class="form-group col-md-4 margin_t_5">

        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy big_kratka">
                <span class="font_size_12"><?php echo $umowa['DataUmowy'] ?></span>
            </div>
            <label class="font_size_10 ">data i podpis Klienta/Uprawnionego</label>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="clear_b"></div>
    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <p class="margin_t_20 font_w_700 font_size_12">Pozasądowe sposoby rozpatrywania reklamacji</p>
        <p class="font_size_12">Klient może skorzystać z nieodpłatnych i dobrowolnych pozasądowych sposobów rozpatrywania reklamacji w drodze mediacji lub za
            pomocą sądów polubownych w przypadku nieuwzględnienia reklamacji Klienta przez VOTUM lub nierozpatrzenia jej w terminie 21dni,
            na przykład przez złożenie na odpowiednim formularzu wniosku do właściwego terenowo Wojewódzkiego Inspektoratu Inspekcji Handlowej,
            więcej na stronie internetowej www.polubowne.uokik.gov.pl
        </p>
    </div>
    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <p class="margin_t_10 font_w_700 font_size_12">Prawo odstąpienia od umowy</p>
        <p class="font_size_12">Zgodnie z przepisami ustawy z dn. 20.05.2014 r. o prawach konsumenta (tj. Dz. U. z 2017r., poz. 683 ze zm) Klient może odstąpić od umowy w terminie 14 dni
            od dnia jej zawarcia bez podawania przyczyny i bez ponoszenia kosztów, z wyjątkiem kosztów zapłaty kwoty proporcjonalnej do zakresu świadczeń spełnionych
            do otrzymania przez VOTUM informacji o odstąpienie, jeżeli Klient zażądał rozpoczęcia wykonania usługi przed upływem terminu odstąpienia. Prawo odstąpienia
            można wykonać przez poinformowanie VOTUM o swojej decyzji na przykład pismem wysłanym pocztą elektroniczną na dane teleadresowe VOTUM wskazane poniżej i korzystając
            z wzoru poniżej, przy czym skorzystanie z wzoru nie jest obowiązkowe.
        </p>
    </div>



    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <div class="ramka">

            <div class="text_a_right margin_t_10 float_r padding_r_40 ">
                <p class="padding_r_40 margin_b_0 font_w_700 font_size_12">VOTUM S.A.</p>
                <p class="padding_r_40 margin_b_0 font_size_12">ul. Wyścigowa 56i, 53-012 Wrocław</p>
                <p class="padding_r_40 margin_b_0 font_size_12">fax: 71/ 33 93 403, dok@votum-sa.pl</p>
            </div>

            <div class="margin_t_80 pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
                <p class="margin_b_0 font_w_700 font_size_12 text_a_center">WZÓR OŚWIADCZENIA O ODSTĄPIENIU</p>
            </div>
            <p class="text_a_center font_size_12">(Tylko do odstąpienia od umowy)</p>

            <p class="ex_for_votum_l">Egzemplarz dla VOTUM</p>
            <p class="ex_for_votum_r">Egzemplarz dla VOTUM</p>

            <div class="padding_0 float_l margin_t_20 padding_l_40 padding_r_40">
                <div class="padding_0">
                    _____________________________________________________________
                    <p class="font_size_12">Imię i nazwisko Klienta</p>
                    _____________________________________________________________
                    <p class="font_size_12">Adres zamieszkania Klienta</p>
                    <p class="font_size_12">Niniejszym informuję o odstąpieniu od umowy zawartej w dniu <?php echo(!empty($umowa['DataUmowy'])) ? $umowa['DataUmowy'] : '_______________' ?></p>
                    ________________________________
                    <p class="font_size_12 padding_l_40">data i podpis Klienta/Uprawnionego</p>
                </div>
            </div>
            <!--<div class="example_1"><p>WZÓR</p></div>-->
        </div>
        <!--<div class="example_1"><p>WZÓR</p></div>-->
    </div>
    <div class="clear_b"></div>

    <div class="margin_t_10 margin_b_20">
            <div style="width: 106%; margin-left: -3%; height: 2px"> __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ </div>
    </div>
    <div class="example_1"><p>WZÓR</p></div>

    <div class="clear_b"></div>
    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <p class="margin_t_20 font_w_700 font_size_12">Pozasądowe sposoby rozpatrywania reklamacji</p>
        <p class="font_size_12">Klient może skorzystać z nieodpłatnych i dobrowolnych pozasądowych sposobów rozpatrywania reklamacji w drodze mediacji lub za
            pomocą sądów polubownych w przypadku nieuwzględnienia reklamacji Klienta przez VOTUM lub nierozpatrzenia jej w terminie 21dni,
            na przykład przez złożenie na odpowiednim formularzu wniosku do właściwego terenowo Wojewódzkiego Inspektoratu Inspekcji Handlowej,
            więcej na stronie internetowej www.polubowne.uokik.gov.pl
        </p>
    </div>
    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <p class="margin_t_10 font_w_700 font_size_12">Prawo odstąpienia od umowy</p>
        <p class="font_size_12">Zgodnie z przepisami ustawy z dn. 20.05.2014 r. o prawach konsumenta (tj. Dz. U. z 2017r., poz. 683 ze zm) Klient może odstąpić od umowy w terminie 14 dni
            od dnia jej zawarcia bez podawania przyczyny i bez ponoszenia kosztów, z wyjątkiem kosztów zapłaty kwoty proporcjonalnej do zakresu świadczeń spełnionych
            do otrzymania przez VOTUM informacji o odstąpienie, jeżeli Klient zażądał rozpoczęcia wykonania usługi przed upływem terminu odstąpienia. Prawo odstąpienia
            można wykonać przez poinformowanie VOTUM o swojej decyzji na przykład pismem wysłanym pocztą elektroniczną na dane teleadresowe VOTUM wskazane poniżej i korzystając
            z wzoru poniżej, przy czym skorzystanie z wzoru nie jest obowiązkowe.
        </p>
    </div>



    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <div class="ramka">

            <div class="text_a_right margin_t_10 float_r padding_r_40">
                <p class="padding_r_40 margin_b_0 font_w_700 font_size_12">VOTUM S.A.</p>
                <p class="padding_r_40 margin_b_0 font_size_12">ul. Wyścigowa 56i, 53-012 Wrocław</p>
                <p class="padding_r_40 margin_b_0 font_size_12">fax: 71/ 33 93 403, dok@votum-sa.pl</p>
            </div>

            <div class="margin_t_80 pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
                <p class="margin_b_0 font_w_700 font_size_12 text_a_center">WZÓR OŚWIADCZENIA O ODSTĄPIENIU</p>
            </div>
            <p class="text_a_center font_size_12">(Tylko do odstąpienia od umowy)</p>

            <p class="ex_for_votum_l">Egzemplarz dla klienta</p>
            <p class="ex_for_votum_r">Egzemplarz dla klienta</p>

            <div class="padding_0 float_l margin_t_20 padding_l_40 padding_r_40">
                <div class="padding_0">
                    _____________________________________________________________
                    <p class="font_size_12">Imię i nazwisko Klienta</p>
                    _____________________________________________________________
                    <p class="font_size_12">Adres zamieszkania Klienta</p>
                    <p class="font_size_12">Niniejszym informuję o odstąpieniu od umowy zawartej w dniu <?php echo(!empty($umowa['DataUmowy'])) ? $umowa['DataUmowy'] : '_______________' ?></p>
                    ________________________________
                    <p class="font_size_12 padding_l_40">data i podpis Klienta/Uprawnionego</p>
                </div>
            </div>

        </div>
    </div>
    <div class="example_2"><p>WZÓR</p></div>
    <div class="stopka_bottom_right"><?php echo $stopka; ?></div>

</div>