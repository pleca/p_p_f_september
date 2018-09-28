<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/zgloszenie_szkody.css'; ?>" type="text/css" />
<?php 

	$identyfikator_przedstawiciela = 'A1234567';
    $kod_jednostki = '2345678';
    $kod_konsultanta = '2345678';
    $nr_sprawy = '2345/67/8123456';
	
	$numer_stopka = 'PG-2-1-F1/2015-04-01';
	
	$data_zamowienia = '30-10-2015';
	$imie_zleceniodawcy = 'Łukasz';
	$nazwisko_zleceniodawcy = 'Krzemień';
    $wiek_zleceniodawcy = '30';
	$ulica_zleceniodawcy = 'Wrocławska';
	$numer_domu_zleceniodawcy = '51';
	$numer_mieszkania_zleceniodawcy = '5';
	$kod_pocztowy_zleceniodawcy = '55-300';
	$miejscowosc_zleceniodawcy = 'Oleśnica';
    $ulica_zleceniodawcy_kor = 'Wrocławska';
	$numer_domu_zleceniodawcy_kor = '51';
	$numer_mieszkania_zleceniodawcy_kor = '5';
	$kod_pocztowy_zleceniodawcy_kor = '55-300';
	$miejscowosc_zleceniodawcy_kor = 'Oleśnica';
	$pesel_zleceniodawcy = '91503045588';
	$dowod_zleceniodawcy = 'AJA543211';
    $telefon_zleceniodawcy = '889988122';
	$email_zleceniodawcy = 'marek@marek.pl';

    $imie_poszkodowany = 'Łukasz';
	$nazwisko_poszkodowany = 'Krzemień';
    $wiek_poszkodowany = '30';
	$ulica_poszkodowany = 'Wrocławska';
	$numer_domu_poszkodowany = '51';
	$numer_mieszkania_poszkodowany = '5';
	$kod_pocztowy_poszkodowany = '55-300';
	$miejscowosc_poszkodowany = 'Oleśnica';
	$pesel_poszkodowany = '91503045588';
	$dowod_poszkodowany = 'AJA543211';
    $telefon_poszkodowany = '889988122';
	$email_poszkodowany = 'marek@marek.pl';

    $imie_uprawniony = 'Łukasz';
	$nazwisko_uprawniony = 'Krzemień';
    $wiek_uprawniony = '30';
	$ulica_uprawniony = 'Wrocławska';
	$numer_domu_uprawniony = '51';
	$numer_mieszkania_uprawniony = '5';
	$kod_pocztowy_uprawniony = '55-300';
	$miejscowosc_uprawniony = 'Oleśnica';
	$pesel_uprawniony = '91503045588';
	$dowod_uprawniony = 'AJA543211';
    $telefon_uprawniony = '889988122';
	$email_uprawniony = 'marek@marek.pl';
    $wiek_uprawnionego = '35';
    $zawod_uprawnionego = 'stolarz';
    $zawod_wykonywany_uprawnionego = 'tynkarz';
    $kwalifikacje_uprawnionego = 'dobre';
    $inna_praca_uprawnionego = 'dorywcza';
    $zarobki_uprawnionego = '2 000';

    $imie_uprawniony_do_inf = 'Łukasz';
	$nazwisko_uprawniony_do_inf = 'Krzemień';
    $pesel_uprawniony_do_inf = '91503045588';

	$data_zdarzenia = '30-10-2015';
    $godzina_zdarzenia = '9:30';
    $miejsce_zdarzenia = 'Wrocław';

    $pojazd_a_marka = 'Opel';
    $pojazd_a_nr_rejestracji = 'DW A2345';
    $pojazd_a_kraj_rej = 'Polska';
    $pojazd_a_kierujacy = 'Jan Test';
    $pojazd_a_posiadacz = 'Jan Test';
    $pojazd_a_ubezpieczyciel = 'PZU';
    $pojazd_a_polisa = '1234567897';

    $pojazd_b_marka = 'KIA';
    $pojazd_b_nr_rejestracji = 'PO A2345';
    $pojazd_b_kraj_rej = 'Polska';
    $pojazd_b_kierujacy = 'Jan Testa';
    $pojazd_b_posiadacz = 'Jan Testa';
    $pojazd_b_ubezpieczyciel = 'AVIVA';
    $pojazd_b_polisa = '1234567890';

    $opis_zdarzenia = 'Zgodnie z przepisami ustawy z dnia 30 maja 2014 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że ma
            Pan/Pani prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od
            umowy kończy się po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, musi Pan/Pani
            poinformować VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl
            o swojej decyzji w drodze jednoznacznego oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną.
            Może Pan/Pani skorzystać z wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do
            odstąpienia od umowy, wystarczy, aby wysłał/a Pan/Pani informację dotyczącą wykonania przysługującego Panu/Pani prawa do
            odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.';
    $obrazenia_ciala = 'Zgodnie z przepisami ustawy z dnia 30 maja 2014 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że ma
            Pan/Pani prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od
            umowy kończy się po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, musi Pan/Pani
            poinformować VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl
            o swojej decyzji w drodze jednoznacznego oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną.
            Może Pan/Pani skorzystać z wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do
            odstąpienia od umowy, wystarczy, aby wysłał/a Pan/Pani informację dotyczącą wykonania przysługującego Panu/Pani prawa do
            odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.';

    $sygnatura_akt_karna = '1233/ST/34';
    $miejsce_policja = 'Radom';
    $zarzut_dla_sprawcy = '123d';
    $umorzono_na_podstawie = '123d';
    $nazwa_sadu = 'we Wrocławiu';
    $wyrok = '6h54';

    $nr_szkody_cywilna = '1233/ST/34';
    $pojazd_data_zgloszenia = '30-05-2015';
    $osoba_data_zgloszenia = '30-10-2013';
    $kwota_szkoda_osobowa = '1 500';
    $data_decyzji = '30-10-2014';

    $ubezpieczyciel_NNW = 'HESTIA';
    $procent_uszczerbku = '20';
    $gdzie_zgloszono = 'PZU';
    $procent_uszczerbku_ubezpieczyciela = '10';
    $jednorazowe_odszkodowanie = '5 000';
    $zwolnienie_od = '15-06-2016';
    $zwolnienie_do = '20-07-2016';
    $data_niezdolnosci = '20-07-2016';
    $kto_przyznal = 'PZU';
    $co_przyznal = 'inny zzasiłek';
    $ile_przyznal = '1 000';
    $do_kiedy_przyznal = '31-12-2016';

    $przedstawiciel = 'ADAM SKAŁA';

    $skad_pogotowie = 'Oława';
    $skad_przychodnia = 'Wrocław';
    $data_zgloszenia_do_przychodni = '01-03-2014';
    $miejsca_hospitalizacji_1 = 'Poznań';
    $data_hospitalizacji_1 = '25-02-2016';
    $placowki_medyczne_1 = 'Sztpital Wojewódzki';
    $data_placowek_1 = '16-06-2015';
    
    $nazwa_pelnomocnika = 'TES SA';
    $data_umowy_z_pelnomocnikiem = '25-10-2015';
    $data_wypowiedzenia_umowy_z_pelnomocnikiem = '25-12-2015';
    $kierujacy_A_stosunek = 'brat';
    $kierujacy_B_stosunek = 'wujek';
        
    $dok_dla_pelnomocnika = 'zdjęć RTG';
    $ile_kart = '6';
        
    $marka_potracajacego = 'Ford';
    $rejestracja_potracajacego = 'DW 1234';        
    $pojazd_poszkodowanego = 'Skoda';
    $rejestracja_auta_potracajacego = 'DWR 5432';
    $inne_miejsce = 'bagażnik';
        
    $koniec_leczenia = '25-10-2015';
    $planowany_koniec_leczenia  = '25-10-2016';
    $chorobowe_od = '30-10-2015';
    $chorobowe_do = '25-10-2015';
        
    $imie_zmarlego = 'Anna';
    $nazwisko_zmarlego = 'Denek';
    $data_smierci = '25-10-2015';
    $wiek_zmarlego = '25';
    $zawod_zmarlego = 'księgowa';
    $zawod_wykonywany_zmarlego = 'kasjerka';
    $kwalifikacje_zmarlego = 'istnieja';
    $inna_praca_zmarlego = 'kadrowa';
    $zarobki_zmarlego = '3000';
    
    $inne_pokrewienstwo = 'córka';
    $ilosc_dzieci = '1';
    $wiek_pozostawionego = '7';
        
    $tresc_oswiadczenia = 'W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu! Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur – i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”, czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.

    Standardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku.';

    $zezwolenie_na = 'Jakaś treść';
?>	
	


  
    
	

	


	











