<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/zus_ofe.css'; ?>" type="text/css" />
<?php 

	$identyfikator_przedstawiciela = 'A1234567';
    $kod_jednostki = '2345678';
    $kod_konsultanta = '2345678';
    $nr_sprawy = '2345/67/8123456';

    $znak_wodny = 'POTWIERDZENIE ZAMÓWIENIA';
    $znak_wodny_wzor = 'WZÓR';
    $znak_wodny_nie_wypelniac = 'NIE WYPEŁNIAĆ';
	
	$numer_stopka = 'PG-2-1-F1/2015-04-01';
	
	$data_zamowienia = '30-10-2015';
	$imie_zleceniodawcy = 'Łukasz';
	$nazwisko_zleceniodawcy = 'Krzemień';
	$ulica_zleceniodawcy = 'Wrocławska';
	$numer_domu_zleceniodawcy = '51';
	$numer_mieszkania_zleceniodawcy = '5';
	$kod_pocztowy_zleceniodawcy = '55-300';
	$miejscowosc_zleceniodawcy = 'Oleśnica';
    $pesel_zleceniodawcy = '98764504696';
    $dowod_zleceniodawcy = 'AJA654321';
    $telefon_zleceniodawcy = '123456789';
    $w_imieniu_imie = 'Jan';
    $w_imieniu_nazwisko = 'Niezbędny';
    $w_imieniu_ulica = 'Krótka';
    $w_imieniu_numer_domu = '34';
    $w_imieniu_numer_mieszkania = '3';
    $w_imieniu_kod_pocztowy = '34-876';
    $w_imieniu_miejscowosc = 'Legnica';
    $email_zleceniodawcy = 'votum@votum-sa.pl';
    $w_imieniu_pesel = '86052259874';
    $w_imieniu_telefon = '321456765';
    $w_imieniu_email = 'test@votum-sa.pl';
    $w_imieniu_dowod = 'RED234576';

    $numer_rachunku = '12 1256 5874 4568 7456 4523 2145';
    $posiadacz_rachunku_imie = 'Marian';
    $posiadacz_rachunku_nazwisko = 'Stonoga';
    $posiadacz_rachunku_ulica = 'Ćwiartki';
    $posiadacz_rachunku_numer_domu = '3';
    $posiadacz_rachunku_numer_mieszkania = '4';
    $posiadacz_rachunku_kod_pocztowy = '23-654';
    $posiadacz_rachunku_miejscowosc = 'Poznań';
    $posiadacz_rachunku = "Adam Słodowy";

    $ulica_zleceniodawcy_kor = 'Wrocławska';
	$numer_domu_zleceniodawcy_kor = '51';
	$numer_mieszkania_zleceniodawcy_kor = '5';
	$kod_pocztowy_zleceniodawcy_kor = '55-300';
	$miejscowosc_zleceniodawcy_kor = 'Oleśnica';

    $imie_zmarlego = 'Marek';
    $nazwisko_zmarlego = 'Kukut';
    $pesel_zmarlego = '12063287521';
    $nip_zmarlego = '913-12-12-52';
    $dowod_zmarlego = 'GFD234576';
    $pokrewienstwo_zmarlego = 'brat';
    $data_smierci_zmarlego = '18-05-2015';
    $adres_zmarlego = 'ul. Miła 1, 55-300 Wrocław';
    $rachunek_zmarlego = '12 2584 1235 8549 5267 4263 2581';
    $podmiot_prowadzacy_rachunek = 'PZU';
    $data_wyplaty_emerytury = '01-01-2015';
    $nazwisko_uprawnionego_do_kasy = 'Kuś Jan';
    $spadkobierca = 'Kuś Jan';
    $bank_zmarlego = 'BZWBK';
    $rachunek_bankowy_zmarlego = '22 2584 1235 8549 5267 4263 2581';
    $data_roszczenia = '25-02-1999';
    $kto_pelnomocnikiem = 'Kroczak Jan';
    $odwolanie_pelnomocnictwa = '26-03-2015';

    $inne_informacje = 'Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’ spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).';
    $lista_dokumentacji = 'Zdjęcia, ksera, pełnomocnictwo';

    $dane_małżonka = 'Alicja Skóra';
    $numer_rachunku_w_funduszu = '17 2584 1235 8549 5267 4263 2581';
    
?>	 
    
<div class="strona strona_1">
	<div class="identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="logo_votum"></div>
    <div class="strona_tresc">
	<div class="tytul_strony_1">
		<p>UMOWA</p>
		<p>O DOCHODZENIE ŚRODKÓW Z ZUS, OFE I RACHUNKÓW BANKOWYCH</p>
	</div>
	<div class="na_podstawie_zamowienia">
		<p class="pogrubienie">zawarta na podstawie zamówienia z dnia</p>
		<p class="pogrubienie"><?php echo $data_zamowienia; ?></p>
		<p class="pogrubienie">r. złożonego przez</p>
	</div>
	<div class="zleceniodawca">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu margin_r_20"><?php echo $dowod_zleceniodawcy; ?></div>
		</div>
        <div class="element">
			<p>TELEFON</p>
			<div class="zleceniodawca_telefon"><?php echo $telefon_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu małoletniego /ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $w_imieniu_imie; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $w_imieniu_nazwisko; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $w_imieniu_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $w_imieniu_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $w_imieniu_numer_mieszkania; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $w_imieniu_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $w_imieniu_miejscowosc; ?></div>
		</div>	
		<div class="clear_b"></div>
	</div>
	<div class="naglowek_sekcji">dla</div>
	<div class="zleceniobiorca">
		<p>	
			VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
			zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod
			numerem <span class="czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,</span>
			którą reprezentuje:
		</p>
		<div class="zleceniobiorca_reprezentant"><?php echo $reprezentant; ?></div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="sekcja_paragraf">§ 1</div>
		<div class="sekcja_tresc"><p>
			Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności mających na celu ustalenie podmiotu zobowiązanego do wypłaty (zwanego dalej „zobowiązanym“) na rzecz Zleceniodawcy środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym (zwanych dalej „rachunkiem emerytalnym”), lub na rachunku bankowym zmarłego posiadacza i uzyskanie od zobowiązanego wypłaty należnych Zleceniodawcy środków pieniężnych.
		</p></div>
	</div>
    <div class="sekcja">
		<div class="sekcja_tytul">OKRES OBOWIĄZYWANIA UMOWY</div>
		<div class="sekcja_paragraf">§ 2</div>
		<div class="sekcja_tresc"><p>
			Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od zobowiązanego na rzecz Zleceniodawcy należnych mu środków pieniężnych zgromadzonych na rachunku emerytalnym lub na rachunku bankowym w postępowaniu przedsądowym.
		</p></div>
	</div>
    <div class="sekcja">
		<div class="sekcja_tytul">PRAWA I OBOWIĄZKI STRON</div>
		<div class="sekcja_paragraf">§ 3</div>
		<div class="sekcja_tresc"><p>
			1. Zleceniodawca zobowiązuje się do niezwłocznego przekazania VOTUM żądanej przez niego dokumentacji oraz udzielenia informacji niezbędnych do wykonania umowy.</p>
            <p>
			2. Zobowiązanie Zleceniodawcy do przekazania dokumentacji obejmuje w szczególności:</p>
            <p>
			a) odpis skrócony aktu zgonu zmarłego posiadacza rachunku emerytalnego;</p>
            <p>
			b) odpis skrócony aktu urodzenia Zleceniodawcy;</p>
            <p>
			c) dokument potwierdzający uprawnienie do reprezentacji małoletniego albo ubezwłasnowolnionego całkowicie lub częściowo Zleceniodawcy, np. postanowienie sądu rodzinnego o ustanowieniu opiekuna lub kuratora, albo postanowienie sądu rodzinnego o ustanowieniu rodziny zastępczej;</p>
            <p>
			d) kopię dokumentu tożsamości Zleceniodawcy albo osoby reprezentującej Zleceniodawcę, potwierdzony za zgodność z oryginałem przez notariusza lub organ gminy;</p>
            <p>
			e) zgłoszenie przystąpienia posiadacza rachunku emerytalnego do funduszu emerytalnego lub umowę;</p>
            <p>
			f) dokumentację i adresowaną do posiadacza rachunku emerytalnego korespondencję z funduszu emerytalnego lub Zakładu Ubezpieczeń Społecznych, dotyczącą rachunku emerytalnego albo przyznania świadczeń emerytalnych, a także dokumentację potwierdzającą prowadzenie rachunku bankowego, w tym korespondencję kierowaną z banku do posiadacza rachunku;</p>
            <p>
			g) postanowienie sądu o stwierdzeniu nabycia spadku przez Zleceniodawcę lub notarialny akt poświadczenia dziedziczenia przez Zleceniodawcę po zmarłym posiadaczu rachunku emerytalnego, jeżeli posiadacz rachunku emerytalnego nie wskazał osób uprawnionych do otrzymania środków zgromadzonych na rachunku emerytalnym.</p>
        </div>
	</div>
    <div class="objasnienia strona_1">
		* Jeżeli umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu. Wypełnić jedynie w razie zaistnienia ww. okoliczności.
        </div></div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
