<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

    if(!in_array('1', $luzu)){
        header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
    }

    $administracjaMain = new AdministracjaMain();
    $administracjaMain->wyswietlNaglowek(false, 'Administracja');
    $administracjaMain->zaladujBiblioteki();


?>
    <script type="text/javascript" src="<?php adres_strony(); ?>moduly/administracja_systemem/js/funkcje"></script>
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/administracja_systemem/css/administracjaSystem.css'; ?>" type="text/css" />

    <div class="col-md-12 paddding_l_0 paddding_r_0 administracjaSystememStrona">
        <div class="col-md-12 gdzieJestem"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
        <div class="col-md-2 stronaMenuBoczne">
            <div class="panel panel-default ">
                <div class="panel-heading">MENU</div>
                <div class="panel-body panel_body_menu">
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_zarzadzanie_uzytkownikami')){ ?>
                        <button id="zakladka_zarzadzanie_uzytkownikami" type="button" class="btn btn-default">Zarządzanie użytkownikami</button>
                    <?php } ?>
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_powiadomienia')){ ?>
                        <button id="zakladka_powiadomienia" type="button" class="btn btn-default">Powiadomienia</button>
                    <?php } ?>
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_historia_rejestracji')){ ?>
                        <button id="zakladka_historia_rejestracji" type="button" class="btn btn-default">Historia rejestracji</button>
                    <?php } ?>
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_historia_logowan')){ ?>
                        <button id="zakladka_historia_logowan" type="button" class="btn btn-default">Historia logowań</button>
                    <?php } ?>
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_zarzadzanie_grupami')){ ?>
                        <button id="zakladka_zarzadzanie_grupami" type="button" class="btn btn-default">Zarządzanie grupami</button>
                    <?php } ?>
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_zarzadzanie_uprawnieniami')){ ?>
                        <button id="zakladka_zarzadzanie_uprawnieniami" type="button" class="btn btn-default">Zarządzanie uprawnieniami</button>
                    <?php } ?>
                    <?php if($administracjaMain->sprawdzUprawnienie('administracja_dane_systemowe')){ ?>
                        <button id="zakladka_dane_systemowe" type="button" class="btn btn-default">Dane systemowe</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 glownaZawartoscStrony">
            <div class="panel panel-default">
                <div id="panel_body_zawartosc" class="panel-body panel_body_zawartosc">
                </div>
            </div>
        </div>
        <div class="col-md-4 szczegolyElementuZawartosc">
            <div class="panel panel-default">
                <div class="panel-heading">Szczegóły elementu</div>
                <div class="panel-body" id="szczegolyElementu">
                    <p>Wybierz element aby wyświetlić szczegóły...</p>
                </div>
            </div>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="clear_b margin_b_60"></div>



<?php $administracjaMain->wyswietlStopke(false); ?>