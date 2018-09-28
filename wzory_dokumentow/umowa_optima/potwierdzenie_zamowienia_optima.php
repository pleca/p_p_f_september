<?php 

	require_once($_SERVER ['DOCUMENT_ROOT'].'wzory_dokumentow/db/funkcje_db.php');
	
	require_once($_SERVER ['DOCUMENT_ROOT'].'funkcje_glowne.php');

	$dokument_id = $_POST['dokument_id'];
	$uzytkownik_id = $_POST['uzytkownik_id'];
	
	$umowa = umowa_pobierz_dane_po_id_dla_uzytkownika($dokument_id, $uzytkownik_id);
	
	$znak_wodny = 'POTWIERDZENIE ZAMÓWIENIA';
	
	$numer_stopka = 'PG-2-1-F1/2016-03-25';
	
	$wysokosc_wynagrodzenia_procent = $umowa['wynagrodzenie_procent'];
	$wysokosc_wynagrodzenia_procent_slownie = slownie($wysokosc_wynagrodzenia_procent);
?>

<script src="../js/jquery.js"></script>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />

<div class="strona">
	<div class="identyfikator_przedstawiciela"><?php echo $umowa['numer_agenta']; ?></div>
	<div class="logo_votum"></div>
	<div class="strona_znak_wodny"><?php echo $znak_wodny; ?></div>
	<div class="tytul_strony umowa_optima">
		<p>UMOWA</p>
		<p>O DOCHODZENIE ROSZCZEŃ Z OBSŁUGĄ PROCESOWĄ “OPTIMA”</p>
	</div>
	<div class="na_podstawie_zamowienia">
		<p>na podstawie zamówienia z dnia</p>
		<p class="pogrubienie">30-10-1991</p>
		<p>r. złożonego przez</p>
	</div>
	<div class="zleceniodawca">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $umowa['klient_imie']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $umowa['klient_nazwisko']; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $umowa['klient_ulica']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $umowa['klient_nr_domu']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $umowa['klient_nr_mieszkania']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $umowa['klient_kod_pocztowy']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $umowa['klient_miasto']; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>PESEL</p>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $umowa['klient_pesel']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>SERIA I NUMER DOWODU</p>
			<div class="zleceniodawca_seria_i_numer_dowodu margin_r_20"><?php echo $umowa['klient_dowod_osobisty']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>TELEFON</p>
			<div class="zleceniodawca_telefon "><?php echo $umowa['klient_telefon']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>ADRES E-MAIL</p>
			<div class="zleceniodawca_adres_email"><?php echo $umowa['klient_adres_email']; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>		
		<div class="napis">działającego w imieniu 
			<span><?php 
				if($umowa['klient_dziala_w_imieniu']=='małoletniego'){
					echo 'małoletniego';
				} else{
					echo '<s>małoletniego</s>';
				}
				?>
			</span> / 
			<span><?php 
				if($umowa['klient_dziala_w_imieniu']=='ubezwłasnowolnionego'){
					echo 'ubezwłasnowolnionego';
				} else{
					echo '<s>ubezwłasnowolnionego</s>';
				}
				?>
			</span>/ 
			<span><?php 
				if($umowa['klient_dziala_w_imieniu']=='małżonka'){
					echo 'małżonka';
				} else{
					echo '<s>małżonka</s>';
				}
				?>
			*</span>
		</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $umowa['reprezentant_imie']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $umowa['reprezentant_nazwisko']; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $umowa['reprezentant_ulica']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $umowa['reprezentant_nr_domu']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $umowa['reprezentant_nr_mieszkania']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $umowa['reprezentant_kod_pocztowy']; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $umowa['reprezentant_miasto']; ?>&nbsp;</div>
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
		<div class="zleceniobiorca_reprezentant">&nbsp;</div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="sekcja_paragraf">§ 1</div>
		<div class="sekcja_tresc"><p>
			Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności mających na celu ustalenie
podmiotu (zwanego dalej zobowiązanym) ponoszącego odpowiedzialność cywilną w związku z wypadkiem z dnia <b><?php echo $umowa['data_wypadku']; ?></b>
			i uzyskanie od niego świadczeń odszkodowawczych za szkodę na osobie należnych Zleceniodawcy.
		</p></div>
	</div>
	
	<div class="sekcja">
		<div class="sekcja_tytul">OKRES OBOWIĄZYWANIA UMOWY</div>
		<div class="sekcja_paragraf">§ 2</div>
		<div class="sekcja_tresc"><p>
			Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Zleceniodawcy świadczeń należnych od zobowiązanego <span class="pogrubienie">w postępowaniu
przedsądowym, sądowym i egzekucyjnym.</span>
		</p></div>
	</div>
	
		<div class="sekcja">
		<div class="sekcja_tytul">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</div>
		<div class="sekcja_paragraf">§ 3</div>
		<div class="sekcja_tresc">
			<p>
				1. Skierowanie sprawy na drogę postępowania sądowego przeciwko zobowiązanemu wymaga zgody obu stron umowy.
			</p>
			<p>
				2. W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie postępowania sądowego, zobowiązuje się on do niezwłocznego
przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy oraz wszelkiej żądanej przez niego dokumentacji
i oświadczeń, które będą przydatne do wykonania umowy.
			</p>
			<p>
				3. <span class="pogrubienie">VOTUM pokrywa koszty wynagrodzenia pełnomocnika procesowego,</span> za wyjątkiem kosztów przejazdów pełnomocnika procesowego
na rozprawy, w wysokości określonej przez przepisy Rozporządzenia Ministra Infrastruktury w sprawie warunków ustalania oraz sposobu dokonywania
zwrotu kosztów używania do celów służbowych samochodów osobowych, motocykli i motorowerów niebędących własnością pracodawcy
(Dz. U. z 2002 r. nr 27,poz. 271) albo kosztów zastępstwa substytucyjnego w wysokości nie przekraczającej 300 zł (słownie: trzystu
złotych) od każdego posiedzenia, do pokrycia których zobowiązany będzie Zleceniodawca.
			</p>
			<p>
				4. <span class="pogrubienie">VOTUM zobowiązuje się do wystąpienia o zwolnienie Zleceniodawcy z kosztów sądowych,</span> po uprzednim złożeniu przez Zleceniodawcę
oświadczenia o stanie rodzinnym, majątku i dochodach, wg wzoru urzędowego. W przypadku braku zwolnienia przez sąd
z kosztów sądowych, do ich pokrycia zobowiązuje się Zleceniodawca.
			</p>
			<p>
				5. Koszty procesu zasądzone od zobowiązanego przypadają VOTUM lub Zleceniodawcy w części, w jakiej zostały poniesione przez każdą
ze stron, z tym, że koszty zastępstwa procesowego zasądzone w sprawie przypadają pełnomocnikowi procesowemu, o którym mowa
w § 4 ust. 1.
			</p>
		</div>
	</div>
	
		<div class="sekcja">
		<div class="sekcja_tytul">PRAWA I OBOWIĄZKI STRON</div>
		<div class="sekcja_paragraf">§ 4</div>
		<div class="sekcja_tresc">
		<p>
			1. Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
<span class="pogrubienie">adwokatów lub radców prawnych,</span> przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy jak za działania własne.
		</p>

		
		
		</div>
	</div>
	
	<div class="objasnienia">
		* W przypadku, gdy umowa zawierana jest w imieniu osoby nie posiadającej pełnej zdolności do czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę
podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we
wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu. Wypełnić jedynie w razie
zaistnienia powyższych okoliczności.
	</div>
	

	
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_2">
<div class="strona_znak_wodny"><?php echo $znak_wodny; ?></div>
<div class="sekcja">
		<div class="sekcja_tresc">
		<p>
			2. Zleceniodawca upoważnia VOTUM do pozyskiwania informacji o jego stanie zdrowia w zakresie, w jakim jest to niezbędne do wykonania
umowy.
		</p>
		<p>
			3. <span class="pogrubienie">VOTUM oświadcza, że nie zawrze w imieniu Zleceniodawcy ugody ze zobowiązanym bez jego zgody.</span> Wyrażenie zgody może nastąpić
w dowolnej formie. W przypadku złożenia oferty zawarcia ugody przez zobowiązanego bezpośrednio Zleceniodawcy, zobowiązuje
się on do niezwłocznego poinformowania o tym VOTUM.
		</p>
		<p>
			4. Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM.
VOTUM rozpatruje reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 14 dni.
		</p>
		<p>
			5. Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email,
