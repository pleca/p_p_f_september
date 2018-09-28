<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>
<?php
if(!in_array('138', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
tytul_strony('Franki 2.0');
?>

<link rel="stylesheet" href="https://cdn.votum-sa.pl/bootstrap-4.0.0/css/bootstrap.css" type="text/css" />
<script type="text/javascript" src="https://cdn.votum-sa.pl/bootstrap-4.0.0/js/bootstrap.js"></script>

<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/jquery.js"></script>
<!--<link rel="stylesheet" href="https://cdn.votum-sa.pl/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.css" />-->
<!--<script src="http://kendo.cdn.telerik.com/2018.1.221/js/jquery.min.js"></script>-->
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/kendo.all.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script id="skrypty" type="text/javascript" src="<?php echo adres_strony(); ?>moduly/franki2.0/js/funkcje"></script>
<!--<link rel="stylesheet" href="https://use.typekit.net/dqs6lau.css">-->
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.common.css" />
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap-v4.css" />
<link rel="stylesheet" href="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/styles/web/kendo.bootstrap.mobile.css" />
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/messages/kendo.messages.pl-PL.js"></script>
<script src="https://cdn.votum-sa.pl/kendoui.for.jquery.2018.2.620/src/js/cultures/kendo.culture.pl-PL.js"></script>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/franc-calculator.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/main.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/contract.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/contract-list.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/commission-calculator.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/umowa.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/franki2.0/css/documents.css'; ?>" type="text/css" />

<script>
  window.user = "<?php echo $_SESSION['uzytkownik_login']; ?>";
  window.dodaj_dokument = "<?php echo in_array('dodaj_dokument', $_SESSION['_listaUprawnien']); ?>";
  window.edytuj_dokument = "<?php echo in_array('edytuj_dokument', $_SESSION['_listaUprawnien']); ?>";
  window.usun_dokument = "<?php echo in_array('usun_dokument', $_SESSION['_listaUprawnien']); ?>";
  window.pobierz_dokument = "<?php echo in_array('usun_dokument', $_SESSION['_listaUprawnien']); ?>";
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
                        <a class="nav-link odswierzSesje" id="v-pills-documents-tab" href="./src/getFile/getFileRaport.php" aria-selected="false">Raport</a>
                        <?php if (in_array('frankikalkulatory', $_SESSION['_listaUprawnien'])) { ?>
                            <a class="nav-link active odswierzSesje" id="v-pills-franc-calculator-tab" data-toggle="pill" href="#v-pills-franc-calculator" role="tab" aria-controls="v-pills-franc-calculator" aria-selected="true">Kalkulator roszczeń</a>
                        <?php } ?>
                        <a class="nav-link odswierzSesje" id="v-pills-commission-calculator-tab" data-toggle="pill" href="#v-pills-commission-calculator" role="tab" aria-controls="v-pills-commission-calculator" aria-selected="false">Kalkulator ofertowy</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract-tab" data-toggle="pill" href="#v-pills-contract" role="tab" aria-controls="v-pills-contract" aria-selected="false">Zawarcie umowy - kreator dodania nowych umów</a>
                        <a class="nav-link odswierzSesje" id="v-pills-contract_list-tab" data-toggle="pill" href="#v-pills-contract_list" role="tab" aria-controls="v-pills-contract_list" aria-selected="false">Podpisane umowy</a>
                        <a class="nav-link odswierzSesje" id="v-pills-documents-tab" data-toggle="pill" href="#v-pills-documents" role="tab" aria-controls="v-pills-documents" aria-selected="false">Dokumenty</a>
                        <a class="nav-link odswierzSesje" id="v-pills-department-tab" data-toggle="pill" href="#v-pills-department" role="tab" aria-controls="v-pills-department" aria-selected="false">Departament Spraw Bankowych</a>
                        <a class="nav-link odswierzSesje" id="v-pills-presentations-tab" data-toggle="pill" href="#v-pills-presentations" role="tab" aria-controls="v-pills-presentations" aria-selected="false">Prezentacje eventowe</a>
                        <a class="nav-link odswierzSesje" id="v-pills-library-tab" data-toggle="pill" href="#v-pills-library" role="tab" aria-controls="v-pills-library" aria-selected="false">Biblioteka</a>
                        <a class="nav-link odswierzSesje" id="v-pills-videos-tab" data-toggle="pill" href="#v-pills-videos" role="tab" aria-controls="v-pills-videos" aria-selected="false">Filmy instruktażowe</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-10">
            <div class="tab-content card card-body" id="v-pills-tabContent">
                <div class="tab-pane fade <?php if (in_array('frankikalkulatory', $_SESSION['_listaUprawnien'])) { echo 'show active'; }?>"  id="v-pills-franc-calculator" role="tabpanel" aria-labelledby="v-pills-franc-calculator-tab">
                    <?php require_once('./src/franc_calculator.php'); ?>
                </div>
                <div class="tab-pane fade" id="v-pills-commission-calculator" role="tabpanel" aria-labelledby="v-pills-commision-calculator-tab">
                    <?php require_once('./src/commission_calculator.php'); ?>
                </div>
                <div class="tab-pane fade <?php if (!in_array('frankikalkulatory', $_SESSION['_listaUprawnien'])) { echo 'show active'; }?>"" id="v-pills-contract" role="tabpanel" aria-labelledby="v-pills-contract-tab">
                <?php require_once('./src/contract.php'); ?>
            </div>
            <div class="tab-pane fade" id="v-pills-contract_list" role="tabpanel" aria-labelledby="v-pills-contract_list-tab">
                <?php require_once('./src/contract_list.php'); ?>
            </div>
            <div class="tab-pane fade" id="v-pills-documents" role="tabpanel" aria-labelledby="v-pills-documents-tab">
                <?php require_once('./src/documents.php'); ?>
            </div>
            <div class="tab-pane fade" id="v-pills-department" role="tabpanel" aria-labelledby="v-pills-department-tab">
                <?php require_once('./src/department.php'); ?>
            </div>
            <div class="tab-pane fade" id="v-pills-presentations" role="tabpanel" aria-labelledby="v-pills-presentations-tab">
                <?php require_once('./src/presentations.php'); ?>
            </div>
            <div class="tab-pane fade" id="v-pills-library" role="tabpanel" aria-labelledby="v-pills-library-tab">
                <?php require_once('./src/library.php'); ?>
            </div>
            <div class="tab-pane fade" id="v-pills-videos" role="tabpanel" aria-labelledby="v-pills-videos-tab">
                <?php require_once('./src/videos.php'); ?>
            </div>
        </div>
    </div>
</div>

</div>

<div id="printContractFrankWindow">
    <?php require_once('./contract_pattern/contract_template.php'); ?>
</div>



<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>
