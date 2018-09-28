<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$w_imieniu = json_decode($_POST['w_imieniu'], true);
$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);

$stopka = 'PG-2-13-F1/2016-03-25';
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">
        <div class="pdf_strona_pierwsza_naglowek_maxima">
            <div class="pdfs_przedstawiciel_dane">
                <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
                <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
            </div>
            <div class="pdfs_tytu_dokumentu pdf_tytul_maxima">
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">UMOWA</p>
                <p class="margin_b_0 font_w_700 text_a_center">O DOCHODZENIE ŚRODKÓW Z ZUS, OFE I RACHUNKÓW BANKOWYCH</p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <p class="font_w_700 margin_t_0">na podstawie zamówienia z dnia <?php echo $umowa['DataUmowy']; ?> r. złożonego przez:</p>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">ZLECENIODAWCĘ:</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza">
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">imie</label>
                <div class="pdf_kratka"><?php echo $klient['Imie']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">nazwisko</label>
                <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
            </div>
            <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania zleceniodawcy</p>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ulica</label>
                <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
                <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">mieszkania</label>
                <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
                <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">miejscowość</label>
                <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">pesel</label>
                <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">seria i numer dowodu</label>
                <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">telefon</label>
                <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
            </div>
            <div class="form-group col-md-12">
                <label class="pdf_duze_litery font_size_10">Adres e-mail</label>
                <div class="pdf_kratka"><?php echo $klient['Mail']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0 font_w_700">działając w imieniu własnym lub
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == '1') ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małoletniego
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == '2') ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ubezwłasnowolnionego
                    <span class="glyphicon glyphicon<?php echo ($w_imieniu['Opis'] == '3') ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> małżonka
                </p>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">imie</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Imie']; ?></div>
            </div>
            <div class="form-group col-md-6">
                <label class="pdf_duze_litery font_size_10">nazwisko</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Nazwisko']; ?></div>
            </div>
            <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania zleceniodawcy</p>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ulica</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Ulica']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_r_0">
                <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['NrDomu']; ?></div>
            </div>
            <div class="form-group col-md-1 paddding_l_0">
                <label class="pdf_duze_litery font_size_10">mieszkania</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['NrMieszkania']; ?></div>
            </div>
            <div class="form-group col-md-2">
                <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['KodPocztowy']; ?></div>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">miejscowość</label>
                <div class="pdf_kratka"><?php echo $w_imieniu['Miasto']; ?></div>
            </div>
        </div>
        <label class="text_a_center col-md-12 margin_t_10">dla</label>
        <label class="pdf_duze_litery pdf_label_kratka pdf_szary_napis margin_l_20">ZLECENIOBIORCY:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza font_size_14">
            VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks 71/ 33 93 403, e-mail: dok@votum-sa.pl,
            zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</span>
        </div>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_10">przedmiot umowy</label>
        <label class="text_a_center col-md-12 font_w_700">§ 1</label>
        <p class="col-md-12">1Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności mających na celu ustalenie podmiotu zobowiązanego do wypłaty
            (zwanego dalej „zobowiązanym“) na rzecz Zleceniodawcy środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez
            Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym (zwanych dalej „rachunkiem emerytalnym”), lub na rachunku bankowym zmarłego posiadacza i uzyskanie od zobowiązanego
            wypłaty należnych Zleceniodawcy środków pieniężnych.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_10">OKRES OBOWIĄZYWANIA UMOWY</label>
        <label class="text_a_center col-md-12 font_w_700">§ 2</label>
        <p>Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od zobowiązanego na rzecz Zleceniodawcy należnych mu środków pieniężnych zgromadzonych na rachunku emerytalnym lub na
            rachunku bankowym w postępowaniu przedsądowym.</span></p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_10">PRAWA I OBOWIĄZKI STRON</label>
        <label class="text_a_center col-md-12 font_w_700">§ 3</label>
        <p class="margin_b_0">1. Zleceniodawca zobowiązuje się do niezwłocznego przekazania VOTUM żądanej przez niego dokumentacji oraz udzielenia informacji niezbędnych do wykonania umowy.</p>
        <p class="margin_b_0">2. Zobowiązanie Zleceniodawcy do przekazania dokumentacji obejmuje w szczególności:</p>
        <p class="margin_b_0">a) odpis skrócony aktu zgonu zmarłego posiadacza rachunku emerytalnego;</p>
        <p class="margin_b_0">b) odpis skrócony aktu urodzenia Zleceniodawcy;</p>
        <p class="margin_b_0">c) dokument potwierdzający uprawnienie do reprezentacji małoletniego albo ubezwłasnowolnionego całkowicie lub częściowo Zleceniodawcy, np. postanowienie sądu rodzinnego
            o ustanowieniu opiekuna lub kuratora, albo postanowienie sądu rodzinnego o ustanowieniu rodziny zastępczej;</p>
        <p class="margin_b_0">d) kopię dokumentu tożsamości Zleceniodawcy albo osoby reprezentującej Zleceniodawcę, potwierdzony za zgodność z oryginałem przez notariusza lub organ gminy;</p>
        <p class="margin_b_0">e) zgłoszenie przystąpienia posiadacza rachunku emerytalnego do funduszu emerytalnego lub umowę;</p>
        <p class="margin_b_0">f) dokumentację i adresowaną do posiadacza rachunku emerytalnego korespondencję z funduszu emerytalnego lub Zakładu Ubezpieczeń Społecznych, dotyczącą rachunku emerytalnego
            albo przyznania świadczeń emerytalnych, a także dokumentację potwierdzającą prowadzenie rachunku bankowego, w tym korespondencję kierowaną z banku do posiadacza rachunku;</p>

        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_10"></div>
        <p class="margin_b_0 font_size_10">*Jeżeli umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego,
            umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu,
            zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu. Wypełnić jedynie w razie zaistnienia ww. okoliczności.</p>


        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">1/3</p>
        </div>
    </div>
    <div class="pdf_strona">

        <p class="margin_b_0">g) postanowienie sądu o stwierdzeniu nabycia spadku przez Zleceniodawcę lub notarialny akt poświadczenia dziedziczenia przez Zleceniodawcę po zmarłym posiadaczu rachunku emerytalnego,
            jeżeli posiadacz rachunku emerytalnego nie wskazał osób uprawnionych do otrzymania środków zgromadzonych na rachunku emerytalnym.</p>
        <p class="margin_b_0">3. Zleceniodawca jest zobowiązany przekazać VOTUM dokumentację, o której mowa w ust. 1 i 2, w oryginałach lub kopiach poświadczonych za zgodność z oryginałem przez notariusza albo
            właściwy organ gminy, z wyjątkiem dokumentów, o których mowa w ust. 2 lit. e) i f) oraz z zastrzeżeniem postanowień ust. 2 lit. d).</p>
        <p class="margin_b_0">4. Czynności wchodzące w zakres umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności adwokatów lub radców prawnych, przy czym za działanie tych osób
            VOTUM odpowiada wobec Zleceniodawcy, jak za działania własne.</p>
        <p class="margin_b_0">5. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi
            w terminie 14 dni.</p>
        <p class="margin_b_0">6. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email, a w przypadku ich braku – na adres zameldowania/korespondencyjny.</p>


        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_10">WYNAGRODZENIE</label>
        <label class="text_a_center col-md-12 font_w_700">§ 4</label>
        <p class="">1. VOTUM zobowiązuje się do przekazania Zleceniodawcy środków pieniężnych uzyskanych od zobowiązanego, wypłaconych z rachunku emerytalnego lub bankowego w terminie <span class="font_w_700">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim
            potrąceniu należnego VOTUM wynagrodzenia, wg wyboru Zleceniodawcy w następujący sposób: <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przekazem pocztowym na adres Zleceniodawcy / <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> na wskazany przez Zleceniodawcę rachunek bankowy:</p>
        <div class="form-group col-md-12 paddding_r_0 paddding_l_0 margin_t_10">
            <label class="pdf_duze_litery font_size_10 col-md-12 paddding_l_0">nr rachunku</label>
            <div class="col-md-8 pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieNumer']; ?></div>
            <label class="pdf_duze_litery font_size_10 col-md-4"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</label>
        </div>
        <p class="font_size_10 col-md-12 margin_b_4 paddding_l_0"><span class="pdf_duze_litery font_w_700">Dane posiadacza rachunku </span>(Wypełnić, jeżeli posiadaczem rachunku jest inna osoba niż Zleceniodawca. Wskazać imię, nazwisko i adres posiadacza.)</p>
        <div class="form-group col-md-6 paddding_l_0">
            <label class="pdf_duze_litery font_size_10 ">imie</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieImie']; ?></div>
        </div>
        <div class="form-group col-md-6 paddding_r_0">
            <label class="pdf_duze_litery font_size_10">nazwisko</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieNazwisko']; ?></div>
        </div>
        <div class="form-group col-md-4 paddding_l_0">
            <label class="pdf_duze_litery font_size_10 ">ulica</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieUlica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieNrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">mieszkania</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieNrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieKodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4  paddding_r_0">
            <label class="pdf_duze_litery font_size_10">miejscowość</label>
            <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieMiasto']; ?></div>
        </div>
        <div class="clear_b margin_b_10"></div>
        <p class="margin_b_0 margin_t_20">2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich środków pieniężnych uzyskanych w jego imieniu z rachunku emerytalnego lub bankowego w ramach wykonania niniejszej umowy.</p>
        <p class="margin_b_0">3. Z tytułu wykonania umowy VOTUM przysługuje wynagrodzenie w wysokości 25% (słownie: dwadzieścia pięć procent) brutto (w tym podatek od towarów i usług VAT w wysokości 23%) wartości uzyskanych
            dla Zleceniodawcy środków pieniężnych.</p>
        <p class="margin_b_0">4. VOTUM nie pobiera wynagrodzenia od kwot przekazanych na rzecz Zleceniodawcy w formie wypłaty transferowej obejmującej połowę środków objętych małżeńską wspólnością ustawową zgromadzonych na rachunku emerytalnym.</p>
        <p class="margin_b_0">5. Dodatkowo VOTUM przysługuje zwrot udokumentowanych kosztów:</p>
        <p class="margin_b_0">a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa;</p>
        <p class="margin_b_0">b) przekazu pocztowego, jeżeli Zleceniodawca nie podał numeru rachunku bankowego do spełnienia świadczenia;</p>
        <p class="margin_b_0">c) uzyskania aktów stanu cywilnego, tj. aktu zgonu, aktu małżeństwa oraz aktu urodzenia.</p>
        <p class="margin_b_0">6. W przypadku dokonania wypłaty przez zobowiązanego środków pieniężnych z rachunku emerytalnego lub bankowego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia umowy,
            Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia ich otrzymania należne VOTUM wynagrodzenie na rachunek bankowy prowadzony
            w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023 2392 0799, bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy Zleceniodawca jest małoletni, ubezwłasnowolniony
            częściowo lub całkowicie, albo też, gdy jest reprezentowany przez swojego małżonka, przedstawiciel ustawowy, kurator lub opiekun, albo małżonek Zleceniodawcy zawierający umowę w jego imieniu,
            przyjmuje odpowiedzialność solidarną za zapłatę wynagrodzenia VOTUM.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_10">POSTANOWIENIA KOŃCOWE</label>
        <label class="text_a_center col-md-12 font_w_700">§ 5</label>
        <p class="margin_b_0">1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.</p>
        <p class="margin_b_0">2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.</p>
        <p class="margin_b_0">3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron.</p>

        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_20"></div>
        <p class="margin_b_0 font_size_10">Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz. U. z 2014 r., poz. 1182 ze zm.) VOTUM informuje, że:</p>
        <p class="margin_b_0 font_size_10">1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,</p>
        <p class="margin_b_0 font_size_10">2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od
            których będą uzyskiwane informacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,</p>
        <p class="margin_b_0 font_size_10">3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,</p>
        <p class="margin_b_0 font_size_10">4. podanie VOTUM danych osobowych jest dobrowolne.</p>
        <p class="margin_b_0 font_size_10">Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących stanu zdrowia, skazań,
            orzeczeń o ukaraniu i mandatów karnych, a także innych orzeczeń wydanych w postępowaniu sądowym) w celu wykonania umowy.</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">votum s.a.</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca.</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <p class="margin_b_0 margin_t_20 font_w_700">Oświadczenie</p>
        <p class="">Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca</p>
            </div>
            <div class="clear_b"></div>
        </div>


        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">2/2</p>
        </div>
    </div>
