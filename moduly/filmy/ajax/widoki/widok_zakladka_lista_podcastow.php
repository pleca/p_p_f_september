<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $filmyMain = new FilmyMain($bazaDanych);

    if($filmyMain->sprawdzUprawnienie('podcasty_dodaj')) {
        echo '<div class="panel panel-default margin_b_10"><div class="panel_naglowek"><i class="float_r fa fa-plus dodaj_podcast" aria-hidden="true"></i><div class="clear_b"></div></div></div>';
    }
?>

<div class="width_100 margin_b_10 padding_r_0 padding_l_0">
    <?php
        echo $filmyMain->wygenerujChmurkeTagow(true, null, 'Chmurka tagów');
    ?>
</div>
<div class="panel panel-default margin_b_0">
    <div class="panel-body">
        <div id="tabelkaWynikowPodcastow">
            <?php
                echo $filmyMain->tabelkaWynikowPodcastow();
            ?>
        </div>
    </div>
</div>