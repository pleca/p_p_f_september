<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

$konkursyMain = new KonkursyMain($bazaDanych);

if(!$konkursyMain->sprawdzUprawnienie('konkursy')){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}

$konkursyMain->wyswietlNaglowek(false, 'konkursy');
$konkursyMain->zaladujBiblioteki();

?>
<script type="text/javascript" src="<?php adres_strony(); ?>moduly/konkursy/js/funkcje"></script>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/konkursy/css/konkursy.css'; ?>" type="text/css" />

    <div class="container-fluid padding_r_0 padding_l_0 konkursyModul">
        <div class="col-md-12 gdzieJestem"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
        <div class="col-md-2">
            <div class="panel panel-default ">
                <div class="panel-heading">MENU</div>
                <div class="panel-body panel_body_menu">
                    <button id="zakladka_lista_konkursow" type="button" class="btn btn-default">Konkursy</button>
                    <button id="zakladka_rankingi" type="button" class="btn btn-default">Rankingi</button>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div id="panel_body_zawartosc" class="panel-body ">
                </div>
            </div>
        </div>
        <div class="clear_b"></div>
    </div>


<?php $konkursyMain->wyswietlStopke(false); ?>