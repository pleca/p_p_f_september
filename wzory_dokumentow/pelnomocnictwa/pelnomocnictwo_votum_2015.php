<link rel="stylesheet"
	href="<?php  echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/zgloszenie_szkody.css'; ?>"
	type="text/css" />

<?php

$numer_stopka = 'PG-2-1-F1/2015-04-01';

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = $_POST ['id_sprawy'];

(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];

$klient_id = sprawa_pobierz_warosc_z_tabeli_po_id ( 'sprawa_klient_id', 'sprawa', $id_sprawy );
$zdarzenie_id = sprawa_pobierz_warosc_z_tabeli_po_id ( 'sprawa_zdarzenie_id', 'sprawa', $id_sprawy );

$klient_osoba = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $klient_id ['sprawa_klient_id'] );
$klient_adres = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $klient_osoba ['sprawa_adres_zameldowania_id'] );
$zdarzenie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_zdarzenie', $zdarzenie_id ['sprawa_zdarzenie_id'] );

$imie_zleceniodawcy = $klient_osoba ['imie'];
$nazwisko_zleceniodawcy = $klient_osoba ['nazwisko'];
$ulica_zleceniodawcy = $klient_adres ['ulica'];
$numer_domu_zleceniodawcy = $klient_adres ['nr_domu'];
$numer_mieszkania_zleceniodawcy = $klient_adres ['nr_mieszkania'];
$kod_pocztowy_zleceniodawcy = $klient_adres ['kod_pocztowy'];
$miejscowosc_zleceniodawcy = $klient_adres ['miasto'];
$pesel_zleceniodawcy = $klient_osoba ['pesel'];
$dowod_zleceniodawcy = $klient_osoba ['dowod'];
$zlec_czy_obcokrajowiec = $klient_osoba ['czy_obcokrajowiec'];

$zezwolenie_na;
$data_zdarzenia = $zdarzenie ['data'];
?>


