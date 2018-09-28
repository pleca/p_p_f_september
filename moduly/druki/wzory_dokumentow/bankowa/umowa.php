<?php
    setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

    $umowa = json_decode($_POST['umowa'], true);
    $klient = json_decode($_POST['klient'], true);
    $klient2 = json_decode($_POST['klient2'], true);
    $wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
    $umowa_dane = json_decode($_POST['umowa_dane'], true);
    $lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
    $lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];
    $adres_do_korespondencji = json_decode($_POST['adres_do_korespondencji'], true);
    $uprawniony_do_inf_tel = json_decode($_POST['uprawniony_do_inf_tel'], true);

    $stopka = 'PG-2-21-F1/2018-05-24';
    //$stopka = 'PG-2-21-F1/2018-02-10';
    //$stopka_zalacznik = 'PG-2-21-F5/2017-02-16';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek">
        <div class="pdfs_przedstawiciel_dane">
            <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
            <div class="pdf_kratka"><?php echo $umowa['KodJednostki'] ; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod jednostki</p>
            <div class="pdf_kratka"><?php echo $umowa['KonsultantId']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod konsultanta</p>
            <div class="pdf_kratka"></div>
            <p class="pdf_duze_litery font_size_10 margin_b_0 margin_t_2">nr sprawy</p>
        </div>
        <div class="pdfs_tytu_dokumentu">
            <p class="margin_b_0">UMOWA</p>
            <p class="margin_b_0">O DOCHODZENIE ROSZCZEŃ Z UMÓW BANKOWYCH</p>
        </div>
        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>
    <p class="font_w_700 margin_t_10">na podstawie zamówienia z dnia <?php echo $umowa['DataUmowy']; ?> r. złożonego przez:</p>
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
            <div class="pdf_kratka"><?php echo $klient['Ulica'] ; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
            <div class="pdf_kratka"><?php echo $klient['NrDomu'] ; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">mieszkania</label>
            <div class="pdf_kratka"><?php echo $klient['NrMieszkania'] ; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $klient['KodPocztowy'] ; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">miejscowość</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto'] ; ?></div>
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
    </div>
    <p class="font_w_700 col-md-12 margin_t_10 text_a_center margin_b_10">oraz</p>
    <div class="pdf_czerwona_kratka pdf_kratka_duza">
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">imie</label>
            <div class="pdf_kratka"><?php echo $klient2['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">nazwisko</label>
            <div class="pdf_kratka"><?php echo $klient2['Nazwisko']; ?></div>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania zleceniodawcy</p>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ulica</label>
            <div class="pdf_kratka"><?php echo $klient2['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
            <div class="pdf_kratka"><?php echo $klient2['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">mieszkania</label>
            <div class="pdf_kratka"><?php echo $klient2['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $klient2['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">miejscowość</label>
            <div class="pdf_kratka"><?php echo $klient2['Miasto']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">pesel</label>
            <div class="pdf_kratka"><?php echo $klient2['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">seria i numer dowodu</label>
            <div class="pdf_kratka"><?php echo $klient2['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">telefon</label>
            <div class="pdf_kratka"><?php echo $klient2['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">Adres e-mail</label>
            <div class="pdf_kratka"><?php echo $klient2['Mail']; ?></div>
        </div>
    </div>
    <p class="font_w_700 col-md-12 margin_t_0">zwanego/zwanych dalej ZLECENIODAWCĄ</p>
    <label class="text_a_center col-md-12 margin_b_0 margin_t_0">dla</label>
    <label class="pdf_duze_litery pdf_label_kratka pdf_szary_napis margin_l_20">ZLECENIOBIORCY:</label>
    <div class="pdf_szara_kratka pdf_kratka_duza">
        VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks 71/ 33 93 403, e-mail: dok@votum-sa.pl,
        zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
        <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</span>
    </div>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">przedmiot umowy</label>
    <label class="text_a_center col-md-12 font_w_700">§ 1</label>
    <p class="col-md-12">Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności polegających na dochodzeniu
        roszczeń od <?php echo (empty($umowa_dane['Zobowiazany'])) ? '____________________________________________________________' :'<span class="font_w_700">'.$umowa_dane['Zobowiazany'].'</span>'; ?> (zwanego dalej Zobowiązanym) dotyczących umowy kredytu
        <?php echo ($umowa_dane['RodzajKredytu'] == '') ? '____________________________________________________________' :'<span class="font_w_700">'.$umowa_dane['RodzajKredytu'].'</span>'; ?> numer <?php echo (empty($umowa_dane['NrKredytu'])) ? '____________________' : '<span class="font_w_700">'.$umowa_dane['NrKredytu'].'</span>'; ?> indeksowanego bądź denominowanego do waluty
        obcej w związku z zastosowaną przez bank konstrukcją indeksacji oraz ubezpieczeń z nią powiązanych.</p>
    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">OKRES OBOWIĄZYWANIA UMOWY</label>
    <label class="text_a_center col-md-12 font_w_700">§ 2</label>
    <p>Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Zleceniodawcy świadczeń należnych od zobowiązanego
        <span class="font_w_700">w postępowaniu przedsądowym, sądowym i egzekucyjnym.</span></p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</label>
    <label class="text_a_center col-md-12 font_w_700">§ 3</label>
    <p class="margin_b_0">1. W przypadku, gdy Zobowiązany nie zaspokoi roszczeń dotyczących umowy, o której mowa w § 1 lub zaspokoi je w niższej niż należna
            wysokości, sprawa może zostać skierowana na drogę postępowania sądowego. Skierowanie sprawy na drogę postępowania sądowego
            przeciwko zobowiązanemu wymaga zgody obu stron umowy.</p>
    <p class="margin_b_0">2. W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie postępowania sądowego, zobowiązuje się on do niezwłocznego
        przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy oraz wszelkiej żądanej przez niego dokumentacji
        i oświadczeń, które będą przydatne do wykonania umowy.</p>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">1/4</p>
    </div>
</div>

<div class="pdf_strona">
    <p class="margin_b_0">3. <span class="font_w_700">VOTUM pokrywa koszty wynagrodzenia pełnomocnika procesowego,</span> za wyjątkiem kosztów przejazdów pełnomocnika procesowego
        na rozprawy, w wysokości określonej przez przepisy Rozporządzenia Ministra Infrastruktury w sprawie warunków ustalania oraz sposobu
        dokonywania zwrotu kosztów używania do celów służbowych samochodów osobowych, motocykli i motorowerów niebędących
        własnością pracodawcy (Dz. U. z 2002 r. nr 27,poz. 271) albo kosztów zastępstwa substytucyjnego w wysokości nie przekraczającej 300
        zł (słownie: trzystu złotych) od każdego posiedzenia, do pokrycia których zobowiązany będzie Zleceniodawca.</p>
    <p class="margin_b_0">4. W przypadku braku zwolnienia przez sąd z kosztów sądowych, do ich pokrycia zobowiązuje się Zleceniodawca.</p>
    <p class="">5. Koszty procesu zasądzone od zobowiązanego przypadają VOTUM lub Zleceniodawcy w części, w jakiej zostały poniesione przez każdą
        ze stron, z tym, że koszty zastępstwa procesowego zasądzone w sprawie przypadają pełnomocnikowi procesowemu, o którym mowa
        w § 4 ust. 1.</p>
    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700">PRAWA I OBOWIĄZKI STRON</label>
    <label class="text_a_center col-md-12 font_w_700">§ 4</label>
    <p class="margin_b_0">1. Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
        <span class="font_w_700">adwokatów lub radców prawnych,</span> przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy jak za działania własne.</p>
    <p class="margin_b_0">2. <span class="font_w_700">VOTUM oświadcza, że nie zawrze w imieniu Zleceniodawcy ugody ze zobowiązanym bez jego zgody.</span> Wyrażenie zgody może nastąpić
        w dowolnej formie. W przypadku złożenia oferty zawarcia ugody przez zobowiązanego bezpośrednio Zleceniodawcy, zobowiązuje się
        on do niezwłocznego poinformowania o tym VOTUM.</p>
    <p class="margin_b_0">3. Zleceniodawca zobowiązuje się do niezwłocznego przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu
        umowy oraz wszelkiej żądanej przez niego dokumentacji i oświadczeń, które będą przydatne do wykonania umowy, w szczególności:</p>
    <p class="margin_b_0">a) kopii dowodu osobistego potwierdzonego za zgodność z oryginałem przez notariusza lub organ gminy,</p>
    <p class="margin_b_0">b) kopii umowy kredytu bankowego wraz z aneksami (jeżeli takowe były zawierane),</p>
    <p class="margin_b_0">c) kopii regulaminu kredytów i pożyczek hipotecznych załączonego do umowy kredytu bankowego,</p>
    <p class="margin_b_0">d) kopii Tabeli Opłat i Prowizji załączonej do umowy kredytu bankowego,</p>
    <p class="margin_b_0">e) otrzymanych od Zobowiązanego harmonogramów spłaty rat,</p>
    <p class="margin_b_0">f) kopii potwierdzeń spłaty rat,</p>
    <p class="margin_b_0">g) kopii pism oraz decyzji Zobowiązanego w przedmiocie udzielonego kredytu.</p>
    <p class="margin_b_0">4. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM.
        VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 30 dni.</p>
    <p class="">5. Informacje o sposobie wykonywania umowy mogą być przekazywane na wskazany w umowie nr telefonu, adres e-mail, pocztą lub
        na konto Klienta dostępne za pośrednictwem strony internetowej VOTUM.</p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">WYNAGRODZENIE</label>
    <label class="text_a_center col-md-12 font_w_700">§ 5</label>
    <p class="">1. VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych świadczeń w terminie <span class="font_w_700">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim
        potrąceniu należnego VOTUM wynagrodzenia <!--<span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 1) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span> przekazem pocztowym / <span class="glyphicon glyphicon<?php /*echo ($wynagrodzenie['SposobPlatnosciId'] == 2) ? '-check' : '-unchecked' ; */?>" aria-hidden="true"></span>--> na wskazany przez Zleceniodawcę rachunek bankowy:</p>
    <div class="form-group col-md-12 paddding_r_0 paddding_l_0 margin_t_10">
        <label class="pdf_duze_litery font_size_10">nr rachunku</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieNumer']; ?></div>
    </div>
    <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4 paddding_l_0">POSIADACZ RACHUNKU</p>
    <div class="form-group col-md-6 paddding_l_0">
        <label class="pdf_duze_litery font_size_10 ">imie</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieImie']; ?></div>
    </div>
    <div class="form-group col-md-6 paddding_r_0">
        <label class="pdf_duze_litery font_size_10">nazwisko</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieNazwisko']; ?></div>
    </div>
    <div class="form-group col-md-4 paddding_l_0">
        <label class="pdf_duze_litery font_size_10 ">ulica</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieUlica']; ?></div>
    </div>
    <div class="form-group col-md-1 paddding_r_0">
        <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieNrDomu']; ?></div>
    </div>
    <div class="form-group col-md-1 paddding_l_0">
        <label class="pdf_duze_litery font_size_10">mieszkania</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieNrMieszkania']; ?></div>
    </div>
    <div class="form-group col-md-2">
        <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieKodPocztowy']; ?></div>
    </div>
    <div class="form-group col-md-4  paddding_r_0">
        <label class="pdf_duze_litery font_size_10">miejscowość</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieMiasto']; ?></div>
    </div>
    <div class="clear_b margin_b_10"></div>
    <p class="margin_b_0 margin_t_20">2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej
        umowy.</p>
    <p class="margin_b_0">3. VOTUM przysługuje wynagrodzenie w kwocie 350 zł (słownie trzysta pięćdziesiąt złotych) brutto (w tym podatek od towarów i usług
        VAT w wysokości 23%) za analizę merytoryczną dokumentacji i roszczeń Klienta.</p>
    <p class="margin_b_0">4. Zleceniodawca uiszcza z góry wynagrodzenie, o którym mowa w ust. 3 powyżej, na rachunek VOTUM o numerze: 40 1050 1575
        1000 0023 1250 6476, w terminie 7 dni od dnia doręczenia Zleceniodawcy informacji VOTUM o zarejestrowaniu sprawy i nadaniu jej
        numeru, który należy podać w tytule przelewu. VOTUM może wstrzymać się z wykonaniem umowy do dnia uiszczenia wynagrodzenia,
        o którym mowa w ust. 3 powyżej.</p>
    <p class="margin_b_0">5. W przypadku braku podstaw do prowadzenia sprawy, wynagrodzenia nie pobiera się i Klient nie jest zobowiązany do dokonania
        wpłaty wskazanej w ust. 3, a jeżeli wpłacił wynagrodzenie, podlega ono zwrotowi. Zwrot wynagrodzenia nastąpi niezwłocznie, nie
        później niż w terminie 14 dni od dnia ustalenia braku podstaw do prowadzenia sprawy, na rachunek bankowy Klienta lub w innej,
        uzgodnionej pomiędzy stronami formie.</p>
    <p class="margin_b_0">6. Z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie w wysokości <?php echo (empty($umowa_dane['ProcentWynagrodzenia'])) ? '__________' :'<span class="font_w_700">'.$umowa_dane['ProcentWynagrodzenia'].'</span>'; ?> %
        (słownie: <?php echo (empty($umowa_dane['ProcentWynagrodzeniaSlownie'])) ? '_______________' : $umowa_dane['ProcentWynagrodzeniaSlownie']; ?> %) brutto (w tym podatek od towarów i usług VAT w wysokości 23%) wartości uzyskanych dla
        Zleceniodawcy świadczeń, niezależnie od wynagrodzenia, o którym mowa w ust. 3.</p>






    <p class="margin_b_0">7. Dodatkowo VOTUM przysługuje zwrot <span class="font_w_700">udokumentowanych</span> kosztów:</p>
    <p class="margin_b_0">a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych opłat
        skarbowych oraz opłat sądowych,</p>
    <p class="margin_b_0">b) opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie postępowania w sprawie rozwiązywania
        sporów między klientem a podmiotem rynku finansowego do Rzecznika Finansowego;</p>
    <p class="margin_b_0">c) opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie umowy o przeprowadzenie mediacji w centrum mediacji Sądu
        Polubownego przy Komisji Nadzoru Finansowego.</p>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">2/4</p>
    </div>
