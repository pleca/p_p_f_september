<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

?>

<script type="text/javascript" src="<?php echo adres_strony(); ?>js/wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo adres_strony(); ?>js/wysiwyg-editor.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<div class="edytor_podpis">


	<?php 
		$mailing_podpis_szablon = 	mailing_podpis_szablon_pobierz();	
		
		$mailing_podpis_szablon_ilosc = mysqli_num_rows($mailing_podpis_szablon);
		
		if($mailing_podpis_szablon_ilosc == 0){
			echo '<div class="ep_pojedynczy" style="margin-bottom: 0px;">';
				echo '<div class="epp_edytor" style="display:block">';
				echo '<textarea class="editor" name="editor" placeholder="Wprowadź tekst..."><p>Wprowadź tekst...</p></textarea>';
				echo '<div class="epp_zapisz_nowy_szablon">ZAPISZ</div>';
				echo '</div>';
			echo '</div>';
		}else{
			$mailing_podpis_szablon = mysqli_fetch_assoc($mailing_podpis_szablon);
			
			echo '<div class="ep_pojedynczy" style="margin-bottom: 0px;">';
				echo '<div class="epp_edytor" style="display:block">';
				echo '<textarea class="editor" name="editor" placeholder="Wprowadź tekst...">'.htmlspecialchars_decode($mailing_podpis_szablon['podpis_html']).'</textarea>';
				echo '<div class="epp_zapisz_szablon" data-mailing_podpis_szablon_id="'.$mailing_podpis_szablon['id'].'">ZAPISZ</div>';
				echo '</div>';
			echo '</div>';
		}
	
			
	
	?>
	
	
</div>
