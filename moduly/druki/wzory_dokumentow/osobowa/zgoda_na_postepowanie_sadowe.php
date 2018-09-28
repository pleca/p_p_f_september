<?php
setlocale(LC_CTYPE, "pl_PL.UTF-8");

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$uprawniony = json_decode($_POST['uprawniony'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);
$lista_swiadkow = json_decode($_POST['lista_swiadkow']);

?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>



    <div class="pdf_strona">

        <div class="pdf_strona_pierwsza_naglowek_pouczenie margin_t_80">
            <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp.png"/></div>
        </div>

        <p class="margin_b_0 margin_t_60 pdf_duze_litery font_size_26 font_w_700 text_a_center">OŚWIADCZENIE - ZGODA NA POSTĘPOWANIE SĄDOWE</p>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">

        <p class="margin_t_60 line_height_28">Ja niżej podpisany/a
            <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Imie'].' '.$klient['Nazwisko'] : $uprawniony['Imie'].' '.$uprawniony['Nazwisko'];?>,

            pouczony/a o kosztach związanych z wytoczeniem powództwa, wnoszę o skierowanie sprawy o dochodzenie roszczeń odszkodowawczych dotyczących zdarzenia z dnia
            <?php echo (!empty($pozostale_informacje['Data'])) ? $pozostale_informacje['Data'] : '________________'; ?> r. przeciwko zobowiązanemu do wypłaty odszkodowania <?php echo (!empty($pozostale_informacje['Zobowiazany'])) ? $pozostale_informacje['Zobowiazany'] : '________________'; ?> na drogę postępowania sądowego.
        </p>

        <p class="margin_t_60 line_height_28">Jednocześnie informuję, że w sprawie dotyczącej roszczeń z wypadku z dnia:
            <?php echo (!empty($pozostale_informacje['Data'])) ? $pozostale_informacje['Data'] : '________________'; ?> r. :
        </p>
        <p class="line_height_28">
            1. <span class="font_w_700"><?php echo ($pozostale_informacje['CzyToczonoPostepowanie'] == 1) ? 'toczyło się' : (($pozostale_informacje['CzyToczonoPostepowanie'] == 2) ? 'nie toczyło się' : 'toczyło się/nie toczyło się');?> </span> postępowanie sądowe w zakresie zadośćuczynienia/odszkodowania.
        </p>
        <p class="line_height_28">
            Jeśli toczyło się postępowanie, proszę wskazać Sąd i sygnaturę akt <?php echo ($pozostale_informacje['CzyToczonoPostepowanie'] == 1) ? $pozostale_informacje['Sad'].' '.$pozostale_informacje['SygnaturaAkt'] : '_________________________________________' ;?>
        </p>
        <p class="line_height_28">
            2. <span class="font_w_700"><?php echo ($pozostale_informacje['CzyZawartoUgode'] == 1) ? 'zawarto ugodę' : (($pozostale_informacje['CzyZawartoUgode'] == 2) ? 'nie zawarto ugody' : 'zawarto ugodę/nie zawarto ugody');?></span>
        </p>

        <p class="line_height_28 margin_t_40">
            W związku z dochodzeniem roszczeń odszkodowawczych, poniżej wskazuję osoby, które mogłyby być wezwane w charakterze świadków w sądzie,
            celem potwierdzenia okoliczności doznanej przeze mnie szkody, naruszonych więzi rodzinnych, oraz wykazania zmiany sytuacji życiowej stosunku do tej,
            jaka występowała przed zdarzeniem (może to być osoba z kręgu rodziny, znajomych, sąsiad/ka lub inna osoba, proszę podać imię i nazwisko oraz adres
            zamieszkania świadka).
        </p>

        <div class="pdf_podpisy_p col-md-12 paddding_l_0 paddding_r_0 margin_t_40">

            <?php

            if (count($lista_swiadkow)) {
                for($i=0;$i<count($lista_swiadkow);$i++) {
                    $licznik=$i+1;
                    echo '<p class="line_height_28">'.$licznik.'. '.$lista_swiadkow[$i]->Imie.' '.$lista_swiadkow[$i]->Nazwisko.', '.$lista_swiadkow[$i]->Ulica.' '.$lista_swiadkow[$i]->NrDomu.' '.$lista_swiadkow[$i]->NrMieszkania.', '.$lista_swiadkow[$i]->KodPocztowy.' '.$lista_swiadkow[$i]->Wartosc.'</p>';

                }
            } else {
                echo '<p class="line_height_28">1. _______________________________________________________________________________________________________</p>';
                echo '<p class="line_height_28 text_a_right">   _______________________________________________________________________________________________________</p>';
                echo '<p class="line_height_28">2. _______________________________________________________________________________________________________</p>';
                echo '<p class="line_height_28 text_a_right">   _______________________________________________________________________________________________________</p>';
                echo '<p class="line_height_28">3. _______________________________________________________________________________________________________</p>';
                echo '<p class="line_height_28 text_a_right">   _______________________________________________________________________________________________________</p>';
            }

            ?>

        </div>
        <div class="clear_b"></div>


        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_60">
            <div class="float_r center">
                _______________________________________<br>
                data, czytelny podpis
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