</div>

<div class="pdf_strona">

    <p class="margin_b_0">8. VOTUM nie pobiera wynagrodzenia w przypadku wypowiedzenia umowy przez Klienta. Jeżeli wypowiedzenie nastąpiło bez ważnego
        powodu, a na skutek wykonania umowy Klient uzyskał świadczenie pieniężne, VOTUM może domagać się naprawienia szkody wyłącznie
        do kwoty wysokości wynagrodzenia, jakie zostałoby naliczone, gdyby Klient nie wypowiedział umowy</p>
    <p class="margin_b_0">9. W przypadku spełnienia świadczenia przez zobowiązanego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej umowy,
        Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania
        należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575
        1000 0023 2392 0799 bądź w inny sposób wskazany przez VOTUM. </p>
    <p class="margin_b_0">10. Za zobowiązania wynikające z niniejszej umowy Zleceniodawcy ponoszą odpowiedzialność solidarną.</p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">POSTANOWIENIA KOŃCOWE</label>
    <label class="text_a_center col-md-12 font_w_700">§ 6</label>
    <p class="margin_b_0">1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.</p>
    <p class="margin_b_0">2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.</p>
    <p class="margin_b_0">3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednej dla każdej ze stron.</p>
    <p class="">4. Integralną częścią niniejszej umowy jest załącznik – Klauzule informacyjne dla Klienta.</p>

    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_20"></div>
    <p class="margin_b_0 font_size_10">Klient oświadcza, że __ upoważnia/ __ nie upoważnia Zleceniobiorcę do uzyskiwania informacji i dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku z realizacją niniejszej umowy.</p>
