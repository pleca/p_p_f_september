<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

$sklepMain = new SklepMain($bazaDanych);

if(!$sklepMain->sprawdzUprawnienie('sklep')){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}

$sklepMain->wyswietlNaglowek(false, 'Sklep');
$sklepMain->zaladujBiblioteki();

?>
    <script type="text/javascript" src="<?php adres_strony(); ?>moduly/sklep/js/funkcje"></script>
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/sklep/css/sklep.css'; ?>" type="text/css" />

    <div class="container-fluid padding_r_0 padding_l_0 sklepModul">
        <div class="col-md-12 gdzieJestem "><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
        <div class="col-md-2 sklepModulMenu">
            <div class="panel panel-default ">
                <div class="panel-heading">MENU</div>
                <div class="panel-body panel_body_menu">
                    <button id="zakladka_lista_produktow" type="button" class="btn btn-default">Lista produktów</button>
                </div>
            </div>
        </div>
        <div class="col-md-7 sklepModulZawartosc padding_l_0 padding_r_0">
            <div class="panel panel-default">
                <div id="panel_body_zawartosc" class="panel-body ">
                </div>
            </div>
        </div>
        <div class="col-md-3 sklepModul">
            <div class="panel panel-default">
                <div class="panel-heading">Koszyk</div>
                <div class="panel-body" id="szczegolyElementu">
                    <p>Wybierz element aby wyświetlić szczegóły...</p>
                </div>
            </div>
        </div>
        <div class="clear_b"></div>
    </div>


<?php $sklepMain->wyswietlStopke(false); ?>