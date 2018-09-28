<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_z_kategori_id = htmlspecialchars($_POST['produkty_z_kategori_id']);

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$produkty_z_kategori = produkty_z_kategori_pobierz_dane_po_id($produkty_z_kategori_id);



?>

<div class="szczegoly_produktu_tlo"></div>
<div class="szczegoly_produktu_przod">
	
		<div class="szczegoly_produktu_przod_belka_top">
			<p class="szczegoly_produktu_przod_belka_top_tytul" data-szczegoly_produktu_id="<?php echo $produkty_z_kategori['id']; ?>">
				<?php echo $produkty_z_kategori['nazwa_produktu']; ?> (<?php echo $produkty_z_kategori['id']; ?>)
			</p>		
			<span class="szczegoly_produktu_zamknij">X</span>
		</div>
		
		
		<div class="szczegoly_produktu_informacje_podglad">
			<?php 
				$rodzaj_produkty = explode('.',$produkty_z_kategori['nazwa_pliku']);
				
				if($rodzaj_produkty[1] == 'pdf' || $rodzaj_produkty[1] == 'PDF'){
					if(!strpos($_SERVER['HTTP_USER_AGENT'],'Edge')){
                        echo '<a target="_blank" href="wyswietlProdukt.php?id_d='.$produkty_z_kategori['id'].'&nazwa='.$produkty_z_kategori['nazwa_pliku'].'"><div style="margin-bottom: 10px;" class="szczegoly_produktu_pobierz " >PODGLĄD</div></a>';
						echo '<iframe width="340" height="389" src="ajax/widoki/podglad_produktu?id_d='.$produkty_z_kategori['id'].'&nazwa='.$produkty_z_kategori['nazwa_pliku'].'" ></iframe>';
					}else{
						echo '<div class="szczegoly_produktu_informacje_podglad_brak"><p>Brak Podglądu</p></div>';
					}
				}else{
					echo '<div class="szczegoly_produktu_informacje_podglad_brak"><p>Brak Podglądu</p></div>';
				}
			?>
		
			<div class="szczegoly_produktu_pobierz szczegoly_produktu_pobierz_d" data-szczegoly_produktu_p="<?php echo $produkty_z_kategori['liczba_pobran']; ?>" data-szczegoly_produktu_id="<?php echo $produkty_z_kategori['id']; ?>" data-szczegoly_produktu_nazwa="<?php echo $produkty_z_kategori['nazwa_pliku']; ?>" >POBIERZ</div>
		</div>
		<div class="szczegoly_produktu_informacje">
		
			<div class="szczegoly_produktu_informacje_naglowki">
				<div class="szczegoly_produktu_informacje_naglowki_przycisk aktywny_p" data-nazwa_tresci="ogolne">Ogólne</div>
				<?php if(in_array('128', $luzu)){  ?>
					<div class="szczegoly_produktu_informacje_naglowki_przycisk" data-nazwa_tresci="widocznosc">Widoczność</div>
				<?php } ?>
				<?php if(in_array('129', $luzu)){  ?>
					<div class="szczegoly_produktu_informacje_naglowki_przycisk" data-nazwa_tresci="archiwum">Archiwum</div>
				<?php } ?>
			</div>
			<div class="szczegoly_produktu_informacje_tresc">
				<div id="ogolne" class="szczegoly_produktu_informacje_tresc_pojedyncza aktywny_t">
					<div class="szczegoly_produktu_przod_data_utworzenia sdit_szt">
						<p class="sdit_szop">Data dodania</p>					
						<div class="sdit_szczegoly"><?php echo $produkty_z_kategori['data_utworzenia']; ?></div>
					</div>					
					<div class="szczegoly_produktu_przod_data_modyfikacji sdit_szt">
						<p class="sdit_szop">Data ostatniej modyfikacji</p>
						<div class="sdit_szczegoly"><?php echo $produkty_z_kategori['data_modyfikacji']; ?></div>
					</div>					
					<div class="szczegoly_produktu_przod_liczba_pobran sdit_szt">
						<p class="sdit_szop">Liczba pobrań</p>
						<div class="sdit_szczegoly liczba_pobran"><?php echo $produkty_z_kategori['liczba_pobran']; ?></div>
					</div>					
					<div class="szczegoly_produktu_przod_opis sdit_szt">
						<p class="sdit_szop">Opis</p>
						<div class="sdit_szczegoly"><?php echo $produkty_z_kategori['opis']; ?></div>
					</div>
				</div>
				<?php if(in_array('128', $luzu)){  ?>
				<div id="widocznosc" class="szczegoly_produktu_informacje_tresc_pojedyncza">
					<?php 
					
						$lista_grup = uzytkownik_grupy_pobierz_wszystkie();
						
						$uprawnienie_dok = produkty_grupy_pobierz_grupa_id($produkty_z_kategori['id']);
						
						$i = 0;
						while ($udk = mysqli_fetch_assoc($uprawnienie_dok)) {
							$uprawnienie_dok_a[$i] = $udk['uzytkownik_grupa_id'];
							//echo $uprawnienie_dok_a[$i];
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
											if(in_array($uglp['id'], $uprawnienie_dok_a)){ echo ' zaznaczone'; }
										echo '" data-produkty_grupy_id="'.$uglp['id'].'" ></div>';
										echo '<div class="uzytkownik_grupy_pojedyncza_nazwa">'.$uglp['nazwa'].'</div>';
									echo '</div>';
								
								}
							}
				
						?>
						<div class="clear_b"></div>
					</div>
				
					<div class="produkty_uzytkownicy_lista">
					<p>Lista użytkowników</p>
					<div class="produkty_uzytkownicy_dodaj_nowy">DODAJ</div>
						<div id="produkty_uzytkownicy_lista_dodanych" class="produkty_uzytkownicy_lista_dodanych">
							<?php 
								echo '<div class="produkty_uzytkownicy_pojedyncza dup_naglowek">';
									echo '<div class="dup_login dup_el">Nr agenta</div>';
									echo '<div class="dup_imie dup_el">Imię</div>';
									echo '<div class="dup_nazwisko dup_el">Nazwisko</div>';
								
								echo '</div>';
							
								$lista_uzytkownikow = produkty_uzytkownicy_pobierz_wszystkie($produkty_z_kategori['id']);
							//echo $produkty_z_kategori['id'];
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
				<?php } ?>
				<?php if(in_array('29', $luzu)){  ?>
				<div id="archiwum" class="szczegoly_produktu_informacje_tresc_pojedyncza">
					<?php 
						echo '<div class="produkty_z_kategori_archiwum_pojedyncza naglowek">';
							echo '<p class="dzkap_id">ID</p>';
							echo '<p class="dzkap_da">Data archiwizacji</p>';
							echo '<p class="dzkap_t">Typ</p>';
							echo '<p class="dzkap_p">Pobrania</p>';
							echo '<div class="clear_b"></div>'	;
						echo '</div>';
						
						$produkty_z_kategori_archiwum = produkty_z_kategori_archiwum_pobierz_dane_po_id($produkty_z_kategori_id);
						
						while ($dzka = mysqli_fetch_assoc($produkty_z_kategori_archiwum)) {
							echo '<div class="produkty_z_kategori_archiwum_pojedyncza wiersz">';
								echo '<p class="dzkap_id">'.$dzka['id'].'</p>';
								echo '<p class="dzkap_da">'.$dzka['data_archiwizacji'].'</p>';
								$typ_pliku = explode('.',$dzka['nazwa_pliku']);
								echo '<p class="dzkap_t">'.$typ_pliku[1].'</p>';
								echo '<p class="dzkap_p">'.$dzka['liczba_pobran'].'</p>';
								echo '<span class="zapisz_plik_z_archwum pobierz_na_dysk szczegoly_produktu_pobierz_d"  data-szczegoly_produktu_nazwa="'.$dzka['nazwa_pliku'].'" data-szczegoly_produktu_id="'.$dzka['id'].'" data-szczegoly_produktu_p="'.$dzka['liczba_pobran'].'"></span>';
								echo '<div class="clear_b"></div>'	;						
							echo '</div>';
						}
					
					?>
					<div class="height_10"></div>
				</div>
				<?php } ?>
			</div>
			
		</div>
		<div class="clear_b"></div>
		
	
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
								echo '<span class="lista_uzytkownikow_dla_grupy_dodaj_uprawnienie" data-uzytkownik_id="'.$ludp['id'].'"></span>';
							echo '</div>';
						}
					echo '</div>';
				}
			}
		?>
		<div class="height_10"></div>
	</div>

