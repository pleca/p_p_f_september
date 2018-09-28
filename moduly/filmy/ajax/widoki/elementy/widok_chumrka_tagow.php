<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();

$listaTagow = $widokDane['listaTagow'];
$podcastId = $widokDane['podcastId'];
$tytul = $widokDane['tytul'];

?>

<div class="panel panel-default margin_b_0 chumrkaTagow">
    <div class="panel-heading"><?php echo $tytul; ?></div>
    <div class="panel-body">
        <?php
            if(count($listaTagow) !== 0){
                foreach($listaTagow as $tag){
                    $tag_tmp = $bazaDanych->pobierzDane('*','podcasty_tagi','id = '.$tag);
                    $tag_tmp = $tag_tmp->fetch_object();

                    if(is_null($podcastId)){
                        $liczbaWystapien = 12+(2*$tag_tmp->liczba_wystapien);
                        ?>
                            <span class="pojedynczyTagTekstowy wczytajTabelkeDlaTagu cursor_p" data-tag_nazwa="<?php echo $tag_tmp->nazwa; ?>" style="font-size: <?php echo $liczbaWystapien; ?>px;">
                                <?php echo $tag_tmp->nazwa; ?>
                            </span>
                        <?php
                    }else{
                        ?>
                            <span class="badge pojedynczyTag">
                                <?php echo $tag_tmp->nazwa; ?>
                                <i data-tag_id="<?php echo $tag; ?>" data-reakcja="usun" data-element_id="<?php echo $podcastId; ?>" class="fa fa-times-circle dodajUsunTag" aria-hidden="true"></i>
                            </span>
                        <?php
                    }
                }
            }else{
                echo 'Brak dodanych tagów';
            }
        ?>
    </div>
</div>
