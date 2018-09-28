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
?>
<link rel="stylesheet"
	href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_maxima.css'; ?>"
	type="text/css" />
<?php

$identyfikator_przedstawiciela = $dane_uzytkownika ['login'];
$umowa = sprawa_pobierz_dane_umowy ( $id_umowy );

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );

$poszkodowany_id = $sprawa ['sprawa_poszkodowany_id'];
$poszkodowany = sprawa_pobierz_dane_osoby ( $poszkodowany_id );

$zleceniodawca_id = $sprawa ['sprawa_klient_id'];
$uprawniony_id = $sprawa ['sprawa_uprawniony_id'];

$zleceniodawca = sprawa_pobierz_dane_osoby ( $zleceniodawca_id );
$adres_zleceniodawcy = sprawa_pobierz_adres ( $zleceniodawca ['sprawa_adres_zameldowania_id'] );

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
$zlec_czy_obcokrajowiec = $zleceniodawca ['czy_obcokrajowiec'];
$ulica_zleceniodawcy = $adres_zleceniodawcy ['ulica'];
$dom_zleceniodawcy = $adres_zleceniodawcy ['nr_domu'];
$mieszkanie_zleceniodawcy = $adres_zleceniodawcy ['nr_mieszkania'];
$kod_zleceniodawcy = $adres_zleceniodawcy ['kod_pocztowy'];
$miejscowosc_zleceniodawcy = $adres_zleceniodawcy ['miasto'];
$telefon_zleceniodawcy = $kontakt ['telefon'];
$email_zleceniodawcy = $kontakt ['email'];

$imie_uprawnionego = $uprawniony ['imie'];
$nazwisko_uprawnionego = $uprawniony ['nazwisko'];
$ulica_uprawnionego = $adres_uprawnionego ['ulica'];
$dom_uprawnionego = $adres_uprawnionego ['nr_domu'];
$mieszkanie_uprawnionego = $adres_uprawnionego ['nr_mieszkania'];
$kod_uprawnionego = $adres_uprawnionego ['kod_pocztowy'];
$miejscowosc_uprawnionego = $adres_uprawnionego ['miasto'];

$reprezentant = '';

$upr_czy_obcokrajowiec = $uposazony ['czy_obcokrajowiec'];

if ($forma_platnosci == 'przelew') {
	$platnosc = '1';
} else if ($forma_platnosci == 'przekaz') {
	$platnosc = '0';
}

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
	$znak_wodny = '<div class="um_strona_znak_wodny">POTWIERDZENIE ZAMÓWIENIA</div>';
}
?>

