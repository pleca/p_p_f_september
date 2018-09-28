<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$element_id = $_POST['element_id'];
$tabelka = $_POST['tabelka'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$element = produkty_grupa_kategoria_pobierz_dane($element_id, $tabelka);

?>

<div class="szczegoly_produktu_tlo"></div>
<div class="szczegoly_produktu_przod edytuj_element">
	<div class="szczegoly_produktu_przod_belka_top">
		<p class="szczegoly_produktu_przod_belka_top_tytul" data-tabelka="<?php echo $tabelka; ?>" data-element_id="<?php echo $element_id; ?>">
			<?php echo $element['nazwa']; ?> (<?php echo $element['id']; ?>)
			
		</p>
		<span class="szczegoly_produktu_zamknij">X</span>
		<?php 
		if($tabelka == 'produkty_strona'){
			if(in_array('121', $luzu)){ ?>
				<span style="display:block; float:right; " class="produkty_strona_edytuj_usun" ></span>
		<?php 
			}
		} ?>
		
		<?php 
		if($tabelka == 'produkty_kategoria'){
			if(in_array('124', $luzu)){ ?>
				<span style="display:block; float:right; " class="produkty_kategoria_usun" ></span>
		<?php 
			}
		} ?>	
		<div class="czy_jestes_pewnien">
			<p class="zablokowane_pole_transparent">Czy jesteś pewien? </p >
			<div data-id_element="<?php echo $element['id']; ?>" class="element_usun_tak 
			<?php 
				if($tabelka == 'produkty_strona'){ echo ' produkty_strona_edytuj_usun_tak '; }
				if($tabelka == 'produkty_kategoria'){ echo ' produkty_kategoria_usun_tak '; }
			?>
			
			  zablokowane_pole"> TAK</div>
		</div>
	</div>
	<?php 
	
	if(in_array('120', $luzu)){
		
			echo '<div class="produkty_strona_edytuj" data-strona_id="'.$element['id'].'">';
			echo '<input class="produkty_strona_edytuj_nr_kolejnosci " type="text" value="'.$element['nr_kolejnosci'].'" placeholder="Nr" />';
			echo '<input class="produkty_strona_edytuj_nazwa " type="text" value="'.$element['nazwa'].'"  placeholder="Nazwa" />';
			
			echo '<span style="display:block; float:left; " class="produkty_strona_edytuj_zapisz" >ZAPISZ</span>';
			echo '<div class="clear_b"></div>';
			echo '</div>';
		
	}
	
	?>
	
	<?php 
					
				$lista_grup = uzytkownik_grupy_pobierz_wszystkie();
						
				$uprawnienie_element = produkty_grupa_kategoria_pobierz_grupy_po_id($element_id, $tabelka);
						
				$i = 0;
				while ($ue = mysqli_fetch_assoc($uprawnienie_element)) {
					$uprawnienie_ue[$i] = $ue['uzytkownik_grupa_id'];
					//echo $uprawnienie_ue[$i];
				$i++;
			}
	?>
				<div class="produkty_grupy_lista">
					<p>Grupy użytkowników</p>
						<?php 
							while ($uglp = mysqli_fetch_assoc($lista_grup)) {
								if($uglp['id'] != '1'){
																											
									echo '<div class="uzytkownik_grupy_pojedyncza';
										
									echo '" data-produkty_grupy_id="'.$uglp['id'].'">';
										echo '<div class="uzytkownik_grupy_pojedyncza_kratka';
											if(in_array($uglp['id'], $uprawnienie_ue)){ echo ' zaznaczone'; }
										echo '" data-produkty_grupy_id="'.$uglp['id'].'" ></div>';
										echo '<div class="uzytkownik_grupy_pojedyncza_nazwa">'.$uglp['nazwa'].'</div>';
									echo '</div>';
								
								}
							}
				
						?>
						<div class="clear_b"></div>
					</div>
					
					<div class="produkty_uzytkownicy_lista produkty_uzytkownicy_lista_edytuj_kategorie">
					<p>Lista użytkowników</p>
					<div class="produkty_uzytkownicy_dodaj_nowy">DODAJ</div>
						<div id="produkty_uzytkownicy_lista_dodanych" class="produkty_uzytkownicy_lista_dodanych">
							<?php 
								echo '<div class="produkty_uzytkownicy_pojedyncza dup_naglowek">';
									echo '<div class="dup_login dup_el">Nr agenta</div>';
									echo '<div class="dup_imie dup_el">Imię</div>';
									echo '<div class="dup_nazwisko dup_el">Nazwisko</div>';
								
								echo '</div>';
								//echo $tabelka;
								if($tabelka == 'produkty_strona'){
									$lista_uzytkownikow = produkty_grupa_uzytkownicy_pobierz($element_id);
								}else{
									$lista_uzytkownikow = produkty_kategoria_uzytkownicy_pobierz($element_id);
								}
								
							
								while ($dul = mysqli_fetch_assoc($lista_uzytkownikow)) {
									
																												
										echo '<div class="produkty_uzytkownicy_pojedyncza">';
											echo '<div class="dup_login dup_el">'.$dul['login'].'</div>';
											echo '<div class="dup_imie dup_el">'.$dul['imie'].'</div>';
											echo '<div class="dup_nazwisko dup_el">'.$dul['nazwisko'].'</div>';
											echo '<span class="dup_el_usun" data-uzytkownik_id="'.$dul['uzytkownik_id'].'"></span>';
										echo '</div>';
									
									
								}
					
							?>
						</div>
					</div>
					
					
					
</div>

<div class="lista_wszystkich_uzytkownikow"></div>
	<div class="lista_wszystkich_uzytkownikow_przod">
		<div class="lista_wszystkich_uzytkownikow_przod_belka_top">
			<p class="lista_wszystkich_uzytkownikow_przod_belka_top_tytul" >
				Lista użytkowników
			</p>		
			<span class="lista_wszystkich_uzytkownikow_zamknij">X</span>
		</div>
		
		<div class="lista_wszystkich_uzytkownikow_pole">
			<input type="text" class="lwu_pole_szukaj" placeholder="Wpisz szukaną frazę..."/>
			<div id="lista_wszystkich_uzytkownikow_pole_wyniki"></div>
		</div>
		
		
		<?php 
			$lista_grup = uzytkownik_grupy_pobierz_wszystkie();
			
			while ($uglp = mysqli_fetch_assoc($lista_grup)) {
				
				$lista_uzytkownikow_dla_grupy = uzytkownik_pobierz_liste_po_frupa_id($uglp['id']);
				if(mysqli_num_rows($lista_uzytkownikow_dla_grupy) != '0'){
					echo '<div class="lwu_grupa_nazwa">'.$uglp['nazwa'].'</div>';
					echo '<div class="lwu_grupa">';					
						while ($ludp = mysqli_fetch_assoc($lista_uzytkownikow_dla_grupy)) {
							echo '<div class="lwu_g_uzytkownik_p" data-uzytkownik_grupy_id="'.$ludp['id'].'">';
								echo '<div class="lwu_g_uzytkownik_p_e">'.$ludp['login'].'</div>'; 
								echo '<div class="lwu_g_uzytkownik_p_e">'.$ludp['imie'].'</div>';
								echo '<div class="lwu_g_uzytkownik_p_e">'.$ludp['nazwisko'].'</div>';
								echo '<span class="lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie" data-uzytkownik_id="'.$ludp['id'].'"></span>';
							echo '</div>';
						}
					echo '</div>';
				}
			}
		?>
		<div class="height_10"></div>
	</div>