﻿<?php
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


<div class="col-md-12">
    <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>

    <div class="col-md-2">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU</div>
            <div class="panel-body panel_body_menu">

                <?php // if(in_array('44', $luzu)){ ?>
                <?php //if(in_array('42', $luzu)){ ?>
                    <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/raporty/sprzedaz_struktury/'; ?>">
                        <div id="prow_uzytkownika" class="margin_b_0 margin_t_10 width_100 btn btn-default">Sprzedaż struktury</div></a>
                <!--<a class="margin_t_10" href="<?php /*echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/raporty/test/'; */?>">
                    <div id="prow_uzytkownika" class="margin_b_0 margin_t_10 width_100 btn btn-default">test</div></a>-->
                <?php //} ?>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div id="panel_body_prowizji" class="panel-body ">


                <?php // if(in_array('45', $luzu)){ ?>
                <?php if(in_array('43', $luzu)){ ?>
                    <div class="wykres_prowizji_struktury">
                        <div class="container center">
                            <h3>Raporty</h3>
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






<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

