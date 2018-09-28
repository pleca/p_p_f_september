<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_przelewu_wierzytelnosci.css'; ?>" type="text/css" />
<?php 

	$identyfikator_przedstawiciela = 'A1234567';

	$numer_stopka = 'PG-2-1-F1/2015-04-01';
	
    $numer_umowy = '12-05-2016';
	$data_umowy = '30-10-2015';

    $cedent_nazwa = 'Jan Firmowy';
    $cedent_ulica = 'Miła';
	$cedent_numer_domu = '51';
	$cedent_numer_lokalu = '5';
	$cedent_kod_pocztowy = '55-300';
	$cedent_miejscowosc = 'Oleśnica';
    $cedent_pesel = '98764504696';
    $cedent_dowod = 'AJA654321';
    $cedent_nip = '913-12-12-52';
    $cedent_KRS = '789587126852';
    $cedent_data_urodzenia = '05-05-2001';
    $cedent_telefon = '321456765';
    $cedent_email = 'test@votum-sa.pl';

    $cedent_US = 'Wrocław Fabryczna';
    $cedent_ulica_US = 'Skarbowa';
    $cedent_numer_domu_US = '51';
	$cedent_numer_lokalu_US = '5';
	$cedent_kod_pocztowy_US = '55-300';
	$cedent_miejscowosc_US = 'Oleśnica';
    $cedent_udzial = '50%';

    $cedent_reprezentant_nazwa = 'Jan Firmowy';
    $cedent_reprezentant_ulica = 'Miła';
	$cedent_reprezentant_numer_domu = '51';
	$cedent_reprezentant_numer_lokalu = '5';
	$cedent_reprezentant_kod_pocztowy = '55-300';
	$cedent_reprezentant_miejscowosc = 'Oleśnica';
    $cedent_reprezentant_dowod = 'AJA654321';
    $cedent_reprezentant_data_urodzenia = '05-05-2001';

    $cedent_reprezentant_US = 'Wrocław Fabryczna';
    $cedent_reprezentant_ulica_US = 'Skarbowa';
    $cedent_reprezentant_numer_domu_US = '51';
	$cedent_reprezentant_numer_lokalu_US = '5';
	$cedent_reprezentant_kod_pocztowy_US = '55-300';
	$cedent_reprezentant_miejscowosc_US = 'Oleśnica';
    $cedent_reprezentant_udzial = '50%';

    $cedent_wspolwlasciciel_nazwa = 'Jan Firmowy';
    $cedent_wspolwlasciciel_ulica = 'Miła';
	$cedent_wspolwlasciciel_numer_domu = '51';
	$cedent_wspolwlasciciel_numer_lokalu = '5';
	$cedent_wspolwlasciciel_kod_pocztowy = '55-300';
	$cedent_wspolwlasciciel_miejscowosc = 'Oleśnica';
    $cedent_wspolwlasciciel_dowod = 'AJA654321';
    $cedent_wspolwlasciciel_nip = '913-12-12-52';
    $cedent_wspolwlasciciel_KRS = '789587126852';
    $cedent_wspolwlasciciel_pesel = '7895876852';
    $cedent_wspolwlasciciel_data_urodzenia = '05-05-2001';
    $cedent_wspolwlasciciel_telefon = '702589674';
    $cedent_wspolwlasciciel_email = 'test@votum-co.pl';

    $cedent_wspolwlasciciel_US = 'Wrocław Fabryczna';
    $cedent_wspolwlasciciel_ulica_US = 'Skarbowa';
    $cedent_wspolwlasciciel_numer_domu_US = '51';
	$cedent_wspolwlasciciel_numer_lokalu_US = '5';
	$cedent_wspolwlasciciel_kod_pocztowy_US = '55-300';
	$cedent_wspolwlasciciel_miejscowosc_US = 'Oleśnica';
    $cedent_wspolwlasciciel_udzial = '50%';

    $cesjonariusz = 'Kazimierz Maj';

    $wierzyciel = 'Jan Nowak';
    $tytul_ubezpieczenia = 'ubezpieczenia odpowiedzialności cywilnej posiadaczy pojazdów mechanicznych';
    $data_szkody = '01-02-2014';
    $akta_szkody = '12/1265/2015';
    $marka_pojazdu = 'Skoda';
    $nr_rejestracyjny = 'DWR1234';
    $kwota_odszkodowania = '1500';
    $kwota_slownie = 'tysiąć pięćset';
    
?>	 
    
