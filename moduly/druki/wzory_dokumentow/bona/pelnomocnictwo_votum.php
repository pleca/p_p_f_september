<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$lista_klientow = json_decode($_POST['lista_klientow']);
$umowa_dane = json_decode($_POST['umowa_dane']);

$stopka = 'PG-2-21-F2/2017-01-02';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<?php
    for($i=0;$i<2;$i++) {
        ?>
        <div class="pdf_strona">
            <div class="pdf_strona_pierwsza_naglowek pdf_strona_pierwsza_naglowek_pouczenie">
                <div class="pdfs_tytu_dokumentu margin_t_20 pdf_tytul_dokumentu_pouczenie">
                    <p class="margin_b_0 pdf_duze_litery">PEŁNOMOCNICTWO</p>
                </div>
                <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/>
                </div>
            </div>
            <p class="pdf_czerowny_napis margin_l_20 margin_b_0 font_w_700">UDZIELONE PRZEZ</p>
            <div class="pdf_czerwona_kratka pdf_kratka_duza margin_b_10">
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">IMIĘ I NAZWISKO / FIRMA</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Imie; ?></div>
                </div>
                <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">ADRES</p>
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
                <div class="clear_b"></div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">NIP</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Pesel; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">REGON</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Dowod; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <label class="pdf_duze_litery font_size_10">KRS</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Telefon; ?></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="pdf_duze_litery font_size_10">REPREZENTOWANA(Y) PRZEZ</label>
                    <div class="pdf_kratka"><?php echo $lista_klientow[$i]->Mail; ?></div>
                </div>
            </div>

            <p class="margin_b_0 font_size_12 margin_l_20">Należy wypełnić właściwe pola. W przypadku osób fizycznych: imię i nazwisko, adres, PESEL, seria i numer dowodu osobistego,
                w przypadku osób fizycznych prowadzących działalność gospodarczą: imię i nazwisko, firma, adres, NIP, REGON, w przypadku spółek prawa handlowego
                i innych podmiotów prowadzących działalnośc gospodarczą: firma, siedziba, adres, NIP, REGON, KRS oraz sposób reprezentacji, zgodny z KRS.</p>

            <p class="pdf_szary_napis margin_l_20 margin_b_0 font_w_700 margin_t_20">UPOWAŻNIAJĄCE:</p>
            <div class="pdf_szara_kratka pdf_kratka_duza margin_b_10">
                VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowej 56i, zarejestrowana w Sądzie Rejonowym dla Wrocławia
                Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043,
                    NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</span>
            </div>

            <p class="margin_t_20">do podejmowania w imieniu Mocodawcy przed wszelkimi podmiotami, wszelkich czynności mających na celu ustalenie okoliczności
            zdarzenia z dnia <?php echo '?DANE?'; ?> i jego skutków, oraz dochodzenie roszczeń odszkodowawczych, które z niego wynikają, w tym, w szczególności do:</p>

            <p class="margin_t_20 margin_b_0">1. wszelkich czynności pozaprocesowych i polubownych;</p>
            <p class="margin_b_0">2. zawarcia ugody, w tym związanej ze zrzeczeniem się dalszych roszczeń;</p>
            <p class="margin_b_0">3. odbioru świadczenia;</p>
            <p class="margin_b_0">4. wskazania rachunku bankowego, na który mają być przelane świadczenia;</p>
            <p class="margin_b_0">5. odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem;</p>
            <p class="margin_b_0">6. gromadzenia dokumentacji dotyczącej szkody, w tym jej odbioru od podmiotów, które je tworzą i przechowują;</p>
            <p class="margin_b_0">7. przekazania dokumentacji dotyczącej szkody innym podmiotom w celu wydania opinii w zakresie zasadności i wysokości roszczeń;</p>
            <p class="margin_b_0">8. udzielania dalszych pełnomocnictw.</p>

            <p class="margin_t_20 margin_b_10">Pełnomocnistwo jest ważne takżę po śmierci mocodawcy.</p>
            <p class="margin_b_0">Zgodnie z ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (t.j.Dz.U. 2014 r.,poz.1182,ze zm.), w zakresie czynności objętych
                pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych przez VOTUM S.A. z siedzibą we Wrocłąwiu, ul.Wyścigowa 56i, 53-012 Wrocław oraz podmiot ponoszący
                odpowiedzialność cywilną za poniesioną szkodę, w szczególności zakład ubezpieczeń, a także przetwarzanie i przekazywanie przez ten podmiot danych osobowych
                innym podmiotom, którym zlecono czynności ubezpieczeniowe w ramach likwiacji szkody, w zakresie niezbędnym do ich wykonania.</p>


            <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
                <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                    <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
                </div>
                <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                    <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS MOCODAWCY</p>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="col-md-12 margin_b_40"></div>

            <div class="pdf_strona_stopka col-md-12 margin_b_0">
                <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
                <p class="text_a_center margin_b_0">1/1</p>
            </div>

        </div>


        <?php
    }
?>