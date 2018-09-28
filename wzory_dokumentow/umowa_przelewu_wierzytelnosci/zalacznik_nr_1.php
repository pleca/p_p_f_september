<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/umowa_przelewu_wierzytelnosci.css'; ?>" type="text/css" />
<?php 

	$identyfikator_przedstawiciela = 'A1234567';
    $kod_jednostki = '1234567';
    $kod_konsultanta = '7654321';
    $przedstawiciel = 'ADAM SKAŁA';

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


    $cedent_reprezentant_nazwa = 'Jan Firmowy';
    $cedent_reprezentant_ulica = 'Miła';
	$cedent_reprezentant_numer_domu = '51';
	$cedent_reprezentant_numer_lokalu = '5';
	$cedent_reprezentant_kod_pocztowy = '55-300';
	$cedent_reprezentant_miejscowosc = 'Oleśnica';

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

    $cesjonariusz = 'Kazimierz Maj';
    
    $kwota_wierzytelnosci = '3000';
    $kwota_wierzytelnosci_slownie = 'trzy tysiące';
    $kwota_zaliczki = '500';
    $kwota_zaliczki_slownie = 'pięćset';
    $kwota_do_zaplaty = '300';
    $kwota_do_zaplaty_slownie = 'trzysta';

    $numer_rachunku = '12 1111 1223 1222 1211 2222 1221';
    $posiadacz_rachunku = 'Marek Janowski';

    
?>	 
    
<div class="strona">
	<div class="identyfikator_przedstawiciela"><?php echo $identyfikator_przedstawiciela; ?></div>
    <div class="kod_jednostki"><?php echo $kod_jednostki; ?></div>
    <div class="kod_konsultanta"><?php echo $kod_konsultanta; ?></div>
	<div class="logo_votum"></div>
	<div class="tytul_strony">
		<p>ZAŁĄCZNIK NR 1 DO</p>
		<p>UMOWY PRZELEWU WIERZYTELNOŚCI</p>
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
    </div> 
    
    <div class="naglowek_sekcji">a</div>
    
    <div class="formularz_szary cesjonariusz">
		<p>	
            VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, CENTRUM LIKWIDACJI SZKÓD MAJĄTKOWYCH w Wałbrzychu, ul. Dmowskiego 22/12, 58-300 Wałbrzych, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem <span class="czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości</span>, którą reprezentuje:
		</p>    
			<div class="cesjonariusz_nazwa"><?php echo $cesjonariusz; ?></div>		
	</div>
    
        <div class="sekcja margin_top_60">
		<div class="sekcja_paragraf">§ 1</div>
		<div class="sekcja_tresc">
        1. Cenę wierzytelności, przewidzianą w § 2 ust 1. umowy, ustala się na kwotę <?php echo $kwota_wierzytelnosci; ?> zł (słownie: <?php echo $kwota_wierzytelnosci_slownie; ?> złotych, w tym kwotę <?php echo $kwota_zaliczki; ?> zł (słownie: <?php echo $kwota_zaliczki_slownie; ?> złotych zaliczki na podatek dochodowy w obowiązującej wysokości 18%, co daje do zapłaty kwotę <?php echo $kwota_do_zaplaty; ?> zł (sołwnie: <?php echo $kwota_do_zaplaty_slownie; ?> złotych). <br/> 
        2. Cesjonariusz wyliczy i odprowadzi do właściwego Urzędu Skarbowego zaliczkę na podatek dochodowy, o której mowa w ust. 1 i prześle Cedentowi stosowny PIT w terminie do ostatniego dnia lutego roku następującego po roku zawarcia umowy.<br/>
        3. Cena wskazana w ust. 1 zostanie zapłacona:<br/> 

       
        <div class="element margin_t_12"><span class="kratka">X</span> na rachunek bankowy nr </div>
        <div class="element"><div class="numer_rachunku margin_l_10"><?php echo $numer_rachunku; ?></div></div>
        <div class="clear_b"></div>     
        <div class="element margin_t_12"> Należący do </div>
        <div class="element"><div class="posiadacz_rachunku margin_l_10"><?php echo $posiadacz_rachunku; ?></div></div>
        <div class="clear_b"></div> 
        <div class="element margin_t_3"><span class="kratka">X</span> przekazem pocztowym na rzecz: </div>
        <div class="element"><div class="adresat_przekazu margin_l_10"><?php echo $posiadacz_rachunku; ?></div></div>
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
	   </div>
    
    </div>
    
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona">
	<div class="logo_votum"></div>

    <div class="sekcja margin_top_60">
        4. Załącznik stanowi integralną część umowy.
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">VOTUM S.A.</div>
			<div class="podpis_prawo small_font">CEDENT (OSOBY DOKONUJĄCE CESJI)</div>
			<div class="clear_b"></div>		
		</div>
	    </div>
        
        <div class="sekcja_tresc margin_t_40">
        <p><span class="pogrubienie">Oświadczenie*</span> (*Wypełnić, jeżeli dokumenty zostały podpisane w obecności Przedstawiciela)</p></div>
        <div class="sekcja_tresc margin_t_12">
            <p>Ja niżej podpisany, jako pełnomocnik Cesjonariusza - VOTUM S.A., oświadczam, iż podpisy Cedenta - osób dokonujących cesji na wszystkich dokumentach, w tym na umowie, załącznikach do umowy, powiadomieniu dłużnika o przelewie wierzytelności, pełnomocnictwie, zostały złożone w mojej obecności własnoręcznie przez Cedenta - osoby dokonujące cesji.</p>
        </div>
    
        <div class="sekcja">
		<div class="sekcja_tresc">
            <div class="element">
			<?php echo $przedstawiciel; ?>
            <p>IMIĘ I NAZWISKO PRZEDSTAWICIELA</p>
            </div>
            <div class="podpis_prawo small_font">
                CZYTELNY PODPIS PRZEDSTAWICIELA</div>
			<div class="clear_b"></div>			
		</div>
	</div>
    

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/2</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
