<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$w_imieniu = json_decode($_POST['w_imieniu'], true);
$zmarly = json_decode($_POST['zmarly'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);
$lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
$lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];

$lista_zalacznikow = json_decode($_POST['lista_zalacznikow'], true);

$lista_uprawnionych = $_POST['lista_uprawnionych'];
$lista_spadkobiercow = $_POST['lista_spadkobiercow'];


$stopka = 'PG-2-13-F3/2016-02-02';
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
            <div class="pdf_kratka"><?php echo ($umowa['JednostkaId'] == 'Brak') ? '' : $umowa['JednostkaId'] ; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod jednostki</p>
            <div class="pdf_kratka"><?php echo $umowa['KodKonsultanta']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod konsultanta</p>
            <div class="pdf_kratka"></div>
            <p class="pdf_duze_litery font_size_10 margin_b_0 margin_t_2">nr sprawy</p>
        </div>
        <div class="pdfs_tytu_dokumentu">
            <p class="margin_b_0 font_size_18 font_w_700">ZGŁOSZENIE ROSZCZEŃ O WYPŁATĘ ŚRODKÓW</p>
            <p class="margin_b_0 font_size_18 font_w_700">Z RACHUNKU EMERYTALNEGO/BANKOWEGO</p>
        </div>
        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_t_10">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">ZLECENIODAWCA</div>
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
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 margin_b_0">pesel</label>
            <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 margin_b_0">telefon</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">e-mail</label>
            <div class="pdf_kratka"><?php echo $klient['Mail']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 margin_b_0">seria i numer dowodu</label>
            <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
        </div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">DZIAŁAJĄCY W IMIENIU
            <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> MAŁOLETNIEGO
            <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> UBEZWŁASNOWOLNIONEGO
            <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == 3) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> MAŁŻONKA</div>
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
        <div class="clear_b"></div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10 margin_b_0">pesel</label>
            <div class="pdf_kratka"><?php echo $w_imieniu['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 margin_b_0">telefon</label>
            <div class="pdf_kratka"><?php echo $w_imieniu['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10 margin_b_0">e-mail</label>
            <div class="pdf_kratka"><?php echo $w_imieniu['Mail']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10 margin_b_0">seria i numer dowodu</label>
            <div class="pdf_kratka"><?php echo $w_imieniu['Dowod']; ?></div>
        </div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek padding_b_0">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">DANE ZMARŁEGO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO</div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">IMIĘ</label>
            <div class="pdf_kratka"><?php echo $zmarly['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NAZWISKO</label>
            <div class="pdf_kratka"><?php echo $zmarly['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">PESEL</label>
            <div class="pdf_kratka"><?php echo $zmarly['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NIP</label>
            <div class="pdf_kratka"><?php echo $zmarly['Nip']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NR DOWODU OSOBISTEGO LUB PASZPORTU (JEŻELI POSIADACZOWI RACHUNKU EMERYTALNEGO NIE NADANO NUMERU PESEL)</label>
            <div class="pdf_kratka"><?php echo $zmarly['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">STOPIEŃ POKREWIEŃSTWA Z UPRAWNIONYM (PROSIMY WSKAZAĆ, KIM BYŁ ZMARŁY DLA UPRAWNIONEGO, NP. MAŁŻONEK, MATKA, OJCIEC, ITP.).</label>
            <div class="pdf_kratka"><?php echo $pozostale_informacje['Pokrewienstwo']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">DATA ŚMIERCI POSIADACZA RACHUNKU EMERYTALNEGO</label>
        </div>
        <div class="form-group col-md-3">
            <div class="pdf_kratka"><?php echo $pozostale_informacje['DataSmierci']; ?></div>
        </div>
        <div class="clear_b"></div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">ADRES ZAMIESZKANIA POSIADACZA RACHUNKU EMERYTALNEGO WSKAZANY PODMIOTOWI PROWADZĄCEMU RACHUNEK</label>
        </div>
        <div class="form-group col-md-12">
            <div class="pdf_kratka"><?php echo $zmarly['Ulica'].' '.$zmarly['NrDomu'].' '.$zmarly['NrMieszkania'].' '.$zmarly['KodPocztowy'].' '.$zmarly['Wartosc']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">NR RACHUNKU EMERYTALNEGO</label>
            <div class="pdf_kratka"><?php echo $zmarly['Numer']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10 margin_b_0">PODMIOT PROWADZĄCY RACHUNEK EMERYTALNY</label>
            <div class="pdf_kratka"><?php echo $zmarly['Nazwa']; ?></div>
        </div>

        <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10 font_size_14">Czy posiadacz rachunku emerytalnego pobierał emeryturę?</p>
        <div class="form-group col-md-12 margin_t_5 font_size_14">
            <p class="margin_b_0 margin_l_10 margin_r_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyPobieralEmeryture'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK Jeśli tak, to kiedy nastąpiła pierwsza wypłata emerytury?
                <span class="font_w_700"><?php echo ($pozostale_informacje['CzyPobieralEmeryture'] == 1) ? $pozostale_informacje['DataPierwszejWyplaty'] : ' '; ?></span>
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyPobieralEmeryture'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyPobieralEmeryture'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                BRAK INFORMACJI
            </p>
        </div>

        <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10 font_size_14">Czy posiadacz rachunku emerytalnego, który nie pobierał emerytury, złożył wniosek o ustalenie prawa do emerytury?</p>
        <div class="form-group col-md-12 margin_t_5 font_size_14">
            <p class="margin_b_0 margin_l_10 margin_r_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZlozylWniosekOEmeryture'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK
                </span>
            <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZlozylWniosekOEmeryture'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE
                </span>
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZlozylWniosekOEmeryture'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                BRAK INFORMACJI
                </span>
            </p>
        </div>

        <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10 font_size_14">Czy posiadacz rachunku emerytalnego wskazał w umowie o prowadzenie rachunku emerytalnego osoby uprawnione do otrzymania środków pieniężnych z rachunku emerytalnego po jego śmierci?</p>
        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 margin_l_10 margin_r_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZmarlyWskazalOsoby'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK Jeśli tak, to kogo wskazał?
                <span class="font_w_700">Osoby wskazane przez zmarłego posiadacza rachunku emerytalnego:</span>
            </p>

                <div class="pdf_kratka"><?php echo $lista_uprawnionych; ?></div>

            <p class="margin_b_0 margin_l_10 margin_r_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZmarlyWskazalOsoby'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZmarlyWskazalOsoby'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                BRAK INFORMACJI
            </p>
        </div>
        <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10">Spadkobiercy zmarłego posiadacza rachunku emerytalnego:</p>
        <div class="form-group col-md-12 margin_t_5">
                <div class="pdf_kratka"><?php echo $lista_spadkobiercow; ?></div>
        </div>

    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_35 margin_b_10">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">podpis zleceniodawcy</p>
        </div>
        <div class="clear_b"></div>
    </div>


    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">1/2</p>
    </div>
</div>
<div class="pdf_strona">

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">

        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10">Czy zmarły był posiadaczem rachunku bankowego?</p>
            <p class="margin_b_0 margin_l_10 margin_r_10">(Wypełnić wyłącznie, gdy przedmiotem umowy ma być dochodzenie roszczeń z rachunku bankowego zmarłego posiadacza).</p>
            <p class="margin_b_0 margin_l_10 margin_r_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyBylPosiadaczemRachunkuBankowego'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyBylPosiadaczemRachunkuBankowego'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyBylPosiadaczemRachunkuBankowego'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                BRAK INFORMACJI
            </p>
            <p class="margin_b_0 margin_l_10 margin_r_10">Jeśli tak, to w jakim banku prowadzony był rachunek:
                <span class="font_w_700">
                    <?php echo ($pozostale_informacje['CzyBylPosiadaczemRachunkuBankowego'] == 1) ? $pozostale_informacje['Nazwa'] : ' '; ?>
                </span></br>
                i pod jakim numerem:
                <span class="font_w_700">
                    <?php echo ($pozostale_informacje['CzyBylPosiadaczemRachunkuBankowego'] == 1) ? $pozostale_informacje['Numer'] : ' '; ?>
                </span>
            </p>
        </div>

        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10">Czy zostało wydane postanowienie o stwierdzeniu nabycia spadku lub czy został sporządzony akt notarialny poświadczenia dziedziczenia po zmarłym posiadaczu rachunku emerytalnego?</p>
            <p class="margin_b_0 margin_l_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyWydanoPostanowienie'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyWydanoPostanowienie'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyWydanoPostanowienie'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                BRAK INFORMACJI
            </p>
        </div>

        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10">Czy zgłoszono już roszczenie o wypłatę środków pieniężnych do podmiotu prowadzącego rachunek emerytalny?</p>
            <p class="margin_b_0 margin_l_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZgloszonoRoszczenie'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZgloszonoRoszczenie'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE, Jeśli tak, to kiedy?
                <span class="font_w_700">
                    <?php echo ($pozostale_informacje['CzyZgloszonoRoszczenie'] == 1) ? $pozostale_informacje['DataZgloszeniaRoszczenia'] : ' '; ?>
                </span>
            </p>
        </div>

        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10">Czy uprawnionemu wypłacono środki pieniężne z rachunku emerytalnego?</p>
            <p class="margin_b_0 margin_l_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyWyplaconoSrodki'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK, zarówno z rachunku OFE, jak i subkonta ZUS
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyWyplaconoSrodki'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK, ale wyłącznie z rachunku OFE
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyWyplaconoSrodki'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE
            </p>
        </div>

        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10 font_size_14">Czy zlecono prowadzenie sprawy innemu pełnomocnikowi?</p>
            <p class="margin_b_0 margin_l_10 margin_r_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZleconoPelnomocnikowi'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyZleconoPelnomocnikowi'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE Jeśli tak, to komu?
            </p>
            <div class="pdf_kratka">
                <?php echo ($pozostale_informacje['CzyZgloszonoRoszczenie'] == 1) ? $pozostale_informacje['KomuZlecono'] : ' '; ?>
            </div>
        </div>

        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 font_w_700 margin_l_10 margin_r_10">Czy odwołano pełnomocnictwo udzielone innemu pełnomocnikowi?</p>
            <p class="margin_b_0 margin_l_10">
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyOdwolano'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                TAK
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['CzyOdwolano'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span>
                NIE, Jeśli tak, to kiedy?
                <span class="font_w_700">
                    <?php echo ($pozostale_informacje['CzyZgloszonoRoszczenie'] == 1) ? $pozostale_informacje['KiedyOdwolano'] : ' '; ?>
                </span>
            </p>
        </div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek padding_b_0">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">INNE ISTOTNE INFORMACJE PRZEKAZANE PRZEZ KLIENTA</div>
        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14"><?php echo $pozostale_informacje['InformacjeOdKlienta']; ?></p>
        </div>
    </div>

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek padding_b_0">
        <div class="pdf_kratka_szara_duza_naglowek_zgloszenie font_w_700">LISTA DOKUMENTACJI POBRANEJ OD KLIENTA</div>
        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14">
                <?php



                foreach($lista_dostepnej_dokumentacji as $poj_dok => $poj_dok_war){

                 ?>

                    <div class="col-md-1">
                        <div class="pdf_kratka_niska font_size_12"><?php echo (strpos($lista_pobranej_dokumentacji,($poj_dok)) !== false) ? $lista_zalacznikow[$poj_dok] : ' ' ; ?></div>
                    </div>
                    <?php echo $poj_dok_war; ?>
                    <div class="clear_b"></div>

                <?php
                }
                ?>
            </p>
        </div>
    </div>

    <div class="form-group col-md-12 margin_t_5">
        <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14 font_w_700"><span class="glyphicon glyphicon<?php echo ($pozostale_informacje['OswiadczenieODzialalnosci'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Oświadczam, że prowadzę pozarolniczą działalność gospodarczą. </span></span></p>
        <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14 font_w_700"><span class="glyphicon glyphicon<?php echo ($pozostale_informacje['OfertaProtecta'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Jestem zainteresowany/a ofertą produktów finansowych i wyrażam zgodę na przekazywanie Protecta Finance Sp. z o.o. we Włocławku moich danych osobowych w celach marketingowych, w szczególności w celu opracowania i przedstawienia oferty. </span></p>
        <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14 font_w_700"><span class="glyphicon glyphicon<?php echo ($pozostale_informacje['OfertaFinansowa'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie jestem zainteresowany/a ofertą produktów finansowych. </span></span></p>
        <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14 font_w_700">
            <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['ZgodaNaInformacje'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Wyrażam zgodę / </span></span>
            <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['ZgodaNaInformacje'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie wyrażam zgody na otrzymywanie informacji związanych z wykonywaniem umowy poprzez: </span></span>
        </p>
        <p class="margin_b_0 margin_l_10 margin_r_10 font_size_14 font_w_700">
            <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['ZgodaSms'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> wiadomości tekstowe SMS / </span></span>
            <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['ZgodaMail'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> wiadomości e-mail na numer/adres przeze mnie wskazany. </span></span>
        </p>
    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_20">
        <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA</p>
        </div>
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS KLIENTA</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <p class="margin_b_0 margin_t_20 font_w_700">Oświadczenie</p>
    <p class="">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A. oświadczam, że podpisy Klienta widniejące na formularzu umowy,
        pełnomocnictwie oraz niniejszym druku zgłoszenia roszczenia zostały złożone w mojej obecności własnoręcznie przez Klienta.*</p>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CZYTELNY PODPIS PRZEDSTAWICIELA</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_20"></div>
    <p class="margin_b_0 font_size_10">*Za Klienta uważa się osobę uprawnioną do wypłaty środków z rachunku emerytalnego, a w przypadku, gdy uprawnionym jest
        osoba nie posiadająca pełnej zdolności do czynności prawnych, tj. małoletni lub ubezwłasnowolniony całkowicie, przedstawiciela ustawowego lub opiekuna prawnego uprawnionego, który zawarł umowę z VOTUM S.A.</p>


    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">2/2</p>
    </div>
</div>
