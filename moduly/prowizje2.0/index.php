<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>
<?php
if(!in_array('165', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
tytul_strony('Prowizje 2.0');
?>

<link rel="stylesheet" href="https://cdn.votum-sa.pl/bootstrap-4.0.0/css/bootstrap.css" type="text/css" />
<script type="text/javascript" src="https://cdn.votum-sa.pl/bootstrap-4.0.0/js/bootstrap.js"></script>

<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/jquery.js"></script>
<!--<link rel="stylesheet" href="https://cdn.votum-sa.pl/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.css" />-->
<!--<script src="http://kendo.cdn.telerik.com/2018.1.221/js/jquery.min.js"></script>-->
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/kendo.all.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script id="skrypty" type="text/javascript" src="<?php echo adres_strony(); ?>moduly/prowizje2.0/scripts/funkcje"></script>
<!--<link rel="stylesheet" href="https://use.typekit.net/dqs6lau.css">-->
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.common.css" />
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap-v4.css" />
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap.mobile.css" />
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/messages/kendo.messages.pl-PL.js"></script>
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/cultures/kendo.culture.pl-PL.js"></script>

<link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje2.0/styles/main.css'; ?>" type="text/css" />

<script>
  window.user = "<?php echo $_SESSION['uzytkownik_login']; ?>";
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
                            <a class="nav-link active" id="v-pills-commission_agent-tab" data-toggle="pill" href="#v-pills-commission_agent" role="tab" aria-controls="v-pills-commission_agent" aria-selected="true">Prowizje własne</a>
                            <a class="nav-link odswierzSesje" id="v-pills-commission_structure-tab" data-toggle="pill" href="#v-pills-commission_structure" role="tab" aria-controls="v-pills-commission_structure" aria-selected="false">Prowizje struktury</a>
                            <a class="nav-link odswierzSesje" id="v-pills-invoices-tab" data-toggle="pill" href="#v-pills-invoices" role="tab" aria-controls="v-pills-invoices" aria-selected="false">Faktury</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-10">
            <div class="tab-content card card-body" id="v-pills-tabContent">
                <div class="tab-pane fade show active"  id="v-pills-commission_agent" role="tabpanel" aria-labelledby="v-pills-commission_agent-tab">
                                        <?php require_once('./content/commission_agent.php'); ?>
                </div>
                <div class="tab-pane fade"  id="v-pills-commission_structure" role="tabpanel" aria-labelledby="v-pills-commission_structure-tab">
                                        <?php require_once('./content/commission_structure.php'); ?>
                </div>
                <div class="tab-pane fade" id="v-pills-invoices" role="tabpanel" aria-labelledby="v-pills-invoices-tab">
                                      <?php require_once('./content/invoices.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="commissionWindow">
    <?php  require_once('./templates/commissionTemplate.php'); ?>
</div>
<div id="invoiceSettingsWindow">
    <?php  require_once('./templates/invoiceSettingsTemplate.php'); ?>
</div>
<div id="invoiceWindow"></div>



<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

