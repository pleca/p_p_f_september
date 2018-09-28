<?php 
define('sciezka_dluga', $_SERVER ['DOCUMENT_ROOT']);

include (sciezka_dluga . '/funkcje_glowne.php'); ?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="stylesheet" href="<?php default_css(); ?>" type="text/css" />
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<link id="mobile_css" rel="stylesheet" href="<?php mobile_css(); ?>" type="text/css" />
</head>
<body>

<?php tytul_strony_bez_sesji('BŁĄD 404'); ?>

<div class="body_strona_tytul">STRONA NIE ZOSTAŁA ODNALEZIONA</div>

<div class="body_strona blad_na_stronie">
<div id="body_strona_r" class="body_strona_r">
	


	<div class="blad_napis"><span class="blad_napis_numer">404</span></div>

	<div class="blad_opcje">
			<a href="javascript:history.back()">WSTECZ</a>
	</div>
	

</div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>