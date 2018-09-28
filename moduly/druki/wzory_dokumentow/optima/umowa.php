<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);


$stopka = 'PG-2-9-F1/2017-01-16';
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
                <p class="margin_b_0 font_w_700 text_a_center">O DOCHODZENIE ROSZCZEŃ Z OBSŁUGĄ PROCESOWĄ "MAXIMA"</p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <p class="font_w_700 margin_t_10">na podstawie zamówienia z dnia <?php echo $umowa['DataUmowy']; ?> r. złożonego przez:</p>
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
            <label class="font_w_700 col-md-12 margin_t_10 margin_b_10">działającego w imieniu <?php echo $pozostale_informacje['UmowaDzialajacyWImieniu']; ?></label>
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
        </div>
        <label class="text_a_center col-md-12 margin_t_10">dla</label>
        <label class="pdf_duze_litery pdf_label_kratka pdf_szary_napis margin_l_20">ZLECENIOBIORCY:</label>
        <div class="pdf_szara_kratka pdf_kratka_duza">
            VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks 71/ 33 93 403, e-mail: dok@votum-sa.pl,
            zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
            <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</span>
        </div>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">przedmiot umowy</label>
        <label class="text_a_center col-md-12 font_w_700">§ 1</label>
        <p class="col-md-12">Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności mających na celu ustalenie podmiotu
            (zwanego dalej zobowiązanym) ponoszącego odpowiedzialność cywilną w związku z wypadkiem z dnia <span class="font_w_700"><?php echo $pozostale_informacje['DataZdarzenia']; ?></span>, w którym
            śmierć poniósł/a <span class="font_w_700"><?php echo $pozostale_informacje['DaneOfiary']; ?></span> i uzyskanie od zobowiązanego świadczeń
            odszkodowawczych za szkodę na osobie należnych Zleceniodawcy.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">OKRES OBOWIĄZYWANIA UMOWY</label>
        <label class="text_a_center col-md-12 font_w_700">§ 2</label>
        <p>Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od zobowiązanego na rzecz Zleceniodawcy należnych mu świadczeń
            odszkodowawczych <span class="font_w_700">w postępowaniu przedsądowym, sądowym i egzekucyjnym.</span></p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">REPREZENTACJA W POSTĘPOWANIU SĄDOWYM</label>
        <label class="text_a_center col-md-12 font_w_700">§ 3</label>
        <p class="margin_b_0">1. Skierowanie sprawy na drogę postępowania sądowego przeciwko zobowiązanemu do spełnienia świadczeń odszkodowawczych
            w związku z wypadkiem, o którym mowa w § 1 wymaga zgody obu stron umowy.</p>
        <p class="margin_b_0">2. W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie postępowania sądowego, zobowiązuje się on do niezwłocznego
            przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy oraz wszelkiej żądanej przez niego dokumentacji
            i oświadczeń, które będą przydatne do wykonania umowy.</p>
        <p class="margin_b_0">3. <span class="font_w_700">Koszty wynagrodzenia pełnomocnika procesowego</span>
            procesowego, o którym mowa w § 8 ust. 2, w tym konieczne koszty zastępstwa substytucyjnego, <span class="font_w_700">obciążają VOTUM.</span></p>
        <p class="margin_b_0">4. <span class="font_w_700">VOTUM zobowiązuje się do wystąpienia o zwolnienie Zleceniodawcy z kosztów sądowych</span> , po uprzednim złożeniu przez
            Zleceniodawcę oświadczenia o stanie rodzinnym, majątku i dochodach, wg wzoru urzędowego.</p>
        <p class="margin_b_0">5. <span class="font_w_700">Koszty sądowe ponosi VOTUM</span> ,jeżeli sąd nie zwolni od ich ponoszenia Zleceniodawcy na podstawie wniosku, o którym mowa w ust. 4.</p>
        <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_20"></div>
        <p class="margin_b_0 font_size_10">* W przypadku, gdy umowa zawierana jest w imieniu osoby nie posiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę
            podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we
            wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu. Wypełnić jedynie w razie
            zaistnienia powyższych okoliczności.</p>
        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">1/3</p>
        </div>
    </div>
    <div class="pdf_strona">
        <p class="margin_b_0">6. Koszty procesu poniesione przez Votum podlegają zwrotowi na rzecz Votum wyłącznie z kwoty ogółu świadczeń przyznanych Zleceniodawcy
            rozstrzygnięciem sądu lub ugodą, a koszty zastępstwa procesowego zasądzone w sprawie przypadają pełnomocnikowi procesowemu,
            o którym mowa w § 8 ust.2.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">REPREZENTACJA W POSTĘPOWANIU KARNYM</label>
        <label class="text_a_center col-md-12 font_w_700">§ 4</label>
        <p class="margin_b_0">1. <span class="font_w_700">VOTUM ponosi koszty wynagrodzenia pełnomocnika procesowego</span>, o którym mowa w § 8 ust. 2, reprezentującego Zleceniodawcę
            jako pokrzywdzonego <span class="font_w_700">w karnym postępowaniu przygotowawczym</span> prowadzonym w związku z wypadkiem wskazanym w § 1.</p>
        <p class="margin_b_0">Wynagrodzenie pełnomocnika, które obciąża VOTUM obejmuje:</p>
        <p class="margin_b_0">a) przystąpienie do sprawy w charakterze pełnomocnika pokrzywdzonego w postępowaniu przygotowawczym,</p>
        <p class="margin_b_0">b) wystąpienie o dokumentację niezbędną do realizacji niniejszej umowy,</p>
        <p class="margin_b_0">c) c) sporządzanie pism procesowych.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">REPREZENTACJA W POSTĘPOWANIU PRZED SĄDEM RODZINNYM</label>
        <label class="text_a_center col-md-12 font_w_700">§ 5</label>
        <p class="margin_b_0">Na wniosek Zleceniodawcy, w przypadku, gdy dla realizacji niniejszej umowy niezbędne jest uzyskanie orzeczenia sądu dotyczącego
            ubezwłasnowolnienia, ustanowienia opieki lub kurateli, za zgodą obu stron umowy, <span class="font_w_700">VOTUM poniesie koszty wynagrodzenia
            pełnomocnika procesowego</span>, reprezentującego Zleceniodawcę w postępowaniach dotyczących ww. spraw. Niniejsze postanowienie
            nie dotyczy skierowania sprawy na drogę postępowania sądowego, o którym mowa w § 3 umowy.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">ANALIZA EKSPERCKA</label>
        <label class="text_a_center col-md-12 font_w_700">§ 6</label>
        <p class="margin_b_0">1. W przypadku, gdy ustalenia postępowania karnego prowadzonego w sprawie wypadku, o którym mowa w § 1, ograniczają lub
            wyłączają możliwość uzyskania świadczeń odszkodowawczych za szkodę na osobie, VOTUM zobowiązuje się do zlecenia przeprowadzenia
            analizy eksperckiej biegłemu z zakresu rekonstrukcji wypadków drogowych, celem weryfikacji dokumentacji z postępowania karnego
            lub przygotowania autorskiej opinii w przedmiocie przebiegu wypadku i prawidłowości zachowań jego uczestników.</p>
        <p class="margin_b_0">2. Koszty analizy oraz opinii, o których mowa w ust. 1 ponosi VOTUM, której na mocy odrębnej umowy z ekspertem, będą przysługiwały
            do nich autorskie prawa majątkowe.</p>
        <p class="margin_b_0">3. Udostępnianie, rozpowszechnianie, a także obrót dokumentami, o których mowa w niniejszym paragrafie są możliwe wyłącznie za
            pisemną zgodą VOTUM.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">ZALICZKA NA POCZET ODSZKODOWANIA</label>
        <label class="text_a_center col-md-12 font_w_700">§ 7</label>
        <p class="margin_b_0">W przypadku, gdy ocena okoliczności sprawy wskazuje na istnienie odpowiedzialności po stronie zobowiązanego (w szczególności, jeśli
            poszkodowany był pasażerem lub jest osobą małoletnią poniżej 13-ego roku życia) lub też została ona przez niego przyjęta, VOTUM, na
            wniosek Zleceniodawcy, może udzielić mu zaliczki pieniężnej na poczet przyszłych świadczeń.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">PRAWA I OBOWIĄZKI STRON</label>
        <label class="text_a_center col-md-12 font_w_700">§ 8</label>
        <p class="margin_b_0">1. Zleceniodawca zobowiązuje się do niezwłocznego przekazania VOTUM żądanej przez niego dokumentacji oraz udzielenia informacji
            niezbędnych do wykonania umowy.</p>
        <p class="margin_b_0">2. Czynności wchodzące w zakres umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
            <span class="font_w_700">adwokatów lub radców prawnych</span>, przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy, jak za działania własne.</p>
        <p class="margin_b_0">3. Zleceniodawca upoważnia VOTUM do pozyskiwania informacji o jego stanie zdrowia w zakresie, w jakim jest to niezbędne do
            wykonania umowy.</p>
        <p class="margin_b_0">4. VOTUM oświadcza, że nie zawrze z zobowiązanym ugody w imieniu Zleceniodawcy bez jego uprzedniej zgody. Wyrażenie zgody może
            nastąpić w dowolnej formie z zastrzeżeniem, że zgoda nie może być domniemana lub dorozumiana z oświadczenia woli o innej treści.
            W przypadku złożenia przez zobowiązanego oferty zawarcia ugody bezpośrednio Zleceniodawcy, zobowiązuje się on do niezwłocznego
            poinformowania o tym VOTUM.</p>
        <p class="margin_b_0">5. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM.
            VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 30 dni.</p>
        <p class="margin_b_0">6. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email,
            a w przypadku ich braku – na adres zameldowania/korespondencyjny.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">WYNAGRODZENIE</label>
        <label class="text_a_center col-md-12 font_w_700">§ 9</label>
        <p class="">1. VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych świadczeń w terminie <span class="font_w_700">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim
            potrąceniu należnego VOTUM wynagrodzenia <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przekazem pocztowym / <span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> na wskazany przez Zleceniodawcę rachunek bankowy:</p>
        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">2/3</p>
        </div>
    </div>
    <div class="pdf_strona">
        <div class="form-group col-md-12 paddding_r_0 paddding_l_0 margin_t_10">
            <label class="pdf_duze_litery font_size_10 col-md-12 paddding_l_0">nr rachunku</label>
            <div class="col-md-8 pdf_kratka"><?php echo $wynagrodzenie['WynagrodzenieNumer']; ?></div>
            <label class="pdf_duze_litery font_size_10 col-md-4"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</label>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4 paddding_l_0">Dane odbiorcy wynagrodzenia</p>
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
        <p class="margin_b_0 margin_t_20">W przypadku przekazania przez VOTUM świadczeń przekazem pocztowym, jego koszty obciążają Zleceniodawcę.</p>
        <p class="margin_b_0">2. <span class="font_w_700">VOTUM nie pobiera wynagrodzenia</span> od uzyskanych dla Zleceniodawcy rent, chyba że zobowiązany wypłaca je jednorazowo
            w wysokości należnej za okres co najmniej 6 miesięcy.</p>
        <p class="margin_b_0">3. <span class="font_w_700">VOTUM nie pobiera wynagrodzenia</span> od uzyskanych dla Zleceniodawcy zwrotów kosztów związanych z pogrzebem osoby, o której
            mowa w § 1 umowy.</p>
        <p class="margin_b_0">4. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy.</p>
        <p class="margin_b_0">5. Z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie w wysokości <?php echo $umowa_dane['ProcentWynagrodzenia']; ?> %
            (słownie: <?php echo $umowa_dane['ProcentWynagrodzeniaSlownie']; ?> procent) brutto wartości uzyskanych dla Zleceniodawcy
            świadczeń (w tym podatek od towarów i usług VAT w wysokości 23 %).</p>
        <p class="margin_b_0">6. W przypadku spełnienia świadczenia przez zobowiązanego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej umowy,
            Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania
            należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050
            1575 1000 0023 2392 0799 bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy Zleceniodawca jest małoletni,
            ubezwłasnowolniony częściowo lub całkowicie, albo też gdy jest reprezentowany przez swojego małżonka, przedstawiciel ustawowy,
            kurator lub opiekun, albo małżonek Zleceniodawcy, zawierający umowę w jego imieniu, przyjmuje odpowiedzialność solidarną za zapłatę
            wynagrodzenia VOTUM.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">GWARANCJA BEZPIECZEŃSTWA ZLECENIODAWCY</label>
        <label class="text_a_center col-md-12 font_w_700">§ 10</label>
        <p class="margin_b_0">W przypadku faktycznych bądź prawnych przeszkód w dochodzeniu roszczeń Zleceniodawcy, o których mowa w § 1, odmowy ich
            zaspokojenia przez jednego bądź wszystkich zobowiązanych albo odrzucenia bądź oddalenia w całości powództwa Zleceniodawcy
            o dochodzenie roszczeń odszkodowawczych, <span class="font_w_700">VOTUM zobowiązuje się nie dochodzić od Zleceniodawcy wynagrodzeń oraz zwrotu
                ponoszonych kosztów</span>, które nie zostaną rozliczone z uzyskanych świadczeń, w tym kosztów analizy sprawy i jej prowadzenia na etapie
            przedsądowym i sądowym oraz kosztów reprezentacji w postępowaniu karnym.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">POSTANOWIENIA KOŃCOWE</label>
        <label class="text_a_center col-md-12 font_w_700">§ 11</label>
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
        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
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

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca</p>
            </div>
            <div class="clear_b"></div>
        </div>
        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0">3/3</p>
        </div>
    </div>

