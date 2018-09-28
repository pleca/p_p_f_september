<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'wzory_dokumentow/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'funkcje_glowne.php');


//$id_sprawy = $_POST ['id_sprawy'];
//$id_sprawy = '380';
//$id_umowy = $_POST ['id_umowy'];

(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];
//(isset ( $_POST ['id_umowy'] )) ? $id_umowy = $_POST ['id_umowy'] : $id_umowy = $_GET ['id_umowy'];

//$dane_uzytkownika = uzytkownik_pobierz_po_id ( $uzytkownik_id );

// if ( isset ( $_POST ['id_sprawy'] )) {
?>
<link rel="stylesheet"
	href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_z_bankiem.css'; ?>"
	type="text/css" />
<?php
// }

//$identyfikator_przedstawiciela = $dane_uzytkownika ['login'];

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

$numer_stopka = 'PG-2-21-F2/2017-01-02';

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
	<div class="uo_logo_votum"></div>
	<div class="uo_tytul_strony_optima">
		<p>PEŁNOMOCNICTWO</p>
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
	<div class="uo_zleceniobiorca_pelnomocnik">
		<p>
			VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i,
			zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział
			Gospodarczy Krajowego Rejestru Sądowego pod numerem  KRS: 0000243252, REGON: 020136043, NIP:
            899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.
		</p>
	</div>
	<div class="uo_sekcja margin_t_10">
		<div class="uo_sekcja_tresc">
			<p>
				do podejmowania w moim imieniu wszelkich czynności mających na celu dochodzenie roszczeń dotyczących umowy kredytu hipotecznego
                nr <?php echo $umowa_bankowa['numer_umowy']; ?> udzielonego przez <?php echo $umowa_bankowa['nazwa_banku']; ?> , w tym w szczególności do: wszelkich czynności pozaprocesowych i polubownych, zawarcia ugody,
                w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia, wskazania rachunku bankowego, na który mają być przelane świadczenia,
                odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem, gromadzenia dokumentacji mającej związek ze sprawą, w tym jej odbioru od podmiotów,
                które je tworzą i przechowują, udzielania dalszych pełnomocnictw.
			</p>
		</div>
	</div>

	<div class="uo_sekcja margin_t_10">
		<div class="uo_sekcja_tresc">
			<p>
				Zgodnie z art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016. poz. 1988) upoważniam zarówno bank, a także Rzecznika Finansowego,
                do ujawnienia i przekazania VOTUM S.S. wszelkich żadanych przez Spółcę dokumentów i informacji objętych tajemnicą bankową, dotyczących udzielania i wykonania
                kredytu hipotecznego o numerze <?php echo $umowa_bankowa['numer_umowy']; ?> na podstawie umowy z dnia ____________ , w zakresie niezbędnym do wykonania wszelkich czynności objętych pełnomocnictwem,
                a także realizacji zadań przez Rzecznika Finansowego w związku z wniesionym wnioskiem w ww. sprawie.
			</p>
		</div>
	</div>

    <div class="uo_sekcja margin_t_50">
        <div class="uo_sekcja_tresc">
            <div class="uo_podpis_lewo uo_small_font uo_pogrubienie">MIEJSCOWOŚĆ
                I DATA</div>
            <div class="uo_podpis_prawo uo_small_font uo_pogrubienie">ZLECENIODAWCA</div>
            <div class="clear_b"></div>
        </div>
    </div>

    <div class="uo_objasnienia uo_strona_2 uo_sekcja margin_t_50">
        Oświadczam, że wszystkie świadczenia uzyskane w związku z realizacją niniejszego pełnomocnictwa mają być przekazywane na rachunek bankowy pełnomocnika, tj. VOTUM S.A.,
        ul. Wyścigowa 56 i, 53-012 Wrocław, nr: 20 1050 1575 1000 0024 2109 0479. Niniejsza dyspozycja wskazuje jedyny sposób spełnienia świadczenia przez podmiot zobowiązany
        do zapłaty w związku z realizacją niniejszego pełnomocnictwa.
    </div>

    <div class="uo_sekcja margin_t_50">
        <div class="uo_sekcja_tresc">
            <div class="uo_podpis_lewo uo_small_font uo_pogrubienie">MIEJSCOWOŚĆ
                I DATA</div>
            <div class="uo_podpis_prawo uo_small_font uo_pogrubienie">ZLECENIODAWCA</div>
            <div class="clear_b"></div>
        </div>
    </div>

	<div class="uo_strona_stopka">
		<div class="uo_strona_stopka_numer_strony">1/1</div>
		<div class="uo_strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