<div class="um_strona">
	<?php echo $znak_wodny; ?>
	<div class="um_identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="um_logo_votum"></div>
	<div class="um_tytul_strony_maxima">
		<p>UMOWA</p>
		<p>O DOCHODZENIE ROSZCZEŃ Z OBSŁUGĄ PROCESOWĄ “MAXIMA”</p>
	</div>
	<div class="um_na_podstawie_zamowienia">
		<p>na podstawie zamówienia z dnia</p>
		<p class="um_pogrubienie"><?php echo $data_zamowienia; ?></p>
		<p>r. złożonego przez</p>
	</div>
	<div class="um_zleceniodawca">
		<div class="um_element">
			<p>IMIĘ</p>
			<div class="um_zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>NAZWISKO</p>
			<div class="um_zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?>&nbsp;</div>
		</div>

		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="um_element">
			<p>ULICA</p>
			<div class="um_zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>NR DOMU</p>
			<div class="um_zleceniodawca_nr_domu "><?php echo $dom_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>NR MIESZKANIA</p>
			<div class="um_zleceniodawca_nr_mieszkania margin_r_20"><?php echo $mieszkanie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>KOD POCZTOWY</p>
			<div class="um_zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="um_zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="um_element">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="um_zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec) ? $zleceniodawca['rodzaj_dokumentu'] : $pesel_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="um_element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="um_zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec) ? $zleceniodawca['nr_dokumentu'] : $dowod_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>TELEFON</p>
			<div class="um_zleceniodawca_telefon "><?php echo $telefon_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>ADRES E-MAIL</p>
			<div class="um_zleceniodawca_adres_email"><?php echo $email_zleceniodawcy; ?>&nbsp;</div>
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


		<div class="um_napis">
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
		<div class="um_element">
			<p>IMIĘ</p>
			<div class="um_zleceniodawca_w_imieniu_imie margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_imie; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>NAZWISKO</p>
			<div class="um_zleceniodawca_w_imieniu_nazwisko"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_nazwisko; ?>&nbsp;</div>
		</div>

		<div class="clear_b"></div>
		<div class="um_element">
			<p>ULICA</p>
			<div class="um_zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_ulica; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>NR DOMU</p>
			<div class="um_zleceniodawca_w_imieniu_nr_domu "><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_dom; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>NR MIESZKANIA</p>
			<div class="um_zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_mieszkanie; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>KOD POCZTOWY</p>
			<div class="um_zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_kod; ?>&nbsp;</div>
		</div>
		<div class="um_element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="um_zleceniodawca_w_imieniu_miejscowosc"><?php echo ($w_imieniu == 0) ? '' : $w_imieniu_miejscowosc; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="um_naglowek_sekcji">dla</div>
	<div class="um_zleceniobiorca">
        <p>
            VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel.
            71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
            zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział
            Gospodarczy Krajowego Rejestru Sądowego pod numerem <span
                    class="um_czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP:
				899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,</span>
            którą reprezentuje:
        </p>
        <div class="um_zleceniobiorca_reprezentant"><?php echo $reprezentant; ?>&nbsp;</div>
    </div>
	<div class="um_sekcja">
		<div class="um_sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="um_sekcja_paragraf">§ 1</div>
		<div class="um_sekcja_tresc">
			<p>
				Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie
				Zleceniodawcy do powzięcia czynności mających na celu ustalenie
				podmiotu (zwanego dalej zobowiązanym) ponoszącego odpowiedzialność
				cywilną w związku z wypadkiem z dnia <span class="um_pogrubienie"><?php echo $data_wypadku; ?></span>
				, w którym śmierć poniósł/a <span class="um_pogrubienie"><?php echo $ofiara; ?></span>
				i uzyskanie od zobowiązanego świadczeń odszkodowawczych za szkodę na
				osobie należnych Zleceniodawcy.
			</p>
		</div>
	</div>
	<div class="um_sekcja">
		<div class="um_sekcja_tytul">OKRES OBOWIĄZYWANIA UMOWY</div>
		<div class="um_sekcja_paragraf">§ 2</div>
		<div class="um_sekcja_tresc">
			<p>
				Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od
				zobowiązanego na rzecz Zleceniodawcy należnych mu świadczeń
				odszkodowawczych <span class="um_pogrubienie">w postępowaniu
					przedsądowym, sądowym i egzekucyjnym.</span>
			</p>
		</div>
	</div>
	<div class="um_sekcja">
		<div class="um_sekcja_tytul">REPREZENTACJA W POSTĘPOWANIU SĄDOWYM</div>
		<div class="um_sekcja_paragraf">§ 3</div>
		<div class="um_sekcja_tresc">
			<p>1. Skierowanie sprawy na drogę postępowania sądowego przeciwko
				zobowiązanemu do spełnienia świadczeń odszkodowawczych w związku z
				wypadkiem, o którym mowa w § 1 wymaga zgody obu stron umowy.</p>
			<p>2. W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie
				postępowania sądowego, zobowiązuje się on do niezwłocznego
				przekazania VOTUM wszelkich posiadanych informacji dotyczących
				przedmiotu umowy oraz wszelkiej żądanej przez niego dokumentacji i
				oświadczeń, które będą przydatne do wykonania umowy.</p>
			<p>
				3. <span class="um_pogrubienie">Koszty wynagrodzenia pełnomocnika
					procesowego</span>, o którym mowa w § 8 ust. 2, w tym konieczne
				koszty zastępstwa substytucyjnego, obciążają VOTUM.
			</p>
			<p>
				4. <span class="um_pogrubienie">VOTUM zobowiązuje się do wystąpienia
					o zwolnienie Zleceniodawcy z kosztów sądowych</span>, po uprzednim
				złożeniu przez Zleceniodawcę oświadczenia o stanie rodzinnym,
				majątku i dochodach, wg wzoru urzędowego.
			</p>
			<p>
				5. <span class="um_pogrubienie">Koszty sądowe ponosi VOTUM</span>,
				jeżeli sąd nie zwolni od ich ponoszenia Zleceniodawcy na podstawie
				wniosku, o którym mowa w ust. 4.
			</p>
			<p>6. Koszty procesu poniesione przez Votum podlegają zwrotowi na rzecz VOTUM
                wyłącznie z kwoty ogółu świadczeń przyznanych Zleceniodawcy rozstrzygnięciem sądu lub ugodą,
                a koszty zastępstwa procesowego zasądzone w sprawie przypadają pełnomocnikowi procesowemu,
                o którym mowa w § 8 ust.2.</p>
		</div>
	</div>
	<div class="um_objasnienia strona_1 ">* W przypadku, gdy umowa
		zawierana jest w imieniu osoby nie posiadającej pełnej zdolności do
		czynności prawnych, tj. małoletniego/ubezwłasnowolnionego, umowę
		podpisuje przedstawiciel ustawowy lub opiekun prawny poszkodowanego. W
		razie przemijającej przeszkody, która dotyczy jednego z małżonków
		pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu
		rodzinnego i opiekuńczego, drugi małżonek może za niego działać w
		sprawach zwykłego zarządu. Wypełnić jedynie w razie zaistnienia
		powyższych okoliczności.</div>

	<div class="um_strona_stopka">
		<div class="um_strona_stopka_numer_strony">1/3</div>
		<div class="um_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