<div class="strona strona_2">
    <div class="strona_tresc">
	<div class="sekcja">
		<div class="sekcja_tresc"><p>
			3. Zleceniodawca jest zobowiązany przekazać VOTUM dokumentację, o której mowa w ust. 1 i 2, w oryginałach lub kopiach poświadczonych za zgodność z oryginałem przez notariusza albo właściwy organ gminy, z wyjątkiem dokumentów, o których mowa w ust. 2 lit. e) i f) oraz z zastrzeżeniem postanowień ust. 2 lit. d).</p>
            <p>
			4. Czynności wchodzące w zakres umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy, jak za działania własne.</p>
            <p>
			5. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 14 dni.</p>
            <p>
			6. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email, a w przypadku ich braku – na adres zameldowania/korespondencyjny.</p>
        </div></div>

	   <div class="sekcja">
		<div class="sekcja_tytul">WYNAGRODZENIE</div>
		<div class="sekcja_paragraf">§ 4</div>
		<div class="sekcja_tresc">
			<p class="margin_b_10">
				1. VOTUM zobowiązuje się do przekazania Zleceniodawcy środków pieniężnych uzyskanych od zobowiązanego, wypłaconych z rachunku emerytalnego lub bankowego w terminie <span class="pogrubienie">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM wynagrodzenia, wg wyboru Zleceniodawcy w następujący sposób: <span class="kratka_pojedyncza">X</span>przekazem pocztowym / <span class="kratka_pojedyncza"> </span>na wskazany przez Zleceniodawcę rachunek bankowy:
            <div class="clear_b"></div>
			</p>
			<div class="element">
				<p>NR RACHUNKU</p>
				<div class="zleceniodawca_nr_rachunku margin_r_20"><?php echo $numer_rachunku; ?></div>
			</div>
			<div class="element kratka_element">
				<span class="kratka">X</span><p>POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</p>
			</div>
			<div class="clear_b"></div>
			<p class="male_litery">POSIADACZ RACHUNKU (Wypełnić, jeżeli posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko oraz adres posiadacza.)</p>
			<div class="element">
				<p>IMIĘ</p>
				<div class="posiadacz_rachunku_imie margin_r_20"><?php echo $posiadacz_rachunku_imie; ?></div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="posiadacz_rachunku_nazwisko"><?php echo $posiadacz_rachunku_nazwisko; ?></div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<p>ULICA</p>
				<div class="posiadacz_rachunku_ulica margin_r_20"><?php echo $posiadacz_rachunku_ulica; ?></div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="posiadacz_rachunku_nr_domu "><?php echo $posiadacz_rachunku_numer_domu; ?></div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="posiadacz_rachunku_nr_mieszkania margin_r_20"><?php echo $posiadacz_rachunku_numer_mieszkania; ?></div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="posiadacz_rachunku_kod_pocztowy margin_r_20"><?php echo $posiadacz_rachunku_kod_pocztowy; ?></div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="posiadacz_rachunku_miejscowosc"><?php echo $posiadacz_rachunku_miejscowosc; ?></div>
			</div>	
			<div class="clear_b"></div><br/>
			<p>
            2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich środków pieniężnych uzyskanych w jego imieniu z rachunku emerytalnego lub bankowego w ramach wykonania niniejszej umowy.
			</p>
            <p>
            3. Z tytułu wykonania umowy VOTUM przysługuje wynagrodzenie w wysokości 25% (słownie: dwadzieścia pięć procent) brutto (w tym podatek od towarów i usług VAT w wysokości 23%) wartości uzyskanych dla Zleceniodawcy środków pieniężnych.
			</p>
            <p>
            4. VOTUM nie pobiera wynagrodzenia od kwot przekazanych na rzecz Zleceniodawcy w formie wypłaty transferowej obejmującej połowę środków objętych małżeńską wspólnością ustawową zgromadzonych na rachunku emerytalnym.
			</p>
            <p>
            5. Dodatkowo VOTUM przysługuje zwrot udokumentowanych kosztów:
			</p>
            <p>
            a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa;
			</p>
            <p>
            b) przekazu pocztowego, jeżeli Zleceniodawca nie podał numeru rachunku bankowego do spełnienia świadczenia;
			</p>
            <p>
            c) uzyskania aktów stanu cywilnego, tj. aktu zgonu, aktu małżeństwa oraz aktu urodzenia.
			</p>
            <p>
            6. W przypadku dokonania wypłaty przez zobowiązanego środków pieniężnych z rachunku emerytalnego lub bankowego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia umowy, Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia ich otrzymania należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023 2392 0799, bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy Zleceniodawca jest małoletni, ubezwłasnowolniony częściowo lub całkowicie, albo też, gdy jest reprezentowany przez swojego małżonka, przedstawiciel ustawowy, kurator lub opiekun, albo małżonek Zleceniodawcy zawierający umowę w jego imieniu, przyjmuje odpowiedzialność solidarną za zapłatę wynagrodzenia VOTUM.
			</p>
		</div>
    </div>   
	
	<div class="sekcja">
		<div class="sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="sekcja_paragraf">§ 5</div>
		<div class="sekcja_tresc"><p>
			1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
		</p>
        <p>
			2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.
		</p>
            <p>
			3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron.
		</p>
        </div>
	</div>

    <div class="objasnienia strona_2">
		Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz. U. z 2014 r., poz. 1182 ze zm.) VOTUM informuje, że:<br/>
            1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,
            <br/>
            2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od których będą uzyskiwaneinformacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,
            <br/>
            3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,
            <br/>
            4. podanie VOTUM danych osobowych jest dobrowolne.
            <br/>
            Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu i mandatów karnych, a także innych orzeczeń wydanych w postępowaniu sądowym) w celu wykonania umowy.<br/>
    </div>

    	<div class="sekcja">
		<div class="sekcja_tresc">
		<div class="clear_b"></div>	
			<div class="podpis_lewo pogrubienie"><p>VOTUM S.A</p></div>
			<div class="podpis_prawo pogrubienie"><p>ZLECENIODAWCA</p></div>
			<div class="clear_b"></div>		
		</div>
	</div>
	<div class="oswiadczenie">
		<p class="pogrubienie">Oświadczenie</p>
		<p>Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>
	</div>
	
	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>ZLECENIODAWCA</p></div>
			<div class="clear_b"></div>			
		</div>
</div></div>
 
    <div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


<div class="strona strona_3">
    
	<div class="identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="logo_votum"></div>
    <div class="strona_tresc">
	<div class="tytul_strony_1">
		<p>UMOWA</p>
		<p>O DOCHODZENIE ŚRODKÓW Z ZUS, OFE I RACHUNKÓW BANKOWYCH</p>
	</div>
	<div class="na_podstawie_zamowienia">
		<p class="pogrubienie">zawarta na podstawie zamówienia z dnia</p>
		<p class="pogrubienie"><?php echo $data_zamowienia; ?></p>
		<p class="pogrubienie">r. złożonego przez</p>
	</div>
	<div class="zleceniodawca">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu margin_r_20"><?php echo $dowod_zleceniodawcy; ?></div>
		</div>
        <div class="element">
			<p>TELEFON</p>
			<div class="zleceniodawca_telefon"><?php echo $telefon_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu małoletniego /ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $w_imieniu_imie; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $w_imieniu_nazwisko; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $w_imieniu_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $w_imieniu_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $w_imieniu_numer_mieszkania; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $w_imieniu_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $w_imieniu_miejscowosc; ?></div>
		</div>	
		<div class="clear_b"></div>
	</div>
	<div class="naglowek_sekcji">dla</div>
	<div class="zleceniobiorca">
		<p>	
			VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
			zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod
			numerem <span class="czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,</span>
			którą reprezentuje:
		</p>
		<div class="zleceniobiorca_reprezentant"><?php echo $reprezentant; ?></div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="sekcja_paragraf">§ 1</div>
		<div class="sekcja_tresc"><p>
			Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności mających na celu ustalenie podmiotu zobowiązanego do wypłaty (zwanego dalej „zobowiązanym“) na rzecz Zleceniodawcy środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym (zwanych dalej „rachunkiem emerytalnym”), lub na rachunku bankowym zmarłego posiadacza i uzyskanie od zobowiązanego wypłaty należnych Zleceniodawcy środków pieniężnych.
		</p></div>
	</div>
    <div class="sekcja">
		<div class="sekcja_tytul">OKRES OBOWIĄZYWANIA UMOWY</div>
		<div class="sekcja_paragraf">§ 2</div>
		<div class="sekcja_tresc"><p>
			Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od zobowiązanego na rzecz Zleceniodawcy należnych mu środków pieniężnych zgromadzonych na rachunku emerytalnym lub na rachunku bankowym w postępowaniu przedsądowym.
		</p></div>
	</div>
    <div class="sekcja">
		<div class="sekcja_tytul">PRAWA I OBOWIĄZKI STRON</div>
		<div class="sekcja_paragraf">§ 3</div>
		<div class="sekcja_tresc"><p>
			1. Zleceniodawca zobowiązuje się do niezwłocznego przekazania VOTUM żądanej przez niego dokumentacji oraz udzielenia informacji niezbędnych do wykonania umowy.</p>
            <p>
			2. Zobowiązanie Zleceniodawcy do przekazania dokumentacji obejmuje w szczególności:</p>
            <p>
			a) odpis skrócony aktu zgonu zmarłego posiadacza rachunku emerytalnego;</p>
            <p>
			b) odpis skrócony aktu urodzenia Zleceniodawcy;</p>
            <p>
			c) dokument potwierdzający uprawnienie do reprezentacji małoletniego albo ubezwłasnowolnionego całkowicie lub częściowo Zleceniodawcy, np. postanowienie sądu rodzinnego o ustanowieniu opiekuna lub kuratora, albo postanowienie sądu rodzinnego o ustanowieniu rodziny zastępczej;</p>
            <p>
			d) kopię dokumentu tożsamości Zleceniodawcy albo osoby reprezentującej Zleceniodawcę, potwierdzony za zgodność z oryginałem przez notariusza lub organ gminy;</p>
            <p>
			e) zgłoszenie przystąpienia posiadacza rachunku emerytalnego do funduszu emerytalnego lub umowę;</p>
            <p>
			f) dokumentację i adresowaną do posiadacza rachunku emerytalnego korespondencję z funduszu emerytalnego lub Zakładu Ubezpieczeń Społecznych, dotyczącą rachunku emerytalnego albo przyznania świadczeń emerytalnych, a także dokumentację potwierdzającą prowadzenie rachunku bankowego, w tym korespondencję kierowaną z banku do posiadacza rachunku;</p>
            <p>
			g) postanowienie sądu o stwierdzeniu nabycia spadku przez Zleceniodawcę lub notarialny akt poświadczenia dziedziczenia przez Zleceniodawcę po zmarłym posiadaczu rachunku emerytalnego, jeżeli posiadacz rachunku emerytalnego nie wskazał osób uprawnionych do otrzymania środków zgromadzonych na rachunku emerytalnym.</p>
        </div>
	</div>
    <div class="objasnienia strona_1">
		* Jeżeli umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu. Wypełnić jedynie w razie zaistnienia ww. okoliczności.
    </div></div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