<div class="strona strona_9">
	<div class="logo_votum"></div>
	<div class="tytul_strony_pierwszej">
		<p>PEŁNOMOCNICTWO</p>
	</div>
	<div class="formularz_czerwony">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec) ? $klient_osoba['rodzaj_dokumentu'] : $pesel_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec) ? $klient_osoba['nr_dokumentu'] : $dowod_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="napis">działającego w imieniu małoletniego
			/ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $imie_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $nazwisko_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $ulica_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $numer_domu_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $miejscowosc_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="tekst_szary">UPOWAŻNIAM:</div>
	<div class="formularz_szary margin_top_35">
		<div class="padding_6">VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul.
			Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail:
			dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia
			Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod
			numerem KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057,
			KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</div>
	</div>

	<div class="sekcja_tresc">
		<p>
			do podejmowania w moim imieniu lub w imieniu osoby, którą
			reprezentuję przed wszelkimi podmiotami wszelkich czynności mających
			na celu ustalenie okoliczności zdarzenia z dnia <b><?php echo $data_zdarzenia; ?></b>,
			jak również jego skutków i dochodzenie roszczeń cywilnoprawnych,
			które z tego wynikają, w tym w szczególności do:</br> 1. wszelkich
			czynności pozaprocesowych i polubownych,</br> 2. zawarcia ugody, w
			tym wiążącej sie ze zrzeczeniem siędalszych roszczeń,</br> 3. odbioru
			świadczenia,</br> 4. wskazania rachunku bankowego, na kóry mają być
			przelane świadczenia,</br> 5. odbioru wszelkiej korespondencji w
			sprawach objętych pełnomocnictwem,</br> 6. gromadzenia dokumentacji
			medycznej, w tym jej odbioru od podmiotów, które ją tworzą i
			przechowują</br> 7. udzielania dalszych pełnomocnictw.</br>
		</p>
	</div>
	<div class="sekcja_tresc">
		Pełnomocnictwo jest ważne także po śmierci mocodawcy.</br>
		Jednocześnie na podstawie art. 26 ust 1 ustawy z dnia 6 listopada 2008
		r. o prawach pacjenta i Rzeczniku Praw Pacjenta (Dz.U.2009 r. nr 52
		poz. 417) zezwalam na wydanie/wysłanie przez:</br>
		<div class="padding_6"><?php echo $zezwolenie_na; ?></div>
		odpisów lub kserokopii wszelkiej posiadanej dokumentacji medycznej, w
		tym zawierającej informacje o stanie zdrowia, rozpoznaniu,
		proponowanych oraz możliwych metodach diagnostycznych, leczniczych,
		dających się przewidzieć następstwa ich zastosowania albo zaniechania,
		wynikach leczenia oraz rokowaniu, a tym samym zwalniam w tym zakresie
		ww. od obowiązku zachowania tajemnicy lekarskiej VOTUM S.A.</br> W
		trybie art. 23 w zw. z art. 22 ust. 1 i 3 ustawy z dnia 22 maja 2003
		r. o działalności ubezpieczeniowej (t.j. Dz. U. 2013 r., poz. 950, ze
		zm.) wyrażam zgodę na udostępnienie zakładowi ubezpieczeń prowadzącemu
		proces likwidacji szkody lub jego przedstawicielowi informacji o moim
		stanie zdrowia, przebiegu leczenia lub przyczynie śmierci przez
		podmioty wykonywujące działalność leczniczą, które udzielały mi
		świadczeń zdrowotnych.</br> </br> Zgodnie z ustawą z dnia 29 sierpnia
		1997 r. o ochronie danych osobowych (t.j. Dz.U.2014 r., poz. 1182, ze
		zm.) w zakresie czynności objętych pełnomocnictwem wyrażam zgodę na
		przetwarzanie danych osobowych przez VOTUM S.A. oraz podmiot ponoszący
		odpowiedzialność cywilną za poniesioną szkodę, w szczególności zakład
		ubezpieczeń, a także przetwarzanie i przekazywanie przez ten podmiot
		danych osobowych, w tym dotyczących stanu zdrowia, innym podmiotom,
		którym zlecono czynności ubezpieczeniowe w ramach likwidacji szkody, w
		zakresie niezbędnym do ich wykonania.
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS MOCODAWCY</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_10">
	<div class="logo_votum"></div>
	<div class="tytul_strony_pierwszej">
		<p>PEŁNOMOCNICTWO</p>
	</div>
	<div class="formularz_czerwony">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec) ? $klient_osoba['rodzaj_dokumentu'] : $pesel_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec) ? $klient_osoba['nr_dokumentu'] : $dowod_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="napis">działającego w imieniu małoletniego
			/ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $imie_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $nazwisko_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $ulica_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $numer_domu_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $miejscowosc_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="tekst_szary">UPOWAŻNIAM:</div>
	<div class="formularz_szary margin_top_35">
		<div class="padding_6">VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul.
			Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail:
			dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia
			Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod
			numerem KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057,
			KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</div>
	</div>

	<div class="sekcja_tresc">
		<p>
			do podejmowania w moim imieniu lub w imieniu osoby, którą
			reprezentuję przed wszelkimi podmiotami wszelkich czynności mających
			na celu ustalenie okoliczności zdarzenia z dnia <b><?php echo $data_zdarzenia; ?></b>,
			jak również jego skutków i dochodzenie roszczeń cywilnoprawnych,
			które z tego wynikają, w tym w szczególności do:</br> 1. wszelkich
			czynności pozaprocesowych i polubownych,</br> 2. zawarcia ugody, w
			tym wiążącej sie ze zrzeczeniem siędalszych roszczeń,</br> 3. odbioru
			świadczenia,</br> 4. wskazania rachunku bankowego, na kóry mają być
			przelane świadczenia,</br> 5. odbioru wszelkiej korespondencji w
			sprawach objętych pełnomocnictwem,</br> 6. gromadzenia dokumentacji
			medycznej, w tym jej odbioru od podmiotów, które ją tworzą i
			przechowują</br> 7. udzielania dalszych pełnomocnictw.</br>
		</p>
	</div>
	<div class="sekcja_tresc">
		Pełnomocnictwo jest ważne także po śmierci mocodawcy.</br>
		Jednocześnie na podstawie art. 26 ust 1 ustawy z dnia 6 listopada 2008
		r. o prawach pacjenta i Rzeczniku Praw Pacjenta (Dz.U.2009 r. nr 52
		poz. 417) zezwalam na wydanie/wysłanie przez:</br>
		<div class="padding_6"><?php echo $zezwolenie_na; ?></div>
		odpisów lub kserokopii wszelkiej posiadanej dokumentacji medycznej, w
		tym zawierającej informacje o stanie zdrowia, rozpoznaniu,
		proponowanych oraz możliwych metodach diagnostycznych, leczniczych,
		dających się przewidzieć następstwa ich zastosowania albo zaniechania,
		wynikach leczenia oraz rokowaniu, a tym samym zwalniam w tym zakresie
		ww. od obowiązku zachowania tajemnicy lekarskiej VOTUM S.A.</br> W
		trybie art. 23 w zw. z art. 22 ust. 1 i 3 ustawy z dnia 22 maja 2003
		r. o działalności ubezpieczeniowej (t.j. Dz. U. 2013 r., poz. 950, ze
		zm.) wyrażam zgodę na udostępnienie zakładowi ubezpieczeń prowadzącemu
		proces likwidacji szkody lub jego przedstawicielowi informacji o moim
		stanie zdrowia, przebiegu leczenia lub przyczynie śmierci przez
		podmioty wykonywujące działalność leczniczą, które udzielały mi
		świadczeń zdrowotnych.</br> </br> Zgodnie z ustawą z dnia 29 sierpnia
		1997 r. o ochronie danych osobowych (t.j. Dz.U.2014 r., poz. 1182, ze
		zm.) w zakresie czynności objętych pełnomocnictwem wyrażam zgodę na
		przetwarzanie danych osobowych przez VOTUM S.A. oraz podmiot ponoszący
		odpowiedzialność cywilną za poniesioną szkodę, w szczególności zakład
		ubezpieczeń, a także przetwarzanie i przekazywanie przez ten podmiot
		danych osobowych, w tym dotyczących stanu zdrowia, innym podmiotom,
		którym zlecono czynności ubezpieczeniowe w ramach likwidacji szkody, w
		zakresie niezbędnym do ich wykonania.
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS MOCODAWCY</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_11">
	<div class="logo_votum"></div>
	<div class="tytul_strony_pierwszej">
		<p>PEŁNOMOCNICTWO</p>
	</div>
	<div class="formularz_czerwony">
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_imie margin_r_20"><?php echo $imie_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_nazwisko"><?php echo $nazwisko_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_ulica margin_r_20"><?php echo $ulica_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_nr_domu "><?php echo $numer_domu_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_miejscowosc"><?php echo $miejscowosc_zleceniodawcy; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo ($zlec_czy_obcokrajowiec) ? $klient_osoba['rodzaj_dokumentu'] : $pesel_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="element margin_r_20">
			<?php echo ($zlec_czy_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo ($zlec_czy_obcokrajowiec) ? $klient_osoba['nr_dokumentu'] : $dowod_zleceniodawcy ; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="napis">działającego w imieniu małoletniego
			/ubezwłasnowolnionego/małżonka*</div>
		<div class="element">
			<p>IMIĘ</p>
			<div class="zleceniodawca_w_imieniu_imie margin_r_20"><?php echo $imie_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NAZWISKO</p>
			<div class="zleceniodawca_w_imieniu_nazwisko"><?php echo $nazwisko_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="zleceniodawca_w_imieniu_ulica margin_r_20"><?php echo $ulica_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="zleceniodawca_w_imieniu_nr_domu "><?php echo $numer_domu_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>NR MIESZKANIA</p>
			<div class="zleceniodawca_w_imieniu_nr_mieszkania margin_r_20"><?php echo $numer_mieszkania_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="zleceniodawca_w_imieniu_kod_pocztowy margin_r_20"><?php echo $kod_pocztowy_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="zleceniodawca_w_imieniu_miejscowosc"><?php echo $miejscowosc_poszkodowany; ?>&nbsp;</div>
		</div>
		<div class="clear_b"></div>
	</div>
	<div class="tekst_szary">UPOWAŻNIAM:</div>
	<div class="formularz_szary margin_top_35">
		<div class="padding_6">VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul.
			Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail:
			dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia
			Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod
			numerem KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057,
			KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości.</div>
	</div>

	<div class="sekcja_tresc">
		<p>
			do podejmowania w moim imieniu lub w imieniu osoby, którą reprezentuję przed wszelkimi podmiotami wszelkich czynności mających na celu ustalenie okoliczności zdarzenia z dnia <?php echo $data_zdarzenia; ?>, jak również jego skutków i dochodzenie roszczeń cywilnoprawnych, które z tego wynikają, w tym w szczególności do:</br>
			1. wszelkich czynności pozaprocesowych i polubownych,</br> 2.
			zawarcia ugody, w tym wiążącej sie ze zrzeczeniem siędalszych
			roszczeń,</br> 3. odbioru świadczenia,</br> 4. wskazania rachunku
			bankowego, na kóry mają być przelane świadczenia,</br> 5. odbioru
			wszelkiej korespondencji w sprawach objętych pełnomocnictwem,</br> 6.
			gromadzenia dokumentacji medycznej, w tym jej odbioru od podmiotów,
			które ją tworzą i przechowują</br> 7. udzielania dalszych
			pełnomocnictw.</br>
		</p>
	</div>
	<div class="sekcja_tresc">
		Pełnomocnictwo jest ważne także po śmierci mocodawcy.</br>
		Jednocześnie na podstawie art. 26 ust 1 ustawy z dnia 6 listopada 2008
		r. o prawach pacjenta i Rzeczniku Praw Pacjenta (Dz.U.2009 r. nr 52
		poz. 417) zezwalam na wydanie/wysłanie przez:</br>
		<div class="padding_6"><?php echo $zezwolenie_na; ?></div>
		odpisów lub kserokopii wszelkiej posiadanej dokumentacji medycznej, w
		tym zawierającej informacje o stanie zdrowia, rozpoznaniu,
		proponowanych oraz możliwych metodach diagnostycznych, leczniczych,
		dających się przewidzieć następstwa ich zastosowania albo zaniechania,
		wynikach leczenia oraz rokowaniu, a tym samym zwalniam w tym zakresie
		ww. od obowiązku zachowania tajemnicy lekarskiej VOTUM S.A.</br> W
		trybie art. 23 w zw. z art. 22 ust. 1 i 3 ustawy z dnia 22 maja 2003
		r. o działalności ubezpieczeniowej (t.j. Dz. U. 2013 r., poz. 950, ze
		zm.) wyrażam zgodę na udostępnienie zakładowi ubezpieczeń prowadzącemu
		proces likwidacji szkody lub jego przedstawicielowi informacji o moim
		stanie zdrowia, przebiegu leczenia lub przyczynie śmierci przez
		podmioty wykonywujące działalność leczniczą, które udzielały mi
		świadczeń zdrowotnych.</br> </br> Zgodnie z ustawą z dnia 29 sierpnia
		1997 r. o ochronie danych osobowych (t.j. Dz.U.2014 r., poz. 1182, ze
		zm.) w zakresie czynności objętych pełnomocnictwem wyrażam zgodę na
		przetwarzanie danych osobowych przez VOTUM S.A. oraz podmiot ponoszący
		odpowiedzialność cywilną za poniesioną szkodę, w szczególności zakład
		ubezpieczeń, a także przetwarzanie i przekazywanie przez ten podmiot
		danych osobowych, w tym dotyczących stanu zdrowia, innym podmiotom,
		którym zlecono czynności ubezpieczeniowe w ramach likwidacji szkody, w
		zakresie niezbędnym do ich wykonania.
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS MOCODAWCY</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>