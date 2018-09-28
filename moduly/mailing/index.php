<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

	if(!in_array('32', $luzu)){
		header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
	}

	tytul_strony('MAILING');

?>
<link rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/biblioteki/bootstrap/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/mailing/css/mailing.css'; ?>" type="text/css" />
<script  type="text/javascript" src="<?php echo adres_strony(); ?>moduly/mailing/js/funkcje"></script>
 
<div class="body_strona_tytul zablokowane_pole_transparent">Wybierz jedną z opcji</div>
<?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?>
<div class="body_strona lista mailing">

	<div class="body_strona_l ">
	
		<div id="nowa_wiadomosc" class="element_do_wyboru aktywny zablokowane_pole_transparent" title="nowa_wiadomosc" >
			<p>NOWA WIADOMOŚĆ</p>
		</div>
		<div id="podpis" class="element_do_wyboru zablokowane_pole_transparent" title="Podpis" >
			<p>PODPIS</p>
		</div>
		
		<?php 
		if(in_array('36', $luzu)){ ?>
			<div id="podpis_szablon" class="element_do_wyboru zablokowane_pole_transparent" title="Podpis szablon" >
				<p>PODPIS SZABLON</p>
			</div>
		<?php } ?>
		<div id="lista_schematow" class="element_do_wyboru zablokowane_pole_transparent" title="Lista schematów" >
			<p>LISTA SCHEMATÓW</p>
		</div>
		<div id="lista_wyslanych" class="element_do_wyboru zablokowane_pole_transparent" title="Lista wyslanych" >
			<p>LISTA WYSŁANYCH</p>
		</div>
		<?php 
		if(in_array('37', $luzu)){ ?>
			<div id="lista_wszystkich_wyslanych" class="element_do_wyboru zablokowane_pole_transparent" title="Lista wszystkich wyslanych" >
				<p>LISTA WSZYSTKICH WYSŁANYCH</p>
			</div>
		<?php } ?>
		<div id="grupy_mailingowe" class="element_do_wyboru zablokowane_pole_transparent" title="Grupy mailingowe" >
			<p>GRUPY MAILINGOWE</p>
		</div>
	</div>
	<div id="body_strona_r" class="body_strona_r ">
		<div id="body_strona_r_tresc_tlo" class="body_strona_r_tresc_tlo">
				
			<?php 
			
				require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/ajax/widoki/ajax_edytor_tekstu.php');
			
			?>
			
		</div>
				

	</div>
	
	<div class="clear_b"></div>
</div>


<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>