<div class="strona strona_4">
    <div class="strona_tresc">
	<div class="sekcja">
		<div class="sekcja_tresc"><p>
			3. Zleceniodawca jest zobowiązany przekazać VOTUM dokumentację, o której mowa w ust. 1 i 2, w oryginałach lub kopiach poświadczonych za zgodność z oryginałem przez notariusza albo właściwy organ gminy, z wyjątkiem dokumentów, o których mowa w ust. 2 lit. e) i f) oraz z zastrzeżeniem postanowień ust. 2 lit. d).</p>
            <p>
			4. Czynności wchodzące w zakres umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy, jak za działania własne.</p>
            <p>
			5. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 14 dni.</p>
            <p>
			6. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email, a w przypadku ich braku – na adres zameldowania/korespondencyjny.</p>
        </div></div>

	   <div class="sekcja">
		<div class="sekcja_tytul">WYNAGRODZENIE</div>
		<div class="sekcja_paragraf">§ 4</div>
		<div class="sekcja_tresc">
			<p class="margin_b_10">
				1. VOTUM zobowiązuje się do przekazania Zleceniodawcy środków pieniężnych uzyskanych od zobowiązanego, wypłaconych z rachunku emerytalnego lub bankowego w terminie <span class="pogrubienie">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM wynagrodzenia, wg wyboru Zleceniodawcy w następujący sposób: <span class="kratka_pojedyncza">X</span>przekazem pocztowym / <span class="kratka_pojedyncza"> </span>na wskazany przez Zleceniodawcę rachunek bankowy:
            <div class="clear_b"></div>
			</p>
			<div class="element">
				<p>NR RACHUNKU</p>
				<div class="zleceniodawca_nr_rachunku margin_r_20"><?php echo $numer_rachunku; ?></div>
			</div>
			<div class="element kratka_element">
				<span class="kratka">X</span><p>POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</p>
			</div>
			<div class="clear_b"></div>
			<p class="male_litery">POSIADACZ RACHUNKU (Wypełnić, jeżeli posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko oraz adres posiadacza.)</p>
			<div class="element">
				<p>IMIĘ</p>
				<div class="posiadacz_rachunku_imie margin_r_20"><?php echo $posiadacz_rachunku_imie; ?></div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="posiadacz_rachunku_nazwisko"><?php echo $posiadacz_rachunku_nazwisko; ?></div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<p>ULICA</p>
				<div class="posiadacz_rachunku_ulica margin_r_20"><?php echo $posiadacz_rachunku_ulica; ?></div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="posiadacz_rachunku_nr_domu "><?php echo $posiadacz_rachunku_numer_domu; ?></div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="posiadacz_rachunku_nr_mieszkania margin_r_20"><?php echo $posiadacz_rachunku_numer_mieszkania; ?></div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="posiadacz_rachunku_kod_pocztowy margin_r_20"><?php echo $posiadacz_rachunku_kod_pocztowy; ?></div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="posiadacz_rachunku_miejscowosc"><?php echo $posiadacz_rachunku_miejscowosc; ?></div>
			</div>	
			<div class="clear_b"></div><br/>
			<p>
            2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich środków pieniężnych uzyskanych w jego imieniu z rachunku emerytalnego lub bankowego w ramach wykonania niniejszej umowy.
			</p>
            <p>
            3. Z tytułu wykonania umowy VOTUM przysługuje wynagrodzenie w wysokości 25% (słownie: dwadzieścia pięć procent) brutto (w tym podatek od towarów i usług VAT w wysokości 23%) wartości uzyskanych dla Zleceniodawcy środków pieniężnych.
			</p>
            <p>
            4. VOTUM nie pobiera wynagrodzenia od kwot przekazanych na rzecz Zleceniodawcy w formie wypłaty transferowej obejmującej połowę środków objętych małżeńską wspólnością ustawową zgromadzonych na rachunku emerytalnym.
			</p>
            <p>
            5. Dodatkowo VOTUM przysługuje zwrot udokumentowanych kosztów:
			</p>
            <p>
            a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa;
			</p>
            <p>
            b) przekazu pocztowego, jeżeli Zleceniodawca nie podał numeru rachunku bankowego do spełnienia świadczenia;
			</p>
            <p>
            c) uzyskania aktów stanu cywilnego, tj. aktu zgonu, aktu małżeństwa oraz aktu urodzenia.
			</p>
            <p>
            6. W przypadku dokonania wypłaty przez zobowiązanego środków pieniężnych z rachunku emerytalnego lub bankowego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia umowy, Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia ich otrzymania należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023 2392 0799, bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy Zleceniodawca jest małoletni, ubezwłasnowolniony częściowo lub całkowicie, albo też, gdy jest reprezentowany przez swojego małżonka, przedstawiciel ustawowy, kurator lub opiekun, albo małżonek Zleceniodawcy zawierający umowę w jego imieniu, przyjmuje odpowiedzialność solidarną za zapłatę wynagrodzenia VOTUM.
			</p>
		</div>
    </div>   
	
	<div class="sekcja">
		<div class="sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="sekcja_paragraf">§ 5</div>
		<div class="sekcja_tresc"><p>
			1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
		</p>
        <p>
			2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.
		</p>
            <p>
			3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron.
		</p>
        </div>
	</div>

    <div class="objasnienia strona_2">
		Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz. U. z 2014 r., poz. 1182 ze zm.) VOTUM informuje, że:<br/>
            1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,
            <br/>
            2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od których będą uzyskiwaneinformacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,
            <br/>
            3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,
            <br/>
            4. podanie VOTUM danych osobowych jest dobrowolne.
            <br/>
            Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu i mandatów karnych, a także innych orzeczeń wydanych w postępowaniu sądowym) w celu wykonania umowy.<br/>
    </div>

    	<div class="sekcja">
		<div class="sekcja_tresc">
		<div class="clear_b"></div>	
			<div class="podpis_lewo pogrubienie"><p>VOTUM S.A</p></div>
			<div class="podpis_prawo pogrubienie"><p>ZLECENIODAWCA</p></div>
			<div class="clear_b"></div>		
		</div>
	</div>
	<div class="oswiadczenie">
		<p class="pogrubienie">Oświadczenie</p>
		<p>Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>
	</div>
	
	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>ZLECENIODAWCA</p></div>
			<div class="clear_b"></div>			
		</div>
</div></div>

    <div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


<div class="strona strona_5">
	<div class="identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="logo_votum"></div>
    <div class="strona_znak_wodny"><?php echo $znak_wodny; ?></div>
    <div class="strona_tresc">
	<div class="tytul_strony_1">
		<p>UMOWA</p>
		<p>O DOCHODZENIE ŚRODKÓW Z ZUS, OFE I RACHUNKÓW BANKOWYCH</p>
	</div>
	<div class="na_podstawie_zamowienia">
		<p class="pogrubienie">zawarta na podstawie zamówienia z dnia</p>
		<p class="pogrubienie"><?php echo $data_zamowienia; ?></p>
		<p class="pogrubienie">r. złożonego przez</p>
	</div>
	<div class="zleceniodawca">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu margin_r_20"><?php echo $dowod_zleceniodawcy; ?></div>
		</div>
        <div class="element">
			<p>TELEFON</p>
			<div class="zleceniodawca_telefon"><?php echo $telefon_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu małoletniego /ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $w_imieniu_imie; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $w_imieniu_nazwisko; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $w_imieniu_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $w_imieniu_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $w_imieniu_numer_mieszkania; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $w_imieniu_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $w_imieniu_miejscowosc; ?></div>
		</div>	
		<div class="clear_b"></div>
	</div>
	<div class="naglowek_sekcji">dla</div>
	<div class="zleceniobiorca">
		<p>	
			VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
			zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod
			numerem <span class="czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,</span>
			którą reprezentuje:
		</p>
		<div class="zleceniobiorca_reprezentant"><?php echo $reprezentant; ?></div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="sekcja_paragraf">§ 1</div>
		<div class="sekcja_tresc"><p>
			Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności mających na celu ustalenie podmiotu zobowiązanego do wypłaty (zwanego dalej „zobowiązanym“) na rzecz Zleceniodawcy środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym (zwanych dalej „rachunkiem emerytalnym”), lub na rachunku bankowym zmarłego posiadacza i uzyskanie od zobowiązanego wypłaty należnych Zleceniodawcy środków pieniężnych.
		</p></div>
	</div>
    <div class="sekcja">
		<div class="sekcja_tytul">OKRES OBOWIĄZYWANIA UMOWY</div>
		<div class="sekcja_paragraf">§ 2</div>
		<div class="sekcja_tresc"><p>
			Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od zobowiązanego na rzecz Zleceniodawcy należnych mu środków pieniężnych zgromadzonych na rachunku emerytalnym lub na rachunku bankowym w postępowaniu przedsądowym.
		</p></div>
	</div>
    <div class="sekcja">
		<div class="sekcja_tytul">PRAWA I OBOWIĄZKI STRON</div>
		<div class="sekcja_paragraf">§ 3</div>
		<div class="sekcja_tresc"><p>
			1. Zleceniodawca zobowiązuje się do niezwłocznego przekazania VOTUM żądanej przez niego dokumentacji oraz udzielenia informacji niezbędnych do wykonania umowy.</p>
            <p>
			2. Zobowiązanie Zleceniodawcy do przekazania dokumentacji obejmuje w szczególności:</p>
            <p>
			a) odpis skrócony aktu zgonu zmarłego posiadacza rachunku emerytalnego;</p>
            <p>
			b) odpis skrócony aktu urodzenia Zleceniodawcy;</p>
            <p>
			c) dokument potwierdzający uprawnienie do reprezentacji małoletniego albo ubezwłasnowolnionego całkowicie lub częściowo Zleceniodawcy, np. postanowienie sądu rodzinnego o ustanowieniu opiekuna lub kuratora, albo postanowienie sądu rodzinnego o ustanowieniu rodziny zastępczej;</p>
            <p>
			d) kopię dokumentu tożsamości Zleceniodawcy albo osoby reprezentującej Zleceniodawcę, potwierdzony za zgodność z oryginałem przez notariusza lub organ gminy;</p>
            <p>
			e) zgłoszenie przystąpienia posiadacza rachunku emerytalnego do funduszu emerytalnego lub umowę;</p>
            <p>
			f) dokumentację i adresowaną do posiadacza rachunku emerytalnego korespondencję z funduszu emerytalnego lub Zakładu Ubezpieczeń Społecznych, dotyczącą rachunku emerytalnego albo przyznania świadczeń emerytalnych, a także dokumentację potwierdzającą prowadzenie rachunku bankowego, w tym korespondencję kierowaną z banku do posiadacza rachunku;</p>
            <p>
			g) postanowienie sądu o stwierdzeniu nabycia spadku przez Zleceniodawcę lub notarialny akt poświadczenia dziedziczenia przez Zleceniodawcę po zmarłym posiadaczu rachunku emerytalnego, jeżeli posiadacz rachunku emerytalnego nie wskazał osób uprawnionych do otrzymania środków zgromadzonych na rachunku emerytalnym.</p>
        </div>
	</div>
    <div class="objasnienia strona_1">
		* Jeżeli umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu. Wypełnić jedynie w razie zaistnienia ww. okoliczności.
	</div>
    </div>
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
<div class="strona strona_6">
    <div class="strona_znak_wodny"><?php echo $znak_wodny; ?></div>
    <div class="strona_tresc">
	<div class="sekcja">
		<div class="sekcja_tresc"><p>
			3. Zleceniodawca jest zobowiązany przekazać VOTUM dokumentację, o której mowa w ust. 1 i 2, w oryginałach lub kopiach poświadczonych za zgodność z oryginałem przez notariusza albo właściwy organ gminy, z wyjątkiem dokumentów, o których mowa w ust. 2 lit. e) i f) oraz z zastrzeżeniem postanowień ust. 2 lit. d).</p>
            <p>
			4. Czynności wchodzące w zakres umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy, jak za działania własne.</p>
            <p>
			5. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 14 dni.</p>
            <p>
			6. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email, a w przypadku ich braku – na adres zameldowania/korespondencyjny.</p>
        </div></div>

	   <div class="sekcja">
		<div class="sekcja_tytul">WYNAGRODZENIE</div>
		<div class="sekcja_paragraf">§ 4</div>
		<div class="sekcja_tresc">
			<p class="margin_b_10">
				1. VOTUM zobowiązuje się do przekazania Zleceniodawcy środków pieniężnych uzyskanych od zobowiązanego, wypłaconych z rachunku emerytalnego lub bankowego w terminie <span class="pogrubienie">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM wynagrodzenia, wg wyboru Zleceniodawcy w następujący sposób: <span class="kratka_pojedyncza">X</span>przekazem pocztowym / <span class="kratka_pojedyncza"> </span>na wskazany przez Zleceniodawcę rachunek bankowy:
            <div class="clear_b"></div>
			</p>
			<div class="element">
				<p>NR RACHUNKU</p>
				<div class="zleceniodawca_nr_rachunku margin_r_20"><?php echo $numer_rachunku; ?></div>
			</div>
			<div class="element kratka_element">
				<span class="kratka">X</span><p>POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</p>
			</div>
			<div class="clear_b"></div>
			<p class="male_litery">POSIADACZ RACHUNKU (Wypełnić, jeżeli posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko oraz adres posiadacza.)</p>
			<div class="element">
				<p>IMIĘ</p>
				<div class="posiadacz_rachunku_imie margin_r_20"><?php echo $posiadacz_rachunku_imie; ?></div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="posiadacz_rachunku_nazwisko"><?php echo $posiadacz_rachunku_nazwisko; ?></div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<p>ULICA</p>
				<div class="posiadacz_rachunku_ulica margin_r_20"><?php echo $posiadacz_rachunku_ulica; ?></div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="posiadacz_rachunku_nr_domu "><?php echo $posiadacz_rachunku_numer_domu; ?></div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="posiadacz_rachunku_nr_mieszkania margin_r_20"><?php echo $posiadacz_rachunku_numer_mieszkania; ?></div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="posiadacz_rachunku_kod_pocztowy margin_r_20"><?php echo $posiadacz_rachunku_kod_pocztowy; ?></div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="posiadacz_rachunku_miejscowosc"><?php echo $posiadacz_rachunku_miejscowosc; ?></div>
			</div>	
			<div class="clear_b"></div><br/>
			<p>
            2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich środków pieniężnych uzyskanych w jego imieniu z rachunku emerytalnego lub bankowego w ramach wykonania niniejszej umowy.
			</p>
            <p>
            3. Z tytułu wykonania umowy VOTUM przysługuje wynagrodzenie w wysokości 25% (słownie: dwadzieścia pięć procent) brutto (w tym podatek od towarów i usług VAT w wysokości 23%) wartości uzyskanych dla Zleceniodawcy środków pieniężnych.
			</p>
            <p>
            4. VOTUM nie pobiera wynagrodzenia od kwot przekazanych na rzecz Zleceniodawcy w formie wypłaty transferowej obejmującej połowę środków objętych małżeńską wspólnością ustawową zgromadzonych na rachunku emerytalnym.
			</p>
            <p>
            5. Dodatkowo VOTUM przysługuje zwrot udokumentowanych kosztów:
			</p>
            <p>
            a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa;
			</p>
            <p>
            b) przekazu pocztowego, jeżeli Zleceniodawca nie podał numeru rachunku bankowego do spełnienia świadczenia;
			</p>
            <p>
            c) uzyskania aktów stanu cywilnego, tj. aktu zgonu, aktu małżeństwa oraz aktu urodzenia.
			</p>
            <p>
            6. W przypadku dokonania wypłaty przez zobowiązanego środków pieniężnych z rachunku emerytalnego lub bankowego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia umowy, Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia ich otrzymania należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023 2392 0799, bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy Zleceniodawca jest małoletni, ubezwłasnowolniony częściowo lub całkowicie, albo też, gdy jest reprezentowany przez swojego małżonka, przedstawiciel ustawowy, kurator lub opiekun, albo małżonek Zleceniodawcy zawierający umowę w jego imieniu, przyjmuje odpowiedzialność solidarną za zapłatę wynagrodzenia VOTUM.
			</p>
		</div>
    </div>   
	
	<div class="sekcja">
		<div class="sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="sekcja_paragraf">§ 5</div>
		<div class="sekcja_tresc"><p>
			1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
		</p>
        <p>
			2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.
		</p>
            <p>
			3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron.
		</p>
        </div>
	</div>

    <div class="objasnienia strona_2">
		Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz. U. z 2014 r., poz. 1182 ze zm.) VOTUM informuje, że:<br/>
            1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,
            <br/>
            2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od których będą uzyskiwaneinformacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,
            <br/>
            3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,
            <br/>
            4. podanie VOTUM danych osobowych jest dobrowolne.
            <br/>
            Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu i mandatów karnych, a także innych orzeczeń wydanych w postępowaniu sądowym) w celu wykonania umowy.<br/>
    </div>

    	<div class="sekcja">
		<div class="sekcja_tresc">
		<div class="clear_b"></div>	
			<div class="podpis_lewo pogrubienie"><p>VOTUM S.A</p></div>
			<div class="podpis_prawo pogrubienie"><p>ZLECENIODAWCA</p></div>
			<div class="clear_b"></div>		
		</div>
	</div>
	<div class="oswiadczenie">
		<p class="pogrubienie">Oświadczenie</p>
		<p>Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>
	</div>
	
	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>ZLECENIODAWCA</p></div>
			<div class="clear_b"></div>			
		</div>
