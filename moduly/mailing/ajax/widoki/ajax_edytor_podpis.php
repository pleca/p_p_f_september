<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$email_podpisy = mailing_podpisy_pobierz_po_uzytkownik_id($_SESSION['uzytkownik_id']);

?>

<script type="text/javascript" src="<?php echo adres_strony(); ?>js/wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo adres_strony(); ?>js/wysiwyg-editor.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<div class="edytor_podpis">


	<?php 
		
	$email_podpisy_ilosc=mysqli_num_rows($email_podpisy);
	
	$mailing_podpis_szablon = mailing_podpis_szablon_pobierz();
		
	$mailing_podpis_szablon_ilosc = mysqli_num_rows($mailing_podpis_szablon);
		
	$mailing_podpis_szablon_tresc = '<p>Wprowadź tekst...</p>';
		
	if($mailing_podpis_szablon_ilosc != 0){
		$mailing_podpis_szablon = mysqli_fetch_assoc($mailing_podpis_szablon);
		$mailing_podpis_szablon_tresc = $mailing_podpis_szablon['podpis_html'];
	
		$mailing_podpis_szablon_tresc = str_replace('#!uzytkownik_imie!#', $_SESSION['uzytkownik_imie'], $mailing_podpis_szablon_tresc);
		$mailing_podpis_szablon_tresc = str_replace('#!uzytkownik_nazwisko!#', $_SESSION['uzytkownik_nazwisko'], $mailing_podpis_szablon_tresc);
		$mailing_podpis_szablon_tresc = str_replace('#!uzytkownik_email!#', $_SESSION['uzytkownik_email'], $mailing_podpis_szablon_tresc);
	}
	
	if($email_podpisy_ilosc != 0){
		if(in_array('33', $luzu)){
			echo '<div class="ep_pojedynczy">';
				echo '<div class="epp_nazwa">Dodaj nowy<span class="dodaj edytuj_podpis"></span></div>';
				echo '<div class="epp_edytor" >';
				echo '<input type="text" class="eppe_nazwa" value="" placeholder="Nazwa podpisu" />';
				echo '<textarea class="editor" name="editor" placeholder="Wprowadź tekst...">'.$mailing_podpis_szablon_tresc.'</textarea>';
				echo '<div data-mailing_podpis_domyslny="0" class="epp_zapisz_nowy">ZAPISZ</div>';
				echo '</div>';
			echo '</div>';
		}	
	}
		
		
		if($email_podpisy_ilosc == 0){
						
			
			
			echo '<div class="ep_pojedynczy">';
				echo '<div class="epp_edytor" style="display:block">';
				echo '<input type="text" class="eppe_nazwa" value="" placeholder="Nazwa podpisu" />';
				echo '<textarea class="editor" name="editor" placeholder="Wprowadź tekst...">'.$mailing_podpis_szablon_tresc.'</textarea>';
				echo '<div data-mailing_podpis_domyslny="1" class="epp_zapisz_nowy">ZAPISZ</div>';
				echo '</div>';
			echo '</div>';
		}else{
			while ($ep = mysqli_fetch_assoc($email_podpisy)) {
					
				echo '<div class="ep_pojedynczy" data-podpis_id="'.$ep['id'].'">';
					echo '<div class="epp_nazwa"';
					if($ep['domyslny'] == 1){ echo 'style="display:none;"' ; }
					echo '>'.$ep['nazwa'].'<span class="edytuj edytuj_podpis"></span></div>';
					echo '<div class="epp_edytor" ';
					if($ep['domyslny'] == 1){ echo 'style="display:block;"' ; }
					echo '>';
					if($ep['domyslny'] != 1){
						echo '<span class="usun usun_podpis"></span>';
					}
					echo '<input type="text" class="eppe_nazwa" value="'.$ep['nazwa'].'" />';
					if($ep['domyslny'] != 1){
						echo '<div class="czy_jestes_pewnien podpis_usun_tak"><p>Czy jesteś pewnien?</p><div data-podpis_id="'.$ep['id'].'" class="czy_jestes_pewnien_tak">TAK</div></div>';
					}
					echo '<textarea class="editor" name="editor" placeholder="Wprowadź tekst...">'.htmlspecialchars_decode($ep['podpis_html']).'</textarea>';
					if($email_podpisy_ilosc > 1){
						
						echo '<div class="mailing_podpis_domyslny"><span class="kratka ustaw_domyslny ';
						if($ep['domyslny'] == 1){ echo ' zaznaczone ' ; }
						echo '"></span><p>Domyślny</p></div>';
						
					}
					echo '<div data-epp_id="'.$ep['id'].'" class="epp_zapisz">ZAPISZ</div>';
					echo '</div>';
				echo '</div>';
			}
		}
	
		
	?>
	
	
</div>
