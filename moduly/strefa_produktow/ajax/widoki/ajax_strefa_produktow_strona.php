<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$strona_id = $_POST['dokumenty_strona_id'];
$dokumenty_strona_nazwa = $_POST['dokumenty_strona_nazwa'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$dokumenty_kategoria = dokumenty_rodzaj_pobierz_kategorie_po_strona_id($strona_id, $_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);

?>

<div class="dokumenty_kategoria_dodaj_nowy">
	<div class="dokumenty_strona_nazwa" data-strona_nazwa="<?php echo $dokumenty_strona_nazwa; ?>"><?php echo $dokumenty_strona_nazwa; ?></div>
	<?php if(in_array('22', $luzu)){  ?>
	<div class="dokumenty_strona_kategorii_opcje" data-strona_id="<?php echo $strona_id; ?>">
		<input type="text" class="dokumenty_kategoria_dodaj_nowy_nr_kolejnosci" placeholder="Nr"/>
		<input type="text" class="dokumenty_kategoria_dodaj_nowy_nazwa" placeholder="Nazwa kategorii"/>
		<span class="dokumenty_kategoria_dodaj_nowy_przycisk"></span>
		<span class="dokumenty_kategoria_dodaj_nowy_zapisz"></span>
		<div class="clear_b"></div>
	</div>
	<?php } ?>
	<div class="clear_b"></div>
</div>

<div class="dokumenty_kategoria_lista_tlo">

<?php 

while ($dk = mysqli_fetch_assoc($dokumenty_kategoria)) {
	echo '<div class="dokumenty_kategoria_pojedyncza ';
			if($dk['nazwa'] == 'Inne'){ echo 'dokumenty_kategoria_domyslna " data-dokumenty_kategoria_domyslna="'.$dk['id'].'" '; }else{ echo ' "'; }
	echo ' >';	
		echo '<div class="dokumenty_kategoria_pojedyncza_naglowek" data-dokumenty_kategoria_id="'.$dk['id'].'">';
			//echo '<input class="dokumenty_kategoria_nag_nazwa" type="text" value="'.$dk['nazwa'].'" placeholder="Nazwa kategorii" />'; 
			echo '<div class="dokumenty_kategoria_nag_nazwa"  >'.$dk['nazwa'].'</div>';
			if(in_array('23', $luzu)){
				if($dk['nazwa'] != 'Inne'){
					echo '<span class="dokumenty_kategoria_edytuj" ></span>';

				}
			}
			echo '<div class="clear_b"></div>';
		echo '</div>';
			
		$dokumenty_z_kategori = pobierz_liste_dokumentow_na_podstawie_id($dk['id'], $_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);
		echo '<div class="dokumenty_z_kategori">';
		while ($dzk = mysqli_fetch_assoc($dokumenty_z_kategori)) {
			
				echo '<div class="dokumenty_z_kategori_pojedyncza edytuj_dokumenty_z_kategori" data-dokumenty_z_kategori_id="'.$dzk['id'].'" >';
					echo '<div class="dokumenty_z_kategori_pojedyncza_nazwa_nazwa" data-dokumenty_z_kategori_pojedyncza_id="'.$dzk['id'].'">'.$dzk['nazwa_dokumentu'].'</div>';
					echo '<input class="dokumenty_z_kategori_pojedyncza_nr_kolejnosci edytuj_dokumenty_z_kategori" type="text" value="'.$dzk['nr_kolejnosci'].'" placeholder="Nr" />';
					echo '<input class="dokumenty_z_kategori_pojedyncza_nazwa edytuj_dokumenty_z_kategori" type="text" value="'.$dzk['nazwa_dokumentu'].'" placeholder="Nazwa dokumentu" />'; 
					echo '<input class="dokumenty_z_kategori_pojedyncza_plik edytuj_dokumenty_z_kategori" type="file" name="" />';
					if(in_array('26', $luzu)){
						echo '<span class="dokumenty_z_kategori_pojedyncza_edytuj" ></span>';
						echo '<span class="dokumenty_z_kategori_pojedyncza_zapisz" ></span>';
						
						if(in_array('27', $luzu)){
							echo '<span class="dokumenty_z_kategori_pojedyncza_usun dzkpu_wiersz" ></span>';	
							echo '<div class="czy_jestes_pewnien">';
								echo '<p class="zablokowane_pole_transparent">Czy jesteś pewien? </p >';
								echo '<div data-id_element="'.$dzk['id'].'" class="element_usun_tak dokumenty_z_kategori_pojedyncza_usun_tak" class="zablokowane_pole"> TAK</div>';
							echo '</div>';
						}
					}
					echo '<span class="dokumenty_z_kategori_pojedyncza_anuluj_edytuj" ></span>';
					echo '<span class="dokumenty_z_kategori_pojedyncza_podglad " data-dokumenty_z_kategori_pojedyncza_id="'.$dzk['id'].'"></span>';
					echo '<textarea class="dokumenty_z_kategori_pojedyncza_opis edytuj_dokumenty_z_kategori" placeholder="Opis dokumentu" >'.$dzk['opis'].'</textarea>';
					echo '<div class="clear_b"></div>';
				echo '</div>';
				
			
		}
		echo '</div>';
		if(in_array('25', $luzu)){
			echo '<div class="dokumenty_z_kategori_dodaj_nowy"></div>';
		}
		echo '<div class="clear_b"></div>';
	echo '</div>';
} 

?>

</div>