</div></div>
 
    <div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


<div class="strona strona_7">
    
    <div class="element">
	<div class="id_przedstawiciela margin_r_20 pogrubienie"><?php echo $identyfikator_przedstawiciela; ?></div>
    <p>IDENTYFIKATOR PRZEDSTAWICIELA</p>
    </div>
    <div class="element margin_l_20">
    <div class="podpis_przedstawiciela margin_l_20"></div>
    <p class="margin_l_20">PODPIS PRZEDSTAWICIELA</p>
    </div>
    <div class="clear_b"></div>
    <div class="element">
	<div class="kod_jednostki margin_r_20 pogrubienie"><?php echo $kod_jednostki; ?></div>
    <p>KOD JEDNOSTKI</p>
    </div>
    <div class="clear_b"></div>
    <div class="element">
	<div class="kod_konsultanta margin_r_20 pogrubienie"><?php echo $kod_konsultanta; ?></div>
    <p>KOD KONSULTANTA</p>
    </div>
    <div class="clear_b"></div>
    <div class="element">
	<div class="nr_sprawy margin_r_20 pogrubienie"><?php echo $nr_sprawy; ?></div>
    <p>NUMER SPRAWY</p>
    </div>
    <div class="clear_b"></div>
    <div class="logo_votum"></div>
    <div class="strona_tresc">
	<div class="tytul_strony">
		<p>ZGŁOSZENIE ROSZCZEŃ O WYPŁATĘ ŚRODKÓW <br/>
            Z RACHUNKU EMERYTALNEGO/BANKOWEGO</p>
	</div>
	<div class="formularz">
    <div class="tytul_sekcji_formularza">
        <div class="pola_w_tytule">ZLECENIODAWCA</div>
        </div>
        <div class="tresc_sekcji_fomularza">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $nazwisko_zleceniodawcy; ?></div>
		</div>
        <div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
        <p>ADRES KORESPONDENCYJNY ZLECENIODAWCY (JEŚLI JEST INNY NIŻ ZAMELDOWANIA)</p>
        <div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy_kor; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel_2 margin_r_20"><?php echo $pesel_zleceniodawcy; ?></div>
		</div>
            <div class="element">
			<p>NUMER TELEFONU</p>
			<div class="zleceniodawca_telefon_2 margin_r_20"><?php echo $telefon_zleceniodawcy; ?></div>
		</div>
            <div class="element">
			<p>E-MAIL</p>
			<div class="zleceniodawca_email margin_r_20"><?php echo $email_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu_2"><?php echo $dowod_zleceniodawcy; ?></div>
            </div>    
		<div class="clear_b"></div>
        </div>
    <div class="tytul_sekcji_formularza">
    <div class="pola_w_tytule">
        <div class="element">
        DZIAŁAJĄCY W IMIENIU
        </div>
        <div class="element"><div class="kratka">X</div> MAŁOLETNIEGO</div>
        <div class="element"><div class="kratka">X</div> UBEZWŁASNOWOLNIONEGO</div>
        <div class="element"><div class="kratka">X</div> MAŁŻONKA</div>
        </div>
    </div>
    <div class="tresc_sekcji_fomularza">
    
        <div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $w_imieniu_imie; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $w_imieniu_nazwisko; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $w_imieniu_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $w_imieniu_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $w_imieniu_numer_mieszkania; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $w_imieniu_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $w_imieniu_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel_2 margin_r_20"><?php echo $w_imieniu_pesel; ?></div>
		</div>
            <div class="element">
			<p>NUMER TELEFONU</p>
			<div class="zleceniodawca_telefon_2 margin_r_20"><?php echo $w_imieniu_telefon; ?></div>
		</div>
            <div class="element">
			<p>E-MAIL</p>
			<div class="zleceniodawca_email margin_r_20"><?php echo $w_imieniu_email; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu_2"><?php echo $w_imieniu_dowod; ?></div>
            </div>    
		<div class="clear_b"></div>   
    </div>
    <div class="tytul_sekcji_formularza">
    <div class="pola_w_tytule">
        <div class="element">
        DANE ZMARŁEGO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO
        </div></div>
    </div>
    <div class="tresc_sekcji_fomularza">
    
        <div class="element">
			<p>IMIĘ</p>
			<div class="poszkodowany_imie margin_r_20"><?php echo $imie_zmarlego; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="poszkodowany_nazwisko margin_r_20"><?php echo $nazwisko_zmarlego; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="poszkodowany_pesel margin_r_20"><?php echo $pesel_zmarlego; ?></div>
		</div>
            <div class="element">
			<p>NIP</p>
			<div class="poszkodowany_nip margin_r_20"><?php echo $nip_zmarlego; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>NR DOWODU OSOBISTEGO LUB PASZPORTU (JEŻELI POSIADACZOWI RACHUNKU EMERYTALNEGO NIE NADANO NUMERU PESEL)</p>
			<div class="poszkodowany_seria_i_numer_dowodu"><?php echo $dowod_zmarlego; ?></div>
            </div>    
		<div class="clear_b"></div>  
        <div class="element">
			<p>STOPIEŃ POKREWIEŃSTWA Z UPRAWNIONYM (PROSIMY WSKAZAĆ, KIM BYŁ ZMARŁY DLA UPRAWNIONEGO, NP. MAŁŻONEK, MATKA, OJCIEC, ITP.).</p>
			<div class="poszkodowany_pokrewienstwo"><?php echo $pokrewienstwo_zmarlego; ?></div>
            </div>    
		<div class="clear_b"></div> 
        <div class="element">
			<p>DATA ŚMIERCI POSIADACZA RACHUNKU EMERYTALNEGO</p>
			<div class="data_smierci margin_r_20"><?php echo $data_smierci_zmarlego; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>ADRES ZAMIESZKANIA POSIADACZA RACHUNKU EMERYTALNEGO WSKAZANY PODMIOTOWI PROWADZĄCEMU RACHUNEK</p>
			<div class="adres_poszkodowanego"><?php echo $adres_zmarlego; ?></div>
            </div>    
		<div class="clear_b"></div> 
        <div class="element">
			<p>NR RACHUNKU EMERYTALNEGO</p>
			<div class="rachunek_poszkodowanego margin_r_20"><?php echo $rachunek_zmarlego; ?></div>
		</div>
		<div class="element">
			<p>PODMIOT PROWADZĄCY RACHUNEK EMERYTALNY</p>
			<div class="podmiot_rachunku margin_r_20"><?php echo $podmiot_prowadzacy_rachunek; ?></div>
		</div>
		<div class="clear_b"></div>

        <div class="sekcja">
		<div class="sekcja_tresc rozmiar_czcionki">
        <span class="pogrubienie">Czy posiadacz rachunku emerytalnego pobierał emeryturę?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK Jeśli tak, to kiedy nastąpiła pierwsza wypłata emerytury? <?php echo $data_wyplaty_emerytury; ?></div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy posiadacz rachunku emerytalnego, który nie pobierał emerytury, złożył wniosek o ustalenie prawa do emerytury?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy posiadacz rachunku emerytalnego wskazał w umowie o prowadzenie rachunku emerytalnego osoby uprawnione do otrzymania środków pieniężnych z rachunku emerytalnego po jego śmierci?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK Jeśli tak, to kogo wskazał? <span class="pogrubienie">Osoby wskazane przez zmarłego posiadacza rachunku emerytalnego:</span></div>
        <div class="element">
        <div class="poszkodowany_pokrewienstwo"><?php echo $nazwisko_uprawnionego_do_kasy; ?></div>
		</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Informacje o spadkobiercach posiadacza rachunku emerytalnego (wypełnić w przypadku, gdy brak osób wskazanych przez posiadacza rachunku emerytalnego jako uprawnione do otrzymania środków pieniężnych z rachunku emerytalnego po jego śmierci lub brak informacji na ten temat).</span><br/>
        <span class="pogrubienie">Spadkobiercy zmarłego posiadacza rachunku emerytalnego: </span><?php echo $spadkobierca; ?>
        </div></div>
        </div>
    
	</div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>PODPIS KLIENTA</p></div>
			<div class="clear_b"></div>			
		</div>
        </div></div>
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>	

