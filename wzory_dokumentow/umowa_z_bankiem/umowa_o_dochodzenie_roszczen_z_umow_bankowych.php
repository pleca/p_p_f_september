<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'wzory_dokumentow/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'funkcje_glowne.php');

$uzytkownik_id = $_POST ['uzytkownik_id'];
$id_sprawy = $_POST ['id_sprawy'];
$id_umowy = $_POST ['id_umowy'];

(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];
(isset ( $_POST ['uzytkownik_id'] )) ? $uzytkownik_id = $_POST ['uzytkownik_id'] : $uzytkownik_id = $_GET ['uzytkownik_id'];
(isset ( $_POST ['id_umowy'] )) ? $id_umowy = $_POST ['id_umowy'] : $id_umowy = $_GET ['id_umowy'];
(isset ( $_POST ['potwierdzenie'] )) ? $potwierdzenie = $_POST ['potwierdzenie'] : $potwierdzenie = $_GET ['potwierdzenie'];

$dane_uzytkownika = uzytkownik_pobierz_po_id ( $uzytkownik_id );

// if ( isset ( $_POST ['id_sprawy'] )) {
?>
<link rel="stylesheet"
	href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_z_bankiem.css'; ?>"
	type="text/css" />
<?php
// }

$identyfikator_przedstawiciela = $dane_uzytkownika ['login'];

// $uprawniony = sprawa_pobierz_dane_osoby($id_uprawnionego);
// $adres_zleceniodawcy = sprawa_pobierz_adres($uprawniony['sprawa_adres_zameldowania_id']);

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );
$umowa = sprawa_pobierz_dane_umowy ( $sprawa ['sprawa_umowa_id'] );
$dochodzenie_roszczen = sprawa_pobierz_dochodzenie_roszczen ( $sprawa ['sprawa_dochodzenie_roszczen_id'] );

$umowa_bankowa = sprawa_pokaz_szczegoly_umowy_bankowej ( $sprawa ['sprawa_umowa_bankowa_id'] );

// $poszkodowany_id = $sprawa ['sprawa_poszkodowany_id'];
// $poszkodowany = sprawa_pobierz_dane_osoby ( $poszkodowany_id );
// $adres_poszkodowanego = sprawa_pobierz_adres ( $poszkodowany ['sprawa_adres_zameldowania_id'] );

$zleceniodawca_1_id = $sprawa ['sprawa_klient_id'];
$zleceniodawca_1 = sprawa_pobierz_dane_osoby ( $zleceniodawca_1_id );
$adres_zleceniodawcy_1 = sprawa_pobierz_adres ( $zleceniodawca_1 ['sprawa_adres_zameldowania_id'] );

$zleceniodawca_2_id = $sprawa ['sprawa_klient_2_id'];
$zleceniodawca_2 = sprawa_pobierz_dane_osoby ( $zleceniodawca_2_id );
$adres_zleceniodawcy_2 = sprawa_pobierz_adres ( $zleceniodawca_2 ['sprawa_adres_zameldowania_id'] );

// $uprawniony_id = $sprawa ['sprawa_uprawniony_id'];
// $uprawniony = sprawa_pobierz_dane_osoby ( $uprawniony_id );
// $adres_uprawnionego = sprawa_pobierz_adres ( $uprawniony ['sprawa_adres_zameldowania_id'] );

// $kontakt_id = $zleceniodawca ['sprawa_kontakt_id'];
// $kontakt = sprawa_pobierz_kontakt ( $kontakt_id );

// $poszkodowany_imie = $poszkodowany ['imie'];
// $poszkodowany_nazwisko = $poszkodowany ['nazwisko'];
// $ofiara = $poszkodowany_imie . ' ' . $poszkodowany_nazwisko;

// $zdarzenie_id = $sprawa ['sprawa_zdarzenie_id'];
// $zdarzenie = sprawa_pobierz_dane_z_tabeli_zdarzenie ( $zdarzenie_id );
// $data_wypadku = $zdarzenie ['data'];

$numer_stopka = 'PG-2-21-F1/2017-01-02';

// $data_zamowienia = '________________';

$prowizja = $umowa ['prowizja'];
$forma_platnosci = $umowa ['forma_platnosci'];
$osoba_do_wyplaty = $umowa ['osoba_do_wyplaty_id'];

