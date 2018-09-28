<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$w_imieniu = json_decode($_POST['w_imieniu'], true);




$stopka = 'PG-2-1-F2/2016-06-23';
$nr_strony = 1;
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">
        <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
            <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">PEŁNOMOCNICTWO</p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">JA NIŻEJ PODPISANY:</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_t_10">
            <div class="form-group col-md-6 margin_t_5">
                <label class="pdf_duze_litery font_size_10 margin_b_0">imie</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?></div>
            </div>
            <div class="form-group col-md-6 margin_t_5">
                <label class="pdf_duze_litery font_size_10 margin_b_0">nazwisko</label>
                <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
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
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 margin_b_0">pesel</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 margin_b_0">seria i numer dowodu</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0 font_w_700">działając w imieniu własnym lub
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małoletniego
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ubezwłasnowolnionego
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małżonka<span class="igorny">1)*</span>
                </p>
            </div>
            <div class="form-group col-md-6 margin_t_5">
                <label class="pdf_duze_litery font_size_10 margin_b_0">IMIĘ</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Imie']; ?></div>
            </div>
            <div class="form-group col-md-6 margin_t_5">
                <label class="pdf_duze_litery font_size_10 margin_b_0">NAZWISKO</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Nazwisko']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 margin_b_0">ulica</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">nr domu /</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10 margin_b_0">mieszkania</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10 margin_b_0">kod pocztowy</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 margin_b_0">miejscowość</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Miasto']; ?></div>
            </div>
        </div>

        <label class="pdf_duze_litery pdf_label_kratka pdf_szary_napis margin_l_20 margin_t_10">UPOWAŻNIAM:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
            <p class="margin_b_0">VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, zarejestrowaną w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu, VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod nr
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości. </span></p>
        </div>

        <p class="margin_b_0 margin_t_20">do podejmowania w moim imieniu lub w imieniu osoby, którą reprezentuję przed wszelkimi podmiotami wszelkich czynności mających na celu
            ustalenie okoliczności zdarzenia z dnia <?php ?>, jak również jego skutków i dochodzenie roszczeń cywilnoprawnych, które z tego wynikają, w tym w szczególności do: wszelkich czynności pozaprocesowych i polubownych, zawarcia ugody, w tym wiążącej się ze
            zrzeczeniem się dalszych roszczeń, odbioru świadczenia, wskazania rachunku bankowego, na który mają być przelane świadczenia, odbioru
            wszelkiej korespondencji w sprawach objętych pełnomocnictwem, gromadzenia dokumentacji medycznej, w tym jej odbioru od
            podmiotów, które ją tworzą i przechowują, udzielania dalszych pełnomocnictw.</p>

        <p class="margin_b_0 margin_t_20">Pełnomocnictwo jest ważne także po śmierci mocodawcy.</p>
        <p class="margin_b_0">Jednocześnie na podstawie art. 26 ust. 1 ustawy z dnia 6 listopada 2008 r. o prawach pacjenta i Rzeczniku Praw Pacjenta
            (Dz.U.2009 r. nr 52 poz. 417) zezwalam na wydanie/wysłanie przez:</p>

        <div class="form-group col-md-12 margin_t_10">
            <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
        </div>

        <p class="margin_b_0 margin_t_20">odpisów lub kserokopii wszelkiej posiadanej dokumentacji medycznej, w tym zawierającej informacje o stanie zdrowia, rozpoznaniu, proponowanych
            oraz możliwych metodach diagnostycznych, leczniczych, dających się przewidzieć następstwach ich zastosowania albo zaniechania, wynikach leczenia
            orazrokowaniu, a tym samym zwalniam w tym zakresie ww. od obowiązku zachowania tajemnicy lekarskiej względem Votum S.A. </p>
        <p class="margin_b_0">W trybie art. 40 w zw. z art. 38 ust. 1 i 6 ustawy z dnia 11 września 2015 r. o działalności ubezpieczeniowej i reasekuracyjnej (Dz.U. 2015 r., poz. 1844)
            wyrażam zgodę na udostępnienie zakładowi ubezpieczeń prowadzącemu proces likwidacji szkody lub jego przedstawicielowi informacji o moim
            stanie zdrowia, przebiegu leczenia lub przyczynie śmierci przez podmioty wykonujące działalność leczniczą, które udzielały mi świadczeń zdrowotnych.</p>

        <p class="margin_b_0 margin_t_20">Na podstawie art. 23 ust. 1 pkt 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (t. j. Dz. U. 2015 r. poz. 2135 ze zm.) wyrażam zgodę
            na przetwarzanie moich danych osobowych (w tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu i mandatów karnych, a także
            innych orzeczeń wydanych w postępowaniu sądowym) przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław w celu
            wykonania czynności objętych niniejszym pełnomocnictwem. </p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_50 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS MOCODAWCY</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="form-group col-md-12 margin_top_20">
            <div class="col-md-12 paddding_l_0 paddding_r_0 margin_b_0 font_size_10 text_a_center">DYSPOZYCJA WYPŁATY ŚWIADCZENIA</div>
            <p class="margin_b_0 font_size_10">Oświadczam, że wszystkie świadczenia uzyskane w związku z realizacją niniejszego pełnomocnictwa mają być przekazywane na rachunek bankowy pełnomocnika, tj. VOTUM S.A., ul. Wyścigowa 56 i, 53 – 012 Wrocław, nr: 20
                1050 1575 1000 0024 2109 0479. Powyższa dyspozycja obejmuje w szczególności wypłatę odszkodowań z tytułu szkód objętych umowami ubezpieczenia, o których mowa w ustawie z dnia 11 września 2015 r. o działalności
                ubezpieczeniowej i reasekuracyjnej oraz ustawie z dnia 22 maja 2003 r. o ubezpieczeniach obowiązkowych, Ubezpieczeniowym Funduszu Gwarancyjnym i Polskim Biurze Ubezpieczycieli Komunikacyjnych. Niniejsza
                dyspozycja wskazuje jedyny sposób spełnienia świadczenia przez podmiot zobowiązany do zapłaty w związku z realizacją niniejszego pełnomocnictwa.</p>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_50 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS MOCODAWCY</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="form-group col-md-12 margin_top_20">
        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_10"></div>
        <p class="margin_b_0 font_size_10">1)* Wypełnić jedynie w przypadku, gdy Zleceniodawca działa w imieniu małżonka lub osoby nie posiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego. W razie przemijającej
            przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.</p>
        </div>


        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/1</div>
        </p>
    </div>
    </div>