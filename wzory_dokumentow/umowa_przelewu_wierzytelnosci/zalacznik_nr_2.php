<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_przelewu_wierzytelnosci.css'; ?>" type="text/css" />
<?php 

	$identyfikator_przedstawiciela = 'A1234567';
	$numer_stopka = 'PG-2-1-F1/2015-04-01';
	
    $numer_umowy = '12-05-2016';
	$data_umowy = '30-10-2015';

    $cedent_3_nazwa = 'Jan Firmowy';
    $cedent_3_ulica = 'Miła';
	$cedent_3_numer_domu = '51';
	$cedent_3_numer_lokalu = '5';
	$cedent_3_kod_pocztowy = '55-300';
	$cedent_3_miejscowosc = 'Oleśnica';
    $cedent_3_pesel = '98764504696';
    $cedent_3_dowod = 'AJA654321';
    $cedent_3_nip = '913-12-12-52';
    $cedent_3_KRS = '789587126852';

    $cedent_3_US = 'Wrocław Fabryczna';
    $cedent_3_ulica_US = 'Skarbowa';
    $cedent_3_numer_domu_US = '51';
	$cedent_3_numer_lokalu_US = '5';
	$cedent_3_kod_pocztowy_US = '55-300';
	$cedent_3_miejscowosc_US = 'Oleśnica';
    $cedent_3_udzial = '50%';

    $cedent_4_nazwa = 'Jan Firmowy';
    $cedent_4_ulica = 'Miła';
	$cedent_4_numer_domu = '51';
	$cedent_4_numer_lokalu = '5';
	$cedent_4_kod_pocztowy = '55-300';
	$cedent_4_miejscowosc = 'Oleśnica';
    $cedent_4_pesel = '98764504696';
    $cedent_4_dowod = 'AJA654321';
    $cedent_4_nip = '913-12-12-52';
    $cedent_4_KRS = '789587126852';

    $cedent_4_US = 'Wrocław Fabryczna II';
    $cedent_4_ulica_US = 'Skarbowa';
    $cedent_4_numer_domu_US = '51';
	$cedent_4_numer_lokalu_US = '5';
	$cedent_4_kod_pocztowy_US = '55-300';
	$cedent_4_miejscowosc_US = 'Oleśnica';
    $cedent_4_udzial = '60%';

    $cedent_5_nazwa = 'Jan Firmowy';
    $cedent_5_ulica = 'Miła';
	$cedent_5_numer_domu = '51';
	$cedent_5_numer_lokalu = '5';
	$cedent_5_kod_pocztowy = '55-300';
	$cedent_5_miejscowosc = 'Oleśnica';
    $cedent_5_pesel = '98764504696';
    $cedent_5_dowod = 'AJA654321';
    $cedent_5_nip = '913-12-12-52';
    $cedent_5_KRS = '789587126852';

    $cedent_5_US = 'Wrocław Fabryczna II';
    $cedent_5_ulica_US = 'Skarbowa';
    $cedent_5_numer_domu_US = '51';
	$cedent_5_numer_lokalu_US = '5';
	$cedent_5_kod_pocztowy_US = '55-300';
	$cedent_5_miejscowosc_US = 'Oleśnica';
    $cedent_5_udzial = '30%';
    
?>	 
    
