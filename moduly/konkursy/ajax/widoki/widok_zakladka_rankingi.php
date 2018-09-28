<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $konkursyMain = new KonkursyMain($bazaDanych);

    $koniec = date('Y-m-d');
    $poczatek = date('Y-m-d', strtotime('-60 days'));

?>

<div class="rankingiPrzedstawicieli">
    <ul class="nav nav-tabs" role="tablist">
        <?php if($_SESSION['uzytkownik_grupa_id'] === '1' || $_SESSION['uzytkownik_grupa_id'] === '5'
        || $konkursyMain->sprawdzUprawnienie('konkurs_rankingi_dyrektorow')){ ?>
            <li role="presentation" class=""><a href="#rankingDyrektorzy" aria-controls="rankingDyrektorzy" role="tab" data-toggle="tab">Ranking Dyrektorów</a></li>
        <?php } ?>

        <?php if($_SESSION['uzytkownik_grupa_id'] === '1' || $_SESSION['uzytkownik_grupa_id'] === '4' || $_SESSION['uzytkownik_grupa_id'] === '5'
            || $konkursyMain->sprawdzUprawnienie('konkurs_rankingi_kierownikow')){ ?>
            <li role="presentation" class=" "><a href="#rankingKierownicy" aria-controls="rankingKierownicy" role="tab" data-toggle="tab">Ranking kierowników</a></li>
        <?php } ?>

        <?php if($_SESSION['uzytkownik_grupa_id'] === '1' || $_SESSION['uzytkownik_grupa_id'] === '3' || $_SESSION['uzytkownik_grupa_id'] === '4'
            || $_SESSION['uzytkownik_grupa_id'] === '5' || $konkursyMain->sprawdzUprawnienie('konkurs_rankingi_przedstawicieli')){ ?>
            <li role="presentation" class=" "><a href="#rankingPrzedstawiciele" aria-controls="rankingPrzedstawiciele" role="tab" data-toggle="tab">Ranking przedstawicieli</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content tabContentStyle">
        <?php if($_SESSION['uzytkownik_grupa_id'] === '1' || $_SESSION['uzytkownik_grupa_id'] === '5'
            || $konkursyMain->sprawdzUprawnienie('konkurs_rankingi_dyrektorow')){ ?>
            <div role="tabpanel" class="tab-pane rankingDyrektorzy" id="rankingDyrektorzy">
                <?php echo $konkursyMain->generujRanking($poczatek, $koniec, 3, 'rankingDyrektorzy'); ?>
            </div>
        <?php } ?>

        <?php if($_SESSION['uzytkownik_grupa_id'] === '1' || $_SESSION['uzytkownik_grupa_id'] === '4' || $_SESSION['uzytkownik_grupa_id'] === '5'
            || $konkursyMain->sprawdzUprawnienie('konkurs_rankingi_kierownikow')){ ?>
            <div role="tabpanel" class="tab-pane rankingKierownicy" id="rankingKierownicy">
                <?php echo $konkursyMain->generujRanking($poczatek, $koniec, 2, 'rankingKierownicy'); ?>
            </div>
        <?php } ?>

        <?php if($_SESSION['uzytkownik_grupa_id'] === '1' || $_SESSION['uzytkownik_grupa_id'] === '3' || $_SESSION['uzytkownik_grupa_id'] === '4'
            || $_SESSION['uzytkownik_grupa_id'] === '5' || $konkursyMain->sprawdzUprawnienie('konkurs_rankingi_przedstawicieli')){ ?>
            <div role="tabpanel" class="tab-pane rankingPrzedstawiciele" id="rankingPrzedstawiciele">
                <?php echo $konkursyMain->generujRanking($poczatek, $koniec, 1, 'rankingPrzedstawiciele'); ?>
            </div>
        <?php } ?>

        <?php
            if($_SESSION['uzytkownik_grupa_id'] !== '1' && $_SESSION['uzytkownik_grupa_id'] !== '3' && $_SESSION['uzytkownik_grupa_id'] !== '4'
                && $_SESSION['uzytkownik_grupa_id'] !== '5' && !$konkursyMain->sprawdzUprawnienie('konkurs_rankingi_dyrektorow')
                && !$konkursyMain->sprawdzUprawnienie('konkurs_rankingi_kierownikow') && !$konkursyMain->sprawdzUprawnienie('konkurs_rankingi_przedstawicieli')){
                echo 'Brak danych...';
            }
        ?>

    </div>
</div>


