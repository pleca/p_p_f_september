<link rel="stylesheet"
	href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/zgloszenie_szkody.css'; ?>"
	type="text/css" />

<?php

$numer_stopka = 'PG-2-1-F1/2015-04-01';

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

//$id_sprawy = 728;

(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );
$uprawniony_id = $sprawa ['sprawa_uprawniony_id'];
$uprawniony = sprawa_pobierz_dane_osoby ( $uprawniony_id );

$klient_id = sprawa_pobierz_warosc_z_tabeli_po_id ( 'sprawa_klient_id', 'sprawa', $id_sprawy );
$zdarzenie_id = sprawa_pobierz_warosc_z_tabeli_po_id ( 'sprawa_zdarzenie_id', 'sprawa', $id_sprawy );

$klient_osoba = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $klient_id ['sprawa_klient_id'] );
$klient_adres = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $klient_osoba ['sprawa_adres_zameldowania_id'] );
$zdarzenie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_zdarzenie', $zdarzenie_id ['sprawa_zdarzenie_id'] );

$poszkodowany_id = sprawa_pobierz_warosc_z_tabeli_po_id ( 'sprawa_poszkodowany_id', 'sprawa', $id_sprawy );
$poszkodowany_osoba = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $poszkodowany_id ['sprawa_poszkodowany_id'] );

$imie_poszkodowany = $poszkodowany_osoba ['imie'];
$nazwisko_poszkodowany = $poszkodowany_osoba ['nazwisko'];

$imie_uprawnionego = $uprawniony ['imie'];
$nazwisko_uprawnionego = $uprawniony ['nazwisko'];

$dane_poszkodowanego = $imie_poszkodowany . ' ' . $nazwisko_poszkodowany;
$dane_uprawnionego = $imie_uprawnionego . ' ' . $nazwisko_uprawnionego;

$imie_zleceniodawcy = $klient_osoba ['imie'];
$nazwisko_zleceniodawcy = $klient_osoba ['nazwisko'];
$ulica_zleceniodawcy = $klient_adres ['ulica'];
$numer_domu_zleceniodawcy = $klient_adres ['nr_domu'];
$numer_mieszkania_zleceniodawcy = $klient_adres ['nr_mieszkania'];
$kod_pocztowy_zleceniodawcy = $klient_adres ['kod_pocztowy'];
$miejscowosc_zleceniodawcy = $klient_adres ['miasto'];
$pesel_zleceniodawcy = $klient_osoba ['pesel'];
$dowod_zleceniodawcy = $klient_osoba ['dowod'];

$dane_zleceniodawcy = $imie_zleceniodawcy . ' ' . $nazwisko_zleceniodawcy;

$zezwolenie_na;
$data_zamowienia = '________________';
$data_zdarzenia = $zdarzenie ['data'];


?>

<div class="strona strona_9">
	<div class="logo_kairp"></div>
	<div class="naglowek_z_data">________________, dnia <?php echo $data_zamowienia; ?></div>
	<div class="pelnomocnictwo_tytul">
		<p>PEŁNOMOCNICTWO</p>
	</div>

	<div class="sekcja_tresc">
    Ja niżej podpisany/a, <?php echo $dane_zleceniodawcy; ?>
        <?php if ($sprawa ['sprawa_typ_poszkodowany_id'] == '1') {
            echo 'działając w imieniu własnym oraz jako przedstawiciel małoletniego/małoletniej* ';
            echo $dane_poszkodowanego;
        } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '2' || $sprawa ['sprawa_typ_poszkodowany_id'] == '3') {
            echo 'działając w imieniu własnym oraz jako przedstawiciel ';
            echo $dane_poszkodowanego;
        } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '4') {
            echo 'działając w imieniu własnym oraz jako przedstawiciel ';
            echo $dane_uprawnionego;
        }
        ?>
        upoważniam,
    	<div class="linie_full"></div>
		<div class="clear_b"></div>
		z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp. k.
		we Wrocławiu do prowadzenia sprawy
		<div class="linie_full"></div>
		<div class="clear_b"></div>
		<div class="linie_full"></div>
		<div class="clear_b"></div>
    w związku ze zdarzeniem z dnia <?php echo $data_zdarzenia; ?> r., oraz do odbioru świadczenia.</br>
		Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze
		skutkiem od dnia jego przyjęcia przez Pełnomocnika.
	</div>

	<div class="podpis_prawo small_font margin_top_100">PODPIS MOCODAWCY</div>

	<div class="sekcja_tresc margin_top_200">
		Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam
		substytucji do prowadzenia sprawy:</br>
		<div class="linie_lewo"></div>
		<div class="clear_b"></div>
		<div class="linie_lewo"></div>
		<div class="clear_b"></div>
		<div class="linie_lewo"></div>
		<div class="clear_b"></div>

	</div>

	<div class="sekcja_tresc margin_top_100">
		<div class="element">________________, dnia <?php echo $data_zamowienia; ?> r.</div>
		<div class="clear_b"></div>
		<div class="podpis_lewo small_font">PODPIS PEŁNOMOCNIKA</div>
		<div class="clear_b"></div>
	</div>

	<div class="strona_stopka">
		<div class="linie_full"></div>
		<div class="strona_stopka_numer_strony">
			<div class="font_red">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A.ŁEBEK
				I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
			ul. Wyścigowa 56i; 53-012 Wrocłąw, tel. +48 71 332 93 40, fax +48 332
			93 43</br> e–mail: kancelaria@kairp–lebek.pl, www.kairp–lebek.pl</br>
			NIP: 899–25–79–696 REGON: 020356170 KRS:0000262469
		</div>
	</div>