$imie_zleceniodawcy_1 = $zleceniodawca_1 ['imie'];
$nazwisko_zleceniodawcy_1 = $zleceniodawca_1 ['nazwisko'];
$pesel_zleceniodawcy_1 = $zleceniodawca_1 ['pesel'];
$dowod_zleceniodawcy_1 = $zleceniodawca_1 ['dowod'];
$ulica_zleceniodawcy_1 = $adres_zleceniodawcy_1 ['ulica'];
$dom_zleceniodawcy_1 = $adres_zleceniodawcy_1 ['nr_domu'];
$mieszkanie_zleceniodawcy_1 = $adres_zleceniodawcy_1 ['nr_mieszkania'];
$kod_zleceniodawcy_1 = $adres_zleceniodawcy_1 ['kod_pocztowy'];
$miejscowosc_zleceniodawcy_1 = $adres_zleceniodawcy_1 ['miasto'];
$telefon_zleceniodawcy_1 = $kontakt_1 ['telefon'];
$email_zleceniodawcy_1 = $kontakt_1 ['email'];
$zlec_czy_obcokrajowiec_1 = $zleceniodawca_1 ['czy_obcokrajowiec'];

$imie_zleceniodawcy_2 = $zleceniodawca_2 ['imie'];
$nazwisko_zleceniodawcy_2 = $zleceniodawca_2 ['nazwisko'];
$pesel_zleceniodawcy_2 = $zleceniodawca_2 ['pesel'];
$dowod_zleceniodawcy_2 = $zleceniodawca_2 ['dowod'];
$ulica_zleceniodawcy_2 = $adres_zleceniodawcy_2 ['ulica'];
$dom_zleceniodawcy_2 = $adres_zleceniodawcy_2 ['nr_domu'];
$mieszkanie_zleceniodawcy_2 = $adres_zleceniodawcy_2 ['nr_mieszkania'];
$kod_zleceniodawcy_2 = $adres_zleceniodawcy_2 ['kod_pocztowy'];
$miejscowosc_zleceniodawcy_2 = $adres_zleceniodawcy_2 ['miasto'];
$telefon_zleceniodawcy_2 = $kontakt_2 ['telefon'];
$email_zleceniodawcy_2 = $kontakt_2 ['email'];
$zlec_czy_obcokrajowiec_2 = $zleceniodawca_2 ['czy_obcokrajowiec'];

if ($forma_platnosci == 'przelew') {
	$platnosc = '1';
} else if ($forma_platnosci == 'przekaz') {
	$platnosc = '0';
}

$upr_czy_obcokrajowiec = $uposazony ['czy_obcokrajowiec'];

if ($osoba_do_wyplaty == $zleceniodawca_id) {
	
	$imie_uposazonego = $zleceniodawca ['imie'];
	$nazwisko_uposazonego = $zleceniodawca ['nazwisko'];
	$pesel_uposazonego = $zleceniodawca ['pesel'];
	$dowod_uposazonego = $zleceniodawca ['dowod'];
	$ulica_uposazonego = $adres_zleceniodawcy ['ulica'];
	$dom_uposazonego = $adres_zleceniodawcy ['nr_domu'];
	$mieszkanie_uposazonego = $adres_zleceniodawcy ['nr_mieszkania'];
	$kod_uposazonego = $adres_zleceniodawcy ['kod_pocztowy'];
	$miejscowosc_uposazonego = $adres_zleceniodawcy ['miasto'];
	
	$nr_rachunku = $zleceniodawca ['nr_rachunku'];
} else if ($osoba_do_wyplaty != $zleceniodawca_id) {
	
	$uposazony = sprawa_pobierz_dane_osoby ( $osoba_do_wyplaty );
	$adres_uposazonego = sprawa_pobierz_adres ( $uposazony ['sprawa_adres_zameldowania_id'] );
	
	$imie_uposazonego = $uposazony ['imie'];
	$nazwisko_uposazonego = $uposazony ['nazwisko'];
	$pesel_uposazonego = $uposazony ['pesel'];
	$dowod_uposazonego = $uposazony ['dowod'];
	$ulica_uposazonego = $adres_uposazonego ['ulica'];
	$dom_uposazonego = $adres_uposazonego ['nr_domu'];
	$mieszkanie_uposazonego = $adres_uposazonego ['nr_mieszkania'];
	$kod_uposazonego = $adres_uposazonego ['kod_pocztowy'];
	$miejscowosc_uposazonego = $adres_uposazonego ['miasto'];
	
	$nr_rachunku = $uposazony ['nr_rachunku'];
}

