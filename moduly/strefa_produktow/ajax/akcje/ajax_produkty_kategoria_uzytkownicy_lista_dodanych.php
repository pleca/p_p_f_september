<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$produkt_id = $_POST['produkt_id'];

echo '<div class="produkty_uzytkownicy_pojedyncza dup_naglowek">';
echo '<div class="dup_login dup_el">Nr agenta</div>';
echo '<div class="dup_imie dup_el">Imię</div>';
echo '<div class="dup_nazwisko dup_el">Nazwisko</div>';

echo '</div>';
	
$lista_uzytkownikow = produkty_kategoria_uzytkownicy_pobierz($produkt_id);
	
while ($dul = mysqli_fetch_assoc($lista_uzytkownikow)) {
	

	echo '<div class="produkty_uzytkownicy_pojedyncza">';
		echo '<div class="dup_login dup_el">'.$dul['login'].'</div>';
		echo '<div class="dup_imie dup_el">'.$dul['imie'].'</div>';
		echo '<div class="dup_nazwisko dup_el">'.$dul['nazwisko'].'</div>';
		echo '<span class="dup_el_usun" data-uzytkownik_id="'.$dul['uzytkownik_id'].'"></span>';
	echo '</div>';
		
		
}