<!--    <p class="margin_b_0 font_size_10">1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,</p>-->
<!--    <p class="margin_b_0 font_size_10">2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od których będą uzyskiwane-->
<!--        informacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,</p>-->
<!--    <p class="margin_b_0 font_size_10">3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,</p>-->
<!--    <p class="margin_b_0 font_size_10">4. podanie VOTUM danych osobowych jest dobrowolne, lecz niezbędne dla celów wykonania umowy.</p>-->

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

    <div class="col-md-12 margin_t_20">
        <p class="margin_b_0 margin_t_20 font_w_700">Oświadczenie</p>
        <p class="">Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>
    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">3/4</p>
    </div>

</div>

<div class="pdf_strona">

    <label class="pdf_label_kratka pdf_szary_napis margin_l_20">ADRES DO KORESPONDENCJI (Wypełnić jeśli inny niż w przypadku zleceniodawcy):</label>
    <div class="pdf_czerwona_kratka pdf_kratka_duza">
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">imie</label>
            <div class="pdf_kratka"><?php echo ($umowa_dane['AdresKorJakZameldowania'] == 0 ) ? $klient['Imie'] : ''; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">nazwisko</label>
            <div class="pdf_kratka"><?php echo ($umowa_dane['AdresKorJakZameldowania'] == 0 ) ? $klient['Nazwisko'] : ''; ?></div>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres do krespondencji zleceniodawcy</p>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ulica</label>
            <div class="pdf_kratka"><?php echo $adres_do_korespondencji['KorUlica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
            <div class="pdf_kratka"><?php echo $adres_do_korespondencji['KorNrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">mieszkania</label>
            <div class="pdf_kratka"><?php echo $adres_do_korespondencji['KorNrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $adres_do_korespondencji['KorKodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">miejscowość</label>
            <div class="pdf_kratka"><?php echo $adres_do_korespondencji['KorMiasto']; ?></div>
        </div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_t_10">
        <div class="pdf_kratka_duza_naglowek font_w_700 pdf_duze_litery">UPRAWNIONY DO UZYSKANIA INFORMACJI TELEFONICZNEJ</div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">imie</label>
            <div class="pdf_kratka"><?php echo $uprawniony_do_inf_tel['Imie']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">nazwisko</label>
            <div class="pdf_kratka"><?php echo $uprawniony_do_inf_tel['Nazwisko']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">pesel</label>
            <div class="pdf_kratka"><?php echo $uprawniony_do_inf_tel['Pesel']; ?></div>
        </div>
    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery">miejscowość i data.</p>
        </div>
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_b_10">
        <div class="pdf_kratka_duza_naglowek font_w_700 pdf_duze_litery">LISTA DOKUMENTACJI POBRANEJ OD KLIENTA</div>
        <p class="col-md-12 padding_10 margin_t_10">
        <div class="pdf_duze_litery">ILOŚĆ DOKUMENTÓW POBRANYCH OD KLIENTA</div>
            <?php
                foreach($lista_dostepnej_dokumentacji as $poj_dok => $poj_dok_war){
            ?>
                    <span class="glyphicon glyphicon<?php echo (strpos($lista_pobranej_dokumentacji,($poj_dok)) !== false) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> <?php echo $poj_dok_war; ?>;
            <?php
                }
            ?>
        </p>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_b_10">
        <div class="pdf_kratka_duza_naglowek font_w_700 pdf_duze_litery">ODPOWIEDZIALNOŚĆ ZOBOWIĄZANEGO</div>
        <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> ZGŁOSZONO ROSZCZENIE DO BANKU O ZWROT
            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgloszenieRoszczenDoBanku'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> NIE ZGŁOSZONO ROSZCZEŃ</p>
        <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nadpłaconych rat w związku z zastosowaną indeksacją</p>
        <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($umowa_dane['UbezpieczeniPomostowe'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia pomostowego, data zgłoszenia: <?php echo (empty($umowa_dane['UbezpieczeniePomostoweData'])) ? '_______________' : $umowa_dane['UbezpieczeniePomostoweData']; ?> r.</p>
        <p class="col-md-12 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['UbezpieczenieWkladu'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia wkładu własnego, data zgłoszenia: <?php echo (empty($umowa_dane['UbezpieczenieWkladuData'])) ? '_______________' : $umowa_dane['UbezpieczenieWkladuData']; ?> r.</p>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek font_w_700 pdf_duze_litery">DOCHODZENIE ROSZCZEŃ</div>
        <p class="col-md-12 margin_t_10"><span class="glyphicon glyphicon<?php echo ($umowa_dane['ZlecenieDochodzeniaRoszczen'] != 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi</p>
        <p class="col-md-12 "><span class="glyphicon glyphicon<?php echo ($umowa_dane['ZlecenieDochodzeniaRoszczen'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> sprawę zlecano wcześniej pełnomocnikowi <?php echo (empty($umowa_dane['PelnomocnikNazwa'])) ? '____________________________________________________________' : $umowa_dane['PelnomocnikNazwa']; ?></p>
        <p class="col-md-12">z którym zawarto umowę dnia <?php echo (empty($umowa_dane['PelnomocnikDataZawarcia'])) ? '____________________' : $umowa_dane['PelnomocnikDataZawarcia']; ?></p>
        <p class="col-md-12 margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['PelnomocnikWypowiedzenieUmowy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowę z wyżej wymienionym wypowiedziano w dniu <?php echo (empty($umowa_dane['PelnomocnitWypowiedzenieUmowyData'])) ? '____________________' : $umowa_dane['PelnomocnitWypowiedzenieUmowyData']; ?></p>

    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_20">
        <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
            <p class="margin_b_0"><?php echo (!empty($umowa['Miasto']) && !empty($umowa['DataUmowy'])) ? $umowa['Miasto'].', '.$umowa['DataUmowy'] : '&nbsp;' ; ?></p>
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery">miejscowos i data</p>
        </div>
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <p class="margin_b_0">&nbsp;</p>
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <p class="margin_b_0 margin_t_20 font_size_10 font_w_700">Oświadczenie</p>
    <p class="font_size_10 font_w_700">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A. oświadczam, że podpisy Zleceniodawcy/ców widniejące na formularzu umowy oraz pełnomocnictwie
        zostały złożone w mojej obecności własnoręcznie przez Zleceniodawcę/ców.</p>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CZYTELNY PODPIS PRZEDSTAWICIELA</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">4/4</p>
    </div>
</div>
<div class="pdf_strona pdf_strona_zalacznik">
    <div class="">
        <div class="pdfs_tytu_doumentu_zalacznik">
            <p class="margin_b_0"></p>
            <p class="margin_b_30 margin_t_120 pdf_duze_litery font_w_70055">ZAŁĄCZNIK - Klauzula informacyjna dla klienta</p>
        </div>
        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>
    <p class="margin_b_30 margin_t_50 font_w_700">§1 Informacje</p>
    <ol class="roman">
        <li class="margin_b_10">VOTUM S.A. z siedzibą we Wrocławiu informuje, że w związku z obowiązkami wynikającymi z ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (RODO), dane osobowe podane przez Klienta w umowie i załącznikach do umowy, jak również dane uzyskane w trakcie jej wykonywania będą przetwarzane przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, wpisana do rejestru przedsiębiorców KRS pod numerem 0000243252 (dalej „Spółka”), która stanie się Administratorem tych danych.</li>
        <li class="margin_b_10">Uzyskanie informacji o procesach przetwarzania danych osobowych możliwe jest poprzez kontakt z Inspektorem Ochrony Danych w formie elektronicznej: e-mail iod@votum-sa.pl lub pisemnej: Inspektor Ochrony Danych, ul. Wyścigowa 56i, 53-012 Wrocław. </li>
        <li class="margin_b_10">Dane osobowe przetwarzane będą w następujących celach oraz na podstawie następujących przesłanek:
            <ol class="numerowanie">
                <li>Wykonie umowy na rzecz klienta, podstawą prawną jest art. 6 ust. 1 lit b RODO.</li>
                <li>Marketing usług własnych, wykorzystywane do tego celu będą środki komunikacji w tym telefon oraz email, podstawą prawną jest art. 6 ust. 1 lit. f) RODO.</li>
                <li>Zapewnienie prawidłowości podatkowych po wystawieniu faktury, podstawą prawna jest art. 6 ust. 1 lit. c) RODO uszczegółowienie w art. 70 §1 Ordynacji Podatkowej</li>
                <li>W przypadku wyrażenia dodatkowych zgód (art. 6 ust.1 lit a), dane osobowe będą przetwarzane w celu zaproponowania usług podmiotów powiązanych z VOTUM S.A wskazanym w §2 poniżej</li>
            </ol>
        </li>
        <li class="margin_b_10">Dane osobowe udostępnione będą bankom udzielającym kredytów indeksowanych bądź denominowanych do waluty obcej w związku z zastosowaną indeksacją oraz ubezpieczeń z nimi powiązanym, a w razie takiej potrzeby - organom państwowym.</li>
        <li class="margin_b_10">W zależności o celu przetwarzania dane osobowe Klienta będą przetwarzane przez następujący okres czasu:
            <ol class="numerowanie">
                <li>W związku z możliwością podniesienia roszczeń z kodeksu cywilnego, przez okres do 10 lat od momentu zakończenia umowy. </li>
                <li>W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu wniesienia sprzeciwu na marketing usług VOTUM S.A.</li>
                <li>W związku z wymogami ustawy, przez okres 5 lat + bieżący rok podatkowy od momenty wystawienia faktury</li>
                <li>W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu wniesienia sprzeciwu na marketing wskazanego podmiotu.</li>
            </ol>
        </li>
        <li class="margin_b_10">Klient ma prawo dostępu do swoich danych, ich sprostowania, usunięcia lub ograniczenia przetwarzania a także do wniesienia sprzeciwu wobec przetwarzania danych, w tym na marketing usług własnych VOTUM S.A. Klient jest uprawniony do cofnięcia wyrażonej zgody na przetwarzanie danych w każdym czasie, a także do wniesienia skargi w związku z przetwarzaniem danych do organu nadzorczego – Prezesa Urzędu Ochrony Danych Osobowych. </li>
        <li class="margin_b_10">Podanie danych jest dobrowolne jednakże niezbędne dla celów wykonania umowy.
            W przypadku braku podania danych lub niewyrażenia zgody na ich przetwarzanie, realizacja umowy może stać się niemożliwa.
        </li>
        <li class="margin_b_10">Dane osobowe wskazane w umowie, będą podlegały profilowaniu, które ma na celu dopasowanie i zaproponowanie Klientowi nowych usług. Każdorazowo przed podjęciem decyzji w tym przedmiocie dane osobowe będą weryfikowane przez pracownika VOTUM S.A.</li>
    </ol>
    <p class="margin_t_15">Oświadczam, że zapoznałem się z treścią informacji zawartych w §1</p>
    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 text_a_right">podpis Klienta/osoby działającej w imieniu Klienta</p>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"></div>
        <p class="text_a_center margin_b_0"></p>
    </div>
</div>

<div class="pdf_strona pdf_strona_zalacznik">
    <p class="margin_b_30 margin_t_50 font_w_700">§2 Zgody Klienta</p>
    <ol class="roman">
        <li class="margin_b_10">Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym podmiotom
            <ol class="numerowanie">
                <li class="margin_b_10"><b>DSA Investment S.A.</b>Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty produktów finansowych i ubezpieczeń osobowych: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li class="margin_b_10">
                <li><b>Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k.</b> Golikówka 6, 30-723 Kraków, KRS: 0000290430  , w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDanePCRF'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDanePCRF'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>Fundacja VOTUM</b> ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneFundacja'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneFundacja'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>AUTOVOTUM S.A.</b> ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty usług wynajmu pojazdów zastępczych; <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneAutovotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneAutovotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>Biuro Ekspertyz Procesowych sp. z o.o.</b> Aleja Wiśniowa 47, 53-126 Wrocław, KRS:  0000565095, w zakresie danych teleadresowych w celu sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe. <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneBEP'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneBEP'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
            </ol>
        </li>
        <li class="margin_b_10">Wyrażam zgodę na wykonywanie następujących czynności przez:
            <ol class="numerowanie">
                <li class="margin_b_10"><b>DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,</b>
                    <ol class="numerowanie_alfabet_male">
                        <li class="margin_b_10">Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                        <li class="margin_b_10">Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                    </ol>
                </li>
                <li class="margin_b_10"><b>VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,  </b>
                    <ol class="numerowanie_alfabet_male">
                        <li class="margin_b_10">przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z 	ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfVotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfVotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                        <li class="margin_b_10">przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu 	automatycznych 	systemów wywołują¬cych w rozumieniu ustawy z dn.16.07.2004 r. Prawo 	telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 	1907): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingVotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingVotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
    </ol>
    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 text_a_right">podpis Klienta/osoby działającej w imieniu Klienta</p>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"></div>
        <p class="text_a_center margin_b_0"></p>
    </div>
</div>
<?php
    if($umowa_dane['ListaDodatkowychKlientow'] != 0){
        $lista_dodatkowych_klientow = json_decode($_POST['lista_dodatkowych_klientow']);
?>
    <div class="pdf_strona pdf_strona_zalacznik">
        <div class="pdf_strona_pierwsza_naglowek">
            <div class="pdfs_przedstawiciel_dane">
                <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
                <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
                <div class="pdf_kratka"></div>
                <p class="pdf_duze_litery font_size_10 margin_b_0 margin_t_2">nr sprawy</p>
            </div>
            <div class="pdfs_tytu_dokumentu_zalacznik">
                <p class="margin_b_0"></p>
                <p class="margin_b_0 pdf_duze_litery">ZAŁĄCZNIK NR 1 DO UMOWY</p>
                <p class="margin_b_0 pdf_duze_litery">O DOCHODZENIE ROSZCZEŃ Z UMÓW BANKOWYCH</p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <p class="margin_b_0 margin_t_0 font_w_700">zawartej na podstawie oferty z dnia <?php echo $umowa['DataUmowy'] ?> r.</p>
        <?php
            $nr_str = 1;
            for($i=0;$i<count($lista_dodatkowych_klientow);$i++){
                if($i == 4){
                    ?>
                    <div class="pdf_strona_stopka col-md-12 margin_b_0">
                        <div class="pdf_strona_stopka_wersja"><?php echo $stopka_zalacznik; ?></div>
                        <p class="text_a_center margin_b_0"><?php echo $nr_str++; ?>/<?php echo $nr_str; ?></p>
                    </div>
                    </div>
                        <div class="pdf_strona pdf_strona_zalacznik">
                            <div class="pdf_strona_pierwsza_naglowek">
                                <div class="pdfs_przedstawiciel_dane">
                                    <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
                                    <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
                                    <div class="pdf_kratka"></div>
                                    <p class="pdf_duze_litery font_size_10 margin_b_0 margin_t_2">nr sprawy</p>
                                </div>
                                <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
                            </div>
                    <?php
                }
                ?>
                    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_b_10">
                        <div class="pdf_kratka_duza_naglowek font_w_700 pdf_duze_litery">zleceniodawca <?php echo $i+3; ?></div>
                        <div class="form-group col-md-6 margin_t_10">
                            <label class="pdf_duze_litery font_size_10">imie</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Imie; ?></div>
                        </div>
                        <div class="form-group col-md-6 margin_t_10">
                            <label class="pdf_duze_litery font_size_10">nazwisko</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Nazwisko; ?></div>
                        </div>
                        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania zleceniodawcy</p>
                        <div class="form-group col-md-4">
                            <label class="pdf_duze_litery font_size_10">ulica</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Ulica; ?></div>
                        </div>
                        <div class="form-group col-md-1 paddding_r_0">
                            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->NrDomu; ?></div>
                        </div>
                        <div class="form-group col-md-1 paddding_l_0">
                            <label class="pdf_duze_litery font_size_10">mieszkania</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->NrMieszkania; ?></div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->KodPocztowy; ?></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="pdf_duze_litery font_size_10">miejscowość</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Miasto; ?></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="pdf_duze_litery font_size_10">pesel</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Pesel; ?></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="pdf_duze_litery font_size_10">seria i numer dowodu</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Dowod; ?></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="pdf_duze_litery font_size_10">telefon</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Telefon; ?></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="pdf_duze_litery font_size_10">Adres e-mail</label>
                            <div class="pdf_kratka"><?php echo $lista_dodatkowych_klientow[$i]->Mail; ?></div>
                        </div>
                    </div>
                <?php
            }
        ?>
        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery">VOTUM S.A.</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">zleceniodawca</p>
            </div>
            <div class="clear_b"></div>
        </div>
        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka_zalacznik; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_str; ?>/<?php echo $nr_str; ?></p>
        </div>
    </div>
<?php
    }
?>

<?php
/*    if($umowa_dane['AdresKorJakZameldowania'] == 0){
*/?><!--
    <div class="pdf_strona">
        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
                <p class="margin_b_0 pdf_duze_litery"><?php /*echo $klient['Imie'].' '.$klient['Nazwisko']; */?></p>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_20 font_size_10 pdf_duze_litery">imię i nazwisko</p>

                <p class="margin_t_20 margin_b_0 pdf_duze_litery"><?php /*echo $klient['Ulica'].', '.$klient['NrDomu'].((!empty($klient['NrMieszkania'])) ? '' : '/'.$klient['NrMieszkania'] ); */?></p>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_20 font_size_10 pdf_duze_litery ">adres zameldowania, ulica, nr domu/mieszkania</p>

                <p class="margin_t_20 margin_b_0 pdf_duze_litery"><?php /*echo $klient['KodPocztowy'].', '.$klient['Miasto']; */?></p>
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery ">kod pocztowy, miejscowość</p>
            </div>
            <div class="pdf_podpisy_p float_r col-md-3 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_center">miejscowosc i data</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <p class="col-md-12 margin_b_0 margin_t_60 pdf_duze_litery text_a_center font_w_700 font_size_26">OŚWIADCZENIE</p>

        <p class="col-md-12 margin_b_0 margin_t_60">
            Ja/my* niżej podpisany/a/ni* <span class="font_w_700"><?php
/*                    echo $klient['Imie'].' '.$klient['Nazwisko'];
                    if(!empty($klient2['Imie']) && !empty($klient2['Nazwisko'])){
                        echo ', '.$klient2['Imie'].' '.$klient2['Nazwisko'];
                    }

                    for($i=0;$i<count($lista_dodatkowych_klientow);$i++){
                        echo ', '.$lista_dodatkowych_klientow[$i]->Imie.' '.$lista_dodatkowych_klientow[$i]->Nazwisko;
                    }
                */?></span>
            proszę/prosimy o przesyłanie wszelkiej korespondencji dotyczącej sprawy o dochodzenie roszczenia z umowy kredytu hipotecznego nr <span class="font_w_700"><?php /*echo $umowa_dane['NrKredytu']; */?></span>
            indeksowanego bądź denominowanego do waluty obcej na poniżej wskazany adres korespondencyjny:
            <span class="font_w_700"><?php /*echo $adres_do_korespondencji['KorUlica'].' '.$adres_do_korespondencji['KorNrDomu'].((!empty($adres_do_korespondencji['KorNrMieszkania'])) ? '' : '/'.$adres_do_korespondencji['KorNrMieszkania'] ).', '.$adres_do_korespondencji['KorKodPocztowy'].' '.$adres_do_korespondencji['KorMiasto'] */?></span>
        </p>
        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-4 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">Własnoręczny podpis zleceniodawcy/ców</p>
            </div>
            <div class="clear_b"></div>
        </div>
    </div>
--><?php
/*    }
*/?>