<div class="strona strona_8">
    <div class="strona_tresc">
    <div class="formularz">
        <div class="tresc_sekcji_fomularza">
		<div class="sekcja">
		<div class="sekcja_tresc rozmiar_czcionki">
        <span class="pogrubienie">Czy zmarły był posiadaczem rachunku bankowego?</span><br/>
        (Wypełnić wyłącznie, gdy przedmiotem umowy ma być dochodzenie roszczeń z rachunku bankowego zmarłego posiadacza).<br/>
        <div class="element"><div class="kratka">X</div> TAK  /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        Jeśli tak, to w jakim banku prowadzony był rachunek: <?php echo $bank_zmarlego; ?><br/>
        i pod jakim numerem: <?php echo $rachunek_bankowy_zmarlego; ?><br/>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy zostało wydane postanowienie o stwierdzeniu nabycia spadku lub czy został sporządzony akt notarialny poświadczenia dziedziczenia po zmarłym posiadaczu rachunku emerytalnego?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy zgłoszono już roszczenie o wypłatę środków pieniężnych do podmiotu prowadzącego rachunek emerytalny?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element">Jeśli tak, to kiedy? <?php echo $data_roszczenia; ?></div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy uprawnionemu wypłacono środki pieniężne z rachunku emerytalnego?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK, zarówno z rachunku OFE, jak i subkonta ZUS/ </div>
        <div class="element"><div class="kratka">X</div> TAK, ale wyłącznie z rachunku OFE/ </div>
        <div class="element"><div class="kratka">X</div> NIE </div>
        <div class="clear_b"></div>   
        <span class="pogrubienie">Czy zlecono prowadzenie sprawy innemu pełnomocnikowi?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK / </div>
        <div class="element"><div class="kratka">X</div> NIE Jeśli tak, to komu? </div>
        <div class="element"><div class="poszkodowany_pokrewienstwo"><?php echo $kto_pelnomocnikiem; ?></div></div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy odwołano pełnomocnictwo udzielone innemu pełnomocnikowi?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK / </div>
        <div class="element"><div class="kratka">X</div> NIE Jeśli tak, to kiedy? <?php echo $odwolanie_pelnomocnictwa; ?></div>
        <div class="clear_b"></div> 
        </div></div>
        </div>
        <div class="tytul_sekcji_formularza">
        <div class="pola_w_tytule">
        INNE ISTOTNE INFORMACJE PRZEKAZANE PRZEZ KLIENTA
        </div></div>
        

        <div class="tresc_sekcji_fomularza">
        <?php echo $inne_informacje; ?>
        </div>
        
        <div class="tytul_sekcji_formularza">
        <div class="pola_w_tytule">
        LISTA DOKUMENTACJI POBRANEJ OD KLIENTA
        </div></div>

        <div class="tresc_sekcji_fomularza">
        <?php echo $lista_dokumentacji; ?>
        </div>
        <span class="pogrubienie">
        <div class="element"><div class="kratka">X</div> Oświadczam, że prowadzę pozarolniczą działalność gospodarczą.</div>
        <div class="element"><div class="kratka">X</div> Jestem zainteresowany/a ofertą produktów finansowych i wyrażam zgodę na przekazywanie Protecta Finance Sp. z o.o. we Włocławku moich danych osobowych w celach marketingowych, w szczególności w celu opracowania i przedstawienia oferty.</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> Nie jestem zainteresowany/a ofertą produktów finansowych.</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> Wyrażam zgodę / </div><div class="element"><div class="kratka">X</div> Nie wyrażam zgody na otrzymywanie informacji związanych z wykonywaniem umowy poprzez</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> wiadomości tekstowe SMS / </div><div class="element"><div class="kratka">X</div> wiadomości e-mail na numer/adres przeze mnie wskazany.</div></span>
        <div class="clear_b"></div> 

	</div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
		<div class="clear_b"></div>	
			<div class="podpis_lewo pogrubienie"><p>MIEJSCOWOŚĆ I DATA</p></div>
			<div class="podpis_prawo pogrubienie"><p>PODPIS KLIENTA</p></div>
			<div class="clear_b"></div>		
		</div>
	</div>
    
    <div class="oswiadczenie">
		<p class="pogrubienie">Oświadczenie</p>
		<p class="pogrubienie">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A. oświadczam, że podpisy Klienta widniejące na formularzu umowy, pełnomocnictwie oraz niniejszym druku zgłoszenia roszczenia zostały złożone w mojej obecności własnoręcznie przez Klienta.*</p>
	</div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>CZYTELNY PODPIS PRZEDSTAWICIELA</p></div>
			<div class="clear_b"></div>			
		</div>
	</div>
    
    <div class="objasnienia">
		* Za Klienta uważa się osobę uprawnioną do wypłaty środków z rachunku emerytalnego, a w przypadku, gdy uprawnionym jest osoba nie posiadająca pełnej zdolności do czynności prawnych, tj. małoletni lub ubezwłasnowolniony całkowicie, przedstawiciela ustawowego lub opiekuna prawnego uprawnionego, który zawarł umowę z VOTUM S.A.
    </div></div>
    
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>	



<div class="strona strona_9">
    <div class="element">
	<div class="id_przedstawiciela margin_r_20 pogrubienie"><?php echo $identyfikator_przedstawiciela; ?></div>
    <p>IDENTYFIKATOR PRZEDSTAWICIELA</p>
    </div>
    <div class="element margin_l_20">
    <div class="podpis_przedstawiciela margin_l_20"></div>
    <p class="margin_l_20">PODPIS PRZEDSTAWICIELA</p>
    </div>
    <div class="clear_b"></div>
    <div class="element">
	<div class="kod_jednostki margin_r_20 pogrubienie"><?php echo $kod_jednostki; ?></div>
    <p>KOD JEDNOSTKI</p>
    </div>
    <div class="clear_b"></div>
    <div class="element">
	<div class="kod_konsultanta margin_r_20 pogrubienie"><?php echo $kod_konsultanta; ?></div>
    <p>KOD KONSULTANTA</p>
    </div>
    <div class="clear_b"></div>
    <div class="element">
	<div class="nr_sprawy margin_r_20 pogrubienie"><?php echo $nr_sprawy; ?></div>
    <p>NUMER SPRAWY</p>
    </div>
    <div class="clear_b"></div>
    <div class="logo_votum"></div>
    <div class="strona_znak_wodny"><?php echo $znak_wodny; ?></div>
    <div class="strona_tresc">
	<div class="tytul_strony">
		<p>ZGŁOSZENIE ROSZCZEŃ O WYPŁATĘ ŚRODKÓW <br/>
            Z RACHUNKU EMERYTALNEGO/BANKOWEGO</p>
	</div>
	<div class="formularz">
    <div class="tytul_sekcji_formularza">
        <div class="pola_w_tytule">ZLECENIODAWCA</div>
        </div>
        <div class="tresc_sekcji_fomularza">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $nazwisko_zleceniodawcy; ?></div>
		</div>
        <div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?></div>
		</div>
		<div class="clear_b"></div>
        <p>ADRES KORESPONDENCYJNY ZLECENIODAWCY (JEŚLI JEST INNY NIŻ ZAMELDOWANIA)</p>
        <div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy_kor; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy_kor; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel_2 margin_r_20"><?php echo $pesel_zleceniodawcy; ?></div>
		</div>
            <div class="element">
			<p>NUMER TELEFONU</p>
			<div class="zleceniodawca_telefon_2 margin_r_20"><?php echo $telefon_zleceniodawcy; ?></div>
		</div>
            <div class="element">
			<p>E-MAIL</p>
			<div class="zleceniodawca_email margin_r_20"><?php echo $email_zleceniodawcy; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu_2"><?php echo $dowod_zleceniodawcy; ?></div>
            </div>    
		<div class="clear_b"></div>
        </div>
    <div class="tytul_sekcji_formularza">
    <div class="pola_w_tytule">
        <div class="element">
        DZIAŁAJĄCY W IMIENIU
        </div>
        <div class="element"><div class="kratka">X</div> MAŁOLETNIEGO</div>
        <div class="element"><div class="kratka">X</div> UBEZWŁASNOWOLNIONEGO</div>
        <div class="element"><div class="kratka">X</div> MAŁŻONKA</div>
        </div>
    </div>
    <div class="tresc_sekcji_fomularza">
    
        <div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $w_imieniu_imie; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $w_imieniu_nazwisko; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $w_imieniu_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $w_imieniu_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $w_imieniu_numer_mieszkania; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $w_imieniu_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $w_imieniu_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel_2 margin_r_20"><?php echo $w_imieniu_pesel; ?></div>
		</div>
            <div class="element">
			<p>NUMER TELEFONU</p>
			<div class="zleceniodawca_telefon_2 margin_r_20"><?php echo $w_imieniu_telefon; ?></div>
		</div>
            <div class="element">
			<p>E-MAIL</p>
			<div class="zleceniodawca_email margin_r_20"><?php echo $w_imieniu_email; ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu_2"><?php echo $w_imieniu_dowod; ?></div>
            </div>    
		<div class="clear_b"></div>   
    </div>
    <div class="tytul_sekcji_formularza">
    <div class="pola_w_tytule">
        <div class="element">
        DANE ZMARŁEGO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO
        </div></div>
    </div>
    <div class="tresc_sekcji_fomularza">
    
        <div class="element">
			<p>IMIĘ</p>
			<div class="poszkodowany_imie margin_r_20"><?php echo $imie_zmarlego; ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="poszkodowany_nazwisko margin_r_20"><?php echo $nazwisko_zmarlego; ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="poszkodowany_pesel margin_r_20"><?php echo $pesel_zmarlego; ?></div>
		</div>
            <div class="element">
			<p>NIP</p>
			<div class="poszkodowany_nip margin_r_20"><?php echo $nip_zmarlego; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>NR DOWODU OSOBISTEGO LUB PASZPORTU (JEŻELI POSIADACZOWI RACHUNKU EMERYTALNEGO NIE NADANO NUMERU PESEL)</p>
			<div class="poszkodowany_seria_i_numer_dowodu"><?php echo $dowod_zmarlego; ?></div>
            </div>    
		<div class="clear_b"></div>  
        <div class="element">
			<p>STOPIEŃ POKREWIEŃSTWA Z UPRAWNIONYM (PROSIMY WSKAZAĆ, KIM BYŁ ZMARŁY DLA UPRAWNIONEGO, NP. MAŁŻONEK, MATKA, OJCIEC, ITP.).</p>
			<div class="poszkodowany_pokrewienstwo"><?php echo $pokrewienstwo_zmarlego; ?></div>
            </div>    
		<div class="clear_b"></div> 
        <div class="element">
			<p>DATA ŚMIERCI POSIADACZA RACHUNKU EMERYTALNEGO</p>
			<div class="data_smierci margin_r_20"><?php echo $data_smierci_zmarlego; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>ADRES ZAMIESZKANIA POSIADACZA RACHUNKU EMERYTALNEGO WSKAZANY PODMIOTOWI PROWADZĄCEMU RACHUNEK</p>
			<div class="adres_poszkodowanego"><?php echo $adres_zmarlego; ?></div>
            </div>    
		<div class="clear_b"></div> 
        <div class="element">
			<p>NR RACHUNKU EMERYTALNEGO</p>
			<div class="rachunek_poszkodowanego margin_r_20"><?php echo $rachunek_zmarlego; ?></div>
		</div>
		<div class="element">
			<p>PODMIOT PROWADZĄCY RACHUNEK EMERYTALNY</p>
			<div class="podmiot_rachunku margin_r_20"><?php echo $podmiot_prowadzacy_rachunek; ?></div>
		</div>
		<div class="clear_b"></div>

        <div class="sekcja">
		<div class="sekcja_tresc rozmiar_czcionki">
        <span class="pogrubienie">Czy posiadacz rachunku emerytalnego pobierał emeryturę?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK Jeśli tak, to kiedy nastąpiła pierwsza wypłata emerytury? <?php echo $data_wyplaty_emerytury; ?></div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy posiadacz rachunku emerytalnego, który nie pobierał emerytury, złożył wniosek o ustalenie prawa do emerytury?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy posiadacz rachunku emerytalnego wskazał w umowie o prowadzenie rachunku emerytalnego osoby uprawnione do otrzymania środków pieniężnych z rachunku emerytalnego po jego śmierci?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK Jeśli tak, to kogo wskazał? <span class="pogrubienie">Osoby wskazane przez zmarłego posiadacza rachunku emerytalnego:</span></div>
        <div class="element">
        <div class="poszkodowany_pokrewienstwo"><?php echo $nazwisko_uprawnionego_do_kasy; ?></div>
		</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Informacje o spadkobiercach posiadacza rachunku emerytalnego (wypełnić w przypadku, gdy brak osób wskazanych przez posiadacza rachunku emerytalnego jako uprawnione do otrzymania środków pieniężnych z rachunku emerytalnego po jego śmierci lub brak informacji na ten temat).</span><br/>
        <span class="pogrubienie">Spadkobiercy zmarłego posiadacza rachunku emerytalnego: </span><?php echo $spadkobierca; ?>
        </div></div>
        </div>
    
	</div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>PODPIS KLIENTA</p></div>
			<div class="clear_b"></div>			
		</div>
	</div></div>
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>	

