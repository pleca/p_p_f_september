<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$klient = json_decode($_POST['klient'], true);
$poszkodowany = json_decode($_POST['poszkodowany'], true);
$uprawniony = json_decode($_POST['uprawniony'], true);
$uprawniony_do_inf = json_decode($_POST['uprawniony_do_inf'], true);
$zdarzenie = json_decode($_POST['zdarzenie'], true);
$pojazdA = json_decode($_POST['PojazdA'], true);
$pojazdB = json_decode($_POST['PojazdB'], true);
$odpowiedzialnosc_karna = json_decode($_POST['odpowiedzialnosc_karna'], true);
$odpowiedzialnosc_cywilna = json_decode($_POST['odpowiedzialnosc_cywilna'], true);
$inne_odszkodowania = json_decode($_POST['inne_odszkodowania'], true);
$dane_o_niezdolnosci = json_decode($_POST['dane_o_niezdolnosci'], true);
$przebieg_leczenia = json_decode($_POST['przebieg_leczenia'], true);
$dochodzenie_roszczen = json_decode($_POST['dochodzenie_roszczen'], true);
$oswiadczenie_poszkodowanego = json_decode($_POST['oswiadczenie_poszkodowanego'], true);

$liczba_szpitali = $_POST['liczba_szpitali'];

for($i=1; $i<=$liczba_szpitali; $i++) {
    ${'hospitalizacja_'.$i} = json_decode($_POST['hospitalizacja_'.$i], true);
}

$liczba_placowek = $_POST['liczba_placowek'];

for($i=1; $i<=$liczba_placowek; $i++) {
    ${'placowki_'.$i} = json_decode($_POST['placowki_'.$i], true);
}

