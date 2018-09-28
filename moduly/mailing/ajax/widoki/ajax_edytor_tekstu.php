<?php 
	require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php'); 
	require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');
?>


<script type="text/javascript" src="<?php echo adres_strony(); ?>js/wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo adres_strony(); ?>js/wysiwyg-editor.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<div class="mailing_naglowek" data-mailing_id="">
	<p></p><span class="zapisz mailing_zapisz_schemat"></span>
</div>

<div class="mailing_tytul">
	<p class="mailing_tytul_tytul">Temat wiadomości</p>
	<input type="text" class="mailing_tytul_pole" value="" placeholder="Temat wiadomości"/>
</div>

<div class="mailing_adresat">
	<p class="mailing_adresat_tytul">Nadawca imie i nazwisko</p>
	<?php 
		if(in_array('34', $luzu)){
			echo '<input type="text" class="mailing_adresat_pole mailing_adresat_imie_nazwisko" value="'.$_SESSION['uzytkownik_imie'].' '.$_SESSION['uzytkownik_nazwisko'].'" placeholder="Imię i nazwisko nadawcy"/>';
		}else{
			echo '<p class="mailing_adresat_imie_nazwisko_p">'.$_SESSION['uzytkownik_imie'].' '.$_SESSION['uzytkownik_nazwisko'].'</p>';
		}
	?>
	
</div>

<div class="mailing_adresat">
	<p class="mailing_adresat_tytul">Nadawca adres email</p>
	<?php 
		if(in_array('34', $luzu)){
			echo '<input type="text" class="mailing_adresat_pole mailing_adresat_email" value="'.$_SESSION['uzytkownik_email'].'" placeholder="Adres email nadawcy"/>';
		}else{
			echo '<p class="mailing_adresat_email_p">'.$_SESSION['uzytkownik_email'].'</p>';
		}
	?>
	</div>

<div class="mailing_podpis">
	<p class="mailing_adresat_tytul">Wybierz podpis</p>
	<?php 

		$email_podpisy = mailing_podpisy_pobierz_po_uzytkownik_id($_SESSION['uzytkownik_id']);
		
			$email_podpisy_ilosc_pole = mysqli_num_rows($email_podpisy);
			if($email_podpisy_ilosc_pole == 0){
				echo '<p style="padding:5px;">Brak podpisu - Przejdź do zakładki "PODPIS"</p>';
			}else if($email_podpisy_ilosc_pole == 1){
				$ep = mysqli_fetch_assoc($email_podpisy);
				echo '<p style="padding:5px;">'.$ep['nazwa'].'</p>';
			}else{	
				echo '<select class="mailing_podpis_lista">';
					while ($ep = mysqli_fetch_assoc($email_podpisy)) {
						echo '<option data-podpis_id="'.$ep['id'].'" ';
						if($ep['domyslny'] == 1){ echo ' selected="selected" '; }
						echo '>'.$ep['nazwa'].'</option>';
					}
				echo '</select>';
			}
		
			
		
	?>
</div>



<textarea class="editor" name="editor" placeholder="Wprowadź tekst...">
	<p>Wpisz treść wiadomości...</p>
	<?php 
		$email_podpis_domyslny = mailing_podpis_domyslny_po_uzytkownik_id($_SESSION['uzytkownik_id']);
		
		echo '<div class="podpis_w_tresci">';
			echo htmlspecialchars_decode ($email_podpis_domyslny['podpis_html']);
		
			echo '<div class="podpis_w_tresci_end"></div>';
		echo '</div >';
		
	?>
</textarea>

<div class="mailing_podpis_do_wiadomosci">
	<p class="mailing_adresat_tytul">Do wiadomości</p>
	<div class="mailing_dw_a_pole">
		<input placeholder="Adres email" type=email class="mailing_dw_a_input"/>
		<span class="dodaj dodaj_mailing_dw_a"></span>
	<div class="clear_b"></div>
	</div>
	<div id="mailing_dw_a">
		
	</div>
	<div class="clear_b"></div>
</div>

<div class="mailing_podpis_do_wiadomosci mailing_pojedynczy_odbiorca">
	<p class="mailing_adresat_tytul">Odbiorca</p>
	<div class="mailing_odbiorca_pojedynczy_a_pole">
		<input placeholder="Adres email" type=email class="mailing_odbiorca_a_input"/>
		<span class="dodaj dodaj_mailing_odbiorca_a"></span>
	<div class="clear_b"></div>
	</div>
	<div id="mailing_odbiorca_pojedynczy_a">
		
	</div>
	<div class="clear_b"></div>
</div>

<div class="mailing_podpis_do_wiadomosci mailing_odbiorcy_bez_dw">
	<p class="mailing_adresat_tytul">Lista odbiorców</p>
