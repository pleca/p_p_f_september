<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$strona_id = $_POST['produkty_strona_id'];
$produkty_strona_nazwa = $_POST['produkty_strona_nazwa'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');
$produkty_kategoria = produkty_rodzaj_pobierz_kategorie_po_strona_id($strona_id, $_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);

?>

<div class="produkty_kategoria_dodaj_nowy">
	<div class="produkty_strona_nazwa" data-strona_nazwa="<?php echo $produkty_strona_nazwa; ?>"><?php echo $produkty_strona_nazwa; ?></div>
	<?php if(in_array('122', $luzu)){  ?>
	<div class="produkty_strona_kategorii_opcje" data-strona_id="<?php echo $strona_id; ?>">
		<input type="text" class="produkty_kategoria_dodaj_nowy_nr_kolejnosci" placeholder="Nr"/>
		<input type="text" class="produkty_kategoria_dodaj_nowy_nazwa" placeholder="Nazwa kategorii"/>
		<span class="produkty_kategoria_dodaj_nowy_przycisk"></span>
		<span class="produkty_kategoria_dodaj_nowy_zapisz"></span>
		<div class="clear_b"></div>
	</div>
	<?php } ?>
	<div class="clear_b"></div>
</div>

<div class="produkty_kategoria_lista_tlo">

<?php

while ($dk = mysqli_fetch_assoc($produkty_kategoria)) {
	echo '<div class="produkty_kategoria_pojedyncza ';
			if($dk['nazwa'] == 'Inne'){ echo 'produkty_kategoria_domyslna " data-produkty_kategoria_domyslna="'.$dk['id'].'" '; }else{ echo ' "'; }
	echo ' >';
		echo '<div class="produkty_kategoria_pojedyncza_naglowek" data-produkty_kategoria_id="'.$dk['id'].'">';
			//echo '<input class="produkty_kategoria_nag_nazwa" type="text" value="'.$dk['nazwa'].'" placeholder="Nazwa kategorii" />';
			echo '<div class="produkty_kategoria_nag_nazwa"  >'.$dk['nazwa'].'</div>';
			if(in_array('123', $luzu)){
				if($dk['nazwa'] != 'Inne'){
					echo '<span class="produkty_kategoria_edytuj" ></span>';

				}
			}
			echo '<div class="clear_b"></div>';
		echo '</div>';

		$produkty_z_kategori = pobierz_liste_produktow_na_podstawie_id($dk['id'], $_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);
		echo '<div class="produkty_z_kategori">';
		while ($dzk = mysqli_fetch_assoc($produkty_z_kategori)) {

				echo '<div class="produkty_z_kategori_pojedyncza edytuj_produkty_z_kategori" data-produkty_z_kategori_id="'.$dzk['id'].'" >';
					echo '<div class="produkty_z_kategori_pojedyncza_nazwa_nazwa" data-produkty_z_kategori_pojedyncza_id="'.$dzk['id'].'">'.$dzk['nazwa_produktu'].'</div>';
					echo '<input class="produkty_z_kategori_pojedyncza_nr_kolejnosci edytuj_produkty_z_kategori" type="text" value="'.$dzk['nr_kolejnosci'].'" placeholder="Nr" />';
					echo '<input class="produkty_z_kategori_pojedyncza_nazwa edytuj_produkty_z_kategori" type="text" value="'.$dzk['nazwa_produktu'].'" placeholder="Nazwa produktu" />';
					echo '<input class="produkty_z_kategori_pojedyncza_plik edytuj_produkty_z_kategori" type="file" name="" />';
					if(in_array('126', $luzu)){
						echo '<span class="produkty_z_kategori_pojedyncza_edytuj" ></span>';
						echo '<span class="produkty_z_kategori_pojedyncza_zapisz" ></span>';

						if(in_array('127', $luzu)){
							echo '<span class="produkty_z_kategori_pojedyncza_usun dzkpu_wiersz" ></span>';
							echo '<div class="czy_jestes_pewnien">';
								echo '<p class="zablokowane_pole_transparent">Czy jesteś pewien? </p >';
								echo '<div data-id_element="'.$dzk['id'].'" class="element_usun_tak produkty_z_kategori_pojedyncza_usun_tak" class="zablokowane_pole"> TAK</div>';
							echo '</div>';
						}
					}
					echo '<span class="produkty_z_kategori_pojedyncza_anuluj_edytuj" ></span>';
					echo '<span class="produkty_z_kategori_pojedyncza_podglad " data-produkty_z_kategori_pojedyncza_id="'.$dzk['id'].'"></span>';
					echo '<textarea class="produkty_z_kategori_pojedyncza_opis edytuj_produkty_z_kategori" placeholder="Opis produktu" >'.$dzk['opis'].'</textarea>';
					echo '<div class="clear_b"></div>';
				echo '</div>';


		}
		echo '</div>';
		if(in_array('125', $luzu)){
			echo '<div class="produkty_z_kategori_dodaj_nowy"></div>';
		}
		echo '<div class="clear_b"></div>';
	echo '</div>';
}

?>

</div>