<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'wzory_dokumentow/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'funkcje_glowne.php');

$uzytkownik_id = $_POST ['uzytkownik_id'];
$id_sprawy = $_POST ['id_sprawy'];
$id_umowy = $_POST ['id_umowy'];
$id_uprawnionego = $_POST ['id_uprawnionego'];

(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];
(isset ( $_POST ['uzytkownik_id'] )) ? $uzytkownik_id = $_POST ['uzytkownik_id'] : $uzytkownik_id = $_GET ['uzytkownik_id'];
(isset ( $_POST ['id_umowy'] )) ? $id_umowy = $_POST ['id_umowy'] : $id_umowy = $_GET ['id_umowy'];
(isset ( $_POST ['potwierdzenie'] )) ? $potwierdzenie = $_POST ['potwierdzenie'] : $potwierdzenie = $_GET ['potwierdzenie'];

$dane_uzytkownika = uzytkownik_pobierz_po_id ( $uzytkownik_id );

// if ( isset ( $_POST ['id_sprawy'] )) {
?>
<link rel="stylesheet"
	href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_optima.css'; ?>"
	type="text/css" />
<?php
// }

$identyfikator_przedstawiciela = $dane_uzytkownika ['login'];

// $uprawniony = sprawa_pobierz_dane_osoby($id_uprawnionego);
// $adres_zleceniodawcy = sprawa_pobierz_adres($uprawniony['sprawa_adres_zameldowania_id']);

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );
$umowa = sprawa_pobierz_dane_umowy ( $sprawa ['sprawa_umowa_id'] );

$poszkodowany_id = $sprawa ['sprawa_poszkodowany_id'];
$poszkodowany = sprawa_pobierz_dane_osoby ( $poszkodowany_id );
$adres_poszkodowanego = sprawa_pobierz_adres ( $poszkodowany ['sprawa_adres_zameldowania_id'] );

$zleceniodawca_id = $sprawa ['sprawa_klient_id'];
$zleceniodawca = sprawa_pobierz_dane_osoby ( $zleceniodawca_id );
$adres_zleceniodawcy = sprawa_pobierz_adres ( $zleceniodawca ['sprawa_adres_zameldowania_id'] );

$uprawniony_id = $sprawa ['sprawa_uprawniony_id'];
$uprawniony = sprawa_pobierz_dane_osoby ( $uprawniony_id );
$adres_uprawnionego = sprawa_pobierz_adres ( $uprawniony ['sprawa_adres_zameldowania_id'] );

$kontakt_id = $zleceniodawca ['sprawa_kontakt_id'];
$kontakt = sprawa_pobierz_kontakt ( $kontakt_id );

$poszkodowany_imie = $poszkodowany ['imie'];
$poszkodowany_nazwisko = $poszkodowany ['nazwisko'];
$ofiara = $poszkodowany_imie . ' ' . $poszkodowany_nazwisko;

$zdarzenie_id = $sprawa ['sprawa_zdarzenie_id'];
$zdarzenie = sprawa_pobierz_dane_z_tabeli_zdarzenie ( $zdarzenie_id );
$data_wypadku = $zdarzenie ['data'];

$numer_stopka = 'PG-2-9-F1/2016-03-25';

$data_zamowienia = '________________';

$prowizja = $umowa ['prowizja'];
$forma_platnosci = $umowa ['forma_platnosci'];
$osoba_do_wyplaty = $umowa ['osoba_do_wyplaty_id'];

$imie_zleceniodawcy = $zleceniodawca ['imie'];
$nazwisko_zleceniodawcy = $zleceniodawca ['nazwisko'];
$pesel_zleceniodawcy = $zleceniodawca ['pesel'];
$dowod_zleceniodawcy = $zleceniodawca ['dowod'];
$ulica_zleceniodawcy = $adres_zleceniodawcy ['ulica'];
$dom_zleceniodawcy = $adres_zleceniodawcy ['nr_domu'];
$mieszkanie_zleceniodawcy = $adres_zleceniodawcy ['nr_mieszkania'];
$kod_zleceniodawcy = $adres_zleceniodawcy ['kod_pocztowy'];
$miejscowosc_zleceniodawcy = $adres_zleceniodawcy ['miasto'];
$telefon_zleceniodawcy = $kontakt ['telefon'];
$email_zleceniodawcy = $kontakt ['email'];
$zlec_czy_obcokrajowiec = $zleceniodawca ['czy_obcokrajowiec'];

