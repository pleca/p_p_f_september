<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>
<?php
if(!in_array('140', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
tytul_strony('Szkody rzeczowe');
?>

<link rel="stylesheet" href="https://cdn.votum-sa.pl/bootstrap-4.0.0/css/bootstrap.css" type="text/css" />
<script type="text/javascript" src="https://cdn.votum-sa.pl/bootstrap-4.0.0/js/bootstrap.js"></script>

<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/jquery.js"></script>
<!--<link rel="stylesheet" href="https://cdn.votum-sa.pl/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.css" />-->
<!--<script src="http://kendo.cdn.telerik.com/2018.1.221/js/jquery.min.js"></script>-->
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/kendo.all.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script id="skrypty" type="text/javascript" src="<?php echo adres_strony(); ?>moduly/szkody_rzeczowe/scripts/funkcje"></script>
<!--<link rel="stylesheet" href="https://use.typekit.net/dqs6lau.css">-->
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.common.css" />
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap-v4.css" />
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap.mobile.css" />
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/messages/kendo.messages.pl-PL.js"></script>
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/cultures/kendo.culture.pl-PL.js"></script>

<link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkody_rzeczowe/styles/main.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkody_rzeczowe/styles/bona.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkody_rzeczowe/styles/contract_list.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkody_rzeczowe/contract_templates/css/bona.css'; ?>" type="text/css" />


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
                        <a class="nav-link active" id="v-pills-contract_list-tab" data-toggle="pill" href="#v-pills-contract_list" role="tab" aria-controls="v-pills-contract_list" aria-selected="true">Lista umów</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract_bona-tab" data-toggle="pill" href="#v-pills-contract_bona" role="tab" aria-controls="v-pills-contract_bona" aria-selected="false">BONA - kreator umowy</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract_transfer_bls-tab" data-toggle="pill" href="#v-pills-contract_transfer_bls" role="tab" aria-controls="v-pills-contract_transfer_bls" aria-selected="false">Przelew wierzytelności BLS - kreator umowy</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract_fiducary_bls-tab" data-toggle="pill" href="#v-pills-contract_fiducary_bls" role="tab" aria-controls="v-pills-contract_fiducary_bls" aria-selected="false">Powierniczy przelew wierzytelności BLS - kreator umowy</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract_transfer-tab" data-toggle="pill" href="#v-pills-contract_transfer" role="tab" aria-controls="v-pills-contract_transfer" aria-selected="false">Przelew wierzytelności - kreator umowy</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract_fiducary-tab" data-toggle="pill" href="#v-pills-contract_fiducary" role="tab" aria-controls="v-pills-contract_fiducary" aria-selected="false">Powierniczy przelew wierzytelności - kreator umowy</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-10">
            <div class="tab-content card card-body" id="v-pills-tabContent">
                <div class="tab-pane fade show active"  id="v-pills-contract_list" role="tabpanel" aria-labelledby="v-pills-contract_list-tab">
                                        <?php require_once('./content/contract_list.php'); ?>
                </div>
                <div class="tab-pane fade"  id="v-pills-contract_bona" role="tabpanel" aria-labelledby="v-pills-contract_bona-tab">
                                        <?php require_once('./content/bona.php'); ?>
                </div>
                <div class="tab-pane fade" id="v-pills-contract_transfer_bls" role="tabpanel" aria-labelledby="v-pills-contract_transfer_bls-tab">
                    <!--                    --><?php //require_once('./content/contract_transfer_bls.php'); ?>
                </div>
                <div class="tab-pane fade" id="v-pills-contract_fiducary_bls" role="tabpanel" aria-labelledby="v-pills-contract_fiducary_bls-tab">
                    <!--                    --><?php //require_once('./content/contract_fiducary_bls.php'); ?>
                </div>
                <div class="tab-pane fade" id="v-pills-contract_transfer" role="tabpanel" aria-labelledby="v-pills-contract_transfer-tab">
                    <!--                    --><?php //require_once('./content/contract_transfer.php'); ?>
                </div>
                <div class="tab-pane fade" id="v-pills-contract_fiducary" role="tabpanel" aria-labelledby="v-pills-contract_fiducary-tab">
                    <!--                    --><?php //require_once('./content/contract_fiducary.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contractWindow">
    <?php require_once('./templates/editContractTemplate.php'); ?>
</div>

<div id="printContractWindow">
    <?php require_once('./contract_templates/printBonaContractTemplate.php'); ?>
</div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

