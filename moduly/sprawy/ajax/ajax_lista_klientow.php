<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php'); 

			require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php'); 
			
			//$lista_klientow = pobierz_liste_klientow();
			
			$lista_klientow = pobierz_liste_klientow_ze_sprawami();
		?>
				<div class="tabelka">	
					<div class="tabelka_naglowek tabelka_wiersz zablokowane_pole_transparent">
						<p class="tabelka_id">ID</p>
						<p class="tabelka_imie">Imię</p>
						<p class="tabelka_nazwisko">Nazwisko</p>
						<p class="tabelka_pesel">PESEL</p>
						<p class="tabelka_dowod_osobisty">NR DOWODU</p>
						<p class="tabelka_opcje"></p>
						<div class="clear_b"></div>
					</div>		
					<?php 
						
					while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow ) ) {
						echo '<div class="tabelka_wiersz">';
							echo '<p class="tabelka_id zablokowane_pole_transparent">'.$wiersz['id'].'</p>';
							echo '<p class="tabelka_imie zablokowane_pole_transparent">'.$wiersz['imie'].'</p>';
							echo '<p class="tabelka_nazwisko zablokowane_pole_transparent">'.$wiersz['nazwisko'].'</p>';
							echo '<p class="tabelka_pesel zablokowane_pole_transparent">'.$wiersz['pesel'].'</p>';
							echo '<p class="tabelka_dowod_osobisty zablokowane_pole_transparent">'.$wiersz['dowod'].'</p>';
							echo '<p class="tabelka_opcje">';
								
								echo '<span class="edytuj_klienta edytuj" title="Edytuj"></span>';
							echo '</p>';
						echo '</div>';
					}
					
					?>
				</div>
			