$imie_poszkodowanego = $poszkodowany ['imie'];
$nazwisko_poszkodowanego = $poszkodowany ['nazwisko'];
$ulica_poszkodowanego = $adres_poszkodowanego ['ulica'];
$dom_poszkodowanego = $adres_poszkodowanego ['nr_domu'];
$mieszkanie_poszkodowanego = $adres_poszkodowanego ['nr_mieszkania'];
$kod_poszkodowanego = $adres_poszkodowanego ['kod_pocztowy'];
$miejscowosc_poszkodowanego = $adres_poszkodowanego ['miasto'];

$imie_uprawnionego = $uprawniony ['imie'];
$nazwisko_uprawnionego = $uprawniony ['nazwisko'];
$ulica_uprawnionego = $adres_uprawnionego ['ulica'];
$dom_uprawnionego = $adres_uprawnionego ['nr_domu'];
$mieszkanie_uprawnionego = $adres_uprawnionego ['nr_mieszkania'];
$kod_uprawnionego = $adres_uprawnionego ['kod_pocztowy'];
$miejscowosc_uprawnionego = $adres_uprawnionego ['miasto'];

$reprezentant = '';

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
		<p>O DOCHODZENIE ROSZCZEŃ Z OBSŁUGĄ PROCESOWĄ “OPTIMA”</p>
	</div>
	<div class="uo_na_podstawie_zamowienia">
		<p>na podstawie zamówienia z dnia</p>
		<p class="uo_pogrubienie"><?php echo $data_zamowienia; ?></p>
		<p>r. złożonego przez</p>
	</div>
	<div class="uo_zleceniodawca">
		<div class="uo_element">
			<p>IMIĘ</p>
			<div class="uo_zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NAZWISKO</p>
			<div class="uo_zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="uo_element">
			<p>ULICA</p>
			<div class="uo_zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR DOMU</p>
			<div class="uo_zleceniodawca_nr_domu "><?php echo $dom_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR MIESZKANIA</p>
			<div class="uo_zleceniodawca_nr_mieszkania margin_r_20"><?php echo $mieszkanie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>KOD POCZTOWY</p>
			<div class="uo_zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="uo_zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="uo_element">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="uo_zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec) ? $zleceniodawca['rodzaj_dokumentu'] : $pesel_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="uo_element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="uo_zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec) ? $zleceniodawca['nr_dokumentu'] : $dowod_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>TELEFON</p>
			<div class="uo_zleceniodawca_telefon "><?php echo $telefon_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>ADRES E-MAIL</p>
			<div class="uo_zleceniodawca_adres_email"><?php echo $email_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>

        <?php
        $typ_poszkodowanego = $sprawa ['sprawa_typ_poszkodowany_id'];

        if ($sprawa ['sprawa_poszkodowany_id'] == $sprawa ['sprawa_klient_id']) {

            $w_imieniu = 0;

        } else if ($sprawa ['sprawa_poszkodowany_id'] != $sprawa ['sprawa_klient_id']) {

            if ($typ_poszkodowanego == '4') {

                $w_imieniu = $sprawa ['sprawa_uprawniony_id'];

                $w_imieniu_imie = $imie_uprawnionego;
                $w_imieniu_nazwisko = $nazwisko_uprawnionego;
                $w_imieniu_ulica = $ulica_uprawnionego;
                $w_imieniu_dom = $dom_uprawnionego;
                $w_imieniu_mieszkanie = $mieszkanie_uprawnionego;
                $w_imieniu_kod = $kod_uprawnionego;
                $w_imieniu_miejscowosc = $miejscowosc_uprawnionego;


            } else if ($typ_poszkodowanego != '4' && $typ_poszkodowanego != '0') {

                $w_imieniu = $sprawa ['sprawa_poszkodowany_id'];

                $w_imieniu_imie = $imie_poszkodowanego;
                $w_imieniu_nazwisko = $nazwisko_poszkodowanego;
                $w_imieniu_ulica = $ulica_poszkodowanego;
                $w_imieniu_dom = $dom_poszkodowanego;
                $w_imieniu_mieszkanie = $mieszkanie_poszkodowanego;
                $w_imieniu_kod = $kod_poszkodowanego;
                $w_imieniu_miejscowosc = $miejscowosc_poszkodowanego;

            }
        }
        ?>


		<div class="uo_napis">
            działającego w imieniu <span><?php
                if ($sprawa ['sprawa_typ_poszkodowany_id'] == '0') {
                    echo '<s>małoletniego/ubezwłasnowolnionego/małżonka</s>';
                } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '1') {
                    echo 'małoletniego';
                } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '2'){
                    echo 'ubezwłasnowolnionego';
                } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '3'){
                    echo 'małżonka';
                }
                ?></span>
		</div>
		<div class="uo_element">
			<p>IMIĘ</p>
			<div class="uo_zleceniodawca_w_imieniu_imie margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_imie; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NAZWISKO</p>
			<div class="uo_zleceniodawca_w_imieniu_nazwisko"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_nazwisko; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="uo_element">
			<p>ULICA</p>
			<div class="uo_zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_ulica; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR DOMU</p>
			<div class="uo_zleceniodawca_w_imieniu_nr_domu "><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_dom; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>NR MIESZKANIA</p>
			<div class="uo_zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_mieszkanie; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>KOD POCZTOWY</p>
			<div class="uo_zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_kod; ?>&nbsp;</div>
		</div>
		<div class="uo_element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="uo_zleceniodawca_w_imieniu_miejscowosc"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_miejscowosc; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="uo_naglowek_sekcji">dla</div>
	<div class="uo_zleceniobiorca">
		<p>
			VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel.
			71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
			zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział
			Gospodarczy Krajowego Rejestru Sądowego pod numerem <span
				class="uo_czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP:
				899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,</span>
			którą reprezentuje:
		</p>
		<div class="uo_zleceniobiorca_reprezentant"><?php echo $reprezentant; ?>&nbsp;</div>
	</div>
	<div class="uo_sekcja margin_t_0">
		<div class="uo_sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="uo_sekcja_paragraf">§ 1</div>
		<div class="uo_sekcja_tresc">
			<p>
				Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie
				Zleceniodawcy do powzięcia czynności mających na celu ustalenie
				podmiotu (zwanego dalej zobowiązanym) ponoszącego odpowiedzialność
				cywilną w związku z wypadkiem z dnia <b><?php echo $data_wypadku; ?></b>
				i uzyskanie od niego świadczeń odszkodowawczych za szkodę na osobie
				należnych Zleceniodawcy.
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
			<p>1. Skierowanie sprawy na drogę postępowania sądowego przeciwko
				zobowiązanemu wymaga zgody obu stron umowy.</p>
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
			<p>
				4. <span class="uo_pogrubienie">VOTUM zobowiązuje się do wystąpienia
					o zwolnienie Zleceniodawcy z kosztów sądowych,</span> po uprzednim
				złożeniu przez Zleceniodawcę oświadczenia o stanie rodzinnym,
				majątku i dochodach, wg wzoru urzędowego. W przypadku braku
				zwolnienia przez sąd z kosztów sądowych, do ich pokrycia zobowiązuje
				się Zleceniodawca.
			</p>
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
					class="uo_pogrubienie">adwokatów lub radców prawnych,</span> przy
				czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy jak
				za działania własne.
			</p>
		</div>
	</div>

	<div class="uo_objasnienia">* W przypadku, gdy umowa zawierana jest w
		imieniu osoby nie posiadającej pełnej zdolności do czynności prawnych,
		tj. małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel
		ustawowy lub opiekun prawny poszkodowanego. W razie przemijającej
		przeszkody, która dotyczy jednego z małżonków pozostających we
		wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego i opiekuńczego,
		drugi małżonek może za niego działać w sprawach zwykłego zarządu.
		Wypełnić jedynie w razie zaistnienia powyższych okoliczności.</div>



	<div class="uo_strona_stopka">
		<div class="uo_strona_stopka_numer_strony">1/2</div>
		<div class="uo_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="uo_strona uo_strona_2">
	<?php echo $znak_wodny; ?>
	<div class="uo_sekcja">
		<div class="uo_sekcja_tresc">
			<p>2. Zleceniodawca upoważnia VOTUM do pozyskiwania informacji o jego
				stanie zdrowia w zakresie, w jakim jest to niezbędne do wykonania
				umowy.</p>
			<p>
				3. <span class="uo_pogrubienie">VOTUM oświadcza, że nie zawrze w
					imieniu Zleceniodawcy ugody ze zobowiązanym bez jego zgody.</span>
				Wyrażenie zgody może nastąpić w dowolnej formie. W przypadku
				złożenia oferty zawarcia ugody przez zobowiązanego bezpośrednio
				Zleceniodawcy, zobowiązuje się on do niezwłocznego poinformowania o
				tym VOTUM.
			</p>
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
				<span class="uo_kratka"><?php echo $osoba_do_wyplaty == $zleceniodawca_id ? 'X' : '&nbsp&nbsp';  ?></span>
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
			<p>
				2. <span class="uo_pogrubienie">VOTUM nie pobiera wynagrodzenia</span>
				od uzyskanych dla Zleceniodawcy zwrotów kosztów leczenia,
				hospitalizacji, rehabilitacji, dostosowania lokalu lub pojazdu do
				potrzeb osoby niepełnosprawnej, zakupu protez, sprzętów
				ortopedycznych, lekarstw, materiałów opatrunkowych, jak również
				kosztów przejazdów Zleceniodawcy oraz najbliższych członków jego
				rodziny do placówek medycznych.
			</p>
			<p>
				3. <span class="uo_pogrubienie">VOTUM nie pobiera wynagrodzenia</span>
				od uzyskanych dla Zleceniodawcy zwrotów kosztów związanych z
				pogrzebem najbliższego członka jego rodziny.
			</p>
			<p>
				4. <span class="uo_pogrubienie">VOTUM nie pobiera wynagrodzenia</span>
				od uzyskanych dla Zleceniodawcy rent, chyba że zobowiązany wypłaca
				je jednorazowo w wysokości należnej za okres co najmniej 6 miesięcy.
			</p>
			<p>5. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w
				jego imieniu świadczeń w ramach wykonania niniejszej umowy.</p>

			<p>
				6. Z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie w wysokości <?php echo $prowizja; ?> %
				(słownie: <?php echo slownie($prowizja); ?> %) brutto (w tym podatek od towarów i usług VAT w wysokości 23%)
				wartości uzyskanych dla Zleceniodawcy świadczeń.
			</p>
			<p>
				7. Dodatkowo VOTUM przysługuje zwrot <span class="uo_pogrubienie">udokumentowanych</span>
				kosztów:<br /> a) opłat skarbowych od pełnomocnictwa w kwocie 17 zł
				(słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych
				opłat skarbowych oraz opłat sądowych,<br /> b) uzyskania opinii,
				tłumaczeń oraz odpisów i kserokopii dokumentów służących do
				wykonania umowy, w wysokości wynikającej z rachunku/faktury
				wystawionej przez podmiot wydający opinię, tłumaczenie lub
				dokumenty,<br /> c) przekazu pocztowego, jeżeli Zleceniodawca nie
				podał numeru rachunku bankowego do spełnienia świadczenia.
			</p>
			<p>8. W przypadku spełnienia świadczenia przez zobowiązanego
				bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej
				umowy, Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym
				VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania
				należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING
				Bank Śląski S.A. Oddział we Wrocławiu, nr 70 1050 1575 1000 0023
				2392 0799 bądź w inny sposób wskazany przez VOTUM. W przypadku, gdy
				Zleceniodawca jest małoletni, ubezwłasnowolniony częściowo lub
				całkowicie, albo też gdy jest reprezentowany przez swojego małżonka,
				przedstawiciel ustawowy, kurator lub opiekun, albo małżonek
				Zleceniodawcy, zawierający umowę w jego imieniu, przyjmuje
				odpowiedzialność solidarną za zapłatę wynagrodzenia VOTUM.</p>
		</div>
	</div>







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
		danych osobowych (tekst jednolity: Dz.U. z 2002 r. nr 101, poz. 926 ze
		zm.) VOTUM informuje, że: <br />1. administratorem danych osobowych
		jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012
		Wrocław, <br />2. dane osobowe będą przetwarzane w celu wykonania
		umowy i mogą być przekazywane podmiotom współpracującym przy jej
		wykonaniu, jak również podmiotom od których będą uzyskiwane informacje
		niezbędne do wykonania umowy i podmiotom od których będą dochodzone
		roszczenia, <br />3. posiada Pani/Pan prawo dostępu do treści danych
		oraz ich poprawiania, <br />4. podanie VOTUM danych osobowych jest
		dobrowolne. <br />Wyrażam zgodę na przetwarzanie danych osobowych
		osoby, na rzecz której będą dochodzone roszczenia odszkodowawcze (w
		tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu i
		mandatów karnych, a także innych orzeczeń wydanych w postępowaniu
		sądowym) w celu wykonania umowy.
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

	<div class="uo_strona_stopka">
		<div class="uo_strona_stopka_numer_strony">2/2</div>
		<div class="uo_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>


</div>
