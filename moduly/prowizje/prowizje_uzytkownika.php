<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

// if(!in_array('44', $luzu)){
if(!in_array('42', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
tytul_strony('PROWIZJE WŁASNE');

?>


<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/npm.js"></script>


<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>moduly/prowizje/js/funkcje_uzytkownik"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/buttons.print.min.js"></script>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/css/buttons.dataTables.min.css'; ?>" type="text/css" />

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fontawsome/css/font-awesome.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje/css/style.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/dataTables.bootstrap.css'; ?>" type="text/css" />

<div class="col-md-12">
    <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
    <div class="col-md-2">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU PROWIZJI</div>
            <div class="panel-body panel_menu_body">

                <button id="wszystkie" type="button" class="btn btn-default" style='display:block'>Wszystkie</button>
                <button id="podstawowe" type="button" class="btn btn-default prowizjau_1" style='display:none'>Podstawowe</button>
                <button id="ofe" type="button" class="btn btn-default prowizjau_2" style='display:none'>OFE</button>
                <button id="cesje_wierzytelnosci" type="button" class="btn btn-default prowizjau_3" style='display:none'>Cesje wierzytelnosci</button>
                <button id="cesje_walbrzych" type="button" class="btn btn-default prowizjau_4" style='display:none'>Cesje Wałbrzych</button>
                <button id="wss_cesje" type="button" class="btn btn-default prowizjau_5" style='display:none'>WSS cesje</button>
                <button id="wss_osobowe" type="button" class="btn btn-default prowizjau_6" style='display:none'>WSS osobowe</button>
                <button id="wnm_cesje" type="button" class="btn btn-default prowizjau_7" style='display:none'>VNM cesje</button>
                <button id="wnm_osobowe" type="button" class="btn btn-default prowizjau_8" style='display:none'>VNM osobowe</button>
                <button id="auta_zastepcze" type="button" class="btn btn-default prowizjau_9" style='display:none'>Auta zastępcze</button>
                <button id="ssv" type="button" class="btn btn-default prowizjau_10" style='display:none'>SSV</button>

            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div id="panel_body_prowizji" class="panel-body ">
                <div class="zmiana_roku">
                    <div class="col-md-4"></div>
                    <div class="col-md-1 center rok_poprzedni"><span class="glyphicon glyphicon-chevron-left"</span></div>
                    <div class="col-md-2 center" id="rok"></div>
                    <div class="col-md-1 center rok_kolejny"><span class="glyphicon glyphicon-chevron-right"</span></div>
                    <div class="col-md-4"></div>
                </div>

                <table id="suma_prowizji_uzytkownika" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"></table>

                <table id="typy_prowizji" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Podstawowe</th>
                        <th>OFE</th>
                        <th>Cesje wierzytelności</th>
                        <th>Cesje Wałbrzych</th>
                        <th>WSS Cesje</th>
                        <th>WSS Osobowe</th>
                        <th>VNM Cesje</th>
                        <th>VNM Osobowe</th>
                        <th>Auta zastępcze</th>
                        <th>SSV</th>
                    </tr>
                    </thead>
                </table>

                <table id="szczegoly_prowizji" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"></table>

            </div>
        </div>
    </div>
    <div class="clear_b"></div>
</div>
<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