<div class="strona strona_10">
    <div class="strona_znak_wodny"><?php echo $znak_wodny; ?></div>
    <div class="strona_tresc">
    <div class="formularz">
        <div class="tresc_sekcji_fomularza">
		<div class="sekcja">
		<div class="sekcja_tresc rozmiar_czcionki">
        <span class="pogrubienie">Czy zmarły był posiadaczem rachunku bankowego?</span><br/>
        (Wypełnić wyłącznie, gdy przedmiotem umowy ma być dochodzenie roszczeń z rachunku bankowego zmarłego posiadacza).<br/>
        <div class="element"><div class="kratka">X</div> TAK  /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        Jeśli tak, to w jakim banku prowadzony był rachunek: <?php echo $bank_zmarlego; ?><br/>
        i pod jakim numerem: <?php echo $rachunek_bankowy_zmarlego; ?><br/>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy zostało wydane postanowienie o stwierdzeniu nabycia spadku lub czy został sporządzony akt notarialny poświadczenia dziedziczenia po zmarłym posiadaczu rachunku emerytalnego?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element"><div class="kratka">X</div> BRAK INFORMACJI</div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy zgłoszono już roszczenie o wypłatę środków pieniężnych do podmiotu prowadzącego rachunek emerytalny?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK /</div>
        <div class="element"><div class="kratka">X</div> NIE /</div>
        <div class="element">Jeśli tak, to kiedy? <?php echo $data_roszczenia; ?></div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy uprawnionemu wypłacono środki pieniężne z rachunku emerytalnego?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK, zarówno z rachunku OFE, jak i subkonta ZUS/ </div>
        <div class="element"><div class="kratka">X</div> TAK, ale wyłącznie z rachunku OFE/ </div>
        <div class="element"><div class="kratka">X</div> NIE </div>
        <div class="clear_b"></div>   
        <span class="pogrubienie">Czy zlecono prowadzenie sprawy innemu pełnomocnikowi?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK / </div>
        <div class="element"><div class="kratka">X</div> NIE Jeśli tak, to komu? </div>
        <div class="element"><div class="poszkodowany_pokrewienstwo"><?php echo $kto_pelnomocnikiem; ?></div></div>
        <div class="clear_b"></div> 
        <span class="pogrubienie">Czy odwołano pełnomocnictwo udzielone innemu pełnomocnikowi?</span><br/>
        <div class="element"><div class="kratka">X</div> TAK / </div>
        <div class="element"><div class="kratka">X</div> NIE Jeśli tak, to kiedy? <?php echo $odwolanie_pelnomocnictwa; ?></div>
        <div class="clear_b"></div> 
        </div></div>
        </div>
        <div class="tytul_sekcji_formularza">
        <div class="pola_w_tytule">
        INNE ISTOTNE INFORMACJE PRZEKAZANE PRZEZ KLIENTA
        </div></div>
        

        <div class="tresc_sekcji_fomularza">
        <?php echo $inne_informacje; ?>
        </div>
        
        <div class="tytul_sekcji_formularza">
        <div class="pola_w_tytule">
        LISTA DOKUMENTACJI POBRANEJ OD KLIENTA
        </div></div>

        <div class="tresc_sekcji_fomularza">
        <?php echo $lista_dokumentacji; ?>
        </div>
        <span class="pogrubienie">
        <div class="element"><div class="kratka">X</div> Oświadczam, że prowadzę pozarolniczą działalność gospodarczą.</div>
        <div class="element"><div class="kratka">X</div> Jestem zainteresowany/a ofertą produktów finansowych i wyrażam zgodę na przekazywanie Protecta Finance Sp. z o.o. we Włocławku moich danych osobowych w celach marketingowych, w szczególności w celu opracowania i przedstawienia oferty.</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> Nie jestem zainteresowany/a ofertą produktów finansowych.</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> Wyrażam zgodę / </div><div class="element"><div class="kratka">X</div> Nie wyrażam zgody na otrzymywanie informacji związanych z wykonywaniem umowy poprzez</div>
        <div class="clear_b"></div> 
        <div class="element"><div class="kratka">X</div> wiadomości tekstowe SMS / </div><div class="element"><div class="kratka">X</div> wiadomości e-mail na numer/adres przeze mnie wskazany.</div></span>
        <div class="clear_b"></div> 

	</div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
		<div class="clear_b"></div>	
			<div class="podpis_lewo pogrubienie"><p>MIEJSCOWOŚĆ I DATA</p></div>
			<div class="podpis_prawo pogrubienie"><p>PODPIS KLIENTA</p></div>
			<div class="clear_b"></div>		
		</div>
	</div>
    
    <div class="oswiadczenie">
		<p class="pogrubienie">Oświadczenie</p>
		<p class="pogrubienie">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A. oświadczam, że podpisy Klienta widniejące na formularzu umowy, pełnomocnictwie oraz niniejszym druku zgłoszenia roszczenia zostały złożone w mojej obecności własnoręcznie przez Klienta.*</p>
	</div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo pogrubienie"><p>CZYTELNY PODPIS PRZEDSTAWICIELA</p></div>
			<div class="clear_b"></div>			
		</div>
	</div>
    
    <div class="objasnienia">
		* Za Klienta uważa się osobę uprawnioną do wypłaty środków z rachunku emerytalnego, a w przypadku, gdy uprawnionym jest osoba nie posiadająca pełnej zdolności do czynności prawnych, tj. małoletni lub ubezwłasnowolniony całkowicie, przedstawiciela ustawowego lub opiekuna prawnego uprawnionego, który zawarł umowę z VOTUM S.A.
    </div></div>
    
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>	

<div class="strona strona_11">
	<div class="logo_votum"></div>
    <div class="strona_tresc">
	<div class="tytul_strony_pierwszej">
		<p>PEŁNOMOCNICTWO</p>
	</div>
	<div class="formularz_czerwony">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $dowod_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu małoletniego /ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $imie_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $nazwisko_poszkodowany ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $ulica_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $numer_domu_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $miejscowosc_poszkodowany ?></div>
		</div>	
		<div class="clear_b"></div>
        <div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $dowod_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>	
	</div>
    <div class="tekst_szary">UPOWAŻNIAM:</div>
    <div class="formularz_szary margin_top_35"><div class="padding_6">
	VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, zarejestrowaną w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu, VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod <span class="czerwony_tekst">nr KRS 0000243252, REGON 020136043, NIP 899-25-49-057, kapitał zakładowy 1.200.000 zł wpłacony w całości</span>, do reprezentowania mnie/ małoletniego/ ubezwłasnowolnionego całkowicie/ małżonka* (niewłaściwe skreślić), przy wykonywaniu wszelkich czynności mających na celu ustalenie i realizację uprawnienia do wypłaty środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym, zwanym „rachunkiem emerytalnym” lub na rachunku bankowym prowadzonym na rzecz posiadacza:<br/><br/>
    <div class="element">
        <p>IMIĘ I NAZWISKO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO</p>
        <div class="poszkodowany_pokrewienstwo"><?php echo $posiadacz_rachunku; ?></div></div>   
    <div class="clear_b"></div><br/>
    w szczególności do:<br/>
    1. wszelkich czynności pozaprocesowych i polubownych, w tym składania i odbierania oświadczeń woli;<br/> 
    2. odbioru środków pieniężnych zgromadzonych na „rachunku emerytalnym” lub na rachunku bankowym i wskazania numeru rachunku bankowego, na który ma być spełnione świadczenie;<br/> 
    3. odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem;<br/> 
    4. gromadzenia dokumentacji niezbędnej do uzyskania wypłaty środków pieniężnych z „rachunku emerytalnego”, w tym do odbioru tej dokumentacji od podmiotów, które ją tworzą i przechowują;<br/> 
    5. udzielania dalszych pełnomocnictw.
    </div></div>
    

    <div class="sekcja_tresc">
    W zakresie czynności objętych pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych zgodnie z ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz. U. z 2014 r., poz. 1182 ze zm.).
    </div>
       
        <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS MOCODAWCY</div>
			<div class="clear_b"></div>		
		</div>
	    </div></div>
    
    <div class="objasnienia bottom">
		1) *W przypadku, gdy umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.
        </div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


<div class="strona strona_12">
	<div class="logo_votum"></div>
    <div class="strona_tresc">
	<div class="tytul_strony_pierwszej">
		<p>PEŁNOMOCNICTWO</p>
	</div>
	<div class="formularz_czerwony">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $dowod_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu małoletniego /ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $imie_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $nazwisko_poszkodowany ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $ulica_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $numer_domu_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $miejscowosc_poszkodowany ?></div>
		</div>	
		<div class="clear_b"></div>
        <div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $dowod_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>	
	</div>
    <div class="tekst_szary">UPOWAŻNIAM:</div>
    <div class="formularz_szary margin_top_35"><div class="padding_6">
	VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, zarejestrowaną w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu, VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod <span class="czerwony_tekst">nr KRS 0000243252, REGON 020136043, NIP 899-25-49-057, kapitał zakładowy 1.200.000 zł wpłacony w całości</span>, do reprezentowania mnie/ małoletniego/ ubezwłasnowolnionego całkowicie/ małżonka* (niewłaściwe skreślić), przy wykonywaniu wszelkich czynności mających na celu ustalenie i realizację uprawnienia do wypłaty środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym, zwanym „rachunkiem emerytalnym” lub na rachunku bankowym prowadzonym na rzecz posiadacza:<br/><br/>
    <div class="element">
        <p>IMIĘ I NAZWISKO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO</p>
        <div class="poszkodowany_pokrewienstwo"><?php echo $posiadacz_rachunku; ?></div></div>   
    <div class="clear_b"></div><br/>
    w szczególności do:<br/>
    1. wszelkich czynności pozaprocesowych i polubownych, w tym składania i odbierania oświadczeń woli;<br/> 
    2. odbioru środków pieniężnych zgromadzonych na „rachunku emerytalnym” lub na rachunku bankowym i wskazania numeru rachunku bankowego, na który ma być spełnione świadczenie;<br/> 
    3. odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem;<br/> 
    4. gromadzenia dokumentacji niezbędnej do uzyskania wypłaty środków pieniężnych z „rachunku emerytalnego”, w tym do odbioru tej dokumentacji od podmiotów, które ją tworzą i przechowują;<br/> 
    5. udzielania dalszych pełnomocnictw.
    </div></div>
    

    <div class="sekcja_tresc">
    W zakresie czynności objętych pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych zgodnie z ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz. U. z 2014 r., poz. 1182 ze zm.).
    </div>
       
        <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS MOCODAWCY</div>
			<div class="clear_b"></div>		
		</div>
	    </div></div>
    
    <div class="objasnienia bottom">
		1) *W przypadku, gdy umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.
        </div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


