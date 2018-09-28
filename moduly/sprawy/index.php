<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>

<?php tytul_strony('ZARZĄDZANIE SPRAWAMI'); ?>

    <script class="skryptJs" type="text/javascript" src="<?php echo get_adres_strony(); ?>/biblioteki/fullcalendar/moment.js"></script>
<script class="skryptJs" type="text/javascript" src="<?php echo get_adres_strony(); ?>/biblioteki/bootstrap/js/bootstrap-datetimepicer.js"></script>

<script id="skrypty" type="text/javascript" src="<?php echo get_adres_strony(); ?>moduly/sprawy/js/funkcje"></script>
<link rel="stylesheet" href="<?php echo get_adres_strony(); ?>moduly/sprawy/css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/biblioteki/bootstrap/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_adres_strony(); ?>/biblioteki/bootstrap/css/bootstrap-datetimepicker.css" />

<?php

if (isset ( $_GET ['id_klienta'] )) {
	echo '<div id="id_klienta" data-id_klienta="' . $_GET ['id_klienta'] . '"></div>';
}

?>

<div class="body_strona_tytul zablokowane_pole_transparent">WYBIERZ
	ELEMENT Z ELEMENTÓW</div>
<?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?>
<div class="body_strona lista mobile_umowy">

	<div class="body_strona_l">

		<div id="klient"
			class="klient element_do_wyboru aktywny zablokowane_pole_transparent"
			title="Lista Klientów">
			<p>LISTA KLIENTÓW</p>
		</div>
		<div id="lista_umow" class="lista_umow element_do_wyboru"
			title="Lista umów">
			<p>LISTA UMÓW</p>
		</div>
		<div id="umowa" class="umowa element_do_wyboru" title="Utwórz umowę">
			<p>UTWÓRZ UMOWĘ</p>
		</div>


		<!--  <div id="umowa" class="element_do_wyboru " title="Umowa" >
			<p>UMOWY</p>
			<div class="bloczek_a_optima elementy_do_wyboru_opcje">
				<p id="bloczek_a_optima_umowa" class="element_do_wyboru_opcje" title="Umowa">OPTIMA</p>
				<p id="bloczek_a_maxima_umowa" class="element_do_wyboru_opcje" title="Umowa">MAXIMA</p>
				<p id="bloczek_a_promedica_umowa" class="element_do_wyboru_opcje" title="Umowa">PROMEDICA</p>

			</div>
		</div>-->


		<!--<div id="oswiadczenie_o_dojazdach" class="element_do_wyboru" title="Oświadczenie o dojazdach" >
			<p>OŚWIADCZENIE O DOJAZDACH DO PLACÓWEK MEDYCZNYCH</p>
		</div>-->

	</div>
	<div id="body_strona_r" class="body_strona_r">
	<?php
	require_once ('ajax/ajax_klient.php');
	
	?>
			</div>
    <div class="clear_b"></div>
</div>


</div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>