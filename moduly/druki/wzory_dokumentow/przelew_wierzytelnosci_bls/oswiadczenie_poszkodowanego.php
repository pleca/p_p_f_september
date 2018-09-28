<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$klient = json_decode($_POST['klient'], true);

$stopka = 'PG-2-14-F24/2018-05-24';
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">


            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>



        <p class="margin_b_0 font_w_700 font_size_26 text_a_center margin_t_60">Oświadczenie poszkodowanego</p>
        <p class="margin_b_0 font_w_700 font_size_18 text_a_center margin_t_20">w związku z wypadkiem z dnia: <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span></p>

        <div class="pdf_czerwona_kratka pdf_kratka_duza margin_t_60">

            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">IMIĘ I NAZWISKO</label>
                <div class="pdf_kratka"><?php echo $klient['Imie'].' '.$klient['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">PESEL</label>
                <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">SERIA I NUMER DOWODU</label>
                <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
            </div>
        </div>


        <div class="form-group col-md-9 margin_t_20">
            <span class="pdf_czerowny_napis font_w_700">1.</span> Czy jest Pan(i) nadal posiadaczem samochodu o nr rej. <span class="font_w_700"><?php echo $umowa_dane['NrRejestracyjny']; ?>?</span>
        </div>
        <div class="form-group col-md-3 margin_t_20">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNadalPosiadacz'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNadalPosiadacz'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">2.</span> W przypadku sprzedaży samochodu* proszę o informację, czy został on sprzedany w stanie uszkodzonym?
        </div>
        <div class="form-group col-md-3 margin_t_20">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzySprzedanoUszkodzony'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzySprzedanoUszkodzony'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">3.</span> Czy samochód miał przed wypadkiem inne, nienaprawione uszkodzenia?
        </div>
        <div class="form-group col-md-3 margin_t_10">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyMialUszkodzenia'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyMialUszkodzenia'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">4.</span> Czy samochód miał przed wypadkiem wcześniejsze szkody, które zostały naprawione?
        </div>
        <div class="form-group col-md-3 margin_t_10">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNaprawianoWczesniej'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNaprawianoWczesniej'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNaprawianoWczesniej'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE WIEM
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">5.</span> Jeżeli TAK, to czy do naprawy użyto oryginalnych części zamiennych?
        </div>
        <div class="form-group col-md-3 margin_t_10">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyUzytoOryginalneCzesci'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyUzytoOryginalneCzesci'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyUzytoOryginalneCzesci'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE WIEM
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">6.</span> Czy po wypadku z dnia <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span> naprawił(a) Pan(i) samochód?
        </div>
        <div class="form-group col-md-3 margin_t_10">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNaprawionoPoWypadku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyNaprawionoPoWypadku'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">7.</span> W przypadku dokonania naprawy samochodu proszę o informację,
            czy otrzymane odszkodowanie wystarczyło na naprawę z wykorzystaniem oryginalnych części zamiennych.
        </div>
        <div class="form-group col-md-3 margin_t_20">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyOdszkodowaniePokrylo'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyOdszkodowaniePokrylo'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
        </div>

        <div class="form-group col-md-9 margin_t_10">
            <span class="pdf_czerowny_napis font_w_700">8.</span> Czy w wyniku przeprowadzonej naprawy przywrócono stan samochodu sprzed wypadku**?
        </div>
        <div class="form-group col-md-3 margin_t_10 margin_b_60">
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyStanPrzedWypadkiem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  TAK
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['CzyStanPrzedWypadkiem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>  NIE
        </div>
        <div class="clear_b"></div>

        <p class="margin_b_20 font_size_14">*Jeżeli sprzedał(a) Pan(i) samochód, proszę dołączyć kopię umowy sprzedaży.</p>

        <p class="margin_b_10 font_size_14">** Przywrócenie do stanu sprzed wypadku oznacza naprawienie pojazdu z użyciem nowych oryginalnych części zamiennych oraz
            zastosowanie przy naprawie samochodu technologii naprawy zalecanej przez producenta pojazdu.</p>

        <p class="margin_b_10 font_size_14">W przypadku wcześniejszych napraw samochodu dokonanych z użyciem nieoryginalnych części zamiennych, przywrócenie pojazdu do
            stanu sprzed wypadku oznacza naprawę z wykorzystaniem części zamiennych tej samej klasy, co części wykorzystane do wcześniejszych
            napraw oraz zastosowanie przy naprawie samochodu technologii naprawy zalecanej przez producenta pojazdu.</p>

<!--        <p class="margin_b_10 font_size_14 margin_t_60 margin_l_20 margin_r_40">Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz.U. z 2016 r., poz. 922-->
<!--            ze zm.) VOTUM S.A. z siedzibą we Wrocławiu informuje, że:</p>-->
<!--        <p class="margin_b_0 font_size_14 margin_l_20 margin_r_40">1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,</p>-->
<!--        <p class="margin_b_0 font_size_14 margin_l_20 margin_r_40">2. dane osobowe będą przetwarzane w celu dochodzenia roszczeń majątkowych od podmiotów zobowiązanych do naprawienia-->
<!--            szkody i mogą być przekazywane podmiotom współpracującym przy dochodzeniu roszczeń majątkowych, jak również-->
<!--            podmiotom, od których będą dochodzone roszczenia,</p>-->
<!--        <p class="margin_b_0 font_size_14 margin_l_20 margin_r_40">3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,</p>-->
<!--        <p class="margin_b_0 font_size_14 margin_l_20 margin_r_40">4. podanie VOTUM S.A. z siedzibą we Wrocławiu danych osobowych jest dobrowolne.</p>-->


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
