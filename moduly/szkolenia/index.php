<?php 
	require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); 
	
	if(!in_array('65', $luzu)){
		header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
	}

    $szkoleniaMain = new SzkoleniaMain();

    $szkoleniaMain->wyswietlNaglowek(false, 'szkolenia');

    $szkoleniaMain->zaladujBiblioteki();
?>



<script type="text/javascript" src="<?php adres_strony(); ?>moduly/szkolenia/js/funkcje"></script>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkolenia/css/szkolenia.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/css/animate.css'; ?>" type="text/css" />

<div class="col-md-12  paddding_l_0 paddding_r_0 szkoleniaModul">
	<div class="col-md-12 gdzieJestem"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
	<div class="col-md-2">
		<div class="panel panel-default ">
			<div class="panel-heading">MENU</div>
			<div class="panel-body panel_body_menu">
				<button id="zakladka_aktualnosci" type="button" class="btn btn-default">Aktualności</button>
				<button id="zakladka_lista_szkolen_online" type="button" class="btn btn-default">Lista szkoleń online</button>
                <button id="zakladka_kalendarz_szkolen" type="button" class="btn btn-default margin_b_0">Kalendarz szkoleń</button>
                <?php if($szkoleniaMain->sprawdzUprawnienie('dokumenty')){ ?>
                    <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/dokumenty/'; ?>"><div id="zakladka_link_do_dokumentow" class="margin_b_0 margin_t_10 width_100 btn btn-default">Link do dokumentów</div></a>
                <?php } ?>
				 <?php if($szkoleniaMain->sprawdzUprawnienie('szkolenia_testy_sprawdz')){ ?>
                    <button id="zakladka_lista_wypelnionych_testow" type="button" class="btn btn-default margin_t_10">Lista wypełnionych testów</button>
                <?php } ?>

			</div>
		</div>
	</div>
	<div class="col-md-7 szkoleniaZawartosc">
		<div class="panel panel-default">
			<div id="panel_body_zawartosc" class="panel-body ">
			</div>
		</div>
	</div>
	<div class="col-md-3 listaKonczacychSieSzkolen">
		<div class="panel panel-default">
			<div class="panel-heading">LISTA KOŃCZĄCYCH SIĘ SZKOLEŃ ONLINE</div>
			<div class="panel-body" id="listaKonczacychSieSzkolen">
				<?php
                    echo $szkoleniaMain->generujListeKonczacychSzkolen($bazaDanych);
                ?>
			</div>
		</div>
	</div>
	<div class="clear_b"></div>
</div>
<div class="clear_b margin_b_60"></div>

<?php $szkoleniaMain->wyswietlStopke(false); ?>