<div class="strona strona_13">
	<div class="logo_votum"></div>
    <div class="strona_tresc">
	<div class="tytul_strony_pierwszej">
		<p>PEŁNOMOCNICTWO</p>
	</div>
	<div class="formularz_czerwony">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $dowod_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu małoletniego /ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $imie_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $nazwisko_poszkodowany ?></div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $ulica_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $numer_domu_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_poszkodowany ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $miejscowosc_poszkodowany ?></div>
		</div>	
		<div class="clear_b"></div>
        <div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $pesel_zleceniodawcy ?></div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $dowod_zleceniodawcy ?></div>
		</div>
		<div class="clear_b"></div>	
	</div>
    <div class="tekst_szary">UPOWAŻNIAM:</div>
    <div class="formularz_szary margin_top_35"><div class="padding_6">
	VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, zarejestrowaną w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu, VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod <span class="czerwony_tekst">nr KRS 0000243252, REGON 020136043, NIP 899-25-49-057, kapitał zakładowy 1.200.000 zł wpłacony w całości</span>, do reprezentowania mnie/ małoletniego/ ubezwłasnowolnionego całkowicie/ małżonka* (niewłaściwe skreślić), przy wykonywaniu wszelkich czynności mających na celu ustalenie i realizację uprawnienia do wypłaty środków pieniężnych zgromadzonych na rachunku prowadzonym przez Otwarty Fundusz Emerytalny lub na subkoncie prowadzonym przez Zakład Ubezpieczeń Społecznych, lub na innym koncie emerytalnym, zwanym „rachunkiem emerytalnym” lub na rachunku bankowym prowadzonym na rzecz posiadacza:<br/><br/>
    <div class="element">
        <p>IMIĘ I NAZWISKO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO</p>
        <div class="poszkodowany_pokrewienstwo"><?php echo $posiadacz_rachunku; ?></div></div>   
    <div class="clear_b"></div><br/>
    w szczególności do:<br/>
    1. wszelkich czynności pozaprocesowych i polubownych, w tym składania i odbierania oświadczeń woli;<br/> 
    2. odbioru środków pieniężnych zgromadzonych na „rachunku emerytalnym” lub na rachunku bankowym i wskazania numeru rachunku bankowego, na który ma być spełnione świadczenie;<br/> 
    3. odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem;<br/> 
    4. gromadzenia dokumentacji niezbędnej do uzyskania wypłaty środków pieniężnych z „rachunku emerytalnego”, w tym do odbioru tej dokumentacji od podmiotów, które ją tworzą i przechowują;<br/> 
    5. udzielania dalszych pełnomocnictw.
    </div></div>
    

    <div class="sekcja_tresc">
    W zakresie czynności objętych pełnomocnictwem wyrażam zgodę na przetwarzanie danych osobowych zgodnie z ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz. U. z 2014 r., poz. 1182 ze zm.).
    </div>
       
        <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS MOCODAWCY</div>
			<div class="clear_b"></div>		
		</div>
	    </div></div>
    
    <div class="objasnienia bottom">
		1) *W przypadku, gdy umowa zawierana jest w imieniu osoby nieposiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.
        </div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_14">
	<div class="logo_kairp"></div>
	<div class="naglowek_z_data">Wrocław, dnia <?php echo $data_zamowienia ?></div>
    <div class="pelnomocnictwo_tytul"><p>PEŁNOMOCNICTWO</p></div>
	    
    <div class="sekcja_tresc">
    Ja niżej podpisany/a, <?php echo $imie_zleceniodawcy.' '.$nazwisko_zleceniodawcy; ?> upoważniam adwokata/radcę prawnego _________________________________________________ do prowadzenia sprawy dochodzenia roszczeń o wypłatę środków z rachunku emerytalnego/dochodzenia roszczeń o wypłatę środków zgromadzonych na rachunkach bankowych zmarłego <?php echo $imie_zmarlego.' '.$nazwisko_zmarlego; ?> oraz do odbioru świadczenia.</br> 
    
    </div>
    
    <div class="podpis_prawo small_font margin_top_100">PODPIS MOCODAWCY</div>

    <div class="sekcja_tresc margin_top_200">
    Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</br>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
    
    </div>

    <div class="sekcja_tresc margin_top_100">
    <div class="element">Wrocław, dnia <?php echo $data_zamowienia ?> r.</div>
    <div class="clear_b"></div>	
    <div class="podpis_lewo small_font">PODPIS PEŁNOMOCNIKA</div>
    <div class="clear_b"></div>	
    </div>

	<div class="strona_stopka">
        <div class="linie_full"></div>
		<div class="strona_stopka_numer_strony">
        <div class="font_red">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A.ŁEBEK I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
        ul. Wyścigowa 56i; 53-012 Wrocłąw, tel. +48 71 332 93 40, fax +48 332 93 43</br> 
        e–mail: kancelaria@kairp–lebek.pl, www.kairp–lebek.pl</br> 
        NIP: 899–25–79–696 REGON: 020356170 KRS:0000262469        
        </div>
	</div>
</div>

<div class="strona strona_15">
	<div class="logo_kairp"></div>
	<div class="naglowek_z_data">Wrocław, dnia <?php echo $data_zamowienia ?></div>
    <div class="pelnomocnictwo_tytul"><p>PEŁNOMOCNICTWO</p></div>
	    
    <div class="sekcja_tresc">
    Ja niżej podpisany/a, <?php echo $imie_zleceniodawcy.' '.$nazwisko_zleceniodawcy; ?> upoważniam adwokata/radcę prawnego _________________________________________________ do prowadzenia sprawy dochodzenia roszczeń o wypłatę środków z rachunku emerytalnego/dochodzenia roszczeń o wypłatę środków zgromadzonych na rachunkach bankowych zmarłego <?php echo $imie_zmarlego.' '.$nazwisko_zmarlego; ?> oraz do odbioru świadczenia.</br> 
    
    </div>
    
    <div class="podpis_prawo small_font margin_top_100">PODPIS MOCODAWCY</div>

    <div class="sekcja_tresc margin_top_200">
    Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</br>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
    
    </div>

    <div class="sekcja_tresc margin_top_100">
    <div class="element">Wrocław, dnia <?php echo $data_zamowienia ?> r.</div>
    <div class="clear_b"></div>	
    <div class="podpis_lewo small_font">PODPIS PEŁNOMOCNIKA</div>
    <div class="clear_b"></div>	
    </div>

	<div class="strona_stopka">
        <div class="linie_full"></div>
		<div class="strona_stopka_numer_strony">
        <div class="font_red">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A.ŁEBEK I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
        ul. Wyścigowa 56i; 53-012 Wrocłąw, tel. +48 71 332 93 40, fax +48 332 93 43</br> 
        e–mail: kancelaria@kairp–lebek.pl, www.kairp–lebek.pl</br> 
        NIP: 899–25–79–696 REGON: 020356170 KRS:0000262469        
        </div>
	</div>
</div>

<div class="strona strona_16">
	<div class="logo_kairp"></div>
	<div class="naglowek_z_data">Wrocław, dnia <?php echo $data_zamowienia ?></div>
    <div class="pelnomocnictwo_tytul"><p>PEŁNOMOCNICTWO</p></div>
	    
    <div class="sekcja_tresc">
    Ja niżej podpisany/a, <?php echo $imie_zleceniodawcy.' '.$nazwisko_zleceniodawcy; ?> upoważniam adwokata/radcę prawnego _________________________________________________ do prowadzenia sprawy dochodzenia roszczeń o wypłatę środków z rachunku emerytalnego/dochodzenia roszczeń o wypłatę środków zgromadzonych na rachunkach bankowych zmarłego <?php echo $imie_zmarlego.' '.$nazwisko_zmarlego; ?> oraz do odbioru świadczenia.</br> 
    
    </div>
    
    <div class="podpis_prawo small_font margin_top_100">PODPIS MOCODAWCY</div>

    <div class="sekcja_tresc margin_top_200">
    Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</br>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
			<div class="linie_lewo"></div>
		<div class="clear_b"></div>
    
    </div>

    <div class="sekcja_tresc margin_top_100">
    <div class="element">Wrocław, dnia <?php echo $data_zamowienia ?> r.</div>
    <div class="clear_b"></div>	
    <div class="podpis_lewo small_font">PODPIS PEŁNOMOCNIKA</div>
    <div class="clear_b"></div>	
    </div>

	<div class="strona_stopka">
        <div class="linie_full"></div>
		<div class="strona_stopka_numer_strony">
        <div class="font_red">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A.ŁEBEK I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
        ul. Wyścigowa 56i; 53-012 Wrocłąw, tel. +48 71 332 93 40, fax +48 332 93 43</br> 
        e–mail: kancelaria@kairp–lebek.pl, www.kairp–lebek.pl</br> 
        NIP: 899–25–79–696 REGON: 020356170 KRS:0000262469        
        </div>
	</div>
</div>


<div class="strona strona_17">
	<div class="logo_votum"></div>
    
    <div class="sekcja_tresc margin_top_70">
            <div class="linie_prawo">Wrocław, dnia <?php echo $data_zamowienia ?></div>
			<div class="naglowek_lewo"></div>
		<div class="clear_b"></div>
			<div class="naglowek_lewo"></div>
		<div class="clear_b"></div>
			<div class="naglowek_lewo small_font">DANE MAŁŻONKA ZMARŁEGO</div>
		<div class="clear_b"></div>
    
    </div>
    
    <div class="tytul_strony_pierwszej">
		<p>OŚWIADCZENIE O MAŁŻEŃSKICH<br/> STOSUNKACH MAJĄTKOWYCH
        </p>
	</div>
    	<div class="formularz_czerwony_oswiadczenie margin_top_100">
            <span class="pogrubienie">w dniu zawarcia związku małżeńskiego z </span> 
            <?php echo $dane_małżonka ?>
            <div class="clear_b"></div>
            <div class="element"><div class="kratka">X</div> istniała wspólnota majątkowa,</div>
            <div class="clear_b"></div>
            <div class="element"><div class="kratka">X</div> istniała rozdzielność majątkowa;</div>
		    <div class="clear_b"></div><br/>
            
            <span class="pogrubienie">od zawarcia małżeństwa do chwili śmierci małżonka </span> 
            <div class="clear_b"></div>
            <div class="element"><div class="kratka">X</div> nie zaszły żadne zmiany w małżeńskich stosunkach majątkowych,</div>
            <div class="clear_b"></div>
            <div class="element"><div class="kratka">X</div> zaszły zmiany w małżeńskich stosunkach majątkowych, na dowód tego załączam:</div>
		    <div class="clear_b"></div><br/>
            
            <span class="pogrubienie">Prawomocne orzeczenie sądu/umowę w formie aktu notarialnego </span> 
            <div class="clear_b"></div><br/>
            
            <span class="pogrubienie">Jednocześnie oświadczam, że: </span> 
            <div class="clear_b"></div>
            <div class="element"><div class="kratka">X</div> posiadam rachunek w otwartym funduszu emerytalnym prowadzony pod numerem:<br/>
            <?php echo $numer_rachunku_w_funduszu ?>
            </div>
            <div class="clear_b"></div>
            <div class="element"><div class="kratka">X</div> nie posiadam rachunku w otwartym funduszu emerytalnym.</div>
		    <div class="clear_b"></div>

	</div>
    
    <div class="podpis_prawo small_font margin_top_100">WŁASNORĘCZNY PODPIS</div>
    