a w przypadku ich braku – na adres zameldowania/korespondencyjny.
		</p>
		
		
		</div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tytul">WYNAGRODZENIE</div>
		<div class="sekcja_paragraf">§ 5</div>
		<div class="sekcja_tresc">
			<p class="margin_b_10">
				1. VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych świadczeń w terminie <span class="pogrubienie">7 dni roboczych</span> od dnia ich otrzymania, po uprzednim
				potrąceniu należnego VOTUM wynagrodzenia <span class="kratka"><?php echo $umowa['klient_nr_rachunku_bankowego'] == '0' ? 'X' : '&nbsp';  ?></span>przekazem pocztowym / <span class="kratka"><?php echo $umowa['klient_nr_rachunku_bankowego'] != '0' ? 'X' : '&nbsp';  ?></span>na wskazany przez Zleceniodawcę rachunek bankowy:
			</p>
			<div class="element">
				<p>NR RACHUNKU</p>
				<div class="zleceniodawca_nr_rachunku margin_r_20"><?php echo $umowa['klient_nr_rachunku_bankowego'] == 'NULL' ? '&nbsp' : $umowa['klient_nr_rachunku_bankowego'];  ?>&nbsp;</div>
			</div>
			<div class="element kratka_element">
				<span class="kratka"><?php echo $umowa['odbiorca_id'] == $umowa['klient_id'] ? 'X' : '&nbsp&nbsp';  ?></span><p>POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</p>
			</div>
			<div class="clear_b"></div>
			<p class="male_litery">POSIADACZ RACHUNKU (Wypełnić, jeżeli posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko oraz adres posiadacza.)</p>
			<div class="element">
				<p>IMIĘ</p>
				<div class="posiadacz_rachunku_imie margin_r_20"><?php echo $umowa['odbiorca_imie']; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="posiadacz_rachunku_nazwisko"><?php echo $umowa['odbiorca_nazwisko']; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<p>ULICA</p>
				<div class="posiadacz_rachunku_ulica margin_r_20"><?php echo $umowa['odbiorca_ulica']; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="posiadacz_rachunku_nr_domu "><?php echo $umowa['odbiorca_nr_domu']; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="posiadacz_rachunku_nr_mieszkania margin_r_20"><?php echo $umowa['odbiorca_nr_mieszkania']; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="posiadacz_rachunku_kod_pocztowy margin_r_20"><?php echo $umowa['odbiorca_kod_pocztowy']; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="posiadacz_rachunku_miejscowosc"><?php echo $umowa['odbiorca_miasto']; ?>&nbsp;</div>
			</div>	
			<div class="clear_b"></div><br/>
			<p>
				2. <span class="pogrubienie">VOTUM nie pobiera wynagrodzenia</span> od uzyskanych dla Zleceniodawcy zwrotów kosztów leczenia, hospitalizacji, rehabilitacji, dostosowania
lokalu lub pojazdu do potrzeb osoby niepełnosprawnej, zakupu protez, sprzętów ortopedycznych, lekarstw, materiałów opatrunkowych, jak
również kosztów przejazdów Zleceniodawcy oraz najbliższych członków jego rodziny do placówek medycznych.
			</p>
			<p>
				3. <span class="pogrubienie">VOTUM nie pobiera wynagrodzenia</span> od uzyskanych dla Zleceniodawcy zwrotów kosztów związanych z pogrzebem najbliższego
członka jego rodziny.
			</p>
			<p>
				4. <span class="pogrubienie">VOTUM nie pobiera wynagrodzenia</span> od uzyskanych dla Zleceniodawcy rent, chyba że zobowiązany wypłaca je jednorazowo
w wysokości należnej za okres co najmniej 6 miesięcy.
			</p>
			<p>
				5. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy.
			</p>

			<p>
				6. Z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie w wysokości <?php echo $wysokosc_wynagrodzenia_procent; ?> %
				(słownie: <?php echo $wysokosc_wynagrodzenia_procent_slownie; ?> %) brutto (w tym podatek od towarów i usług VAT w wysokości 23%)
				wartości uzyskanych dla Zleceniodawcy świadczeń.
			</p>
			<p>
				7. Dodatkowo VOTUM przysługuje zwrot <span class="pogrubienie">udokumentowanych</span> kosztów:<br/>
a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych
opłat skarbowych oraz opłat sądowych,<br/>
b) uzyskania opinii, tłumaczeń oraz odpisów i kserokopii dokumentów służących do wykonania umowy, w wysokości wynikającej
z rachunku/faktury wystawionej przez podmiot wydający opinię, tłumaczenie lub dokumenty,<br/>
c) przekazu pocztowego, jeżeli Zleceniodawca nie podał numeru rachunku bankowego do spełnienia świadczenia.
			</p>
			<p>
				8. W przypadku spełnienia świadczenia przez zobowiązanego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej umowy,
Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania należne
VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023 2392 0799
bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy Zleceniodawca jest małoletni, ubezwłasnowolniony częściowo lub całkowicie,
albo też gdy jest reprezentowany przez swojego małżonka, przedstawiciel ustawowy, kurator lub opiekun, albo małżonek Zleceniodawcy,
zawierający umowę w jego imieniu, przyjmuje odpowiedzialność solidarną za zapłatę wynagrodzenia VOTUM.
			</p>
		</div>
	</div>
	
	
	

	
	
	
	<div class="sekcja">
		<div class="sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="sekcja_paragraf">§ 6</div>
		<div class="sekcja_tresc">
		<p>
			1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
		</p>
		<p>
			2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu cywilnego.
		</p>
		<p>
			3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednej dla każdej ze stron.
		</p>		
		</div>
	</div>
	
	<div class="objasnienia strona_2 ">
		Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz.U. z 2002 r. nr 101, poz. 926 ze zm.) VOTUM informuje, że:
		<br/>1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,
		<br/>2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom od których będą uzyskiwane
informacje niezbędne do wykonania umowy i podmiotom od których będą dochodzone roszczenia,
		<br/>3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,
		<br/>4. podanie VOTUM danych osobowych jest dobrowolne.
		<br/>Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu
i mandatów karnych, a także innych orzeczeń wydanych w postępowaniu sądowym) w celu wykonania umowy.
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
	</div>
	
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
	
	
</div>