<div class="um_strona um_strona_2">
	<?php echo $znak_wodny; ?>
	<div class="um_sekcja">
		<div class="um_sekcja_tytul">REPREZENTACJA W POSTĘPOWANIU KARNYM</div>
		<div class="um_sekcja_paragraf">§ 4</div>
		<div class="um_sekcja_tresc">
			<p>
				<span class="um_pogrubienie">VOTUM ponosi koszty wynagrodzenia
					pełnomocnika procesowego</span>, o którym mowa w § 8 ust. 2,
				reprezentującego Zleceniodawcę jako pokrzywdzonego <span
					class="um_pogrubienie">w karnym postępowaniu przygotowawczym
					prowadzonym</span> w związku z wypadkiem wskazanym w § 1.
			</p>
			<p>Wynagrodzenie pełnomocnika, które obciąża VOTUM obejmuje:</p>
			<p>1) przystąpienie do sprawy w charakterze pełnomocnika
				pokrzywdzonego w postępowaniu przygotowawczym,</p>
			<p>2) wystąpienie o dokumentację niezbędną do realizacji niniejszej
				umowy,</p>
			<p>3) sporządzanie pism procesowych.</p>
		</div>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">REPREZENTACJA W POSTĘPOWANIU PRZED SĄDEM
			RODZINNYM</div>
		<div class="um_sekcja_paragraf">§ 5</div>
		<div class="um_sekcja_tresc">
			<p>
				Na wniosek Zleceniodawcy, w przypadku, gdy dla realizacji niniejszej
				umowy niezbędne jest uzyskanie orzeczenia sądu dotyczącego
				ubezwłasnowolnienia, ustanowienia opieki lub kurateli, za zgodą obu
				stron umowy, <span class="um_pogrubienie">Votum poniesie koszty
					wynagrodzenia pełnomocnika procesowego</span>, reprezentującego
				Zleceniodawcę w postępowaniach dotyczących ww. spraw. Niniejsze
				postanowienie nie dotyczy skierowania sprawy na drogę postępowania
				sądowego, o którym mowa w § 3 umowy.
			</p>
		</div>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">ANALIZA EKSPERCKA</div>
		<div class="um_sekcja_paragraf">§ 6</div>
		<div class="sum_ekcja_tresc">
			<p>1. W przypadku, gdy ustalenia postępowania karnego prowadzonego w
				sprawie wypadku, o którym mowa w § 1, ograniczają lub wyłączają
				możliwość uzyskania świadczeń odszkodowawczych za szkodę na osobie,
				VOTUM zobowiązuje się do zlecenia przeprowadzenia analizy
				eksperckiej biegłemu z zakresu rekonstrukcji wypadków drogowych,
				celem weryfikacji dokumentacji z postępowania karnego lub
				przygotowania autorskiej opinii w przedmiocie przebiegu wypadku i
				prawidłowości zachowań jego uczestników.</p>
			<p>2. Koszty analizy oraz opinii, o których mowa w ust. 1 ponosi
				VOTUM, której na mocy odrębnej umowy z ekspertem, będą przysługiwały
				do nich autorskie prawa majątkowe.</p>
			<p>3. Udostępnianie, rozpowszechnianie, a także obrót dokumentami, o
				których mowa w niniejszym paragrafie są możliwe wyłącznie za pisemną
				zgodą VOTUM.</p>
		</div>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">ZALICZKA NA POCZET ODSZKODOWANIA</div>
		<div class="um_sekcja_paragraf">§ 7</div>
		<div class="um_sekcja_tresc">
			<p>W przypadku, gdy ocena okoliczności sprawy wskazuje na istnienie
				odpowiedzialności po stronie zobowiązanego (w szczególności, jeśli
				poszkodowany był pasażerem lub jest osobą małoletnią poniżej 13-ego
				roku życia) lub też została ona przez niego przyjęta, VOTUM, na
				wniosek Zleceniodawcy, może udzielić mu zaliczki pieniężnej na
				poczet przyszłych świadczeń.</p>
		</div>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">PRAWA I OBOWIĄZKI STRON</div>
		<div class="um_sekcja_paragraf">§ 8</div>
		<div class="um_sekcja_tresc">
			<p>1. Zleceniodawca zobowiązuje się do niezwłocznego przekazania
				VOTUM żądanej przez niego dokumentacji oraz udzielenia informacji
				niezbędnych do wykonania umowy.</p>
			<p>
				2. Czynności wchodzące w zakres umowy VOTUM może wykonywać za pomocą
				podmiotów współpracujących, w szczególności <span
					class="um_pogrubienie">adwokatów lub radców prawnych</span>, przy
				czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy, jak
				za działania własne.
			</p>
			<p>3. Zleceniodawca upoważnia VOTUM do pozyskiwania informacji o jego
				stanie zdrowia w zakresie, w jakim jest to niezbędne do wykonania
				umowy.</p>
			<p>4. VOTUM oświadcza, że nie zawrze z zobowiązanym ugody w imieniu
				Zleceniodawcy bez jego uprzedniej zgody. Wyrażenie zgody może
				nastąpić w dowolnej formie z zastrzeżeniem, że zgoda nie może być
				domniemana lub dorozumiana z oświadczenia woli o innej treści. W
				przypadku złożenia przez zobowiązanego oferty zawarcia ugody
				bezpośrednio Zleceniodawcy, zobowiązuje się on do niezwłocznego
				poinformowania o tym VOTUM.</p>
			<p>5. Reklamacje związane z wykonaniem umowy Zleceniodawca może
				składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje
				reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 30
				dni.</p>
			<p>6. Informacje dotyczące wykonywania niniejszej umowy będą
				kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres
				email, a w przypadku ich braku – na adres
				zameldowania/korespondencyjny.</p>
		</div>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">WYNAGRODZENIE</div>
		<div class="um_sekcja_paragraf">§ 9</div>
		<div class="um_sekcja_tresc">
			<p class="margin_b_10">
				1. VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych
				świadczeń w terminie <span class="um_pogrubienie">7 dni roboczych</span>
				od dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM
				wynagrodzenia <span class="um_kratka"><?php echo $platnosc == '0' ? 'X' : '&nbsp';  ?></span>przekazem
				pocztowym / <span class="um_kratka"><?php echo $platnosc != '0' ? 'X' : '&nbsp';  ?></span>na
				wskazany przez Zleceniodawcę rachunek bankowy:
			</p>
			<div class="um_element">
				<p>NR RACHUNKU</p>
				<div class="um_zleceniodawca_nr_rachunku margin_r_20"><?php echo $nr_rachunku == '0' ? '&nbsp' : $nr_rachunku.'&nbsp;';  ?>&nbsp;</div>
			</div>
			<div class="um_element um_kratka_element">
				<span class="um_kratka"><?php echo $osoba_do_wyplaty == $zleceniodawca_id ? 'X' : '&nbsp&nbsp';  ?></span>
				<p>POSIADACZEM RACHUNKU BANKOWEGO JEST ZLECENIODAWCA</p>
			</div>
			<div class="clear_b"></div>
			<p class="um_male_litery">POSIADACZ RACHUNKU (Wypełnić, jeżeli
				posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko
				oraz adres posiadacza.)</p>
			<div class="um_element">
				<p>IMIĘ</p>
				<div class="um_posiadacz_rachunku_imie margin_r_20"><?php echo $imie_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="um_element">
				<p>NAZWISKO</p>
				<div class="um_posiadacz_rachunku_nazwisko"><?php echo $nazwisko_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="um_element">
				<p>ULICA</p>
				<div class="um_posiadacz_rachunku_ulica margin_r_20"><?php echo $ulica_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="um_element">
				<p>NR DOMU</p>
				<div class="um_posiadacz_rachunku_nr_domu "><?php echo $dom_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="um_element">
				<p>NR MIESZKANIA</p>
				<div class="um_posiadacz_rachunku_nr_mieszkania margin_r_20"><?php echo $mieszkanie_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="um_element">
				<p>KOD POCZTOWY</p>
				<div class="um_posiadacz_rachunku_kod_pocztowy margin_r_20"><?php echo $kod_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="um_element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="um_posiadacz_rachunku_miejscowosc"><?php echo $miejscowosc_uposazonego; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<br />
			<p>W przypadku przekazania przez VOTUM świadczeń przekazem pocztowym,
				jego koszty obciążają Zleceniodawcę.</p>
		</div>
	</div>
	<div class="um_strona_stopka">
		<div class="um_strona_stopka_numer_strony">2/3</div>
		<div class="um_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="um_strona um_strona_3">
	<?php echo $znak_wodny; ?>
	<div class="um_sekcja">
		<div class="um_sekcja_tresc">
			<p>
			
			
			<p>
				2. <span class="um_pogrubienie">VOTUM nie pobiera wynagrodzenia</span>
				od uzyskanych dla Zleceniodawcy rent, chyba że zobowiązany wypłaca
				je jednorazowo w wysokości należnej za okres co najmniej 6 miesięcy.
			</p>
			<p>
				3. <span class="um_pogrubienie">VOTUM nie pobiera wynagrodzenia</span>
				od uzyskanych dla Zleceniodawcy zwrotów kosztów związanych z
				pogrzebem osoby, o której mowa w § 1 umowy.
			</p>
			<p>4. Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w
				jego imieniu świadczeń w ramach wykonania niniejszej umowy.</p>
			<p>5. Z tytułu wykonania niniejszej umowy VOTUM przysługuje
				wynagrodzenie w wysokości <?php echo $prowizja; ?> % (słownie: <?php echo slownie($prowizja); ?> procent)
				brutto wartości uzyskanych dla Zleceniodawcy świadczeń (w tym
				podatek od towarów i usług VAT w wysokości 23 %).</p>
			<p>6. W przypadku spełnienia świadczenia przez zobowiązanego
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

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">GWARANCJA BEZPIECZEŃSTWA ZLECENIODAWCY</div>
		<div class="um_sekcja_paragraf">§ 10</div>
		<div class="um_sekcja_tresc">
			<p>
				W przypadku faktycznych bądź prawnych przeszkód w dochodzeniu
				roszczeń Zleceniodawcy, o których mowa w § 1, odmowy ich
				zaspokojenia przez jednego bądź wszystkich zobowiązanych albo
				odrzucenia bądź oddalenia w całości powództwa Zleceniodawcy o
				dochodzenie roszczeń odszkodowawczych, <span class="um_pogrubienie">VOTUM
					zobowiązuje się nie dochodzić od Zleceniodawcy wynagrodzeń oraz
					zwrotu ponoszonych kosztów</span>, które nie zostaną rozliczone z
				uzyskanych świadczeń, w tym kosztów analizy sprawy i jej prowadzenia
				na etapie przedsądowym i sądowym oraz kosztów reprezentacji w
				postępowaniu karnym.
			</p>
		</div>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="um_sekcja_paragraf">§ 11</div>
		<div class="um_sekcja_tresc">
			<p>1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem
				nieważności.</p>
			<p>2. W kwestiach nieuregulowanych mają zastosowanie przepisy kodeksu
				cywilnego.</p>
			<p>3. Umowę sporządzono i podpisano w dwóch jednobrzmiących
				egzemplarzach, po jednym dla każdej ze stron.</p>
		</div>
	</div>

	<div class="um_objasnienia um_strona_3 um_sekcja">
		Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie
		danych osobowych (tekst jednolity: Dz. U. z 2014 r., poz. 1182 ze zm.)
		VOTUM informuje, że:</br> 1. administratorem danych osobowych jest
		VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,</br>
		2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być
		przekazywane podmiotom współpracującym przy jej wykonaniu, jak również
		podmiotom od</br> których będą uzyskiwane informacje niezbędne do
		wykonania umowy i podmiotom od których będą dochodzone roszczenia,</br>
		3. posiada Pani/Pan prawo dostępu do treści danych oraz ich
		poprawiania,</br> 4. podanie VOTUM danych osobowych jest dobrowolne.</br>
		Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której
		będą dochodzone roszczenia odszkodowawcze (w tym danych dotyczących
		stanu zdrowia, skazań,</br> orzeczeń o ukaraniu i mandatów karnych, a
		także innych orzeczeń wydanych w postępowaniu sądowym) w celu
		wykonania umowy.</br>
	</div>

	<div class="um_sekcja um_sekcja">
		<div class="um_sekcja_tresc">
			<div class="um_podpis_lewo um_small_font um_pogrubienie">VOTUM S.A.</div>
			<div class="um_podpis_prawo um_small_font um_pogrubienie">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="um_oswiadczenie um_sekcja">
		<p class="um_pogrubienie">Oświadczenie</p>
		<p>Zleceniodawca oświadcza, że żąda rozpoczęcia wykonywania usługi
			przez VOTUM przed upływem terminu do odstąpienia od umowy.</p>
	</div>

	<div class="um_sekcja">
		<div class="um_sekcja_tresc">
			<div class="um_podpis_prawo um_small_font um_pogrubienie">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="um_strona_stopka">
		<div class="um_strona_stopka_numer_strony">3/3</div>
		<div class="um_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


