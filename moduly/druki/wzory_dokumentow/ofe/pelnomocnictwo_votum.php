<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$w_imieniu = json_decode($_POST['w_imieniu'], true);




$stopka = 'PG-2-13-F2/2015-10-19';
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
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0 font_w_700">działając w imieniu własnym lub
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małoletniego
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> obezwłasnowolnionego
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małżonka
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
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 margin_b_0">pesel</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10 margin_b_0">seria i numer dowodu</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Dowod']; ?></div>
            </div>
        </div>

        <label class="pdf_duze_litery pdf_label_kratka pdf_szary_napis margin_l_20 margin_t_10">UPOWAŻNIAM:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
            <p class="margin_b_0">VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, zarejestrowaną w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu, VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod nr
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości, </span>,
            do reprezentowania mnie/ małoletniego/ ubezwłasnowolnionego całkowicie/ małżonka* (niewłaściwe skreślić), przy wykonywaniu wszelkich czynności mających na celu ustalenie i realizację uprawnienia
            do wypłaty środków pieniężnych zgromadzonych na rachun-ku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład
                Ubezpieczeń Społecznych, lub na innym koncie emerytalnym, zwanym „rachunkiem emerytalnym” lub na rachunku bankowym prowadzonym na rzecz posiadacza:</p>
            <div class="form-group col-md-12 margin_t_10">
                <label class="pdf_duze_litery font_size_10 margin_b_0">IMIĘ I NAZWISKO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?> <?php echo $klient['Nazwisko']; ?></div>
            </div>

            <p class="margin_b_0 margin_t_20">w szczególności do:</p>
            <p class="margin_b_0">1. wszelkich czynności pozaprocesowych i polubownych, w tym składania i odbierania oświadczeń woli;</p>
            <p class="margin_b_0">2. odbioru środków pieniężnych zgromadzonych na „rachunku emerytalnym” lub na rachunku bankowym i wskazania numeru rachunku bankowego, na który ma być spełnione świadczenie;</p>
            <p class="margin_b_0">3. odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem;</p>
            <p class="margin_b_0">4. gromadzenia dokumentacji niezbędnej do uzyskania wypłaty środków pieniężnych z „rachunku emerytalnego”, w tym do odbioru tej dokumentacji od podmiotów, które ją tworzą i przechowują;</p>
            <p class="margin_b_0">5. udzielania dalszych pełnomocnictw.</p>
            <p class="margin_b_0">W zakresie czynności objętych pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych zgodnie z ustawą z dnia 29 sierpnia
                1997 r. o ochronie danych osobowych (t.j. Dz.U. z 2016 r., poz. 922 ze zm.).</p>

        </div>

        <p class="margin_b_0 margin_t_20">W zakresie czynności objętych pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych zgodnie z ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz. U. z 2014 r., poz. 1182 ze zm.).</p>

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

        <div class="form-group col-md-12 margin_top_260">
        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_10"></div>
        <p class="margin_b_0 font_size_10">1)* W przypadku, gdy umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych,
            tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody,
            która dotyczy jednego z małżonków pozosta-jących we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego
            działać w sprawach zwykłego zarządu.</p>
        </div>


        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/1</div>
        </p>
    </div>
    </div>