<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$wartosc = htmlspecialchars($_POST['wartosc']);

$wartosc = mb_strtolower($wartosc);

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'funkcje_glowne.php');

$lista_wszystkich_uzytkownikow_wyniki = lista_wszystkich_uzytkownikow_szukaj($wartosc);

$liczba_wierszy = mysqli_num_rows($lista_wszystkich_uzytkownikow_wyniki);

echo '<div class="lista_wszystkich_uzytkownikow_pole_wyniki">';

	if($liczba_wierszy == '0'){
		echo '<p class="lwupwp_b">Brak wyników wyszukiwania...</p>';
	}else{
		echo '<div class="lwupw_pojedynczy_naglowek" >';
			echo '<div class="lwupwp_l lwupwp_e">Login</div>';
			echo '<div class="lwupwp_e lwupwp_i">Imię</div>';
			echo '<div class="lwupwp_e lwupwp_n">Nazwisko</div>';
			echo '<span class="lista_wszystkich_uzytkownikow_pole_wyniki_zwin">X</span>';
			echo '<div class="clear_b"></div>'	;
		echo '</div>';
		while ($lwuw = mysqli_fetch_assoc($lista_wszystkich_uzytkownikow_wyniki)) {
						
			
			$wynik = mb_eregi_replace($wartosc, '<b>'.$wartosc.'</b>', $lwuw['nazwa']);
			
			$wynik = explode(' ',$wynik);
						
			echo '<div class="lwupw_pojedynczy" >';
				echo '<div class="lwupwp_l lwupwp_e">'.$lwuw['login'].'</div>';
				echo '<div class="lwupwp_e lwupwp_i">'.$wynik[0].'</div>';
				echo '<div class="lwupwp_e lwupwp_n">'.$wynik[1].'</div>';
				echo '<span class="lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie lista_uzytkownikow_dla_grupy_dodaj_uprawnienie lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie lwszys" data-uzytkownik_id="'.$lwuw['id'].'"></span>'; 
				echo '<div class="clear_b"></div>'	;
			echo '</div>';
		}
	}

echo '</div>';
