<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

if(!in_array('81', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}

$mainPanel->wyswietlNaglowek(false, 'zgłoszenia');


?>

    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/npm.js"></script>

    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>moduly/zgloszenia/js/funkcje"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/dataTables.bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fontawsome/css/font-awesome.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/zgloszenia/css/style.css'; ?>" type="text/css" />





    <div class="col-md-12">
        <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <table id="zgloszenia" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Numer sprawy</th>
                        <th>Temat</th>
                        <th>Kategoria</th>
                        <th class="etap">Etap sprawy</th>
                        <th>Agent</th>
                        <th>Kierownik</th>
                        <th>Dyrektor</th>
                    </tr>
                    </thead>
                    <div class="szukanie_w_kolumnie">
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Numer sprawy</th>
                            <th>Temat</th>
                            <th>Kategoria</th>
                            <th>Etap sprawy</th>
                            <th>Agent</th>
                            <th>Kierownik</th>
                            <th>Dyrektor</th>
                        </tr>
                        </tfoot>
                    </div>
                </table>
            </div>
        </div>


    </div>
    <div class="clear_b"></div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>