<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_18">
	<div class="logo_votum"></div>
	<div class="tytul_strony_pierwszej">
		<p>POUCZENIE O PRAWIE DO ODSTĄPIENIA</br>
        OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA
        </p>
	</div>
    <div class="sekcja_tytul_lewa">PRAWO DO ODSTĄPIENIA OD UMOWY</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc"><p>
			Zgodnie z przepisami ustawy z dnia 30 maja 2014 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że ma
            Pan/Pani prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od
            umowy kończy się po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, musi Pan/Pani
            poinformować VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl
            o swojej decyzji w drodze jednoznacznego oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną.
            Może Pan/Pani skorzystać z wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do
            odstąpienia od umowy, wystarczy, aby wysłał/a Pan/Pani informację dotyczącą wykonania przysługującego Panu/Pani prawa do
            odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.
		</p></div>
	</div>

    <div class="sekcja_tytul_lewa">SKUTKI ODSTĄPIENIA OD UMOWY</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc"><p>
			W przypadku odstąpienia od niniejszej umowy VOTUM zwraca Panu/Pani wszelkie otrzymane od Pana/Pani płatności, niezwłocznie,
            a w każdym wypadku nie później niż 14 dni od dnia, w którym VOTUM została poinformowana o Pana/Pani decyzji o wykonaniu prawa
            odstąpienia od niniejszej umowy. VOTUM dokona zwrotu płatności przy użyciu takich samych sposobów płatności, jakie zostały przez
            Pana/Panią użyte w pierwotnej transakcji, chyba że Pan/i wyraźnie zgodził/a się na inne rozwiązanie, w każdym przypadku nie poniesie
            Pan/Pani żadnych opłat w związku z tym zwrotem.
		</p>
        <p>Jeżeli zażądał Pan/Pani rozpoczęcia świadczenia usług przed upływem terminu do odstąpienia od umowy, zapłaci Pan/Pani VOTUM
            kwotę proporcjonalną do zakresu świadczeń spełnionych do chwili, w której poinformował/a Pan/Pani VOTUM o odstąpieniu od
            niniejszej umowy.</p>
        <p>Na podstawie art. 38 pkt 1 ustawy z dnia 30 maja 2014 r. o prawach konsumenta VOTUM informuje, że jeżeli wyrazi Pani/Pan zgodę
            na rozpoczęcie świadczenia usług przez VOTUM przed terminem do odstąpienia i VOTUM wykona całą usługę przed upływem terminu
            do odstąpienia, utraci Pani/Pan prawo do odstąpienia od umowy.</p>
        </div>
	</div>

    <div class="sekcja_tytul_lewa">POZASĄDOWE SPOSOBY ROZPATRYWANIA REKLAMACJI</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc"><p>
			Jeżeli złoży Pan/Pani reklamację na usługi VOTUM i nie zostanie ona uwzględniona albo rozpatrzona przez VOTUM
            w terminie 14 dni od dnia jej otrzymania, ma Pan/Pani prawo skorzystać z pozasądowych sposobów rozpatrywania reklamacji
            w drodze mediacji lub za pomocą sądów polubownych, składając na odpowiednim formularzu wniosek do właściwego
            terenowo Wojewódzkiego Inspektoratu Inspekcji Handlowej. Może Pan/Pani również zwrócić się o pomoc do właściwego
            terenowo miejskiego lub powiatowego rzecznika konsumentów. Ze wskazanych sposobów rozwiązywania sporów można
            skorzystać dobrowolnie i nieodpłatnie. Więcej informacji na ten temat może Pan/Pani uzyskać we wskazanych instytucjach oraz
            w Urzędzie Ochrony Konkurencji i Konsumentów, www.uokik.gov.pl.
		</p></div>
	</div> 
    
    <div class="odstapienie">
    <div class="znak_wodny_wzor"><?php echo $znak_wodny_wzor; ?></div>
    <div class="znak_wodny_nie_wypelniac"><?php echo $znak_wodny_nie_wypelniac; ?></div>
    <div class="strona_tresc">
        <div class="tytul_formularza">WZÓR FORMULARZA ODSTĄPIENIA OD UMOWY</div>
        <span class="pogrubienie"><div class="odstapienie_adres_votum">
            VOTUM S.A.</br>
            ul. Wyścigowa 56i</br>
            53-012 Wrocław</div></span>
    <div class="odstapienie_adres_votum">
            fax: 71/ 33 93 403</br>
            dok@votum-sa.pl</div>
    <div class="formularz_odstapienie_tytul">ODSTĄPIENIE OD UMOWY</div>
    <div class="formularz_odstapienie_podtytul">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
    <div class="odstapienie_data">Niniejszym informuję o moim odstąpieniu od umowy zawartej na podstawie zamówienia z dnia .......................</div>
    <div class="konsument">
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info">IMIĘ I NAZWISKO KONSUMENTA</div>
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info"></div>
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info">ADRES ZAMIESZKANIA KONSUMENTA</div>
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info">PODPIS KONSUMENTA, DATA</div>
    </div>
		<div class="clear_b"></div>
	</div>
    </div>
    <div class="sekcja_tresc margin_l_20 pogrubienie"><p>
			Potwierdzam otrzymanie pouczenia o jednakowej treści oraz formularza odstąpienia od umowy o treści zgodnej z zamieszczonym
            wyżej wzorem.
		</p></div>
    <div class="podpis_prawo small_font">
                PODPIS KONSUMENTA, DATA</div>

   	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_19">
	<div class="logo_votum"></div>
	<div class="tytul_strony_pierwszej">
		<p>POUCZENIE O PRAWIE DO ODSTĄPIENIA</br>
        OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA
        </p>
	</div>
    <div class="sekcja_tytul_lewa">PRAWO DO ODSTĄPIENIA OD UMOWY</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc"><p>
			Zgodnie z przepisami ustawy z dnia 30 maja 2014 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że ma
            Pan/Pani prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od
            umowy kończy się po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, musi Pan/Pani
            poinformować VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl
            o swojej decyzji w drodze jednoznacznego oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną.
            Może Pan/Pani skorzystać z wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do
            odstąpienia od umowy, wystarczy, aby wysłał/a Pan/Pani informację dotyczącą wykonania przysługującego Panu/Pani prawa do
            odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.
		</p></div>
	</div>

    <div class="sekcja_tytul_lewa">SKUTKI ODSTĄPIENIA OD UMOWY</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc"><p>
			W przypadku odstąpienia od niniejszej umowy VOTUM zwraca Panu/Pani wszelkie otrzymane od Pana/Pani płatności, niezwłocznie,
            a w każdym wypadku nie później niż 14 dni od dnia, w którym VOTUM została poinformowana o Pana/Pani decyzji o wykonaniu prawa
            odstąpienia od niniejszej umowy. VOTUM dokona zwrotu płatności przy użyciu takich samych sposobów płatności, jakie zostały przez
            Pana/Panią użyte w pierwotnej transakcji, chyba że Pan/i wyraźnie zgodził/a się na inne rozwiązanie, w każdym przypadku nie poniesie
            Pan/Pani żadnych opłat w związku z tym zwrotem.
		</p>
        <p>Jeżeli zażądał Pan/Pani rozpoczęcia świadczenia usług przed upływem terminu do odstąpienia od umowy, zapłaci Pan/Pani VOTUM
            kwotę proporcjonalną do zakresu świadczeń spełnionych do chwili, w której poinformował/a Pan/Pani VOTUM o odstąpieniu od
            niniejszej umowy.</p>
        <p>Na podstawie art. 38 pkt 1 ustawy z dnia 30 maja 2014 r. o prawach konsumenta VOTUM informuje, że jeżeli wyrazi Pani/Pan zgodę
            na rozpoczęcie świadczenia usług przez VOTUM przed terminem do odstąpienia i VOTUM wykona całą usługę przed upływem terminu
            do odstąpienia, utraci Pani/Pan prawo do odstąpienia od umowy.</p>
        </div>
	</div>

    <div class="sekcja_tytul_lewa">POZASĄDOWE SPOSOBY ROZPATRYWANIA REKLAMACJI</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc"><p>
			Jeżeli złoży Pan/Pani reklamację na usługi VOTUM i nie zostanie ona uwzględniona albo rozpatrzona przez VOTUM
            w terminie 14 dni od dnia jej otrzymania, ma Pan/Pani prawo skorzystać z pozasądowych sposobów rozpatrywania reklamacji
            w drodze mediacji lub za pomocą sądów polubownych, składając na odpowiednim formularzu wniosek do właściwego
            terenowo Wojewódzkiego Inspektoratu Inspekcji Handlowej. Może Pan/Pani również zwrócić się o pomoc do właściwego
            terenowo miejskiego lub powiatowego rzecznika konsumentów. Ze wskazanych sposobów rozwiązywania sporów można
            skorzystać dobrowolnie i nieodpłatnie. Więcej informacji na ten temat może Pan/Pani uzyskać we wskazanych instytucjach oraz
            w Urzędzie Ochrony Konkurencji i Konsumentów, www.uokik.gov.pl.
		</p></div>
	</div> 
    
    <div class="odstapienie">
        <div class="znak_wodny_wzor"><?php echo $znak_wodny_wzor; ?></div>
        <div class="znak_wodny_nie_wypelniac"><?php echo $znak_wodny_nie_wypelniac; ?></div>
        <div class="strona_tresc">
        <div class="tytul_formularza">WZÓR FORMULARZA ODSTĄPIENIA OD UMOWY</div>
        <span class="pogrubienie"><div class="odstapienie_adres_votum">
            VOTUM S.A.</br>
            ul. Wyścigowa 56i</br>
            53-012 Wrocław</div></span>
    <div class="odstapienie_adres_votum">
            fax: 71/ 33 93 403</br>
            dok@votum-sa.pl</div>
    <div class="formularz_odstapienie_tytul">ODSTĄPIENIE OD UMOWY</div>
    <div class="formularz_odstapienie_podtytul">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
    <div class="odstapienie_data">Niniejszym informuję o moim odstąpieniu od umowy zawartej na podstawie zamówienia z dnia .......................</div>
    <div class="konsument">
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info">IMIĘ I NAZWISKO KONSUMENTA</div>
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info"></div>
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info">ADRES ZAMIESZKANIA KONSUMENTA</div>
        <div class="dane_konsumenta"></div>
        <div class="dane_konsumenta_info">PODPIS KONSUMENTA, DATA</div>
    </div>
		<div class="clear_b"></div>
	</div>
    </div>

   	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_20">
	<div class="sekcja">
        <span class="pogrubienie"><div class="odstapienie_adres_votum_big">
            VOTUM S.A.</br>
            ul. Wyścigowa 56i</br>
            53-012 Wrocław</div></span>
    <div class="odstapienie_adres_votum_big">
            fax: 71/ 33 93 403</br>
            dok@votum-sa.pl</div>
    <div class="formularz_odstapienie_tytul_big">ODSTĄPIENIE OD UMOWY</div>
    <div class="formularz_odstapienie_podtytul_big">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
    <div class="odstapienie_data_big">Niniejszym informuję o moim odstąpieniu od umowy zawartej na podstawie zamówienia z dnia ........................</div>
    <div class="konsument_big">
        <div class="dane_konsumenta_big"></div>
        <div class="dane_konsumenta_info_big">IMIĘ I NAZWISKO KONSUMENTA</div>
        <div class="dane_konsumenta_big"></div>
        <div class="dane_konsumenta_info_big"></div>
        <div class="dane_konsumenta_big"></div>
        <div class="dane_konsumenta_info_big">ADRES ZAMIESZKANIA KONSUMENTA</div>
        <div class="dane_konsumenta_big"></div>
        <div class="dane_konsumenta_info_big">PODPIS KONSUMENTA, DATA</div>
    </div>
		<div class="clear_b"></div>
	</div>
    <div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div> 
