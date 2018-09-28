<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$liczba_wlascicieli = $_POST['liczba_wlascicieli'];

for($i=1; $i<=$liczba_wlascicieli; $i++) {
    ${'klient_'.$i} = json_decode($_POST['klient_'.$i], true);
    ${'pelnomocnik_'.$i} = json_decode($_POST['pelnomocnik_'.$i], true);
    ${'reprezentant_'.$i} = json_decode($_POST['reprezentant_'.$i], true);
}

$stopka = 'PG-2-14-F12/2016-12-21';
$nr_strony = 1;
$strony = $liczba_wlascicieli;
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php for ($i=1; $i<=$liczba_wlascicieli; $i++ ) { ?>

    <div class="pdf_strona">
        <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
            <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">PEŁNOMOCNICTWO</p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">JA NIŻEJ PODPISANY:</label>

            <div class="pdf_czerwona_kratka pdf_kratka_duza">
                <div class="form-group col-md-3 tlo_podtytulu_czerwone">
                    <label class="pdf_duze_litery podtytul_formularza"><?php echo ( $i != 1) ? 'WSPÓŁWŁAŚCICIEL' : 'WŁAŚCICIEL'; ?></label>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo ( ${'klient_'.$i}['Nazwa'] == '') ? ${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko'] : ${'klient_'.$i}['Nazwa'].' '.${'klient_'.$i}['Imie'].' '.${'klient_'.$i}['Nazwisko']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Ulica']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrDomu']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['NrMieszkania']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['KodPocztowy']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Miasto']; ?></div>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-3">
                    <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'pelnomocnik_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Dowod']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Pesel']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">NIP</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Nip']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                    <div class="pdf_kratka"><?php echo ${'klient_'.$i}['Krs']; ?></div>
                </div>
            </div>

            <p class="font_w_700 col-md-12 margin_t_10 margin_b_10">reprezentowany przez:</p>

            <div class="pdf_szara_kratka pdf_kratka_duza">
                <div class="form-group col-md-3 tlo_podtytulu_szare">
                    <label class="pdf_duze_litery podtytul_formularza">PEŁNOMOCNIK</label>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo (${'pelnomocnik_'.$i}['Nazwa'] == '') ? ${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa'].' '.${'pelnomocnik_'.$i}['Imie'].' '.${'pelnomocnik_'.$i}['Nazwisko']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Ulica']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrDomu']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['NrMieszkania']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['KodPocztowy']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Miasto']; ?></div>
                </div>
                <div class="form-group col-md-3">
                    <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'pelnomocnik_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Dowod']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Pesel']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">NIP</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Nip']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                    <div class="pdf_kratka"><?php echo ${'pelnomocnik_'.$i}['Krs']; ?></div>
                </div>
            </div>

            <div class="pdf_szara_kratka pdf_kratka_duza">
                <div class="form-group col-md-3 tlo_podtytulu_szare">
                    <label class="pdf_duze_litery podtytul_formularza">REPREZENTANT</label>
                </div>
                <div class="clear_b"></div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">IMIĘ, NAZWISKO/FIRMA PRZEDSIĘBIORCY</label>
                    <div class="pdf_kratka"><?php echo (${'reprezentant_'.$i}['Nazwa'] == '') ? ${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko'] : ${'pelnomocnik_'.$i}['Nazwa'].' '.${'reprezentant_'.$i}['Imie'].' '.${'reprezentant_'.$i}['Nazwisko']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">ULICA</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Ulica']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_r_0">
                    <label class="pdf_duze_litery font_size_10 ">NR DOMU /</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NrDomu']; ?></div>
                </div>
                <div class="form-group col-md-1 paddding_l_0">
                    <label class="pdf_duze_litery font_size_10">NR LOKALU</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['NrMieszkania']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KOD POCZTOWY</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['KodPocztowy']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">MIEJSCOWOŚĆ</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Miasto']; ?></div>
                </div>
                <div class="form-group col-md-3">
                    <label class="pdf_duze_litery font_size_10">SERIA I NR <?php echo (${'reprezentant_'.$i}['Dowod'] != NULL) ? 'DOWODU OSOBISTEGO' : 'PASZPORTU' ; ?></label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Dowod']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10 ">PESEL</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Pesel']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">NIP</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Nip']; ?></div>
                </div>
                <div class="form-group col-md-2">
                    <label class="pdf_duze_litery font_size_10">KRS/EDG</label>
                    <div class="pdf_kratka"><?php echo ${'reprezentant_'.$i}['Krs']; ?></div>
                </div>
            </div>


        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20 margin_t_10">UPOWAŻNIAM:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
            VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93
            403, e-mail: dok@votum-sa.pl,
            zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru
            Sądowego pod numerem
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>,
            którą reprezentuje:
            <div class="form-group col-md-12 margin_t_10">
                <div class="pdf_kratka"></div>
            </div>
        </div>

        <p class="margin_b_0 margin_t_20">do podejmowania w moim imieniu lub w imieniu podmiotu, który reprezentuję przed wszelkimi podmiotami wszelkich czynności mających
            na celu ustalenie okoliczności zdarzenia z dnia <span class="font_w_700"><?php echo $umowa_dane['DataSzkody']; ?></span> jak, również jego skutków i dochodzenie roszczeń cywilnoprawnych
            z tytułu szkody na mieniu, które z tego wynikają, w tym w szczególności do:</p>
        <p class="margin_b_0">1. wszelkich czynności pozaprocesowych i polubownych,</p>
        <p class="margin_b_0">2. odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem,</p>
        <p class="margin_b_0">3. gromadzenia dokumentacji w sprawie, w tym jej odbioru od podmiotów, które ją tworzą i przechowują,</p>
        <p class="margin_b_0">4. odbioru świadczenia,</p>
        <p class="margin_b_0">5. udzielania dalszych pełnomocnictw.</p>
        <p class="margin_b_0">W zakresie czynności objętych pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych zgodnie z ustawą z dnia 29 sierpnia
            1997 r. o ochronie danych osobowych (t.j. Dz.U. z 2016 r., poz. 922 ze zm.).</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_50 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0"><?php echo $umowa['Miasto'].', '.$umowa['DataUmowy']; ?>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS MOCODAWCY</p>
            </div>
            <div class="clear_b"></div>
        </div>


        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">1/1</div>
        </p>
    </div>
    </div>
<?php } ?>