if ($potwierdzenie == '1') {
	$znak_wodny = '<div class="uo_strona_znak_wodny">POTWIERDZENIE ZAMÓWIENIA</div>';
}

?>

<script src="../js/jquery.js"></script>

<div class="uo_strona">
	<?php echo $znak_wodny; ?>
	<div class="uo_identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="uo_logo_votum"></div>
	<div class="uo_tytul_strony_optima">
		<p>UMOWA</p>
		<p>O DOCHODZENIE ROSZCZEŃ Z UMÓW BANKOWYCH</p>
	</div>
	<div class="uo_na_podstawie_zamowienia">
		<p>na podstawie zamówienia z dnia</p>
		<p class="uo_pogrubienie">_________________________</p>
		<p>r. złożonego przez</p>
	</div>
	<div class="uo_zleceniodawca">
		<div class="uo_element">
			<p>IMIĘ</p>
			<div class="uo_zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NAZWISKO</p>
			<div class="uo_zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="uo_element">
			<p>ULICA</p>
			<div class="uo_zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR DOMU</p>
			<div class="uo_zleceniodawca_nr_domu "><?php echo $dom_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR MIESZKANIA</p>
			<div class="uo_zleceniodawca_nr_mieszkania margin_r_20"><?php echo $mieszkanie_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>KOD POCZTOWY</p>
			<div class="uo_zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="uo_zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="uo_element">
			<?php echo ($zlec_czy_obcokrajowiec_1) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="uo_zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec_1) ? $zleceniodawca_1['rodzaj_dokumentu'] : $pesel_zleceniodawcy_1 ; ?>&nbsp;</div>
		</div>
		<div class="uo_element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec_1) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="uo_zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec_1) ? $zleceniodawca_1['nr_dokumentu'] : $dowod_zleceniodawcy_1 ; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>TELEFON</p>
			<div class="uo_zleceniodawca_telefon "><?php echo $telefon_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>ADRES E-MAIL</p>
			<div class="uo_zleceniodawca_adres_email"><?php echo $email_zleceniodawcy_1; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="uo_naglowek_sekcji">oraz</div>

	<div class="uo_zleceniodawca">
		<div class="uo_element">
			<p>IMIĘ</p>
			<div class="uo_zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NAZWISKO</p>
			<div class="uo_zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="uo_element">
			<p>ULICA</p>
			<div class="uo_zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR DOMU</p>
			<div class="uo_zleceniodawca_nr_domu "><?php echo $dom_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR MIESZKANIA</p>
			<div class="uo_zleceniodawca_nr_mieszkania margin_r_20"><?php echo $mieszkanie_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>KOD POCZTOWY</p>
			<div class="uo_zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="uo_zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="uo_element">
			<?php echo ($zlec_czy_obcokrajowiec_2) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="uo_zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec_2) ? $zleceniodawca_2['rodzaj_dokumentu'] : $pesel_zleceniodawcy_2 ; ?>&nbsp;</div>
		</div>
		<div class="uo_element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec_2) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="uo_zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec_2) ? $zleceniodawca_2['nr_dokumentu'] : $dowod_zleceniodawcy_2 ; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>TELEFON</p>
			<div class="uo_zleceniodawca_telefon "><?php echo $telefon_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>ADRES E-MAIL</p>
			<div class="uo_zleceniodawca_adres_email"><?php echo $email_zleceniodawcy_2; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="uo_naglowek_sekcji_lewa">
		<p>zwanego/zwanych dalej ZLECENIODAWCĄ</p>
	</div>
	<div class="uo_naglowek_sekcji">dla</div>
	<div class="uo_zleceniobiorca">
		<p>
			VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel.
			71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
			zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział
			Gospodarczy Krajowego Rejestru Sądowego pod numerem <span
				class="uo_czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP:
				899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</span>
		</p>
	</div>
	<div class="uo_sekcja margin_t_10">
		<div class="uo_sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="uo_sekcja_paragraf">§ 1</div>
		<div class="uo_sekcja_tresc">
			<p>
				Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie
				Zleceniodawcy do powzięcia czynności polegających na dochodzeniu
				roszczeń od <span class="uo_pogrubienie"><?php echo $umowa_bankowa['nazwa_banku']; ?></span>
				(zwanego dalej Zobowiązanym) dotyczących umowy kredytu hipotecznego
				numer <span class="uo_pogrubienie"><?php echo $umowa_bankowa['numer_umowy']; ?></span>
				indeksowanego bądź denominowanego do waluty obcej w związku z
				zastosowaną przez bank konstrukcją indeksacji oraz ubezpieczeń z nią
				powiązanych.


			</p>
		</div>
	</div>

	<div class="uo_sekcja">
		<div class="uo_sekcja_tytul">OKRES OBOWIĄZYWANIA UMOWY</div>
		<div class="uo_sekcja_paragraf">§ 2</div>
		<div class="uo_sekcja_tresc">
			<p>
				Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla
				Zleceniodawcy świadczeń należnych od zobowiązanego <span
					class="uo_pogrubienie">w postępowaniu przedsądowym, sądowym i
					egzekucyjnym.</span>
			</p>
		</div>
	</div>

	<div class="uo_sekcja">
		<div class="uo_sekcja_tytul">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</div>
		<div class="uo_sekcja_paragraf">§ 3</div>
		<div class="uo_sekcja_tresc">
			<p>1. W przypadku, gdy Zobowiązany nie zaspokoi roszczeń dotyczących
				umowy, o której mowa w § 1 lub zaspokoi je w niższej niż należna
				wysokości, sprawa może zostać skierowana na drogę postępowania
				sądowego. Skierowanie sprawy na drogę postępowania sądowego
				przeciwko zobowiązanemu wymaga zgody obu stron umowy.</p>
			<p>2. W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie
				postępowania sądowego, zobowiązuje się on do niezwłocznego
				przekazania VOTUM wszelkich posiadanych informacji dotyczących
				przedmiotu umowy oraz wszelkiej żądanej przez niego dokumentacji i
				oświadczeń, które będą przydatne do wykonania umowy.</p>
			<p>
				3. <span class="uo_pogrubienie">VOTUM pokrywa koszty wynagrodzenia
					pełnomocnika procesowego,</span> za wyjątkiem kosztów przejazdów
				pełnomocnika procesowego na rozprawy, w wysokości określonej przez
				przepisy Rozporządzenia Ministra Infrastruktury w sprawie warunków
				ustalania oraz sposobu dokonywania zwrotu kosztów używania do celów
				służbowych samochodów osobowych, motocykli i motorowerów niebędących
				własnością pracodawcy (Dz. U. z 2002 r. nr 27,poz. 271) albo kosztów
				zastępstwa substytucyjnego w wysokości nie przekraczającej 300 zł
				(słownie: trzystu złotych) od każdego posiedzenia, do pokrycia
				których zobowiązany będzie Zleceniodawca.
			</p>
		</div>
	</div>
	<div class="uo_strona_stopka">
		<div class="uo_strona_stopka_numer_strony">1/3</div>
		<div class="uo_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="uo_strona uo_strona_2">
	<?php echo $znak_wodny; ?>
	<div class="uo_sekcja">
		<div class="uo_sekcja_tresc">
			<p>4. W przypadku braku zwolnienia przez sąd z kosztów sądowych, do
				ich pokrycia zobowiązuje się Zleceniodawca.</p>
			<p>5. Koszty procesu zasądzone od zobowiązanego przypadają VOTUM lub
				Zleceniodawcy w części, w jakiej zostały poniesione przez każdą ze
				stron, z tym, że koszty zastępstwa procesowego zasądzone w sprawie
				przypadają pełnomocnikowi procesowemu, o którym mowa w § 4 ust. 1.</p>
		</div>
	</div>
	<div class="uo_sekcja">
		<div class="uo_sekcja_tytul">PRAWA I OBOWIĄZKI STRON</div>
		<div class="uo_sekcja_paragraf">§ 4</div>
		<div class="uo_sekcja_tresc">
			<p>
				1. Czynności wchodzące w zakres niniejszej umowy VOTUM może
				wykonywać za pomocą podmiotów współpracujących, w szczególności <span
					class="uo_pogrubienie">adwokatów lub radców prawnych</span>, przy
				czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy jak
				za działania własne.
			</p>
			<p>
				2. <span class="uo_pogrubienie">VOTUM oświadcza, że nie zawrze w
					imieniu Zleceniodawcy ugody ze zobowiązanym bez jego zgody.</span>
				Wyrażenie zgody może nastąpić w dowolnej formie. W przypadku
				złożenia oferty zawarcia ugody przez zobowiązanego bezpośrednio
				Zleceniodawcy, zobowiązuje się on do niezwłocznego poinformowania o
				tym VOTUM.
			</p>
			<p>3. Zleceniodawca zobowiązuje się do niezwłocznego przekazania
				VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy
				oraz wszelkiej żądanej przez niego dokumentacji i oświadczeń, które
				będą przydatne do wykonania umowy, w szczególności:</p>
			<p>a) kopii dowodu osobistego potwierdzonego za zgodność z oryginałem
				przez notariusza lub organ gminy,</p>
			<p>b) kopii umowy kredytu bankowego wraz z aneksami (jeżeli takowe
				były zawierane),</p>
			<p>c) kopii regulaminu kredytów i pożyczek hipotecznych załączonego
				do umowy kredytu bankowego,</p>
			<p>d) kopii Tabeli Opłat i Prowizji załączonej do umowy kredytu
				bankowego,</p>
			<p>e) otrzymanych od Zobowiązanego harmonogramów spłaty rat,</p>
			<p>f) kopii potwierdzeń spłaty rat,,</p>
			<p>g) kopii pism oraz decyzji Zobowiązanego w przedmiocie udzielonego
				kredytu.</p>
			<p>4. Reklamacje związane z wykonaniem umowy Zleceniodawca może
				składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje
				reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 30
				dni.</p>
			<p>5. Informacje dotyczące wykonywania niniejszej umowy będą
				kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres
				email, a w przypadku ich braku – na adres
				zameldowania/korespondencyjny.</p>
		</div>
	</div>
	<div class="uo_sekcja">
		<div class="uo_sekcja_tytul">WYNAGRODZENIE</div>
		<div class="uo_sekcja_paragraf">§ 5</div>
		<div class="uo_sekcja_tresc">
			<p class="margin_b_10">
				1. VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych
				świadczeń w terminie <span class="uo_pogrubienie">7 dni roboczych</span>
				od dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM
				wynagrodzenia <span class="uo_kratka"><?php echo $platnosc == '0' ? 'X' : '&nbsp';  ?></span>przekazem
				pocztowym / <span class="uo_kratka"><?php echo $platnosc != '0' ? 'X' : '&nbsp';  ?></span>na
				wskazany przez Zleceniodawcę rachunek bankowy:
			</p>
			<div class="uo_element">
				<p>NR RACHUNKU</p>
				<div class="uo_zleceniodawca_nr_rachunku margin_r_20"><?php echo $nr_rachunku == '0' ? '&nbsp' : $nr_rachunku.'&nbsp;';  ?></div>
			</div>
			<div class="uo_element uo_kratka_element">
				<span class="uo_kratka"><?php echo $osoba_do_wyplaty == $zleceniodawca_1_id ? 'X' : '&nbsp&nbsp';  ?></span>
				<p>POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</p>
			</div>
			<div class="clear_b"></div>
			<p class="uo_male_litery">POSIADACZ RACHUNKU (Wypełnić, jeżeli
				posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko
				oraz adres posiadacza.)</p>
			<div class="uo_element">
				<p>IMIĘ</p>
				<div class="uo_posiadacz_rachunku_imie margin_r_20"><?php echo $imie_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="uo_element">
				<p>NAZWISKO</p>
				<div class="uo_posiadacz_rachunku_nazwisko"><?php echo $nazwisko_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="uo_element">
				<p>ULICA</p>
				<div class="uo_posiadacz_rachunku_ulica margin_r_20"><?php echo $ulica_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="uo_element">
				<p>NR DOMU</p>
				<div class="uo_posiadacz_rachunku_nr_domu "><?php echo $dom_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="uo_element">
				<p>NR MIESZKANIA</p>
				<div class="uo_posiadacz_rachunku_nr_mieszkania margin_r_20"><?php echo $mieszkanie_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="uo_element">
				<p>KOD POCZTOWY</p>
				<div class="uo_posiadacz_rachunku_kod_pocztowy margin_r_20"><?php echo $kod_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="uo_element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="uo_posiadacz_rachunku_miejscowosc"><?php echo $miejscowosc_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<br />
			<p>2. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w
				jego imieniu świadczeń w ramach wykonania niniejszej umowy.</p>
			<p>3. Z tytułu wykonania niniejszej umowy VOTUM przysługuje
				wynagrodzenie w wysokości <?php echo $umowa['prowizja'];?> % (słownie: <?php echo slownie($umowa['prowizja']); ?> %) brutto (w tym podatek od towarów i
				usług VAT w wysokości 23%) wartości uzyskanych dla Zleceniodawcy
				świadczeń.</p>
			<p>
				4. Dodatkowo VOTUM przysługuje zwrot <span class="uo_pogrubienie">udokumentowanych</span>
				kosztów:
			</p>
			<p>a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie:
				siedemnaście złotych) od każdego pełnomocnictwa, innych opłat
				skarbowych oraz opłat sądowych,</p>

			<p>b) opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za
				złożenie wniosku o wszczęcie postępowania w sprawie rozwiązywania
				sporów między klientem a podmiotem rynku finansowego do Rzecznika
				Finansowego;</p>
			<p>c) opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za
				złożenie umowy o przeprowadzenie mediacji w centrum mediacji Sądu
				Polubownego przy Komisji Nadzoru Finansowego;</p>
			<p>d) uzyskania opinii, tłumaczeń oraz odpisów i kserokopii
				dokumentów służących do wykonania umowy, w wysokości wynikającej z
				dokumentu sprzedaży wystawionego przez podmiot wydający opinię,
				tłumaczenie lub dokumenty,</p>
			<p>e) przekazu pocztowego, jeżeli Zleceniodawca nie podał numeru
				rachunku bankowego do spełnienia świadczenia.</p>
			<p>5. W przypadku spełnienia świadczenia przez zobowiązanego
				bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej
				umowy, Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym
				VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania
				należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING
				Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023
				2392 0799 bądź w inny sposób wskazany przez VOTUM.</p>
			<p>6. Za zobowiązania wynikające z niniejszej umowy Zleceniodawcy
				ponoszą odpowiedzialność solidarną.</p>
		</div>
	</div>
	<div class="uo_strona_stopka">
		<div class="uo_strona_stopka_numer_strony">2/3</div>
		<div class="uo_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
