<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$lista_schematow = mailing_lista_schematow($_SESSION['uzytkownik_id']);
?>



<?php 

$lista_schematow_liczba = mysqli_num_rows($lista_schematow);

if($lista_schematow_liczba == 0){
	echo '<p>Brak zapisanych schematów</p>';
	return false;
}

	while ($ls = mysqli_fetch_assoc($lista_schematow)) {
		
		echo '<div class="ls_pojedynczy" data-mailing_id="'.$ls['id'].'">';
			echo '<div class="lsp_nazwa mailing_edytuj_widok">'.$ls['temat'].'<span class="edytuj mailing_edytuj"></span></div>';
			
		echo '</div>';
	}
?>