$stopka = 'PG-2-1-F3/2016-12-08';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek">
        <div class="pdfs_przedstawiciel_dane">
            <div class="form-group col-md-3 padding_l_0">
                <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
                <label class="pdf_duze_litery font_size_10 no_bold">IDENTYFIKATOR PRZEDSTAWICIELA</label>
            </div>
            <div class="form-group col-md-6 padding_l_0">
                <div class="pdf_kratka_podpis"></div>
                <label class="pdf_duze_litery font_size_10 no_bold">PODPIS PRZEDSTAWICIELA</label>
            </div>
            <div class="clear_b"></div>
            <div class="pdf_kratka"><?php echo $umowa['KodJednostki']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod jednostki</p>
            <div class="pdf_kratka"><?php echo $umowa['KodKonsultanta']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod konsultanta</p>
            <div class="pdf_kratka"></div>
            <p class="pdf_duze_litery font_size_10 margin_b_0 margin_t_2">nr sprawy</p>
        </div>

        <div class="pdfs_tytu_dokumentu">
            <p class="margin_b_0 font_size_18 font_w_700">ZGŁOSZENIE SZKODY/ZAMÓWIENIE</p>
        </div>

        <div class="pola_typu_umowy_w_1">
                <p class="font_size_10">
                    rodzaj wypadku:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> komunikacyjny /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> w rolnictwie /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inny
                </p>
        </div>

        <div class="pola_typu_umowy_w_2">
                <p class="font_size_10">
                    następstwa:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['TypSzkodyId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> obrażenia ciała /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['TypSzkodyId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> śmierć poszkodowanego /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['TypSzkodyId'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inny
                </p>
        </div>

        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_t_0">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">ZLECENIODAWCA</div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">imie</label>
            <div class="pdf_kratka"><?php echo $klient['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">nazwisko</label>
            <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-1 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">WIEK</label>
            <div class="pdf_kratka"><?php echo ''; ?></div>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania zleceniodawcy</p>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">ulica</label>
            <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">nr domu /</label>
            <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">mieszkania</label>
            <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 margin_b_0">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">miejscowość</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres korespondencyjny zleceniodawcy (jeśli jest inny niż zameldowania)</p>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">ulica</label>
            <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">nr domu /</label>
            <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">mieszkania</label>
            <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 margin_b_0">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">miejscowość</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 ">PESEL</label>
            <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 ">TELEFON</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-5">
            <label class="pdf_duze_litery font_size_10">E-MAIL</label>
            <div class="pdf_kratka"><?php echo $klient['Mail']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($klient['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 color_white">POSZKODOWANY <span class="font_size_12 color_white">(wypełnić jeśli inny niż Zleceniodawca)</span>
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['UmowaDzialajacyWImieniu'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małoletni
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['UmowaDzialajacyWImieniu'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ubezwłasnowolniony
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['UmowaDzialajacyWImieniu'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małżonek
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['UmowaDzialajacyWImieniu'] == 4) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zmarły</div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">IMIĘ</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NAZWISKO</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-1 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">WIEK</label>
            <div class="pdf_kratka"><?php echo ''; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">ulica</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">nr domu /</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">mieszkania</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 margin_b_0">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">miejscowość</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 ">PESEL</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 ">TELEFON</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-5">
            <label class="pdf_duze_litery font_size_10">E-MAIL</label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Mail']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($poszkodowany['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $poszkodowany['Dowod']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700">UPRAWNIONY <span class="font_size_12 color_white">(wypełnić jeśli inny niż Zleceniodawca - najbliższy członek rodziny zmarłego)</span></div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">IMIĘ</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NAZWISKO</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-1 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">WIEK</label>
            <div class="pdf_kratka"><?php echo ''; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">ulica</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">nr domu /</label>
            <div class="pdf_kratka"><?php echo $uprawniony['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10 margin_b_0">mieszkania</label>
            <div class="pdf_kratka"><?php echo $uprawniony['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 margin_b_0">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $uprawniony['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">miejscowość</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Miasto']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 ">PESEL</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 ">TELEFON</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-5">
            <label class="pdf_duze_litery font_size_10">E-MAIL</label>
            <div class="pdf_kratka"><?php echo $uprawniony['Mail']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo ($uprawniony['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
            <div class="pdf_kratka"><?php echo $uprawniony['Dowod']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700">UPRAWNIONY <span class="font_size_12 color_white">(wypełnić jeśli inny niż Zleceniodawca - najbliższy członek rodziny zmarłego)</span></div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">IMIĘ</label>
            <div class="pdf_kratka"><?php echo $uprawniony_do_inf['Imie']; ?></div>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NAZWISKO</label>
            <div class="pdf_kratka"><?php echo $uprawniony_do_inf['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-2 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">PESEL</label>
            <div class="pdf_kratka"><?php echo $uprawniony_do_inf['NrDomu']; ?></div>
        </div>

    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek padding_b_0">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700">Informacje o zdarzeniu z dnia <?php echo $zdarzenie['Data']; ?> godziny <?php echo $zdarzenie['Godzina']; ?></div>
        <div class="form-group col-md-3 margin_t_10">które miało miejsce w
        </div>
        <div class="form-group col-md-9 margin_t_5">
            <div class="pdf_kratka"><?php echo $zdarzenie['Miejscowosc']; ?></div>
        </div>



        <div class="form-group col-md-12 padding_l_10 padding_r_10">
        <div class="form-group col-md-6 ramka">
            <label class="pdf_duze_litery font_size_12 margin_b_0">POJAZD A (w którym znajdował się poszkodowany)
            </label>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">MARKA, TYP POJAZDU</label>
                <div class="pdf_kratka_zdarzenie font_size_14 padding_l_3 margin_t_3"><?php echo $pojazdA['Marka'].' '.$pojazdA['Model']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">NR REJESTRACYJNY</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdA['NrRejestracyjny']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">KRAJ REJESTRACJI (JEŚLI INNY NIŻ POLSKA)</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdA['KrajRejestracji']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">KIERUJĄCY POJAZDEM</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdA['KierujacyPojazdem']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0 margin_t_0">POSIADACZ POJAZDU</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdA['PosiadaczPojazdu']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0 margin_t_0">UBEZPIECZYCIEL OC POSIADACZA POJAZDU</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdA['Ubezpieczyciel']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0 margin_t_0">NUMER POLISY OC</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdA['NumerPolisy']; ?></div>
            </div>
        </div>


        <div class="form-group col-md-6 ramka">
            <label class="pdf_duze_litery font_size_12 margin_b_0">POJAZD B* lub PODMIOT ODPOWIEDZIALNY
            </label>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">MARKA, TYP POJAZDU</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['Marka'].' '.$pojazdB['Model']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">NR REJESTRACYJNY</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['NrRejestracyjny']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">KRAJ REJESTRACJI (JEŚLI INNY NIŻ POLSKA)</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['KrajRejestracji']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">KIERUJĄCY POJAZDEM</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['KierujacyPojazdem']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0 margin_t_0">POSIADACZ POJAZDU</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['PosiadaczPojazdu']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0 margin_t_0">UBEZPIECZYCIEL OC POSIADACZA POJAZDU</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['Ubezpieczyciel']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_b_0 margin_t_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0 margin_t_0">NUMER POLISY OC</label>
                <div class="pdf_kratka_zdarzenie padding_l_3 margin_t_3"><?php echo $pojazdB['NumerPolisy']; ?></div>
            </div>
        </div>
        </div>
        <div class="clear_b"></div>

    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_30 margin_b_10">
        <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">ZLECENIODAWCA</p>
        </div>
        <div class="clear_b"></div>
    </div>


    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">1/6</p>
    </div>
</div>

    <div class="pdf_strona">

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">

            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">REKOMENDACJA</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="margin_b_0 margin_t_10 height_20"><?php echo ''; ?></p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">OPIS ZDARZENIA</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="margin_b_0 margin_t_10 height_180"><?php echo $zdarzenie['OpisZdarzenia']; ?></p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">OBRAŻENIA CIAŁA</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="margin_b_0 margin_t_10 height_180"><?php echo $zdarzenie['OpisObrazen']; ?></p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">ODPOWIEDZIALNOŚC KARNA sygnatura akt <?php echo $odpowiedzialnosc_karna['SygnaturaAkt']; ?></div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['Oswiadczenie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> sprawca napisał oświadczenie i
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['WezwanoPolicje'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wezwano policję /
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['WezwanoPolicje'] == 0) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wezwano policji
                </p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['WezwanoPolicje'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> na miejsce zdarzenia wezwano policję z <?php echo $odpowiedzialnosc_karna['MiejscowoscPolicji']; ?></p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['WszczetoPostepowanie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wszczęto postępowanie w sprawie</p>
                <p class="col-md-12 margin_l_0">
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['PostepowanieZarzut'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> postawiono sprawcy zarzut z art. <?php echo $odpowiedzialnosc_karna['ZarzutArtykul']; ?>
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['KodeksZarzut'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> k.k.
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['KodeksZarzut'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> k.w.
                </p>
                <p class="col-md-12 margin_l_0">
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['PostepowanieKarne'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> postępowanie karne umorzono na podstawie art. <?php echo $odpowiedzialnosc_karna['KarneArtykul']; ?>
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['KodeksKarne'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> k.p.k.
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['KodeksKarne'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> k.p.w.
                </p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['SkierowanoAkt'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> skierowano akt oskarżenia do sądu <?php echo $odpowiedzialnosc_karna['Sad']; ?></p>
                <p class="col-md-12 margin_l_0"><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['ZapadlWyrok'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zapadł wyrok
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['Wyrok'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> skazujący /
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['Wyrok'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> uniewinniający o czyn z art. <?php echo $odpowiedzialnosc_karna['WyrokArtykul']; ?>
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['KodeksArtykul'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> k.k.
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['KodeksArtykul'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> k.w.
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">ODPOWIEDZIALNOŚC CYWILNA nr szkody <?php echo $odpowiedzialnosc_cywilna['NumerSzkody']; ?></div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoPojazdZOc'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zgłoszono szkodę w pojeździe do ubezpieczyciela OC sprawcy, data zgłoszenia <?php echo $odpowiedzialnosc_cywilna['DataZgloszeniaPojazduZOc']; ?></p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoPojazdZOc'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zgłoszono szkody w pojeździe do ubezpieczyciela OC sprawcy</p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoOsobeZOc'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zgłoszono szkodę na osobie do ubezpieczyciela OC sprawcy, data zgłoszenia <?php echo $odpowiedzialnosc_cywilna['DataZgloszeniaOsobyZOc']; ?></p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoOsobeZOc'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zgłoszono szkody na osobie do ubezpieczyciela OC sprawcy</p>
                <p class="col-md-12 ">Odszkodowanie z OC sprawcy: <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['WyplaconoZOcSprawcy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wypłacono /
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['SzkodaWPojezdzie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wypłacono za szkodę w pojeździe
                </p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['SzkodaOsobowa'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wypłacono za szkodę osobową w kwocie zł <?php echo $odpowiedzialnosc_cywilna['KwotaOdszkodowania']; ?></p>
                <p class="col-md-12 ">na podstawie: <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['PodstawaPrawna'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ugody /
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['PodstawaPrawna'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wyroku /
                    <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['PodstawaPrawna'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> decyzji z dnia <?php echo $odpowiedzialnosc_cywilna['DataDecyzji']; ?>
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">INNE ODSZKODOWANIA</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['ZgloszonoZNnw'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zgłoszono szkodę do ubezpieczyciela NNW: <?php echo $inne_odszkodowania['NazwaUbezpieczycielaNnw']; ?></p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['OkreslonoUszczerbekNnw'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ubezpieczyciel NNW określił uszczerbek na zdrowiu na <?php echo $inne_odszkodowania['ProcentUszczerbkuNnw']; ?> %</p>
                <p class="col-md-12 ">Był to wypadek: <span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['JakiWypadek'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przy pracy /
                    <span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['JakiWypadek'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> w drodze do lub z pracy
                </p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['ZgloszonoSzkode'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zgłoszono szkodę do
                    <span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['GdzieZgloszono'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ZUS /
                    <span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['GdzieZgloszono'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> KRUS /
                    <span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['GdzieZgloszono'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $inne_odszkodowania['GdzieZgloszonoInne']; ?>, który określił uszczerbek na zdrowiu na <?php echo $inne_odszkodowania['ProcentUszczerbku']; ?>%
                </p>

                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['PrzyznanoOdszkodowanie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przyznano jednorazowe odszkodowanie z tytułu wypadku przy pracy w wysokości <?php echo $inne_odszkodowania['WysokoscOdszkodowania']; ?> zł</p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($inne_odszkodowania['ZasilekPogrzebowy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przyznano zasiłek pogrzebowy</p>
                <p class="col-md-12 ">W związku z wypadkiem stwierdzono niezdolność do pracy na podstawie:</p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['ZwolnienieLekarskie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zwolnienia lekarskiego na okres od <?php echo $dane_o_niezdolnosci['DataZwolnienieOd']; ?> do <?php echo $dane_o_niezdolnosci['DataZwolnieniaDo']; ?></p>


                <p class="col-md-12 ">na podstawie: <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['OrzeczenieONiezdolnosci'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> orzeczenia o niezdolności do pracy:
                    <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['TypNiezdolnosci'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> całkowitej /
                    <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['TypNiezdolnosci'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> częściowej /
                    <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['TypNiezdolnosci'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> trwałej /
                    <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['TypNiezdolnosci'] == 4) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> okresowej do dnia <?php echo $dane_o_niezdolnosci['DataNiezdolnosciDo']; ?>
                </p>

                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['UbezpieczycielNazwa'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ZUS
                    <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['UbezpieczycielNazwa'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> KRUS /
                    <span class="glyphicon glyphicon<?php echo ($dane_o_niezdolnosci['UbezpieczycielNazwa'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $dane_o_niezdolnosci['UbezpieczycielNazwaInne']; ?> przyznał <?php echo ($dane_o_niezdolnosci['PrzyznanoSwiadczenie'] == 1) ? 'rentę' : '' ; ?> <?php echo $dane_o_niezdolnosci['PrzyznanoSwiadczenieInne']; ?> w wysokości <?php echo $dane_o_niezdolnosci['WysokoscSwiadczenia']; ?> zł miesięcznie, na okres do <?php echo $dane_o_niezdolnosci['DataSwiadczeniaDo']; ?>
                </p>
            </div>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_35 margin_b_10">
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">ZLECENIODAWCA</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">2/6</p>
        </div>
    </div>

    <div class="pdf_strona">

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">

            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">PRZEBIEG LECZENIA (doznane urazy i odczuwane dolegliwości należy opisać w OŚWIADCZENIU)</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($przebieg_leczenia['WezwanoPogotowie'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> na miejsce zdarzenia wezwano pogotowie z: <?php echo $przebieg_leczenia['PogotowieMiejscowosc'].' '.$przebieg_leczenia['PogotowieSzpital']; ?></p>
                <p class="col-md-12"><span class="glyphicon glyphicon<?php echo ($przebieg_leczenia['ZglosilDoLekarza'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> poszkodowany sam zgłosił się do lekarza <?php echo $przebieg_leczenia['DaneLekarza'].' '.$przebieg_leczenia['DanePrzychodni']; ?> w dniu: <?php echo ''; ?></p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($przebieg_leczenia['Hospitalizacja'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> po wypadku poszkodowany był hospitalizowany w:</p>
                <?php for($i=1; $i<=$liczba_szpitali; $i++) {

                    echo "<p class='col-md-12 margin_l_20'>".$i.". ".${'hospitalizacja_'.$i}['MiejsceHospitalizacji']." od ".${'hospitalizacja_'.$i}['DataOdKiedy']." do ".${'hospitalizacja_'.$i}['DataDoKiedy']."</p>";

                }
                ?>

                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($przebieg_leczenia['Zabiegi'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przeprowadzono zabiegi operacyjne (adresy placówek medycznych, w których leczono poszkodowanego w związku z wypadkiem):</p>
                <?php for($i=1; $i<=$liczba_placowek; $i++) {

                    echo "<p class='col-md-12 margin_l_20'>".$i.". ".${'placowki_'.$i}['NazwaPlacowki']." kiedy ".${'placowki_'.$i}['DataZabiegu']."</p>";

                }
                ?>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">DOCHODZENIE ROSZCZEŃ</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['ZleconoRoszczenia'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi</p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['ZleconoRoszczenia'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> sprawę zlecono wcześniej pełnomocnikowi <?php echo $dochodzenie_roszczen['NazwaPelnomocnika']; ?> z którym zawarto umowę dnia <?php echo $dochodzenie_roszczen['DataZawarciaUmowy']; ?>.</p>
                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['WypowiedzenieUmowy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowę z wyżej wymienionym wypowiedziano w dniu <?php echo $dochodzenie_roszczen['DataWypowiedzenia']; ?></p>
                <p class="col-md-12 ">Stosunek do kierującego pojazdem A <span class="glyphicon glyphicon<?php echo ($zdarzenie['StosunekAId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> obcy /
                    <span class="glyphicon glyphicon<?php echo ($zdarzenie['StosunekAId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> rodzina /
                    <span class="glyphicon glyphicon<?php echo ($zdarzenie['StosunekAId'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inny <?php echo $zdarzenie['InnyStosunekDoA']; ?>
                </p>
                <p class="col-md-12 ">Stosunek do kierującego pojazdem B <span class="glyphicon glyphicon<?php echo ($zdarzenie['StosunekBId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> obcy /
                    <span class="glyphicon glyphicon<?php echo ($zdarzenie['StosunekBId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> rodzina /
                    <span class="glyphicon glyphicon<?php echo ($zdarzenie['StosunekBId'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inny <?php echo $zdarzenie['InnyStosunekDoB']; ?>
                </p>
                <p class="col-md-12 font_size_12 margin_t_10">Oświadczam, że zostałem poinformowany o okolicznościach uzasadniających dochodzenie zwrotu wypłaconego odszkodowania od sprawcy wypadku przez ubezpieczyciela lub Ubezpieczeniowy Fundusz Gwarancyjny,
                    określonych w ustawie z dnia 22 maja 2003 r. o ubezpieczeniach obowiązkowych, Ubezpieczeniowym Funduszu Gwarancyjnym i Polskim Biurze Ubezpieczycieli Komunikacyjnych (Dz.U. Nr 124, poz. 1152).</p>
                <p class="col-md-12 font_size_12">Zgodnie z art. 43. zakładowi ubezpieczeń przysługuje prawo dochodzenia od kierującego pojazdem mechanicznym zwrotu wypłaconego z tytułu ubezpieczenia OC posiadaczy pojazdów mechanicznych odszkodowania,
                    jeżeli kierujący: 1) wyrządził szkodę umyślnie lub w stanie po użyciu alkoholu albo pod wpływem środków odurzających, substancji psychotropowych lub środków zastępczych w rozumieniu przepisów o przeciwdziałaniu narkomanii;
                    2) wszedł w posiadanie pojazdu wskutek popełnienia przestępstwa; 3) nie posiadał wymaganych uprawnień do kierowania pojazdem mechanicznym, z wyjątkiem przypadków, gdy chodziło o ratowanie życia ludzkiego lub mienia albo o
                    pościg za osobą podjęty bezpośrednio po popełnieniu przez nią przestępstwa; 4) zbiegł z miejsca zdarzenia.</p>
                <p class="col-md-12 font_size_12">Zgodnie z art. 110 ust. 1 z chwilą wypłaty przez Fundusz odszkodowania, sprawca szkody i osoba, która nie dopełniła obowiązku zawarcia umowy ubezpieczenia obowiązkowego są obowiązani do zwrotu Funduszowi
                    spełnionego świadczenia w przypadku gdu: posiadacz zidentyfikowanego pojadu mechanicznego, którego ruchem szkodę tę wyrządzono, nie był ubezpieczony obowiązkowym ubezpieczeniem OC posiadaczy pojazdów mechanicznych, lub rolnik,
                    osoba pozostająca z nim we wspólnym gospodarstwie domowym lub osoba pracująca w jego gospodarstwie rolnym wyrządzili szkodę, a rolnik nie był ubezpieczony obowiązkowym ubezpieczeniem OC rolników.</p>

                <p class="col-md-12 margin_b_0 margin_t_10">W przypadku możliwości żądania od sprawcy lub osoby, która nie dopełniła obowiązku zawarcia umowy ubezpieczenia obowiązkowego zwrotu wypłaconych odszkodowań przez ubezpieczyciela lub UFG:</p>
                <p class="col-md-12 margin_t_0"><span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['RoszczeniaOdUbezpieczyciela'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> decyduję się na dochodzenie roszczeń od ubezpieczyciela lub UFG /
                    <span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['RoszczeniaOdUbezpieczyciela'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie decyduję się na dochodzenie roszczeń.
                </p>

                <p class="col-md-12 margin_b_0 ">W przypadku dochodzenia roszczeń bezpośrednio od swojego pracodawcy:</p>
                <p class="col-md-12 margin_t_0"><span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['RoszczeniaOdPracodawcy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> decyduję się na dochodzenie roszczeń /
                    <span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['RoszczeniaOdPracodawcy'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie decyduję się na dochodzenie roszczeń.
                </p>

                <p class="col-md-12 margin_b_0 ">Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą się z <?php echo $dochodzenie_roszczen['IloscKart']; ?> słownie <?php echo $dochodzenie_roszczen['IloscKartSlownie']; ?> kart.</p>

                <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaNaInformacje'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Wyrażam zgodę /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaNaInformacje'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Nie wyrażam zgody na otrzymywanie informacji związanych z wykonywaniem umowy poprzez:
                </p>
                <p class="col-md-12"><span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaSms'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiadomości tekstowe SMS /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMail'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiadomości e-mail na numer/adres przeze mnie wskazany.
                </p>

            </div>
        </div>

        <p class="col-md-12 margin_t_20 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['OfertaPCRF'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem zainteresowana/y ofertą rehabilitacyjną i wyrażam zgodę na przekazywanie
            PCRF Votum S.A. Sp. k. w Krakowie moich danych osobowych lub danych osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu opracowania i przedstawienia oferty.</p>

        <p class="col-md-12 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['OfertaFundacji'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem zainteresowana/y objęciem mnie pomocą przez Fundację VOTUM i wyrażam
            zgodę na przekazanie Fundacji VOTUM we Wrocławiu moich danych osobowych lub danych osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu opracowania i przedstawienia
            możliwego zakresu pomocy.</p>

        <p class="col-md-12 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['OfertaGamma'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem zainteresowana/y ofertą usług medycznych i wyrażam zgodę na przekazywanie
            „Centrum Medycznemu Gamma” Sp. z o.o. w Warszawie moich danych osobowych lub danych osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu opracowania i przedstawienia
            oferty.</p>

        <p class="col-md-12 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['OswiadczenieODzialalnosci'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Oświadczam, że prowadzę pozarolniczą działalność gospodarczą.</p>

        <p class="col-md-12 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['OfertaProtecta'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem zainteresowana/y ofertą produktów finansowych i wyrażam zgodę na przekazywanie
            Protecta Finanse Sp. z o.o. we Włocławku moich danych osobowych w celach marketingowych, w szczególności w celu opracowania i przedstawienia oferty.</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_10">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS ZLECENIODAWCY</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <p class="margin_b_0 font_w_700">Oświadczenie</p>
        <p class="col-md-12 font_size_14">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A., oświadczam, iż podpisy Zleceniodawcy na wszystkich dokumentach, tj. na umowie, pełnomocnictwie oraz zgłoszeniu szkody, zostały złożone w mojej obecności własnoręcznie przez Zleceniodawcę.</p>


        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_30 margin_b_10">
            <div class="form-group col-md-6 margin_t_m30">
                <div class="pdf_kratka"><?php echo ''; ?></div>
                <label class="pdf_duze_litery font_size_10">IMIĘ I NAZWISKO PRZEDSTAWICIELA (WYPEŁNIĆ DRUKOWANYMI LITERAMI)</label>
            </div>
            <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CZYTELNY PODPIS PRZEDSTAWICIELA</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">3/6</p>
        </div>
    </div>

    <div class="pdf_strona">

        <p class="col-md-12 text_a_center font_size_20 margin_b_20">OŚWIADCZENIE OSOBY POSZKODOWANEJ</p>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">

            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">OKOLICZNOŚCI ZDARZENIA</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">
                    Ja niżej podpisany/-a <?php echo $poszkodowany['Imie']." ".$poszkodowany['Nazwisko']; ?> świadomy/-a odpowiedzialności karnej za wprowadzanie w błąd ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam, iż byłem/-am uczestnikiem wypadku komunikacyjnego, który miał miejsce w
                    <?php echo $zdarzenie['Miejscowosc']; ?> w dniu <?php echo $zdarzenie['Data']; ?> około godziny <?php echo $zdarzenie['Godzina']; ?>.
                </p>
            </div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 ">W chwili zdarzenia <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodWplywem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> byłem/-am /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodWplywem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie byłem/-am pod wpływem:
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodJakimWplywem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> alkoholu,
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodJakimWplywem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> narkotyków,
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PodJakimWplywem'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> innych środków odurzających.
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">WYPEŁNIĆ TYLKO JEŻELI POSZKODOWANY ZNAJDOWAŁ SIĘ POZA POJAZDEM</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Byłem/-am <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PieszyRowerzysta'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pieszym/-ą /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['PieszyRowerzysta'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> rowerzystą/-ką i zostałem/-am potrącony/-a przez pojazd marki
                    <?php echo $pojazdB['Marka'].' '.$pojazdB['Model']; ?> o nr. rej. <?php echo $pojazdB['NrRejestracyjny']; ?>
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">WYPEŁNIĆ TYLKO JEŚLI POSZKODOWANY ZNAJDOWAŁ SIĘ W POJEŹDZIE</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Typ pojazdu: <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['TypPojazdu'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> samochód /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['TypPojazdu'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> komunikacja zbiorowa /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['TypPojazdu'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $oswiadczenie_poszkodowanego['TypPojazduInny']; ?>
                </p>

                <p class="col-md-12 margin_t_10">W pojeździe marki <?php echo $pojazdA['Marka'].' '.$pojazdA['Model']; ?> o nr. rej. <?php echo $pojazdA['NrRejestracyjny']; ?> byłem/-am <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['KierowcaPasazer'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> kierowcą /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['KierowcaPasazer'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pasażerem i siedziałem/-am
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> obok kierowcy /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> z tyłu za kierowcą /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> tyłu za przednim pasażerem /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial'] == 4) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> z tyłu pośrodku /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['MiejsceGdzieSiedzial'] == 5) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $oswiadczenie_poszkodowanego['MiejsceGdzieSiedzialInne']; ?>
                </p>

                <p class="col-md-12 margin_t_10">W chwili zdarzenia <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['ZapietePasy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> miałem/-am /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['ZapietePasy'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie miałem/-am zapięty pas bezpieczeństwa (założony kask).
                </p>

                <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WlascicielWspolwlasciciel'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WlascicielWspolwlasciciel'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Nie jestem współposiadaczem wyżej wymienionego pojazdu.
                </p>
             </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">WYPEŁNIĆ TYLKO JEŻELI KIERUJĄCY, Z KTÓRYM PODRÓŻOWAŁ POSZKODOWANY BYŁ POD WPŁYWEM ALKOHOLU LUB INNYCH ŚRODKÓW ODURZAJĄCYCH</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Wsiadając do pojazdu przed wypadkiem <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaCzyPodWplywem'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiedziałem/-am /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaCzyPodWplywem'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wiedziałem/-am, że kierujący pojazdem przed zajęciem miejsca za kierownicą spożywał alkohol lub inne środki odurzające.
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">WYPEŁNIĆ TYLKO JEŻELI KIERUJĄCY, Z KTÓRYM PODRÓŻOWAŁ POSZKODOWANY NIE POSIADAŁ UPRAWNIEŃ DO KIEROWANIA POJAZDEM DANEJ KATEGORII</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Wsiadając do pojazdu przed wypadkiem <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaOUprawnieniach'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiedziałem/-am /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['WiedzaOUprawnieniach'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wiedziałem/-am, że kierujący pojazdem nie posiada uprawnień do kierowania danym pojazdem mechanicznym.
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">LECZENIE</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10 margin_b_0">Oświadczam, że leczenie następstw doznanych obrażeń:</p>
                <p class="col-md-12 margin_t_0 margin_b_0"><span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['NastepstwaObrazen'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zakończyło się z dniem <?php echo $oswiadczenie_poszkodowanego['DataZakonczeniaLeczenia']; ?></p>
                <p class="col-md-12 margin_t_0 margin_b_0"><span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['NastepstwaObrazen'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> jeszcze się nie zakończyło, a przewidywany przez lekarzy termin jego ukończenia to <?php echo $oswiadczenie_poszkodowanego['PrzewidzianaDataZakonczenia']; ?></p>
                <p class="col-md-12 margin_t_0 margin_b_0"><span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['NastepstwaObrazen'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> jeszcze się nie zakończyło, a przewidywany termin jego ukończenia nie jest mi znany</p>
                <p class="col-md-12 margin_t_0 margin_b_0"><span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['NastepstwaObrazen'] == 4) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> planowane są jeszcze zabiegi operacyjne</p>
            </div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Jednocześnie informuję, iż w związku z doznanymi obrażeniami przebywałem na zwolnieniu chorobowym w okresie od dnia <?php echo $oswiadczenie_poszkodowanego['DataZwolnieniaOd']; ?> do dnia <?php $oswiadczenie_poszkodowanego['DataZwolnieniaDo']; ?> /
                    <span class="glyphicon glyphicon<?php echo ($oswiadczenie_poszkodowanego['TerminZwolnienia'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nadal.
                </p>
            </div>
        </div>


        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS POSZKODOWANEGO LUB PRZEDSTAWICIELA USTAWOWEGO</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">4/6</p>
        </div>
    </div>

    <div class="pdf_strona">

        <p class="col-md-12 text_a_center font_size_20 margin_b_20">OŚWIADCZENIE OSOBY UPRAWNIONEJ</p>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">
                    Ja niżej podpisany/-a <?php echo $uprawniony['Imie']." ".$uprawniony['Nazwisko']; ?> świadomy/-a odpowiedzialności karnej za wprowadzanie w błąd ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam, że <?php echo $poszkodowany['Imie']." ".$poszkodowany['Nazwisko']; ?>
                    który/-a poniósł/-a śmierć w wyniku zdarzenia z dnia <?php echo $zdarzenie['Data']; ?> r. był/-a członkiem mojej najbliższej rodziny w rozumieniu art. 446 § 3 i 4 k.c.
                </p>
            </div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_b_0">Oświadczenie jest składane w związku z zaistnieniem na skutek śmierci wyżej wymienionego/-ej:</p>
                <p class="col-md-12 margin_t_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pogorszenia sytuacji życiowej w sferze materialnej,
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wystąpienia krzywdy w związku ze śmiercią członka najbliższej rodziny.
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">INFORMACJE O ZMARŁYM/-EJ</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Zmarły/-a w momencie śmierci miał/-a <?php echo '99'; ?> lat. Wykształcenie:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> podstawowe /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zawodowe /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> średnie /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wyższe.
                </p>
                <p class="col-md-12 ">Zawód wyuczony <?php echo $stopka; ?> zawód wykonywany <?php echo $stopka; ?>.
                <p class="col-md-12 ">Dodatkowe kwalifikacje lub uprawnienia <?php echo $stopka; ?>.
                <p class="col-md-12 ">Zatrudnienie:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> brak /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowa o pracę /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowa zlecenia /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> własna działalność gospodarcza /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> gospodarstwo rolne /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> prace dorywcze /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $stopka; ?>
                </p>
                <p class="col-md-12 ">Przeciętne miesięczne zarobki zmarłego w okresie trzech miesięcy przed wypadkiem według mojej wiedzy wynosiły około <?php echo $stopka; ?> zł netto.
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">INFORMACJE O UPRAWNIONYM/-EJ</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">W momencie śmierci zmarłego/-ej miałem/am <?php echo '99'; ?> lat. Wykształcenie:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> podstawowe /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zawodowe /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> średnie /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wyższe.
                </p>
                <p class="col-md-12 ">Zawód wyuczony <?php echo $stopka; ?> zawód wykonywany <?php echo $stopka; ?>.
                <p class="col-md-12 ">Dodatkowe kwalifikacje lub uprawnienia <?php echo $stopka; ?>.
                <p class="col-md-12 ">Zatrudnienie:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> brak /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowa o pracę /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowa zlecenia /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> własna działalność gospodarcza /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> gospodarstwo rolne /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> prace dorywcze /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $stopka; ?>
                </p>
                <p class="col-md-12 ">Moje miesięczne zarobki w okresie ostatnich trzech miesięcy wynosiły średnio <?php echo $stopka; ?> zł netto.
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">STOSUNKI RODZINNE I MAJĄTKOWE</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10">Zmarły/-a był/-a dla mnie:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> mężem / żoną /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> partnerem / partnerką /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ojcem / matką /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> synem / córką /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> bratem / siostrą /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wnukiem / wnuczką /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> dziadkiem / babcią /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> inne <?php echo $stopka; ?>
                </p>

                <p class="col-md-12 margin_b_0">Zmarły/-a
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pozostawał/-a ze mną we wspólnym gospodarstwie domowym,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_65">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> był/-a zameldowany/-a ze mną pod jednym adresem,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_65">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie był/-a zameldowany/-a ze mną pod jednym adresem, ale faktycznie zamieszkiwaliśmy razem,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_65">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pomagał w bieżących obowiązkach związanych z prowadzeniem gospodarstwa domowego,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_65">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie pomagał w bieżących obowiązkach związanych z prowadzeniem gospodarstwa domowego.
                </p>

                <p class="col-md-12">Moje stosunki ze zmarłym/-ą określam jako:
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> bardzo zażyłe /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zażyłe /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> powierzchowne /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> złe.
                </p>

                <p class="col-md-12 margin_b_0">Zmarły/-a
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> był/-a na moim utrzymaniu /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> łożył/-a na moje utrzymanie,
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> posiadał/-a ze mną wspólne konto,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_65">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> partycypował/-a w kosztach utrzymania rodziny,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_65">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> według mojej oceny w przyszłości wspierałby/-aby mnie finansowo w razie potrzeby.
                </p>
            </div>
        </div>

        <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
            <div class="font_w_700 pdf_kratka_szara_duza_naglowek_zgloszenie">SYTUACJA PO ŚMIERCI CZŁONKA NAJBLIŻSZEJ RODZINY</div>
            <div class="form-group col-md-12 margin_b_0">
                <p class="col-md-12 margin_t_10 margin_b_0">Według mojej oceny moja sytuacja życiowa w sferze majątkowej po śmierci członka najbliższej rodziny:</p>
                <p class="col-md-12 margin_t_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie uległa zmianie /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pogorszyła się nieznacznie /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pogorszyła się znacznie.
                </p>
                <p class="col-md-12 ">Moja motywacja do poprawy własnej sytuacji materialnej
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie uległa zmianie /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> poprawiła się /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> pogorszyła się.
                </p>

                <p class="col-md-12 margin_b_0">Po śmierci członka najbliższej rodziny:</p>
                <p class="col-md-12 margin_t_0 margin_b_0 margin_l_10">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> odczułem/-am /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie odczułem/-am znacznego wstrząsu psychicznego,
                </p>
                <p class="col-md-12 margin_t_0 margin_b_0 margin_l_10">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> korzystałem/-am ze środków farmakologicznych/ziołowych w związku ze złym stanem psychicznym /
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> stan mojego zdrowia uległ pogorszeniu,
                </p>
                <p class="col-md-12 margin_t_0 margin_l_10">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> korzystałem/-am z porad/wsparcia psychiatry, psychologa, pedagoga szkolnego, lekarza pierwszego kontaktu, duchownego, rodziny
                </p>
            </div>
            <p class="col-md-12 margin_t_10 margin_b_0">Zmarły/-a pozostawił/-a po sobie
                <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wdowę/wdowca
                <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> dzieci, ile <?php echo $stopka; ?> w wieku <?php echo $stopka; ?>.
            </p>
        </div>


        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS POSZKODOWANEGO LUB PRZEDSTAWICIELA USTAWOWEGO</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">5/6</p>
        </div>
    </div>


<div class="pdf_strona">

    <p class="col-md-12 text_a_center font_size_20 margin_b_20">OŚWIADCZENIE</p>

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek height_1200">

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_10 paddding_r_0">
                <?php echo $stopka; ?>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">IMIĘ I NAZWISKO</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_10">
                <?php echo $stopka; ?>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="clear_b"></div>
        </div>
        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_10 paddding_r_0">
                <?php echo $stopka; ?>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">ADRES</p>
            </div>

            <div class="clear_b"></div>
        </div>


        <div class="form-group col-md-12 margin_b_0">
            <p class="col-md-12 margin_t_60">
                <?php echo $stopka; ?>
            </p>
        </div>
    </div>




    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">6/6</p>
    </div>
</div>