<div class="strona">
	<div class="identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="logo_votum"></div>
	<div class="tytul_strony">
		<p>UMOWA</p>
		<p>PRZELEWU WIERZYTELNOŚCI</p>
        <p>NR: <?php echo $numer_umowy; ?></p>
	</div>
	<div class="na_podstawie_zamowienia">
		<p>zawarta na podstawie oferty z dnia</p>
		<p><?php echo $data_umowy; ?></p>
		<p>r. pomiędzy:</p>
	</div>
	<div class="formularz_czerwony cedent">
    <div class="tytul_sekcji_formularza_czerwony">
        <div class="pola_w_tytule">WŁAŚCICIEL:   /   WSPÓŁWŁAŚCICIEL:</div>
    </div>
		<div class="element">
			<p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
			<div class="cedent_nazwa"><?php echo $cedent_nazwa; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica margin_r_20"><?php echo $cedent_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom margin_r_20"><?php echo $cedent_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal margin_r_20"><?php echo $cedent_numer_lokalu; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy margin_r_20"><?php echo $cedent_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc"><?php echo $cedent_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>SERIA I NR DOWODU OSOBISTEGO / PASZPORTU</p>
			<div class="cedent_dowod margin_r_20"><?php echo $cedent_dowod; ?></div>
		</div>
		<div class="element">
			<p>NR PESEL</p>
			<div class="cedent_pesel margin_r_20"><?php echo $cedent_pesel; ?></div>
		</div>
		<div class="element">
			<p>NIP</p>
			<div class="cedent_nip margin_r_20"><?php echo $cedent_nip; ?></div>
		</div>
		<div class="element">
			<p>KRS/EDG</p>
			<div class="cedent_krs"><?php echo $cedent_KRS; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>DATA URODZENIA</p>
			<div class="cedent_data_urodzenia margin_r_20"><?php echo $cedent_data_urodzenia; ?></div>
		</div>
		<div class="element">
			<p>TELEFON KONTAKTOWY</p>
			<div class="cedent_telefon margin_r_20"><?php echo $cedent_telefon; ?></div>
		</div>
		<div class="element">
			<p>E-MAIL</p>
			<div class="cedent_email"><?php echo $cedent_email; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="napis_us">URZĄD SKARBOWY</div>
        <div class="element">
			<p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
			<div class="cedent_nazwa_US"><?php echo $cedent_US; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica_US margin_r_20"><?php echo $cedent_ulica_US; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom_US margin_r_20"><?php echo $cedent_numer_domu_US; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal_US margin_r_20"><?php echo $cedent_numer_lokalu_US; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy_US margin_r_20"><?php echo $cedent_kod_pocztowy_US; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc_US"><?php echo $cedent_miejscowosc_US; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
				<p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI</p>
				<div class="cedent_udzial margin_r_20"><?php echo $cedent_udzial; ?></div>
        </div>		
        <div class="clear_b"></div>
        <div class="napis_reprezentowany">reprezentowany przez</div>
        <div class="clear_b"></div>
        </div>
        <div class="formularz_szary">
    <div class="tytul_sekcji_formularza_szary">
        <div class="pola_w_tytule">REPREZENTANT 1:</div></div>
        		<div class="element">
			<p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
			<div class="cedent_nazwa"><?php echo $cedent_reprezentant_nazwa; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica margin_r_20"><?php echo $cedent_reprezentant_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom margin_r_20"><?php echo $cedent_reprezentant_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal margin_r_20"><?php echo $cedent_reprezentant_numer_lokalu; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy margin_r_20"><?php echo $cedent_reprezentant_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc"><?php echo $cedent_reprezentant_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>SERIA I NR DOWODU OSOBISTEGO / PASZPORTU</p>
			<div class="cedent_dowod margin_r_20"><?php echo $cedent_reprezentant_dowod; ?></div>
		</div>
		<div class="element">
			<p>DATA URODZENIA</p>
			<div class="cedent_data_urodzenia margin_r_20"><?php echo $cedent_reprezentant_data_urodzenia; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="napis_us">URZĄD SKARBOWY</div>
        <div class="element">
			<p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
			<div class="cedent_nazwa_US"><?php echo $cedent_reprezentant_US; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica_US margin_r_20"><?php echo $cedent_reprezentant_ulica_US; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom_US margin_r_20"><?php echo $cedent_reprezentant_numer_domu_US; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal_US margin_r_20"><?php echo $cedent_reprezentant_numer_lokalu_US; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy_US margin_r_20"><?php echo $cedent_reprezentant_kod_pocztowy_US; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc_US"><?php echo $cedent_reprezentant_miejscowosc_US; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
				<p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI</p>
				<div class="cedent_udzial margin_r_20"><?php echo $cedent_reprezentant_udzial; ?></div>
        </div>		
        <div class="clear_b"></div>           
