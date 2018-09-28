<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

if(!in_array('41', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}

    $mainPanel->wyswietlNaglowek(false, 'prowizje');

?>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/npm.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/googlecharts/loader.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>moduly/prowizje/js/funkcje"></script>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fontawsome/css/font-awesome.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje/css/style.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/dataTables.bootstrap.css'; ?>" type="text/css" />


<div class="col-md-12" style="display:<?php echo (in_array('82', $luzu)) ? 'none' : 'block' ; ?>;">
    <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
    <div class="col-md-2">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU</div>
            <div class="panel-body panel_body_menu">

                <?php // if(in_array('44', $luzu)){ ?>
                <?php if(in_array('42', $luzu)){ ?>
                    <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje/prowizje_uzytkownika/'; ?>">
                        <div id="prow_uzytkownika" class="margin_b_0 margin_t_10 width_100 btn btn-default">Prowizje własne</div></a>
                <?php } ?>

                <?php // if(in_array('45', $luzu)){ ?>
                <?php if(in_array('43', $luzu)){ ?>
                    <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje/prowizje_struktury/'; ?>">
                        <div id="prow_struktury" class="margin_b_0 margin_t_10 width_100 btn btn-default">Prowizje struktury</div></a>
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div id="panel_body_prowizji" class="panel-body ">

                <?php // if(in_array('44', $luzu)){ ?>
                <?php if(in_array('42', $luzu)){ ?>
                    <div class="wykres_prowizji_uzytkownika">
                        <div class="container center">
                            <h3>Twoje prowizje z ostatnich 12 miesięcy</h3>
                        </div>
                        <div id="chart_div_uzytkownik"></div>
                    </div>
                <?php } ?>

                <?php // if(in_array('45', $luzu)){ ?>
                <?php if(in_array('43', $luzu)){ ?>
                    <div class="wykres_prowizji_struktury">
                        <div class="container center">
                            <h3>Najefektywniejsi agenci w ostatnim miesiącu</h3>
                        </div>
                        <div id="chart_div_struktura"></div>
                    </div>
                <?php } ?>
                <div id="error_msg" class="center"></div>
            </div>
        </div>
    </div>
    <div class="clear_b"></div>
</div>

<div class="col-md-12" style="display:<?php echo (in_array('82', $luzu)) ? 'block' : 'none' ; ?>;">
    <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
    <div class="col-md-2">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU PROWIZJI</div>
            <div class="panel-body panel_menu_body">

                <button id="wszystkie_a" type="button" class="btn btn-default">Wszystkie</button>
                <button id="podstawowe_a" type="button" class="btn btn-default prowizja_1">Podstawowe</button>
                <button id="ofe_a" type="button" class="btn btn-default prowizja_2">OFE</button>
                <button id="cesje_wierzytelnosci_a" type="button" class="btn btn-default prowizja_3">Cesje wierzytelnosci</button>
                <button id="wss_cesje_a" type="button" class="btn btn-default prowizja_5">WSS cesje</button>
                <button id="wss_osobowe_a" type="button" class="btn btn-default prowizja_6">WSS osobowe</button>
                <button id="wnm_cesje_a" type="button" class="btn btn-default prowizja_7">VNM cesje</button>
                <button id="wnm_osobowe_a" type="button" class="btn btn-default prowizja_8">VNM osobowe</button>
                <button id="ssv_a" type="button" class="btn btn-default prowizja_10">SSV</button>

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

                <table id="prowizje_wszystkich_za_rok" class="table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Kierownik</th>
                        <th>Dyrektor</th>
                        <th>Styczeń</th>
                        <th>Luty</th>
                        <th>Marzec</th>
                        <th>Kwiecień</th>
                        <th>Maj</th>
                        <th>Czerwiec</th>
                        <th>Lipiec</th>
                        <th>Sierpień</th>
                        <th>Wrzesień</th>
                        <th>Październik</th>
                        <th>Listopad</th>
                        <th>Grudzień</th>
                    </tr>
                    </thead>
                    <div class="szukanie_w_kolumnie">
                        <tfoot>
                        <tr>
                            <th>Agent</th>
                            <th>Kierownik</th>
                            <th>Dyrektor</th>
                            <th>Styczeń</th>
                            <th>Luty</th>
                            <th>Marzec</th>
                            <th>Kwiecień</th>
                            <th>Maj</th>
                            <th>Czerwiec</th>
                            <th>Lipiec</th>
                            <th>Sierpień</th>
                            <th>Wrzesień</th>
                            <th>Październik</th>
                            <th>Listopad</th>
                            <th>Grudzień</th>
                        </tr>
                        </tfoot>
                    </div>

                </table>

                <table id="podzial_prowizji_agentow" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Podstawowe</th>
                        <th>OFE</th>
                        <th>Cesje wierzytelności</th>
                        <th>WSS Cesje</th>
                        <th>WSS Osobowe</th>
                        <th>VNM Cesje</th>
                        <th>VNM Osobowe</th>
                        <th>SSV</th>
                    </tr>
                    </thead>
                </table>

                <table id="szczegoly_prowizji_agentow" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"></table>


            </div>
        </div>
    </div>
    <div class="clear_b"></div>
</div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

