<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_grupy_globalne = mailing_grupy_pobierz_wszystkie($_SESSION['uzytkownik_id']);

while ($mgg = mysqli_fetch_assoc($mailing_grupy_globalne)) {
	echo '<div class="mailing_grupa_pojedyncza">';
		echo '<div class="mgp_nazwa">'.$mgg['mailing_grupa_nazwa'];
			if($mgg['globalna'] == 1){
				if(in_array('38', $luzu)){
					echo '<span data-mailing_grupa_id="'.$mgg['mailing_grupa_id'].'" class="edytuj edytuj_mailing_grupa"></span>';
				}
			}else{
				echo '<span data-mailing_grupa_id="'.$mgg['mailing_grupa_id'].'" class="edytuj edytuj_mailing_grupa"></span>';
			}
		echo '</div>';
	echo '</div>';
}
