<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<?php 

	$identyfikator_przedstawiciela = $_POST['identyfikator_przedstawiciela'];
	
	$numer_stopka = 'PG-2-1-F1/2015-04-01'; 
	
	$imie_nazwisko = 'Łukasz Krzemień';
	$data_urodzin = '30-10-2015';
	$adres_zamieszkania = 'ul. Wrocławska 31/3, 56-416 Twardogóra';
	$pesel = '91503045588';
	$data_wypadku = '30-10-2015';
	$marka_pojazdu = 'Marka';
	$nr_rejestracyjny = 'DW 66666';
	$poj_silnika = '666';
	
	$placowki = array(
			0 => array(
					'data' => '30-10-1991',
					'start' => 'Olesnica',
					'cel' => 'Wrocław',
					'placowka_medyczna' => 'Jakis tam szpital Jakis tam szpital Jakis tam szpital',
					'droga' => '30'
				),
			1 => array(
					'data' => '30-10-1991',
					'start' => 'Olesnica',
					'cel' => 'Wrocław',
					'placowka_medyczna' => 'Jakis tam szpital Jakis tam szpital Jakis tam szpital',
					'droga' => '30'
			),
			2 => array(
					'data' => '30-10-1991',
					'start' => 'Olesnica',
					'cel' => 'Wrocław',
					'placowka_medyczna' => 'Jakis tam szpital Jakis tam szpital Jakis tam szpital',
					'droga' => '30'
			),
			3 => array(
					'data' => '30-10-1991',
					'start' => 'Olesnica',
					'cel' => 'Wrocław',
					'placowka_medyczna' => 'Jakis tam szpital Jakis tam szpital Jakis tam szpital',
					'droga' => '30'
			)
	);
	
?>

<div class="strona">
	<div class="logo_votum"></div>
	<br/>
	<div class="tytul_strony">	
		<p>OŚWIADCZENIE O DOJAZDACH DO PLACÓWEK MEDYCZNYCH</p>		
	</div>
	
	<div class="oswiadczenie_tresc">
		<p>Ja niżej podpisany <span class="pogrubienie"><?php echo $imie_nazwisko ?></span>, 
		ur. dnia <span class="pogrubienie"><?php echo $data_urodzin; ?></span>, 
		zamieszkały <span class="pogrubienie"><?php echo $adres_zamieszkania; ?></span>,
		PESEL <span class="pogrubienie"><?php echo $pesel; ?></span>,
		oświadczam, że w związku z leczeniem po wypadku, który miał miejsce dnia <span class="pogrubienie"><?php echo $data_wypadku; ?></span>,
		do poniżej wymienionych placówek medycznych dojeżdżałem pojazdem marki <span class="pogrubienie"><?php echo $marka_pojazdu; ?></span>,
		o numerze rejestracyjnym <span class="pogrubienie"><?php echo $nr_rejestracyjny; ?></span>,
		poj. silnika <span class="pogrubienie"><?php echo $poj_silnika; ?></span> cm3.
		</p>
	</div>	

	<div class="tabelka">
			<div class="naglowek_tabeli wiersz_tabeli">
				<p class="wiersz_tabeli_lp">Lp.</p>
				<p class="wiersz_tabeli_data">Data</p>
				<p class="wiersz_tabeli_start">Miejscowość wyjazdu</p>
				<p class="wiersz_tabeli_cel">Miejscowość docelowa</p>
				<p class="wiersz_tabeli_rodzaj_placowki">Rodzaj placówki medycznej oraz cel wizyty</p>
				<p class="wiersz_tabeli_odleglosci_obie">Odległość w km w obie strony</p>
			<div class="clear_b"></div>
			</div>
			
			<?php 
				$ile_elementow = count($placowki);
				$suma_km = 0;
				for($i=0;$i<$ile_elementow;$i++){
					echo '<div class="wiersz_tabeli wiersz_tabeli_dane">';					
						echo '<p class="wiersz_tabeli_lp">'.($i+1).'</p>';
						echo '<p class="wiersz_tabeli_data">'.$placowki[$i]['data'].'</p>';
						echo '<p class="wiersz_tabeli_start">'.$placowki[$i]['start'].'</p>';
						echo '<p class="wiersz_tabeli_cel">'.$placowki[$i]['cel'].'</p>';
						echo '<p class="wiersz_tabeli_rodzaj_placowki">'.$placowki[$i]['placowka_medyczna'].'</p>';
						echo '<p class="wiersz_tabeli_odleglosci_obie">'.$placowki[$i]['droga'].'</p>';
					echo '<div class="clear_b"></div></div>';
					
					$suma_km = $suma_km + $placowki[$i]['droga'];
					
				}
			
			?>
			
	</div>
		<div class="stopka_tabeli">
				<p class="stopka_suma_km"><?php echo $suma_km; ?></p>
		</div>
		<div class="clear_b"></div>
	
		<div class="zalaczniki">
			<p>W załączniku kserokopie:</p>
			<div class="zalaczniki_opcje">
				<span class="kratka_pelna">x</span><p> dowodu rejestracyjnego, </p>
				<span class="kratka"></span><p> faktur, </p>
				<span class="kratka"></span><p> paragonów, </p>
				
				<span class="kratka"></span><p> biletów, </p>
				<div class="clear_b"></div>
				<span class="kratka"></span><p> prawa jazdy osoby dowożącej, </p>
				<span class="kratka"></span><p> oświadczenie osoby dowożącej. </p>
			</div>
			<div class="clear_b"></div>
		</div>
	
		<div class="sekcja oswiadczenie_podpisy">
			<div class="sekcja_tresc">
			<div class="clear_b"></div>	
				<div class="podpis_lewo pogrubienie"><p>MIEJSCOWOŚĆ I DATA</p></div>
				<div class="podpis_prawo pogrubienie"><p>PODPIS ZLECENIODAWCY</p></div>
				<div class="clear_b"></div>		
			</div>
		</div>
	
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/1</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>