<div class="mailing_odbiorca">
	<div class="mailing_odbiorca_dodaj">DODAJ</div>
	<div id="mailing_odbiorca_lista">
	
		
	</div>
	<div class="mailing_odbiorca_email" data-adresat_email="<?php echo $_SESSION['uzytkownik_email']; ?>"><p class="mail_napis"><?php echo $_SESSION['uzytkownik_email']; ?></p><div class="clear_b"></div></div>
		
	<div class="clear_b"></div>
</div>
</div>

<?php 
	if(in_array('35', $luzu)){
		echo '<div class="mailing_podpis_do_wiadomosci">';
			echo '<p class="mailing_adresat_tytul">Załączniki</p>';
			echo '<div class="mailing_zalaczniki">';
				echo '<div class="mailing_zalaczniki_dodaj"><span class="mailing_zalaczniki_dodaj_napis">DODAJ</span><input type="file" class="mailing_zalaczniki_dodaj_pole" /></div>';
				echo '<div id="mailing_zalaczniki_lista"></div>';
				echo '<div class="clear_b"></div>';
			echo '</div>';
		echo '</div>';
	}
?>

<div class="mailing_wyslij_testowy" data-adres_email="<?php echo $_SESSION['uzytkownik_email']; ?>">WYŚLIJ TESTOWY<br/><?php echo $_SESSION['uzytkownik_email']; ?></div>


<div class="mailing_wyslij_testowy_zgodnosc"><span class="kratka"></span>Czy mail testowy wygląda prawidłowo?</div>

<div class="mailing_wyslij_jako_udw"><span class="kratka  wyslij_jako_udw "></span>Wyślij jako UDW</div>
<div class="wyslij_jako_udw_l_paczki">Wyślij w paczkach po: <input type="number" class="wyslij_jako_udw_liczba_w_paczce" name="" min="10" max="60" value="10"></div>

<div class="clear_b"></div>
<div class="mailing_wyslij_priorytet"><span class="kratka wyslij_priorytet"></span>Wyślij z priorytetem (Wysoki)</div>

<div class="mailing_wyslij">WYŚLIJ</div>

<div id="mailing_odbiorca_lista_tlo">
	<div class="mailing_odbiorca_lista_tlo"></div>
	<div class="mailing_odbiorca_lista_okno">
			<div class="mailing_odbiorca_lista_okno_belka_top">
				<p class="mailing_odbiorca_lista_okno_belka_top_tytul">
					Lista odbiorców
				</p>		
			<span class="mailing_odbiorca_lista_okno_zamknij">X</span>
		</div>
		
		<div class="mailing_odbiorca_wpisany_recznie">
			<input type="email" class="mailing_odbiorca_wpisany_recznie_pole" placeholder="Adres email odbiorcy"/>
			<span class="dodaj mailing_odbiorca_wpisany_recznie_dodaj" ></span>
		</div>
		
		<div class="mailing_odbiorca_dodaj_z_pliku_csb">
			<span>DODAJ Z PLIKU CSV(rozdzielony przecinkami)</span>
			<input type="file" class="mailing_odbiorca_dodaj_z_pliku_csb_pole" accept=".csv" />
		</div>
		
		<?php if(in_array('90', $luzu)){ ?>
			<div class="mol_struktury ">
				<div class="mols_nazwa">GRUPY</div>
				<div data-element_id="1" data-rodzaj="grupa" class="mol_element_grupy dodaj_maile_elementu">AGENCI</div>
				<div data-element_id="2" data-rodzaj="grupa" class="mol_element_grupy dodaj_maile_elementu">KIEROWNICY</div>
				<div data-element_id="3" data-rodzaj="grupa" class="mol_element_grupy dodaj_maile_elementu">DYREKTORZY</div>
				<div data-element_id="4" data-rodzaj="grupa" class="mol_element_grupy dodaj_maile_elementu">KONSULTANCI</div>
				<div data-element_id="5" data-rodzaj="grupa" class="mol_element_grupy dodaj_maile_elementu">JEDNOSTKI</div>
                <div data-element_id="999" data-rodzaj="grupa" class="mol_element_grupy dodaj_maile_elementu">SSW</div>
			
				<div class="clear_b"></div>
			</div>
		<?php } ?>
		<?php if(in_array('91', $luzu)){ ?>
			<div class="mol_struktury ">
				<div class="mols_nazwa">STRUKTURY</div>
				<div class="mols_lista">
				
				<?php 
				
					$lista_dyrektorow = mailing_pobierz_liste_wszystkich_dyrektorow();
					
					while ($lid = mssql_fetch_assoc($lista_dyrektorow)) {
						echo '<div data-rodzaj="struktura" data-element_id="'.$lid['Id'].'" class="molsl_pojedyncza dodaj_maile_elementu">'.iconv("cp1250","UTF-8",$lid['Dyrektor']).'</div>';
					}
				
				?>
					<div class="clear_b"></div>
				</div>
			</div>
		<?php } ?>
		
	</div>
</div>





