</div>
    
    <div class="formularz_szary">
        <div class="tytul_sekcji_formularza_szary">
            <div class="pola_w_tytule">REPREZENTANT 2:   /   WSPÓŁWŁAŚCICIEL:</div></div> 
        <div class="element">
			<p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
			<div class="cedent_nazwa"><?php echo $cedent_wspolwlasciciel_nazwa; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica margin_r_20"><?php echo $cedent_wspolwlasciciel_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom margin_r_20"><?php echo $cedent_wspolwlasciciel_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal margin_r_20"><?php echo $cedent_wspolwlasciciel_numer_lokalu; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy margin_r_20"><?php echo $cedent_wspolwlasciciel_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc"><?php echo $cedent_wspolwlasciciel_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>SERIA I NR DOWODU OSOBISTEGO / PASZPORTU</p>
			<div class="cedent_dowod margin_r_20"><?php echo $cedent_wspolwlasciciel_dowod; ?></div>
		</div>
		<div class="element">
			<p>NR PESEL</p>
			<div class="cedent_pesel margin_r_20"><?php echo $cedent_wspolwlasciciel_pesel; ?></div>
		</div>
		<div class="element">
			<p>NIP</p>
			<div class="cedent_nip margin_r_20"><?php echo $cedent_wspolwlasciciel_nip; ?></div>
		</div>
		<div class="element">
			<p>KRS/EDG</p>
			<div class="cedent_krs"><?php echo $cedent_wspolwlasciciel_KRS; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>DATA URODZENIA</p>
			<div class="cedent_data_urodzenia margin_r_20"><?php echo $cedent_wspolwlasciciel_data_urodzenia; ?></div>
		</div>
		<div class="element">
			<p>TELEFON KONTAKTOWY</p>
			<div class="cedent_telefon margin_r_20"><?php echo $cedent_wspolwlasciciel_telefon; ?></div>
		</div>
		<div class="element">
			<p>E-MAIL</p>
			<div class="cedent_email"><?php echo $cedent_wspolwlasciciel_email; ?></div>
		</div>
		<div class="clear_b"></div>
        
    </div> 

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/3</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>


