<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$dokument_id = $_POST['dokument_id'];

echo '<div class="dokumenty_uzytkownicy_pojedyncza dup_naglowek">';
echo '<div class="dup_login dup_el">Nr agenta</div>';
echo '<div class="dup_imie dup_el">Imię</div>';
echo '<div class="dup_nazwisko dup_el">Nazwisko</div>';

echo '</div>';
	
$lista_uzytkownikow = dokumenty_kategoria_uzytkownicy_pobierz($dokument_id);
	
while ($dul = mysqli_fetch_assoc($lista_uzytkownikow)) {
	

	echo '<div class="dokumenty_uzytkownicy_pojedyncza">';
		echo '<div class="dup_login dup_el">'.$dul['login'].'</div>';
		echo '<div class="dup_imie dup_el">'.$dul['imie'].'</div>';
		echo '<div class="dup_nazwisko dup_el">'.$dul['nazwisko'].'</div>';
		echo '<span class="dup_el_usun" data-uzytkownik_id="'.$dul['uzytkownik_id'].'"></span>';
	echo '</div>';
		
		
}