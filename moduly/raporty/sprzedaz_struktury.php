<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

// if(!in_array('44', $luzu)){
//if(!in_array('42', $luzu)){
//    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
//}
tytul_strony('RAPORTY');
?>


<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/npm.js"></script>


<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>moduly/raporty/js/funkcje_uzytkownik"></script>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/buttons.print.min.js"></script>
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.common.min.css" />
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.default.min.css" />
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.default.mobile.min.css" />
<script src="<?php adres_strony(); ?>biblioteki/telerik/js/jquery.min.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik/js/kendo.all.min.js"></script>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/css/buttons.dataTables.min.css'; ?>" type="text/css" />

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fontawsome/css/font-awesome.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/raporty/css/style.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/dataTables.bootstrap.css'; ?>" type="text/css" />

<div class="col-md-12">
    <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
    <div class="col-md-2">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU RAPORTY</div>
            <div class="panel-body panel_menu_body">

                <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/raporty/sprzedaz_struktury/'; ?>">
                    <div id="prow_uzytkownika" class="margin_b_0 margin_t_10 width_100 btn btn-default">Sprzedaż struktury</div></a>


            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body ">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="report_user user hide" id="<?php echo $_SESSION['uzytkownik_login']?>"></div>
                        <div class="well well-sm col-sm-3">
                            <div class="">Status</div>
                            <div class="btn btn-default report_filter status status_brak" type="submit">Brak</div>
                            <div class="btn btn-default report_filter status status_BD" type="submit">BD</div>
                            <div class="btn btn-default report_filter status status_DW" type="submit">DW</div>
                            <div class="btn btn-default report_filter status status_OD" type="submit">OD</div>
                            <div class="btn btn-default report_filter status status_UZ" type="submit">UZ</div>
                            <div class="btn btn-default report_filter status status_WA" type="submit">WA</div>
                            <div class="btn btn-default report_filter status status status_WI" type="submit">WI</div>
                            <div class="btn btn-default report_filter status status_WM" type="submit">WM</div>
                            <div class="btn btn-default report_filter status status_MW" type="submit">MW</div>
                            <div class="btn btn-default report_filter status status_SD" type="submit">SD</div>
                        </div>
                        <div class="well well-sm margin_b_10 col-sm-3">
                            <div class="width_100 margin_b_10">Rodzaj sprawy</div>
                            <div class="btn btn-default report_filter type type_445" type="submit">445</div>
                            <div class="btn btn-default report_filter type type_446" type="submit">446</div>
                            <div class="btn btn-default report_filter type type_448" type="submit">448</div>
                            <div class="btn btn-default report_filter type type_bankowa" type="submit">bankowa</div>
                            <div class="btn btn-default report_filter type type_brak" type="submit">brak</div>
                            <div class="btn btn-default report_filter type type_cesja_szkoda_rzeczowa" type="submit">Cesja - szkoda rzeczowa</div>
                            <div class="btn btn-default report_filter type type_cesja_powiernicza" type="submit">Cesja powiernicza - szkoda rzeczowa</div>
                            <div class="btn btn-default report_filter type type_inny" type="submit">inny typ szkody</div>
                            <div class="btn btn-default report_filter type type_ofe" type="submit">OFE</div>
                        </div>
                        <div class="well well-sm margin_b_10 col-sm-3">
                            <div class="width_100 margin_b_10">Rok Wpływu</div>
                            <div class="btn btn-default report_filter year year_2010" type="submit">2010</div>
                            <div class="btn btn-default report_filter year year_2011" type="submit">2011</div>
                            <div class="btn btn-default report_filter year year_2012" type="submit">2012</div>
                            <div class="btn btn-default report_filter year year_2013" type="submit">2013</div>
                            <div class="btn btn-default report_filter year year_2014" type="submit">2014</div>
                            <div class="btn btn-default report_filter year year_2015" type="submit">2015</div>
                            <div class="btn btn-default report_filter year year_2016" type="submit">2016</div>
                            <div class="btn btn-default report_filter year year_2017" type="submit">2017</div>
                            <div class="btn btn-default report_filter year year_2018" type="submit">2018</div>
                        </div>
                        <div class="well well-sm margin_b_10 col-sm-3">
                            <div class="width_100 margin_b_10">Miesiąc wpływu</div>
                            <div class="btn btn-default report_filter month month_1" type="submit">m1</div>
                            <div class="btn btn-default report_filter month month_2" type="submit">m2</div>
                            <div class="btn btn-default report_filter month month_3" type="submit">m3</div>
                            <div class="btn btn-default report_filter month month_4" type="submit">m4</div>
                            <div class="btn btn-default report_filter month month_5" type="submit">m5</div>
                            <div class="btn btn-default report_filter month month_6" type="submit">m6</div>
                            <div class="btn btn-default report_filter month month_7" type="submit">m7</div>
                            <div class="btn btn-default report_filter month month_8" type="submit">m8</div>
                            <div class="btn btn-default report_filter month month_9" type="submit">m9</div>
                            <div class="btn btn-default report_filter month month_10" type="submit">m10</div>
                            <div class="btn btn-default report_filter month month_11" type="submit">m11</div>
                            <div class="btn btn-default report_filter month month_12" type="submit">m12</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="well well-sm margin_b_10 col-sm-6">
                            <div class="width_100 margin_b_10">Czy BONA</div>
                            <div class="btn btn-default report_filter bona bona_bona" type="submit">BONA</div>
                            <div class="btn btn-default report_filter bona bona_other" type="submit">Inne</div>
                        </div>
                        <div class="well well-sm margin_b_10 col-sm-6">
                            <div class="width_100 margin_b_10">Czy osobowa</div>
                            <div class="btn btn-default report_filter personal personal_personal" type="submit">Osobowa</div>
                            <div class="btn btn-default report_filter personal personal_inne" type="submit">Inne</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" class="margin_b_10 btn btn-default przycisk_zapisz_zmiany generuj_raport  btn-block text-uppercase" data-akcja="raport_filtruj" >GENERUJ RAPORT</button>
                    </div>
                </div>
                <div class="row">
                    <section class="home_grid col-sm-12">
                        <div id="grid"></div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <div class="clear_b"></div>
</div>
<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