<div class="strona">
	<div class="logo_votum"></div>
	<div class="formularz_szary margin_top_70">
        <div class="napis_us">URZĄD SKARBOWY</div><div class="napis_przypis"></div>
        <div class="element">
			<p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
			<div class="cedent_nazwa_US"><?php echo $cedent_wspolwlasciciel_US; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica_US margin_r_20"><?php echo $cedent_wspolwlasciciel_ulica_US; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom_US margin_r_20"><?php echo $cedent_wspolwlasciciel_numer_domu_US; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal_US margin_r_20"><?php echo $cedent_wspolwlasciciel_numer_lokalu_US; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy_US margin_r_20"><?php echo $cedent_wspolwlasciciel_kod_pocztowy_US; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc_US"><?php echo $cedent_wspolwlasciciel_miejscowosc_US; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
				<p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI/ W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</p>
				<div class="cedent_udzial margin_r_20"><?php echo $cedent_wspolwlasciciel_udzial; ?></div>
        </div>		
        <div class="clear_b"></div>

    </div>
    
    <div class="naglowek_sekcji">a</div>
    
    <div class="formularz_szary cesjonariusz">
		<p>	
            VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, CENTRUM LIKWIDACJI SZKÓD MAJĄTKOWYCH w Wałbrzychu, ul. Dmowskiego 22/12, 58-300 Wałbrzych, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem <span class="czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>, którą reprezentuje:
		</p>    
			<div class="cesjonariusz_nazwa"><?php echo $cesjonariusz; ?></div>		
	</div>
    
    <p>Strony zgodnie ustalają, co następuję:</p>
    
    <div class="sekcja">
		<div class="sekcja_tytul">PRZEDMIOT UMOWY</div>
		<div class="sekcja_paragraf">§ 1</div>
		<div class="sekcja_tresc">
        Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności, jakie przysługują Cedentowi z tytułu <?php echo $tytul_ubezpieczenia; ?> od <?php echo $wierzyciel; ?> zwanego dalej Dłużnikiem w związku ze szkodą komunikacyjną z dnia <?php echo $data_szkody; ?> r. (nr akt szkodowych: <?php echo $akta_szkody; ?> ), w wyniku której uszkodzeniu uległ pojazd marki <?php echo $marka_pojazdu; ?>, o nr. rej. <?php echo $nr_rejestracyjny; ?>
	   </div>
    
    </div>
    
    <div class="sekcja">
		<div class="sekcja_tytul">WYNAGRODZENIE</div>
		<div class="sekcja_paragraf">§ 2</div>
		<div class="sekcja_tresc">
            1. Cesjonariusz nabywa od Cedenta wszelkie wierzytelności, o których mowa w § 1 za kwotę określoną w załączniku nr 1 do niniejszej umowy.<br/>
            2. Informacja, o której mowa w ust. 1 stanowi tajemnicę handlową i nie podlega ujawnieniu bez zgody Cesjonariusza.<br/>
            3. Cesjonariusz zobowiązuje się do zapłaty kwoty określonej w załączniku nr 1 do niniejszej umowy w terminie 7 dni roboczych od daty podpisania umowy przez Cesjonariusza na rachunek bankowy wskazany przez Cedenta lub w inny sposób określony w załączniku nr 1 do niniejszej umowy.<br/>
	</div>
    
    </div>
    
        <div class="sekcja">
		<div class="sekcja_tytul">OŚWIADCZENIA STRON</div>
		<div class="sekcja_paragraf">§ 3</div>
		<div class="sekcja_tresc">
            1. Cedent oświadcza, że łączna suma odszkodowania, jaką otrzymał w związku ze szkodą, o której mowa w § 1 wyniosła do dnia zawarcia umowy <?php echo $kwota_odszkodowania ?> brutto (słownie : <?php echo $kwota_slownie ?> złotych).<br/>
            2. Cedent oświadcza, że szkoda, o której mowa w § 1 miała miejsce w okolicznościach, o których zawiadomił ubezpieczyciela i nie toczyło się w związku z jej powstaniem postępowanie karne dotyczące doprowadzenia innej osoby do niekorzystnego rozporządzenia własnym lub cudzym mieniem za pomocą wprowadzenia jej w błąd (art. 286 kodeksu karnego) lub spowodowania zdarzenia będącego podstawą do wypłaty odszkodowania w celu uzyskania takiego odszkodowania z tytułu umowy ubezpieczenia (art. 298 kodeksu karnego).<br/>
            3. Cedent oświadcza, że koszty naprawy pojazdu wynikające ze szkody, o której mowa w § 1 nie zostały pokryte na podstawie przedstawienia Dłużnikowi rachunku, faktury VAT lub innego dokumentu potwierdzającego wysokość kosztów naprawy. Koszty, o których mowa w zdaniu pierwszym nie dotyczą holowania, najmu pojazdu zastępczego, parkowania, ani przedmiotów przewożonych w pojeździe, o którym mowa w § 1.<br/>
            4. Cedent oświadcza, że nie zrzekł się roszczeń przysługujących mu względem Dłużnika w związku ze szkodą, o której mowa w § 1, w tym w szczególności na podstawie ugody lub innego porozumienia.<br/>
            5. Cedent oświadcza, że wierzytelność, o której mowa w mowa w § 1 została zaspokojona wyłącznie w kwocie określonej w kosztorysie lub oświadczeniu ubezpieczyciela, które przekazał Cesjonariuszowi.<br/>
            6. Cedent oświadcza, że wszelkie wierzytelności określone w § 1, są wolne od obciążeń, oraz że uprawnienie do ich zbycia na rzecz osób trzecich nie zostało wyłączone.<br/>
            7. Cedent oświadcza, że pojazd, o którym mowa w § 1 umowy, w dacie powstania szkody nie był przedmiotem współwłasności z osobą trzecią.<br/>
            8. Cedent oświadcza, że ujawnił Cesjonariuszowi wszelkie nienaprawione uszkodzenia, jakie pojazd posiadał przed powstaniem szkody komunikacyjnej, o której mowa § 1. Ponadto Cedent oświadcza, że pojazd ten bezpośrednio przed powstaniem szkody był dopuszczony do ruchu po drogach publicznych, o ile nie złożył Cesjonariuszowi przed zawarciem umowy odmiennego oświadczenia w formie pisemnej albo nie przedłożył dokumentów stwierdzających okoliczności przeciwne.<br/>
            9. Cedent oświadcza, że Dłużnik, o którym mowa w § 1, w dacie zawarcia umowy nie ma względem niego żadnej wymagalnej Wierzytelności podlegającej potrąceniu z wierzytelnościami, o których mowa w § 1.<br/>
            10. Cedent zobowiązuje się do sporządzenia pisemnego zawiadomienia dłużnika o przeniesieniu wierzytelności i złożenia go na ręce Cesjonariusza w celu przedłożenia Dłużnikowi. Cedent zobowiązuje się do tego, że nie cofnie złożonego oświadczenia.

	</div>
    
    </div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/3</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona">
	<div class="logo_votum"></div>
        <div class="sekcja margin_top_70">
		<div class="sekcja_tresc">
            11. W przypadku uzyskania przez Cedenta od Dłużnika świadczenia tytułem spłaty wierzytelności, określonej w § 1, po podpisaniu przez Cedenta niniejszej umowy, Cedent zobowiązuje się do przekazania całości świadczenia na rachunek bankowy Cesjonariusza PKO Bank Polski SA O/ Wałbrzych 72 1020 5095 0000 5502 0182 9100 oraz powiadomić o tym Cesjonariusza na piśmie w terminie 7 dni roboczych od daty uzyskania świadczenia.
	</div>
    
    </div>
    
    <div class="sekcja">
		<div class="sekcja_tytul">DOKUMENTACJA DLA CESJONARIUSZA</div>
		<div class="sekcja_paragraf">§ 4</div>
		<div class="sekcja_tresc">
            1. Cedent w celu dochodzenia wierzytelności od Dłużnika przekazuje Cesjonariuszowi następujące dokumenty:<br/>
            a) kopię wypełnionych stron karty pojazdu, o którym mowa w § 1, jeżeli została ona wydana;<br/>
            b) kopię dowodu rejestracyjnego pojazdu, o którym mowa w § 1;<br/>
            c) kopię umowy sprzedaży pojazdu, o którym mowa w § 1, jeżeli został on zbyty po powstaniu szkody, o której mowa w § 1;<br/>
            d) kopie dowodów osobistych wszystkich współwłaścicieli pojazdu, a jeżeli właścicielem pojazdu jest przedsiębiorca, również dokumenty rejestrowe przedsiębiorcy będącego właścicielem pojazdu (wypis z EDG/ KRS);<br/>
            e) kosztorys wyceny szkody zawierający szczegółowy wykaz części podlegających wymianie lub naprawie, procedury naprawcze i czas ich wykonania oraz przyjęte ceny wyżej wymienionych, dla szkody, o której mowa w § 1 niniejszej umowy wykonany na zlecenie lub przez Dłużnika o którym mowa w § 1;<br/>
            f) wszelkie oświadczenia Dłużnika o przyznaniu odszkodowania z tytułu szkody o której mowa w § 1 lub potwierdzenie wpływu odszkodowania na rachunek bankowy Cedenta bądź pokwitowanie jego odbioru;<br/>
            g) w przypadku gdy wierzytelności przysługują Cedentowi z tytułu ubezpieczenia AUTO-CASCO – kopię polisy oraz ogólnych warunków umowy ubezpieczenia aktualnych na dzień zawarcia umowy.<br/>
            2. Cesjonariusz zobowiązuje się do wykorzystania przekazanych dokumentów wyłącznie w celu realizacji umowy.
	</div></div>
    
    <div class="sekcja">    
        <div class="sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
		<div class="sekcja_paragraf">§ 5</div>
		<div class="sekcja_tresc">
            1. Wszelkie zmiany niniejszej umowy wymagają formy pisemnej pod rygorem nieważności.<br/>
            2. Niniejsza umowa wraz z załącznikiem nr 1 została sporządzona w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze Stron.
	</div>
    </div>

        <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">VOTUM S.A.</div>
			<div class="podpis_prawo small_font">CEDENT (OSOBY DOKONUJĄCE CESJI)</div>
			<div class="clear_b"></div>		
		</div>
	    </div>
    
    <div class='objasnienia'>
        Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz.U. z 2014 r., poz. 1182 ze zm.) VOTUM informuje, że:<br/>
        1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław,<br/>
        2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom, od których będą uzyskiwane informacje niezbędne do wykonania umowy i podmiotom, od których będą dochodzone roszczenia,<br/>
        3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,<br/>
        4. podanie VOTUM danych osobowych jest dobrowolne.<br/>
        Wyrażam zgodę na przetwarzanie danych osobowych w celu wykonania umowy.
    </div>
    
    <div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo small_font">CEDENT (OSOBY DOKONUJĄCE CESJI)</div>
			<div class="clear_b"></div>		
		</div>
	    </div>
    
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">3/3</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>