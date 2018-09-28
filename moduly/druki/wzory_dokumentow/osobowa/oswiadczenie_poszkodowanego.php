<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$oswiadczenie_poszkodowanego = json_decode($_POST['oswiadczenie_poszkodowanego'], true);
$poszkodowany = json_decode($_POST['poszkodowany'], true);
$zdarzenie = json_decode($_POST['zdarzenie'], true);
$pojazd_a = json_decode($_POST['pojazd_a'], true);
$pojazd_b = json_decode($_POST['pojazd_b'], true);

$lista_szpitali = json_decode($_POST['lista_szpitali']);


$stopka = 'PG-2-23-F6/2017-10-01';

?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">

        <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>

            <p class="margin_b_0 font_w_700 font_size_26 text_a_center margin_t_30">OŚWIADCZENIE</p>
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center margin_t_0">OSOBY POSZKODOWANEJ</p>



        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_50">
            <p class="font_size_16">
                Ja niżej podpisany/-a <span class="font_w_700"><?php echo (!empty($poszkodowany['Nazwisko'])) ? $poszkodowany['Imie'].' '.$poszkodowany['Nazwisko'] : '______________' ; ?></span> świadomy/-a odpowiedzialności karnej za
                wprowadzenie w błąd ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam, że byłem/-am uczestnikiem wypadku komunikacyjnego z dnia <span class="font_w_700"><?php echo (!empty($zdarzenie['Data'])) ? $zdarzenie['Data'] : '______________'; ?></span> w
                <span class="font_w_700"><?php echo (!empty($zdarzenie['Miejscowosc'])) ? $zdarzenie['Miejscowosc'] : '______________' ; ?></span>.
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <p class="font_size_16">Oświadczam, iż w chwili wypadku
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodWplywem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> byłem/-am
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodWplywem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie byłem/-am pod wpływem:
                <p class="font_size_16"><span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodJakimWplywem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> alkoholu
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodJakimWplywem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> narkotyków
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodJakimWplywem'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> innych środków odurzających.
                </p>
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <p class="font_size_16">W chwili wypadku byłem/-am:
                <p class="font_size_16">
                    <span class="glyphicon glyphicon<?php echo (($oswiadczenie_poszkodowanego['PieszyRowerzysta'] == 1) && ($zdarzenie['TypZdarzeniaId'] == 2)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pieszym/-ą
                    <span class="glyphicon glyphicon<?php echo (($oswiadczenie_poszkodowanego['PieszyRowerzysta'] == 2) && ($zdarzenie['TypZdarzeniaId'] == 2)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> rowerzystą/-ką i zostałem/-am potrącony/-a przez pojazd marki:
                    <span class="font_w_700"><?php echo ($zdarzenie['TypZdarzeniaId'] == 2) ? $pojazd_b['Marka'].' '.$pojazd_b['Model'] : '________________' ; ?></span> o nr. rej. <span class="font_w_700"><?php echo ($zdarzenie['TypZdarzeniaId'] == 2) ? $pojazd_b['NrRejestracyjny'] : '______________' ; ?></span>,
                    <span class="glyphicon glyphicon<?php echo (($zdarzenie['RodzajSzkodyId'] == 1) && ($zdarzenie['TypZdarzeniaId'] == 1)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zajmowałem miejsce w pojeździe marki:
                    <span class="font_w_700"><?php echo ($zdarzenie['TypZdarzeniaId'] == 1) ? $pojazd_a['Marka'].' '.$pojazd_a['Model'] : '________________' ; ?></span> o nr. rej. <span class="font_w_700"><?php echo ($zdarzenie['TypZdarzeniaId'] == 1) ? $pojazd_a['NrRejestracyjny'] : '______________' ; ?></span>, siedziałem/-am:
                    <span class="glyphicon glyphicon<?php echo (($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial']) == 1 && ($zdarzenie['TypZdarzeniaId'] == 1)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> obok kierowcy
                    <span class="glyphicon glyphicon<?php echo (($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial']) == 2 && ($zdarzenie['TypZdarzeniaId'] == 1)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> z tytułu za kierowcą
                    <span class="glyphicon glyphicon<?php echo (($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial']) == 3 && ($zdarzenie['TypZdarzeniaId'] == 1)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> z tyłu za przednim pasażerem
                    <span class="glyphicon glyphicon<?php echo (($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial']) == 5 && ($zdarzenie['TypZdarzeniaId'] == 1)) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <span class="font_w_700"><?php echo (($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial']) == 5 && ($zdarzenie['TypZdarzeniaId'] == 1)) ? $oswiadczenie_poszkodowanego['MiejsceGdzieSiedzialInne'] : '______________' ; ?></span>
                </p>
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <p class="font_size_16">Wsiadając do pojazdu przed wypadkiem
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaCzyPodWplywem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiedziałem/-am
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaCzyPodWplywem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wiedziałem/-am, że kierujący pojazdem
                przed zajęciem miejsca za kierownicą spożywał alkohol lub inne środki odurzające <span class="index_gorny">1</span>.
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <p class="font_size_16">Wsiadając do pojazdu przed wypadkiem
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaOUprawnieniach'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiedziałem/-am
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaOUprawnieniach'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wiedziałem/-am, że kierujący pojazdem nie
                posiada uprawnień do kierowania danym pojazdem mechanicznym <span class="index_gorny">2</span>.
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <p class="font_size_16">Oświadczam jednocześnie, że:</p>
            <p class="font_size_16">
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WlascicielWspolwlasciciel'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WlascicielWspolwlasciciel'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie jestem współposiadaczem wyżej wskazanego pojazdu.
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40">
            <p class="font_size_16">W chwili zdarzenia
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['ZapietePasy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> miałem/-am
                <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['ZapietePasy'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie miałem/-am zapięty pas bezpieczeństwa (założony kask).
            </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <!--<p class="font_size_16">Oświadczam ponadto, że:</p>
            <p class="font_size_16">Leczenie następstw wypadku:
                <span class="glyphicon glyphicon<?php /*echo ($oswiadczenie_poszkodowanego['NastepstwaObrazen'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span> jest zakończone
                <span class="glyphicon glyphicon<?php /*echo ($oswiadczenie_poszkodowanego['NastepstwaObrazen'] == 2) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span> nie jest zakończone.
            </p>-->
            <p class="font_size_16">Po wypadku byłem leczony w następujących placówkach medycznych:</p>
            <p class="font_size_16">
            <?php

            if (count($lista_szpitali)) {
                for($i=0;$i<count($lista_szpitali);$i++) {
                    $licznik=$i+1;
                    echo '<p class="font_size_16">'.$licznik.'. '.$lista_szpitali[$i]->MiejsceHospitalizacji.' '.$lista_szpitali[$i]->DataOdKiedy.' '.$lista_szpitali[$i]->DataDoKiedy.'</p>';

                }
            } else {
                echo '<p class="font_size_16">1. ________________________________________________________________________________________________________</p>';
                echo '<p class="font_size_16">2. ________________________________________________________________________________________________________</p>';
                echo '<p class="font_size_16">3. ________________________________________________________________________________________________________</p>';
            }

            ?>
            </p>

        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_80">
        <p class="margin_b_0">
            W trybie art. 40 w zw. z art. 38 ust. 1 i 6 ustawy z dnia 11 września 2015 r. o działalności ubezpieczeniowej
            i reasekuracyjnej (t.j. Dz. U. z 2017 r. poz. 1170) wyrażam zgodę na udostępnienie zakładowi ubezpieczeń prowadzącemu
            proces likwidacji szkody lub jego przedstawicielowi informacji o moim stanie zdrowia, przebiegu leczenia
            lub przyczynie śmierci przez podmioty wykonujące działalność leczniczą, które udzielały mi świadczeń zdrowotnych.
        </p>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_30">
            <p class="margin_b_0 font_size_10">
                <span class="index_gorny">1</span> Wypełnić, jeżeli kierujący pojazdem spożywał alkohol lub inne środki odurzające.
            </p>
            <p class="margin_b_0 font_size_10">
                <span class="index_gorny">2</span> Wypełnić, jeżeli kierujący pojazdem nie posiadał uprawnień do kierowania pojazdem mechanicznym.
            </p>
        </div>


        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_80">
            <div class="form-group col-md-4 margin_t_5 float_r">
                <div class="pdf_kreska"></div>
                <p class="text_a_center font_size_10">Podpis Klienta/W imieniu klienta</p>
            </div>
        </div>
        <div class="clear_b"></div>


        <div class="stopka_pionowa"><?php echo $stopka; ?></div>
    </div>
