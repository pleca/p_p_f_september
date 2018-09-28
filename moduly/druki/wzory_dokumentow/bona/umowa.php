<?php
    setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

    $umowa = json_decode($_POST['umowa'], true);
    $klient = json_decode($_POST['klient'], true);
    $wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
    $umowa_dane = json_decode($_POST['umowa_dane'], true);
    $lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
    $lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];



    $stopka = 'PG-2-18-F1/2017-01-19';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek_bona">
        <div class="pdfs_przedstawiciel_dane">
            <div class="pdf_kratka"><?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">Identyfikator przedstawiciela</p>
        </div>
        <div class="pdfs_tytu_dokumentu pdf_tytul_bona">
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">UMOWA</p>
            <p class="margin_b_0 font_w_700 font_size_18 text_a_center">O DOCHODZENIE ROSZCZEŃ ODSZKODOWAWCZYCH "BONA"</p>
        </div>
        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>
    <p class="font_w_700 margin_t_10">na podstawie zamówienia z dnia <?php echo $umowa['DataUmowy']; ?> r. złożonego przez:</p>
    <label class="pdf_duze_litery pdf_label_kratka pdf_czarny_napis margin_l_20">WŁAŚCICIEL / WSPÓŁWŁAŚCICIEL</label>
    <div class="pdf_czerwona_kratka pdf_kratka_duza">
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">imie</label>
            <div class="pdf_kratka"><?php echo $klient['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6">
            <label class="pdf_duze_litery font_size_10">nazwisko / firma</label>
            <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
        </div>
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
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">nip</label>
            <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">regon</label>
            <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">krs</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-12">
            <label class="pdf_duze_litery font_size_10">reprezentowana(y) przez</label>
            <div class="pdf_kratka"><?php echo $klient['Mail']; ?></div>
        </div>
    </div>

    <p class="margin_b_0 font_size_12 margin_l_20">Należy wypełnić właściwe pola. W przypadku osób fizycznych: imię i nazwisko, adres, PESEL, seria i numer dowodu osobistego,
        w przypadku osób fizycznych prowadzących działalność gospodarczą: imię i nazwisko, firma, adres, NIP, REGON, w przypadku spółek prawa handlowego
        i innych podmiotów prowadzących działalnośc gospodarczą: firma, siedziba, adres, NIP, REGON, KRS oraz sposób reprezentacji, zgodny z KRS.</p>

    <p class="col-md-12 margin_t_10">zwanego dalej <span class="font_w_700">"Zleceniodawcą"</span>,</p>
    <label class="text_a_center col-md-12">dla</label>
    <div class="pdf_szara_kratka pdf_kratka_duza">
        VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks 71/ 33 93 403, e-mail: dok@votum-sa.pl,
        zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
        <span class="pdf_czerowny_napis">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</span>
    </div>

    <p class="col-md-12 margin_t_10">zwaną dalej <span class="font_w_700">"VOTUM"</span>, o następującej treści:</p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">PRZEDMIOT UMOWY</label>
    <label class="text_a_center col-md-12 font_w_700">§ 1</label>
    <p class="col-md-12">1. VOTUM zobowiązuje się do powzięcia czynności mających na celu uzyskanie należnych Zleceniodawcy świadczeń odszkodowawczych od podmiotu
    obowiązanego do zapewnienia ochrony ubezpieczeniowej (zwanego dalej "Zobowiązanycm"), za szkodę majątkową powstałą na skutek zdarzenia z dnia <?php echo '?DANE?'; ?>.</p>
    <p class="col-md-12">2. VOTUM podejmuje czynności, o których mowa w ust. 1, na podstawie dokumentów uzyskanych od Zleceniodawcy.</p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">WYNAGRODZENIE</label>
    <label class="text_a_center col-md-12 font_w_700">§ 2</label>
    <p>1. VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych świadczeń odszkodowawczych w terminie <span class="font_w_700">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM wynagrodzenia,
     za pośrednictwem <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przekazu pocztowego lub
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> przelewem bankowym na wskazany przez Zleceniodawcę rachunek bankowy:</p>
    <div class="form-group col-md-12 paddding_r_0 paddding_l_0 margin_t_10">
        <label class="pdf_duze_litery font_size_10">nr rachunku</label>
        <div class="pdf_kratka"><?php echo $wynagrodzenie['WynagdorzenieNumer']; ?></div>
    </div>
    <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4 paddding_l_0">Dane odbiorcy wynagrodzenia</p>
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
    <p class="font_size_12">Jeżeli Zleceniodawca, wskazał przekaz pocztowy jako formę przekazania na Jego rzecz uzyskanych świadczeń odszkodowawczych,
        VOTUM przysługuje zwrot kosztów przekazu pocztowego.</p>

    <p class="margin_b_0">2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy.</p>
    <p class="margin_b_0">3. Z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie w wysokości <?php echo '?DANE?'; ?> % (słownie: <?php echo '?DANE?'; ?>) brutto wartości uzyskanych dla Zleceniodawcy świadczeń
        (w tym podatek od towarów i usług VAT w wysokości 23%).</p>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">1/3</p>
    </div>
</div>

    <div class="pdf_strona">

    <p class="margin_b_0">4. Dodatkowo VOTUM przysługuje zwrot udokumentowanych kosztów:</p>
    <p class="margin_b_0">a) wykonania operaty szacunkowego lub opinii, w celu udokumentowania przyczyn powstania szkody, stanu faktycznego po powstaniu szkody i oszacowania wartości szkody,
    jeżeli w trakcie postępowania likwidacyjnego niezbędne okaże się wykonanie tych czynności przez rzeczoznawcę majątkowego, biegłego lub specjalistę z danej dziedziny; w razie potrzeby wykonania
        operatu szacunkowego lub opinii, o ktorych wyżej mowa, VOTUM pinformuje Zleceniodawcę i po uzyskaniu jego zgody, zleci ich wykonanie ww. podmiotom.</p>
    <p class="margin_b_0">b) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnascie złotych) od każdego pełnomocnictwa, innych opłat skarbowych oraz sądowych,</p>
    <p class="margin_b_0">c) określonej w przepisach prawa opłaty za postępowanie pozasądowe prowadzone przed Rzecznikiem Finansowym w wysokości 50,00zł, po uprzednim wyrażeniu zgody na takie postępowanie przez Zleceniodawcę</p>
        <p class="margin_b_0">d) określonej w przepisach prawa opłaty za mediacje przed Sądem Polubownym przy komisji Nadzoru Finansowego w wysokości 50,00zł, po uprzednim wyrażeniu zgody na takie postępowanie przez Zleceniodawcę</p>
    <p class="margin_b_0">5. W przypadku spełnienia świadczenia przez Zobowiązanego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej umowy, Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM
        i wypłacić w terminie 7 dni roboczych od dnia jego otrzymania należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu nr 70 1050 1575 1000 0023 2392 0799, bądź w inny sposób wskazany przez VOTUM.</span></p>

    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">OKRES OBOWIĄZYWANIA UMOWY</label>
    <label class="text_a_center col-md-12 font_w_700">§ 3</label>
        <p class="margin_b_0">Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Zleceniodawcy świadczeń należnych od Zobowiązanego
            <span class="font_w_700">w postępowaniu przedsądowym, sądowym i egzekucyjnym</span>.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</label>
        <label class="text_a_center col-md-12 font_w_700">§ 4</label>
        <p class="margin_b_0">1. Skierowanie sprawy na drogę postępowania sądowego przeciwko Zobowiązanemu wymaga zgody obu stron umowy.</p>
        <p class="margin_b_0">2. W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie postępowania sądowego, zobowiązuje się on do niezwłocznego przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu
            umowy oraz wszelkiej żądanej przez niego dokumentacji i oświadczeń, które będą przydatne do wykonania umowy.</p>
        <p class="margin_b_0"><span class="font_w_700">3. VOTUM pokrywa koszty wynagrodzenia pełnomocnika procesowego</span>, za wyjątkiem kosztów przejazdów pełnomocnika procesowego na rozprawy, w wysokości określonej przez przepisy
        Rozporządzenia Ministra Infrastruktury w sprawie warunków ustalania oraz sposobu dokonywania zwrotu kosztów używania do celów służbowych samochodów osobowych, motocykli i motorowerów niebędących własnością pracodawcy
            (Dz. U. z 2002 r. nr 27, poz. 271) albo kosztów zastępstwa substytucyjnego w wysokości faktycznie poniesionej, nie przekraczającej 300 zł (słownie: trzysta złotych) od każdego posiedzenia, do pokrycia których zobowiązany
            będzie Zleceniodawca</p>
        <p class="margin_b_0"><span class="font_w_700">4. VOTUM zobowiązuje się do wystąpienia o zwolnienie Zleceniodawcy z kosztów sądowych</span>, po uprzednim złożeniu przez Zleceniodawcę oświadczenia o stanie rodzinnym, majątku i dochodach, według obowiązującego
            wzoru urzędowego (w przypadku osób fizycznych) lub przedłożenia dokumentacji rachunkowej i księgowej, niezbędnej do złożenia wniosku o zwolnienie od kosztów sądowych (w przypadku innych podmiotów). W przypadku braku
        zwolnienia przez sąd z kosztów sądowych, do ich pokrycia zobowiązuje się Zleceniodawca.</p>
        <p class="margin_b_0">5. Koszty procesu zasądzone od Zobowiązanego przypadają VOTUM lub Zleceniodawcy w części, w jakiej zostały poniesione przez każdą ze stron, z tym, żę koszty zastępstwa procesowego zasązone w sprawie
        przypadają pełnomocnikowi procesowemu, o którym mowa w § 5 ust. 1.</p>

        <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 margin_t_20">PRAWA I OBOWIĄZKI STRON</label>
        <label class="text_a_center col-md-12 font_w_700">§ 5</label>
        <p class="margin_b_0">1. Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności <span class="font_w_700">adwokatów lub radców prawnych</span>,
         przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy jak za działana własne.</p>
        <p class="margin_b_0">2. Zleceniodawca upoważnia VOTUM do pozyskania informacji o okolicznościach zdarzenia, o którym mowa w § 1 ust. 1, oraz dotyczących go dokumentów, w zakresie w jakim jest to niezbędne do wykonania umowy.</p>
        <p class="margin_b_0">3. <span class="font_w_700">VOTUM oświadcza, żę nie zawrze w imieniu Zleceniodawcy ugody ze zobowiązanym bez jego zgody</span>. Wyrażenie zgody może nastąpić w dowolnej formie. W przypadku złożenia oferty zawarcia ugody przez Zobowiązanego
        bezpośrednio Zleceniodawcy, zobowiązuje się on do niezwłocznego poinformowania o tym VOTUM.</p>
        <p class="margin_b_0">4. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 30 dni.</p>
        <p class="margin_b_0">5. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email, a w przypadku ich braku - na adres zameldowania/korespondencyjny.</p>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">2/3</p>
    </div>
