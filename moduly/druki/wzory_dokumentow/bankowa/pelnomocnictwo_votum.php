<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$lista_klientow = json_decode($_POST['lista_klientow']);
$umowa_dane = json_decode($_POST['umowa_dane']);
$umowa = json_decode($_POST['umowa'], true);

$stopka = 'PG-2-21-F2/2018-05-24';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php
    for($i=0;$i<count($lista_klientow);$i++) {
        ?>
        <div class="pdf_strona">
            <div class="pdf_strona_pierwsza_naglowek pdf_strona_pierwsza_naglowek_pouczenie">
                <div class="pdfs_tytu_dokumentu margin_t_20 pdf_tytul_dokumentu_pouczenie">
                    <p class="margin_b_0 pdf_duze_litery">pełnomocnictwo</p>
                </div>
                <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/>
                </div>
            </div>
            <p class="pdf_czerowny_napis margin_l_20 margin_b_0 font_w_700">JA NIŻEJ PODPISANY:</p>
            <div class="pdf_czerwona_kratka pdf_kratka_duza margin_b_10">
                <div class="form-group col-md-6">
                    <label class="pdf_duze_litery font_size_10">imie</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Imie; ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label class="pdf_duze_litery font_size_10">nazwisko</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Nazwisko; ?></div>
                </div>
                <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania
                    mocodawcy</p>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ulica</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Ulica; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->NrDomu; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">mieszkania</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->NrMieszkania; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->KodPocztowy; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">miejscowość</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Miasto; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">pesel</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Pesel; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">seria i numer dowodu</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Dowod; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">telefon</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Telefon; ?></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">Adres e-mail</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Mail; ?></div>
                </div>
            </div>

            <p class="pdf_szary_napis margin_l_20 margin_b_0 font_w_700 margin_t_20">UPOWAŻNIAM:</p>
            <div class="pdf_szara_kratka pdf_kratka_duza margin_b_10">
                VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowej 56i, zarejestrowana w Sądzie Rejonowym dla Wrocławia
                Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252, REGON: 020136043,
                NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.
            </div>

            <p class="margin_t_20">do podejmowania w moim imieniu wszelkich czynności mających na celu dochodzenie roszczeń dotyczących umowy kredytu
                <?php echo ($umowa_dane->RodzajKredytu == '') ? '____________________________________________________________' : '<span class="font_w_700">'.$umowa_dane->RodzajKredytu.'</span>'; ?>
                numer <?php echo (empty($umowa_dane->NrKredytu)) ? '____________________' : '<span class="font_w_700">'.$umowa_dane->NrKredytu.'</span>' ; ?> udzielonego przez <span class="font_w_700"> <?php echo (empty($umowa_dane->UdzielajacyKredytu)) ? '_____________________________________________________________' : '<span class="font_w_700">'.$umowa_dane->UdzielajacyKredytu.'</span>' ; ?></span>, w tym w szczególności do: wszelkich czynności pozaprocesowych i polubownych,
                zawarcia ugody, w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia, wskazania rachunku bankowego, na
                który mają być przelane świadczenia, odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem, gromadzenia dokumentacji
                mającej związek ze sprawą, w tym jej odbioru od podmiotów, które je tworzą i przechowują, udzielania dalszych pełnomocnictw.</p>

            <p class="margin_t_20">Upoważniam VOTUM S.A. do przekazywania oraz odbierania moich danych osobowych objętych zakresem niniejszego pełnomocnictwa</p>

            <p class="margin_t_20">Zgodnie z art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988) upoważniam zarówno bank,
                a także Rzecznika Finansowego, do ujawnienia i przekazania VOTUM S.A. wszelkich żądanych przez Spółkę dokumentów i informacji
                objętych tajemnicą bankową, dotyczących udzielenia i wykonania kredytu <?php echo ($umowa_dane->RodzajKredytu == '') ? '____________________________________________________________' : '<span class="font_w_700">'.$umowa_dane->RodzajKredytu.'</span>'; ?> o numerze <?php echo (empty($umowa_dane->NrKredytu)) ? '____________________' : '<span class="font_w_700">'.$umowa_dane->NrKredytu.'</span>' ; ?> na podstawie umowy z dnia <?php echo (empty($umowa_dane->DataKredytu)) ? '____________________' : '<span class="font_w_700">'.$umowa_dane->DataKredytu.'</span>' ; ?>, w zakresie niezbędnym do wykonania wszelkich
                czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku z wniesionym wnioskiem
                w ww. sprawie.</p>

            <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
                <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                    <p class="margin_b_0"><?php echo (!empty($umowa['DataUmowy']) && !empty($umowa['Miasto'])) ? $umowa['Miasto'].', '.$umowa['DataUmowy'] : '' ; ?></p>
                    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                    <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
                </div>
                <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                    <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS MOCODAWCY</p>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="col-md-12 margin_b_20"></div>

            <p class="margin_t_20 font_size_10 font_w_700">Oświadczam, że wszystkie świadczenia uzyskane w związku z realizacją niniejszego pełnomocnictwa mają być przekazywane na rachunek bankowy pełnomocnika, tj.
                VOTUM S.A., ul. Wyścigowa 56 i, 53 - 012 Wrocław, nr: 20 1050 1575 1000 0024 2109 0479. Niniejsza dyspozycja wskazuje jedyny sposób spełnienia świadczenia przez
                podmiot zobowiązany do zapłaty w związku z realizacją niniejszego pełnomocnictwa.</p>

            <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
                <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                    <p class="margin_b_0"><?php echo (!empty($umowa['DataUmowy']) && !empty($umowa['Miasto'])) ? $umowa['Miasto'].', '.$umowa['DataUmowy'] : '' ; ?></p>
                    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                    <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
                </div>
                <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                    <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS MOCODAWCY</p>
                </div>
                <div class="clear_b"></div>
            </div>

            <div class="pdf_strona_stopka col-md-12 margin_b_0">
                <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
                <p class="text_a_center margin_b_0">1/1</p>
            </div>

        </div>


        <?php
    }
?>