</div>

<div class="strona strona_10">
	<div class="logo_kairp"></div>
	<div class="naglowek_z_data">________________, dnia <?php echo $data_zamowienia; ?></div>
	<div class="pelnomocnictwo_tytul">
		<p>PEŁNOMOCNICTWO</p>
	</div>

    <div class="sekcja_tresc">
        Ja niżej podpisany/a, <?php echo $dane_zleceniodawcy; ?>
        <?php if ($sprawa ['sprawa_typ_poszkodowany_id'] == '1') {
            echo 'działając w imieniu własnym oraz jako przedstawiciel małoletniego/małoletniej* ';
            echo $dane_poszkodowanego;
        } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '2' || $sprawa ['sprawa_typ_poszkodowany_id'] == '3') {
            echo 'działając w imieniu własnym oraz jako przedstawiciel ';
            echo $dane_poszkodowanego;
        } else if ($sprawa ['sprawa_typ_poszkodowany_id'] == '4') {
            echo 'działając w imieniu własnym oraz jako przedstawiciel ';
            echo $dane_uprawnionego;
        }
        ?>
        upoważniam,
        <div class="linie_full"></div>
        <div class="clear_b"></div>
        z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp. k.
        we Wrocławiu do prowadzenia sprawy
        <div class="linie_full"></div>
        <div class="clear_b"></div>
        <div class="linie_full"></div>
        <div class="clear_b"></div>
        w związku ze zdarzeniem z dnia <?php echo $data_zdarzenia; ?> r., oraz do odbioru świadczenia.</br>
        Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze
        skutkiem od dnia jego przyjęcia przez Pełnomocnika.
    </div>

	<div class="podpis_prawo small_font margin_top_100">PODPIS MOCODAWCY</div>

	<div class="sekcja_tresc margin_top_200">
		Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam
		substytucji do prowadzenia sprawy:</br>
		<div class="linie_lewo"></div>
		<div class="clear_b"></div>
		<div class="linie_lewo"></div>
		<div class="clear_b"></div>
		<div class="linie_lewo"></div>
		<div class="clear_b"></div>

	</div>

	<div class="sekcja_tresc margin_top_100">
		<div class="element">________________, dnia <?php echo $data_zamowienia; ?> r.</div>
		<div class="clear_b"></div>
		<div class="podpis_lewo small_font">PODPIS PEŁNOMOCNIKA</div>
		<div class="clear_b"></div>
	</div>

	<div class="strona_stopka">
		<div class="linie_full"></div>
		<div class="strona_stopka_numer_strony">
			<div class="font_red">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A.ŁEBEK
				I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
			ul. Wyścigowa 56i; 53-012 Wrocłąw, tel. +48 71 332 93 40, fax +48 332
			93 43</br> e–mail: kancelaria@kairp–lebek.pl, www.kairp–lebek.pl</br>
			NIP: 899–25–79–696 REGON: 020356170 KRS:0000262469
		</div>
	</div>
</div>