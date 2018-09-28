<?php
session_start();
if(isset($_SESSION['zalogowany']) || isset($_SESSION['uzytkownik_id'])
    || isset($_SESSION['uzytkownik_imie']) || isset($_SESSION['uzytkownik_nazwisko'])){
    header ( 'Location: https://'.$_SERVER ['HTTP_HOST'].'/strona_glowna' );
}

//header("Location: ".'/var/www/pliki/!druki/102/1498659091_pouczenie.pdf');

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
        <?php $panelLogowania->zaladujBiblioteki(true, true); ?>
        <script class="skryptJs" type="text/javascript" src="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/js/skryptyPanelLogowania"></script>
        <link id="cssMain" rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/css/styleMain.css" type="text/css" />
        <link id="cssMobile" rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/css/styleMobile.css" type="text/css" />

    </head>
    <body>

    <script type="text/javascript">

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new
        Date();a=s.createElement(o),

            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a
            ,m)

        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-47538675-1', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');

    </script>




    <?php $panelLogowania->wyswietlNaglowek(true, 'panel logowania'); ?>

    <div class="container-fluid stronaLogowaniaRejestracji">
        <div class="col-lg-3 col-md-2"></div>
        <div id="stronaZawartosc" class="col-lg-4 col-md-5 col-sm-8 col-xs-12 ">

        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 listaZakladek">
            <button id="zakladka_zaloguj_sie" type="button" class="btn btn-default width_100 margin_b_10 zakladkaElement height_40">Zaloguj się</button>
            <button id="zakladka_zarejestruj_sie" type="button" class="btn btn-default width_100 margin_b_10 zakladkaElement height_40">Zarejestruj się</button>
            <button id="zakladka_zapomnialem_hasla" type="button" class="btn btn-default width_100 zakladkaElement height_40">Zapomniałem hasła</button>
        </div>
        <div class="col-lg-3 col-md-2"></div>
    </div>


    <?php $panelLogowania->wyswietlStopke(true); ?>

    </body>
</html>