</div>

<div class="pdf_strona">
    <label class="pdf_duze_litery text_a_center col-md-12 margin_b_0 font_w_700 ">POSTANOWIENIA KOŃCOWE</label>
    <label class="text_a_center col-md-12 font_w_700">§ 6</label>
    <p class="margin_b_0">1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.</p>
    <p class="margin_b_0">2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.</p>
    <p class="">3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednej dla każdej ze stron.</p>

    <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_t_10 margin_b_20"></div>
    <p class="margin_b_0 font_size_10">Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz. U. z 2014.1182) VOTUM informuje, że:</p>
    <p class="margin_b_0 font_size_10">1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,</p>
    <p class="margin_b_0 font_size_10">2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od których będą uzyskiwane
        informacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,</p>
    <p class="margin_b_0 font_size_10">3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,</p>
    <p class="margin_b_0 font_size_10">4. podanie VOTUM danych osobowych jest dobrowolne, lecz niezbędne dla celów wykonania umowy.</p>
    <p class="margin_b_0 font_size_10 margin_t_10">Wyrażam zgodę na przetwarzanie danych osobowych osoby, na której będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących stanu majątkowego, skazań, orzeczeń o ukaraniu i mandatów karnych,
        a także innych orzeczeń wydanych w postępowaniu sądowym lub administracyjnym) w celu wykonania umowy.</p>

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
