<?php
session_start();
if(isset($_SESSION['zalogowany']) || isset($_SESSION['uzytkownik_id'])
		|| isset($_SESSION['uzytkownik_imie']) || isset($_SESSION['uzytkownik_nazwisko'])){
			header ( 'Location: https://'.$_SERVER['HTTP_HOST'].'/strona_glowna' ) ;
}

$uzytkownikBilet = (isset($_GET['bilet'])) ? htmlspecialchars($_GET['bilet']) : '' ;
$uzytkownikLogin = (isset($_GET['numer'])) ? htmlspecialchars($_GET['numer']) : '' ;

require_once 'konfiguracja/autoload.php';

$panelLogowania = new main_PanelLogowania($bazaDanych);

?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Panel | VOTUM S.A</title>
        <script class="skryptJs" type="text/javascript" src="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/biblioteki/jQuery/jquery.min.js"></script>
        <?php
            $panelLogowania->zaladujBiblioteki((empty($uzytkownikBilet) || empty($uzytkownikLogin)) ? false : true , true);

            if(!empty($uzytkownikBilet) && !empty($uzytkownikLogin)){
                ?>
                    <script class="skryptJs" type="text/javascript" src="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/js/skryptyPanelLogowania"></script>
                <?php
            }
        ?>

        <link id="cssMain" rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/css/styleMain.css" type="text/css" />
        <link id="cssMobile" rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/css/styleMobile.css" type="text/css" />
    </head>
    <body>

    <?php $panelLogowania->wyswietlNaglowek(true, 'Ustaw hasło'); ?>

    <div class="container-fluid stronaLogowaniaRejestracji">
        <div class="col-lg-4 col-md-2"></div>
        <div id="stronaZawartosc" class="col-lg-4 col-md-5 col-sm-8 col-xs-12 ">
            <?php
                if(empty($uzytkownikBilet) || empty($uzytkownikLogin)){

                    echo '<div class="alert alert-danger" role="alert">'.ERROR_TICKET_NUMBER.'</div>';

                }else{
                    $rezultat = $panelLogowania->widokUstawHaslo($uzytkownikBilet, $uzytkownikLogin);
                    if(!$rezultat['rodzaj']){
                        echo '<div class="alert alert-danger" role="alert">'.$rezultat['komunikat'].'</div>';
                    }else{
                        echo $rezultat['tresc'];
                    };
                }
            ?>
        </div>
        <div class="col-lg-4 col-md-2"></div>
    </div>

    <?php $panelLogowania->wyswietlStopke(true); ?>

    </body>
</html>

