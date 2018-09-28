<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<?php 

	$dokument_id = $_POST['dokument_id'];
	$umowa_id = $_POST['dokument_id'];
	
	require_once($_SERVER ['DOCUMENT_ROOT'].'wzory_dokumentow/db/funkcje_db.php');
	
	$oswiadczenie = oswiadczenie_pobierz_dane_po_id($dokument_id);
	
	$numer_stopka = 'PG-2-1-F1/2015-04-01'; 
	
	$imie_nazwisko = $oswiadczenie['imie'].' '.$oswiadczenie['nazwisko'];
	
	$urodziny = new DateTime(implode('-',array(
			(int)substr($oswiadczenie['pesel'],0,2) + 1800 + (((floor(((int)$oswiadczenie['pesel']{2})/2)+1)%5)*100),
			substr($oswiadczenie['pesel'],2,2),
			substr($oswiadczenie['pesel'],4,2),
			))
	);
	
	$data_urodzin = $urodziny->format('Y-m-d');
	
	$adres_zamieszkania = 'ul. '.$oswiadczenie['ulica'].' '.$oswiadczenie['nr_mieszkania'].'/'.$oswiadczenie['nr_domu'].', '.$oswiadczenie['kod_pocztowy'].' '.$oswiadczenie['miasto'];
	
	$pesel = $oswiadczenie['pesel'];
	$data_wypadku = $oswiadczenie['data_wypadku'];
	$marka_pojazdu = $oswiadczenie['pojazd_marka'];
	$nr_rejestracyjny = $oswiadczenie['nr_rejestracyjny'];
	$poj_silnika = $oswiadczenie['poj_silnika'];
	
	$wyjazdy = oswiadczenie_wyjazd_pobierz_dane_po_id($oswiadczenie['id']);
	
	$i = 0;
	
	while ( $wiersz = mysqli_fetch_assoc ( $wyjazdy ) ) {
		
		$placowki[$i] = array(
				'data' => $wiersz['data'],
				'start' => $wiersz['miejscowosc_wyjazd'],
				'cel' => $wiersz['miejscowosc_docelowa'],
				'placowka_medyczna' => $wiersz['nazwa_placowki'],
				'droga' => $wiersz['odleglosc']
		);
		
		$i=$i+1;
	}
	
	$rodzaj_dokumentu = oswiadczenie_dokument_pobierz_rodzaj_po_id_oswiadczenia($oswiadczenie['id']);
	
	$i = 0;
	
	while($wiersz = mysqli_fetch_assoc($rodzaj_dokumentu)){
		$rodzaj_dokumentu_array[$i] =  $wiersz['rodzaj_dokumentu_id'];
		$rodzaj_dokumentu_sciezka_array[$i] = $wiersz['sciezka'];
		
		$i = $i+1;
	}
	
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
				<?php echo in_array('1', $rodzaj_dokumentu_array) ? '<span class="kratka_pelna">x</span>' : '<span class="kratka"></span>'; ?><p> dowodu rejestracyjnego, </p>
				<?php echo in_array('2', $rodzaj_dokumentu_array) ? '<span class="kratka_pelna">x</span>' : '<span class="kratka"></span>'; ?><p> faktur, </p>
				<?php echo in_array('3', $rodzaj_dokumentu_array) ? '<span class="kratka_pelna">x</span>' : '<span class="kratka"></span>'; ?><p> paragonów, </p>
				
				<?php echo in_array('4', $rodzaj_dokumentu_array) ? '<span class="kratka_pelna">x</span>' : '<span class="kratka"></span>'; ?><p> biletów, </p>
				<div class="clear_b"></div>
				<?php echo in_array('5', $rodzaj_dokumentu_array) ? '<span class="kratka_pelna">x</span>' : '<span class="kratka"></span>'; ?></span><p> prawa jazdy osoby dowożącej, </p>
				<?php echo in_array('6', $rodzaj_dokumentu_array) ? '<span class="kratka_pelna">x</span>' : '<span class="kratka"></span>'; ?></span><p> oświadczenie osoby dowożącej. </p>
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

<?php 
	if(count($rodzaj_dokumentu_sciezka_array) != 0){
		$liczba_dokumentow = count($rodzaj_dokumentu_sciezka_array);
				
		for($i=0;$i<$liczba_dokumentow;$i++){
			copy('/var/www/pliki/'.$rodzaj_dokumentu_sciezka_array[$i], '/var/www/html/tmp/'.$_POST['id_zdjec'].'_'.$rodzaj_dokumentu_sciezka_array[$i]) or die("Błąd przy kopiowaniu");
			$sciezka = '/var/www/html/tmp/'.$_POST['id_zdjec'].'_'.$rodzaj_dokumentu_sciezka_array[$i];
			chmod("$sciezka", 0777);
		}		
		
		for($i=0;$i<$liczba_dokumentow;$i++){	
			echo '<div class="strona strona_'.($i+1).'">';
				echo '<img style="max-width:100%; height:auto;" src="../tmp/'.$_POST['id_zdjec'].'_'.$rodzaj_dokumentu_sciezka_array[$i].'" />';
			echo '</div>';
		}
		
		
	}
?>




