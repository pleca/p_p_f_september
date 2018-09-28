<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>
<?php
if(!in_array('130', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
tytul_strony('Leady');
?>

    <link rel="stylesheet" href="https://cdn.votum-sa.pl/bootstrap-4.0.0/css/bootstrap.css" type="text/css" />
    <script type="text/javascript" src="https://cdn.votum-sa.pl/bootstrap-4.0.0/js/bootstrap.js"></script>

    <script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/jquery.js"></script>
    <!--<script src="http://kendo.cdn.telerik.com/2018.1.221/js/jquery.min.js"></script>-->
    <script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/kendo.all.js"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo adres_strony(); ?>moduly/leady/js/funkcje"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCgQbopB6iwpBeR8zqvh0_vKPLtwJLR77w"></script>
    <link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.common.css" />
    <link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap-v4.css" />
    <link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap.mobile.css" />
    <script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/messages/kendo.messages.pl-PL.js"></script>
    <script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/cultures/kendo.culture.pl-PL.js"></script>
    <script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/jszip.min.js"></script>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/leady/css/style.css'; ?>" type="text/css" />

<script>
    window.user = "<?php echo $_SESSION['uzytkownik_login']; ?>";
    window.full_name = "<?php echo $_SESSION['uzytkownik_imie'].' '.$_SESSION['uzytkownik_nazwisko']; ?>";

    window.edycja_leada = "<?php echo in_array('edycja_leada', $_SESSION['_listaUprawnien']); ?>";
    window.dodawanie_leada = "<?php echo in_array('dodawanie_leada', $_SESSION['_listaUprawnien']); ?>";
    window.przejmowanie_leada = "<?php echo in_array('przejmowanie_leada', $_SESSION['_listaUprawnien']); ?>";
    window.przypisz_agenta = "<?php echo in_array('przypisz_agenta', $_SESSION['_listaUprawnien']); ?>";
    window.przypisz_dyrektora = "<?php echo in_array('przypisz_dyrektora', $_SESSION['_listaUprawnien']); ?>";
    window.edytuj_tylko_swoje = "<?php echo in_array('edytuj_tylko_swoje', $_SESSION['_listaUprawnien']); ?>";
    window.edytuj_przypisane = "<?php echo in_array('edytuj_przypisane', $_SESSION['_listaUprawnien']); ?>";

</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12"><?php echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
    </div>
    <div class="row">
        <div class="col-xl-2">
            <div class="card">
                <div class="card-header">
                    MENU
                </div>
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php if (in_array('lista_leadow', $_SESSION['_listaUprawnien'])) { ?>
                            <a class="nav-link <?php echo (in_array('lista_leadow', $_SESSION['_listaUprawnien'])) ? 'active' : ''  ?>" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all" role="tab" aria-controls="v-pills-all" aria-selected="true">Lista leadów</a>
                        <?php } ?>
                        <?php if (in_array('twoje_leady', $_SESSION['_listaUprawnien'])) { ?>
                            <a class="nav-link <?php echo (!in_array('lista_leadow', $_SESSION['_listaUprawnien'])) ? 'active' : ''  ?>" id="v-pills-uleads-tab" data-toggle="pill" href="#v-pills-uleads" role="tab" aria-controls="v-pills-uleads" aria-selected="false">Twoje leady</a>
                        <?php } ?>
                        <?php if (in_array('leady_struktury', $_SESSION['_listaUprawnien'])) { ?>
                            <a class="nav-link" id="v-pills-sleads-tab" data-toggle="pill" href="#v-pills-sleads" role="tab" aria-controls="v-pills-sleads" aria-selected="false">Leady struktury</a>
                        <?php } ?>
                        <?php if (in_array('zarzadzanie_leadami', $_SESSION['_listaUprawnien'])) { ?>
                            <a class="nav-link" id="v-pills-mleads-tab" data-toggle="pill" href="#v-pills-mleads" role="tab" aria-controls="v-pills-mleads" aria-selected="false">Zarządzanie leadami</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-10">
            <div class="tab-content leadsMenu" id="v-pills-tabContent">
                <div class="box wide">
                    <a href="#" class="k-button" id="save_column"><span class="k-icon k-i-save"></span>&nbsp;Zapisz widok kolumn</a>
                    <!--<a href="#" class="k-button" id="load_column">Załaduj widok kolumn</a>-->
                </div>
                <div class="tab-pane fade <?php echo (in_array('lista_leadow', $_SESSION['_listaUprawnien'])) ? 'show active' : ''  ?>" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab"><div id="grid_all_leads"></div></div>
                <div class="tab-pane fade <?php echo (!in_array('lista_leadow', $_SESSION['_listaUprawnien'])) ? 'show active' : ''  ?>" id="v-pills-uleads" role="tabpanel" aria-labelledby="v-pills-uleads-tab"><div id="grid_user_leads"></div></div>
                <div class="tab-pane fade" id="v-pills-sleads" role="tabpanel" aria-labelledby="v-pills-sleads-tab"><div id="grid_struct_leads"></div></div>
                <div class="tab-pane fade" id="v-pills-mleads" role="tabpanel" aria-labelledby="v-pills-mleads-tab"><div id="grid_manager_leads"></div></div>
            </div>
        </div>
    </div>
</div>

<script type="x/kendo-template" id="page-template">
    <div class="page-template">
        <div class="header">
            <div style="float: right">Page #: pageNum # of #: totalPages #</div>
            Multi-page grid with automatic page breaking
        </div>
        <div class="watermark">KENDO UI</div>
        <div class="footer">
            Page #: pageNum # of #: totalPages #
        </div>
    </div>
</script>

<?php

require_once('./src/php/details_leads_window.php');

if (in_array('dodawanie_leada', $_SESSION['_listaUprawnien'])) {
    require_once('./src/php/add_leads_window.php');
}
if (in_array('edycja_leada', $_SESSION['_listaUprawnien']) || in_array('edytuj_przypisane', $_SESSION['_listaUprawnien']) || in_array('edytuj_tylko_swoje', $_SESSION['_listaUprawnien'])) {
    require_once('./src/php/edit_leads_window.php');
}
if (in_array('zarzadzanie_leadami', $_SESSION['_listaUprawnien'])) {
    require_once('./src/php/manage_leads_window.php');
}
?>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

