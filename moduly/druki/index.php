<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

    if(!in_array('71', $luzu)){
        header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
    }

    $drukiMain = new DrukiMain();

    $drukiMain->wyswietlNaglowek(false, 'druki');

    $drukiMain->zaladujBiblioteki();


?>
    <script type="text/javascript" src="<?php adres_strony(); ?>moduly/druki/js/funkcje"></script>

    <link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.default.min.css" />
    <link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.default.mobile.min.css" />
    <script src="<?php adres_strony(); ?>biblioteki/telerik/js/kendo.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/css/druki.css'; ?>" type="text/css" />
    <div class="col-md-12 paddding_l_0 paddding_r_0 drukiModul">
        <div class="col-md-12 gdzieJestem"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
        <div class="col-md-2">
            <div class="panel panel-default ">
                <div class="panel-heading">MENU</div>
                <div class="panel-body panel_body_menu">
                    <button id="zakladka_zarzadzanie_klientami" type="button" class="btn btn-default">Zarządzanie klientami</button>
                    <button id="zakladka_druki_wypelnione" type="button" class="btn btn-default">Druki wypełnione</button>
                    <button id="zakladka_wypelnij_druk" type="button" class="btn btn-default">Wypełnij druk</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 glownaZawartoscStrony">
            <div class="panel panel-default">
                <div id="panel_body_zawartosc" class="panel-body ">
                </div>
            </div>
        </div>
        <div class="col-md-4 szczegolyElementuZawartosc">
            <div class="panel panel-default">
                <div class="panel-heading">Szczegóły elementu</div>
                <div class="panel-body" id="szczegolyElementu">
                    <p>Wybierz element aby wyświetlić szczegóły...</p>
                </div>
            </div>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="clear_b margin_b_60"></div>



<?php $drukiMain->wyswietlStopke(false); ?>