<div class="uo_strona uo_strona_3">
	<?php echo $znak_wodny; ?>

	<div class="uo_sekcja">
		<div class="uo_sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="uo_sekcja_paragraf">§ 6</div>
		<div class="uo_sekcja_tresc">
			<p>1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem
				nieważności.</p>
			<p>2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu
				cywilnego.</p>
			<p>3. Umowę sporządzono i podpisano w dwóch jednobrzmiących
				egzemplarzach, po jednej dla każdej ze stron.</p>
		</div>
	</div>

	<div class="uo_objasnienia uo_strona_2 uo_sekcja">
		Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie
		danych osobowych (Dz. U. z 2016 r. poz. 922 ze zm.) VOTUM informuje,
		że: <br />1. administratorem danych osobowych jest VOTUM S.A. z
		siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, <br />2.
		dane osobowe będą przetwarzane w celu wykonania umowy i mogą być
		przekazywane podmiotom współpracującym przy jej wykonaniu, jak również
		podmiotom od których będą uzyskiwane informacje niezbędne do wykonania
		umowy i podmiotom od których będą dochodzone roszczenia, <br />3.
		posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,
		<br />4. podanie VOTUM danych osobowych jest dobrowolne.
	</div>

	<div class="uo_sekcja">
		<div class="uo_sekcja_tresc">
			<div class="uo_podpis_lewo uo_small_font uo_pogrubienie">VOTUM S.A.</div>
			<div class="uo_podpis_prawo uo_small_font uo_pogrubienie">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="uo_oswiadczenie uo_sekcja">
		<p class="uo_pogrubienie">Oświadczenie</p>
		<p>Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi
			przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>
	</div>
	<div class="uo_sekcja">
		<div class="uo_sekcja_tresc">
			<div class="uo_podpis_prawo uo_small_font uo_pogrubienie">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>


	<div class="formularz">

		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">LISTA DOKUMENTACJI POBRANEJ OD KLIENTA</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class='podtytul'>ILOŚĆ DOKUMENTÓW POBRANYCH OD KLIENTA:</div>
			<div class="clear_b"></div>
			<span class="uo_kratka"><?php echo $umowa_bankowa['umowa'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Umowa z klientem; <span class="uo_kratka"><?php echo $umowa_bankowa['pelnomocnictwo'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Pełnomocnictwo; <span class="uo_kratka"><?php echo $umowa_bankowa['dowod_klienta'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia dokumentu tożsamości Klienta; <span class="uo_kratka"><?php echo $umowa_bankowa['wniosek'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia wniosku kredytowego; <span class="uo_kratka"><?php echo $umowa_bankowa['umowa_z_bankiem'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia umowy kredytu bankowego wraz z aneksami (jeżeli takowe były
			zawierane); <span class="uo_kratka"><?php echo $umowa_bankowa['regulamin'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia Regulaminu udzielania kredytów i pożyczek hipotecznych
			załączonego do umowy kredytu bankowego; <span class="uo_kratka"><?php echo $umowa_bankowa['tabela'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia Tabeli Opłat i Prowizji załączona do umowy kredytu bankowego; <span
				class="uo_kratka"><?php echo $umowa_bankowa['harmonogram'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia harmonogramu spłaty rat; <span class="uo_kratka"><?php echo $umowa_bankowa['potwierdzenia'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia potwierdzenia spłaty rat; <span class="uo_kratka"><?php echo $umowa_bankowa['decyzje'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Decyzje oraz pisma Banku w przedmiocie udzielonego kredytu; <span
				class="uo_kratka"><?php echo $umowa_bankowa['ubezpieczenie'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia potwierdzenia opłaty za ubezpieczenie.
			<div class="clear_b"></div>
			<div class='podtytul'>DODATKOWA DOKUMENTACJA W PRZYPADKU DOCHODZENIA
				ROSZCZENIA Z UDZIAŁEM WSPÓŁKREDYTOBIORCY:</div>
			<div class="clear_b"></div>
			<span class="uo_kratka"><?php echo $umowa_bankowa['dowod_wspolkredytobiorcy'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia dokumentu tożsamości Współkredytobiorcy; <span
				class="uo_kratka"><?php echo $umowa_bankowa['akt_malzenstwa'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			Kopia odpisu skróconego aktu małżeństwa (w przypadku jego zawarcia).
			<div class="clear_b"></div>
		</div>

	</div>

	<div class="formularz">

		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">ODPOWIEDZIALNOŚĆ ZOBOWIĄZANEGO</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class='podtytul'>
				ZGŁOSZONO ROSZCZENIE DO BANKU O ZWROT: <span class="uo_kratka"><?php echo $umowa_bankowa['czy_zgloszono_roszczenia'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>NIE
				ZGŁOSZONO ROSZCZEŃ
			</div>
			<div class="clear_b"></div>
			<div class='odstep_pomiedzy'>
				<span class="uo_kratka"><?php echo $umowa_bankowa['indeksacja'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
				nadpłaconych rat w związku z zastosowaną indeksacją
			</div>
			<div class="clear_b"></div>
			<div class='odstep_pomiedzy'>
				<span class="uo_kratka"><?php echo $umowa_bankowa['ubezp_pomostowe'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
				nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia
				pomostowego, data zgłoszenia: <?php echo $umowa_bankowa['data_ubezp_pomostowe'] != '0000-00-00' ? $umowa_bankowa['data_ubezp_pomostowe'] : '';  ?>
			</div>
			<div class="clear_b"></div>
			<div class='odstep_pomiedzy'>
				<span class="uo_kratka"><?php echo $umowa_bankowa['ubezp_wkl_wlasnego'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
				nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia
				wkładu własnego, data zgłoszenia: <?php echo $umowa_bankowa['data_ubezp_wkl_wlasnego'] != '0000-00-00' ? $umowa_bankowa['data_ubezp_wkl_wlasnego'] : '';  ?>
			</div>
			<div class="clear_b"></div>
		</div>

	</div>

	<div class="formularz">

		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">DOCHODZENIE ROSZCZEŃ</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<span class="uo_kratka"><?php echo $dochodzenie_roszczen['czy_zlecono'] == '0' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi
		</div>
		<div class="clear_b"></div>
		<div class='odstep_pomiedzy'>
			<span class="uo_kratka"><?php echo $dochodzenie_roszczen['czy_zlecono'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			sprawę zlecano wcześniej pełnomocnikowi <?php echo $dochodzenie_roszczen['czy_zlecono'] == '1' ? $dochodzenie_roszczen['komu_zlecono'] : '__________________';  ?> z którym zawarto umowę dnia
			<?php echo $dochodzenie_roszczen['kiedy_zlecono'] != '0000-00-00' ? $dochodzenie_roszczen['kiedy_zlecono'] : '__________________';  ?>
		</div>
		<div class="clear_b"></div>
		<div class='odstep_pomiedzy'>
			<span class="uo_kratka"><?php echo $dochodzenie_roszczen['czy_wypowiedziano'] == '1' ? 'X' : '&nbsp&nbsp&nbsp';  ?></span>
			umowę z wyżej wymienionym wypowiedziano w dniu <?php echo $dochodzenie_roszczen['czy_wypowiedziano'] == '1' ? $dochodzenie_roszczen['kiedy_wypowiedziano'] : '&nbsp&nbsp&nbsp';  ?>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class='odstep_pomiedzy'>
		<div class="element">
			<span class="uo_kratka"><?php echo (($sprawa['zgoda_na_inf_sms']) OR ($sprawa['zgoda_na_inf_email'])) ? 'X' : '&nbsp&nbsp&nbsp'; ?></span>
			Wyrażam zgodę /
		</div>
		<div class="element">
			<span class="uo_kratka"><?php echo (!($sprawa['zgoda_na_inf_sms']) AND !($sprawa['zgoda_na_inf_email'])) ? 'X' : '&nbsp&nbsp&nbsp'; ?></span>
			Nie wyrażam zgody na otrzymywanie informacji związanych z
			wykonywaniem umowy poprzez
		</div>
	</div>
	<div class="clear_b"></div>
	<div class='odstep_pomiedzy'>
		<div class="element">
			<span class="uo_kratka"><?php echo ($sprawa['zgoda_na_inf_sms']) ? 'X' : '&nbsp&nbsp&nbsp'; ?></span>
			wiadomości tekstowe SMS /
		</div>
		<div class="element">
			<span class="uo_kratka"><?php echo ($sprawa['zgoda_na_inf_email']) ? 'X' : '&nbsp&nbsp&nbsp'; ?></span>
			wiadomości e-mail na numer/adres przeze mnie wskazany.
		</div>
	</div>
	<div class="clear_b"></div>

	<div class="uo_sekcja margin_t_50">
		<div class="uo_sekcja_tresc">
			<div class="uo_podpis_lewo uo_small_font uo_pogrubienie">MIEJSCOWOŚĆ
				I DATA</div>
			<div class="uo_podpis_prawo uo_small_font uo_pogrubienie">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="uo_oswiadczenie uo_sekcja">
		<p class="uo_pogrubienie">Oświadczenie</p>
		<p>Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A.
			oświadczam, że podpisy Zleceniodawcy/ców widniejące na formularzu
			umowy oraz pełnomocnictwie zostały złożone w mojej obecności
			własnoręcznie przez Zleceniodawcę/ców.</p>
	</div>
	<div class="uo_sekcja">
		<div class="uo_sekcja_tresc">
			<div class="uo_podpis_prawo uo_small_font uo_pogrubienie">CZYTELNY
				PODPIS PRZEDSTAWICIELA</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="uo_strona_stopka">
		<div class="uo_strona_stopka_numer_strony">3/3</div>
		<div class="uo_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>


</div>