<div class="strona">
	<div class="identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
	<div class="logo_votum"></div>
	<div class="tytul_strony">
		<p>ZAŁĄCZNIK NR 2 DO</p>
		<p>UMOWY PRZELEWU WIERZYTELNOŚCI</p>
        <p>NR: <?php echo $numer_umowy; ?></p>
	</div>
	<div class="na_podstawie_zamowienia">
		<p>zawarta na podstawie oferty z dnia</p>
		<p><?php echo $data_umowy; ?></p>
		<p>r.</p>
	</div>
    <div class="naglowek_pozostale_dane">POZOSTAŁE DANE CEDENTA* 
    <span class="small">(*wpisać dane pozostałych współwłaścicieli/reprezentantów/wspólników spółki cywilnej bądź osobowej):</span></div>
	<div class="formularz_czerwony pozostaly_cedent">
    <div class="tytul_sekcji_formularza_czerwony">
        <div class="pola_w_tytule">REPREZENTANT 3:   /   WSPÓŁWŁAŚCICIEL:</div>
    </div>
		<div class="element">
			<p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
			<div class="cedent_nazwa"><?php echo $cedent_3_nazwa; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica margin_r_20"><?php echo $cedent_3_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom margin_r_20"><?php echo $cedent_3_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal margin_r_20"><?php echo $cedent_3_numer_lokalu; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy margin_r_20"><?php echo $cedent_3_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc"><?php echo $cedent_3_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>SERIA I NR DOWODU OSOBISTEGO / PASZPORTU</p>
			<div class="cedent_dowod margin_r_20"><?php echo $cedent_3_dowod; ?></div>
		</div>
		<div class="element">
			<p>NR PESEL</p>
			<div class="cedent_pesel margin_r_20"><?php echo $cedent_3_pesel; ?></div>
		</div>
		<div class="element">
			<p>NIP</p>
			<div class="cedent_nip margin_r_20"><?php echo $cedent_3_nip; ?></div>
		</div>
		<div class="element">
			<p>KRS/EDG</p>
			<div class="cedent_krs"><?php echo $cedent_3_KRS; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="napis_us">URZĄD SKARBOWY</div>
        <div class="element">
			<p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
			<div class="cedent_nazwa_US"><?php echo $cedent_3_US; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica_US margin_r_20"><?php echo $cedent_3_ulica_US; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom_US margin_r_20"><?php echo $cedent_3_numer_domu_US; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal_US margin_r_20"><?php echo $cedent_3_numer_lokalu_US; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy_US margin_r_20"><?php echo $cedent_3_kod_pocztowy_US; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc_US"><?php echo $cedent_3_miejscowosc_US; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
				<p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI</p>
				<div class="cedent_udzial margin_r_20"><?php echo $cedent_3_udzial; ?></div>
        </div>		
        <div class="clear_b"></div>
        <div class="tytul_sekcji_formularza_czerwony margin_t_12">
        <div class="pola_w_tytule">REPREZENTANT 4:   /   WSPÓŁWŁAŚCICIEL:</div>
        </div> 
        <div class="element">
			<p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
			<div class="cedent_nazwa"><?php echo $cedent_4_nazwa; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica margin_r_20"><?php echo $cedent_4_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom margin_r_20"><?php echo $cedent_4_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal margin_r_20"><?php echo $cedent_4_numer_lokalu; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy margin_r_20"><?php echo $cedent_4_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc"><?php echo $cedent_4_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>SERIA I NR DOWODU OSOBISTEGO / PASZPORTU</p>
			<div class="cedent_dowod margin_r_20"><?php echo $cedent_4_dowod; ?></div>
		</div>
		<div class="element">
			<p>NR PESEL</p>
			<div class="cedent_pesel margin_r_20"><?php echo $cedent_4_pesel; ?></div>
		</div>
		<div class="element">
			<p>NIP</p>
			<div class="cedent_nip margin_r_20"><?php echo $cedent_4_nip; ?></div>
		</div>
		<div class="element">
			<p>KRS/EDG</p>
			<div class="cedent_krs"><?php echo $cedent_4_KRS; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="napis_us">URZĄD SKARBOWY</div>
        <div class="element">
			<p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
			<div class="cedent_nazwa_US"><?php echo $cedent_4_US; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica_US margin_r_20"><?php echo $cedent_4_ulica_US; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom_US margin_r_20"><?php echo $cedent_4_numer_domu_US; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal_US margin_r_20"><?php echo $cedent_4_numer_lokalu_US; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy_US margin_r_20"><?php echo $cedent_4_kod_pocztowy_US; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc_US"><?php echo $cedent_4_miejscowosc_US; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
				<p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI</p>
				<div class="cedent_udzial margin_r_20"><?php echo $cedent_4_udzial; ?></div>
        </div>	
        <div class="clear_b"></div>
        <div class="tytul_sekcji_formularza_czerwony margin_t_12">
        <div class="pola_w_tytule">REPREZENTANT 5:   /   WSPÓŁWŁAŚCICIEL:</div>
        </div> 
        <div class="element">
			<p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
			<div class="cedent_nazwa"><?php echo $cedent_5_nazwa; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica margin_r_20"><?php echo $cedent_5_ulica; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom margin_r_20"><?php echo $cedent_5_numer_domu; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal margin_r_20"><?php echo $cedent_5_numer_lokalu; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy margin_r_20"><?php echo $cedent_5_kod_pocztowy; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc"><?php echo $cedent_5_miejscowosc; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
			<p>SERIA I NR DOWODU OSOBISTEGO / PASZPORTU</p>
			<div class="cedent_dowod margin_r_20"><?php echo $cedent_5_dowod; ?></div>
		</div>
		<div class="element">
			<p>NR PESEL</p>
			<div class="cedent_pesel margin_r_20"><?php echo $cedent_5_pesel; ?></div>
		</div>
		<div class="element">
			<p>NIP</p>
			<div class="cedent_nip margin_r_20"><?php echo $cedent_5_nip; ?></div>
		</div>
		<div class="element">
			<p>KRS/EDG</p>
			<div class="cedent_krs"><?php echo $cedent_5_KRS; ?></div>
		</div>
		<div class="clear_b"></div>
        </div>

    
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona">
	<div class="logo_votum"></div>

    <div class="formularz_czerwony margin_top_70">
        <div class="napis_us">URZĄD SKARBOWY</div>
        <div class="element">
			<p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
			<div class="cedent_nazwa_US"><?php echo $cedent_5_US; ?></div>
		</div>
        <div class="clear_b"></div>
		<div class="element">
			<p>ULICA</p>
			<div class="cedent_ulica_US margin_r_20"><?php echo $cedent_5_ulica_US; ?></div>
		</div>
		<div class="element">
			<p>NR DOMU</p>
			<div class="cedent_dom_US margin_r_20"><?php echo $cedent_5_numer_domu_US; ?></div>
		</div>
		<div class="element">
			<p>NR LOKALU</p>
			<div class="cedent_lokal_US margin_r_20"><?php echo $cedent_5_numer_lokalu_US; ?></div>
		</div>
		<div class="element">
			<p>KOD POCZTOWY</p>
			<div class="cedent_kod_pocztowy_US margin_r_20"><?php echo $cedent_5_kod_pocztowy_US; ?></div>
		</div>
		<div class="element">
			<p>MIEJSCOWOŚĆ</p>
			<div class="cedent_miejscowosc_US"><?php echo $cedent_5_miejscowosc_US; ?></div>
		</div>
		<div class="clear_b"></div>
        <div class="element">
				<p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI</p>
				<div class="cedent_udzial margin_r_20"><?php echo $cedent_5_udzial; ?></div>
        </div>		
        <div class="clear_b"></div>
    </div>
    
    <div class="sekcja_tresc margin_top_70">
			<div class="podpis_lewo small_font">VOTUM S.A.</div>
			<div class="podpis_prawo small_font">CEDENT (OSOBY DOKONUJĄCE CESJI)</div>
			<div class="clear_b"></div>		
		</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
