<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $bazaDanych = new main_BazaDanych();
    $filmyMain = new FilmyMain($bazaDanych);

    $listaPodcastow = $filmyMain->wygenerujListePodcastow($_SESSION['uzytkownik_id'],$_SESSION['uzytkownik_grupa_id']);
    $listaPodcastow_count = count($listaPodcastow);

?>

<table class="table table-striped tabela_lista_podcastow">
    <thead>
    <tr>
        <th class="">Id</th>
        <th class="col-md-3">Nazwa</th>
        <th class="col-md-4">Opis</th>
        <th class="col-md-1">Publikacja</th>
        <th class="col-md-3">Tagi</th>
        <th class="col-md-1"></th>
    </tr>
    </thead>
    <tbody>
    <?php
        if($listaPodcastow_count !== 0){
            for($i=0;$i<$listaPodcastow_count;$i++) {
                $podcast_tmp = $bazaDanych->pobierzDane('*','podcasty','id = '.$listaPodcastow[$i]);
                $podcast_tmp = $podcast_tmp->fetch_object();
                ?>
                <tr>
                    <td class="wyswietlPodcast cursor_p" data-tytul_podcast="<?php echo $podcast_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $podcast_tmp->plik; ?>" data-element_id="<?php echo $podcast_tmp->id; ?>"><?php echo $podcast_tmp->id; ?></td>
                    <td class="col-md-3 wyswietlPodcast cursor_p" data-tytul_podcast="<?php echo $podcast_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $podcast_tmp->plik; ?>" data-element_id="<?php echo $podcast_tmp->id; ?>"><?php echo $podcast_tmp->tytul; ?></td>
                    <td class="col-md-4 wyswietlPodcast cursor_p" data-tytul_podcast="<?php echo $podcast_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $podcast_tmp->plik; ?>" data-element_id="<?php echo $podcast_tmp->id; ?>"><?php echo $podcast_tmp->opis; ?></td>
                    <td class="col-md-1 wyswietlPodcast cursor_p" data-tytul_podcast="<?php echo $podcast_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $podcast_tmp->plik; ?>" data-element_id="<?php echo $podcast_tmp->id; ?>"><?php echo $podcast_tmp->data_dodania; ?></td>
                    <td class="col-md-3 wyswietlPodcast cursor_p" data-tytul_podcast="<?php echo $podcast_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $podcast_tmp->plik; ?>" data-element_id="<?php echo $podcast_tmp->id; ?>">
                        <?php
                            $listaTagow = $bazaDanych->pobierzDane('podcasty_tagi_id','podcasty_id_podcasty_tagi_id','podcasty_id = '.$podcast_tmp->id);
                            if(!is_null($listaTagow)){
                                $tresc = '';
                                while($poj_listaTagow = $listaTagow->fetch_object()){
                                    $tag_tmp = $bazaDanych->pobierzDane('nazwa','podcasty_tagi','id = '.$poj_listaTagow->podcasty_tagi_id);
                                    $tag_tmp = $tag_tmp->fetch_object();
                                    $tresc .= $tag_tmp->nazwa.', ';
                                }
                                echo substr($tresc, 0, -2);
                            }else{
                                echo 'Brak tagów...';
                            }
                        ?>
                    </td>
                    <td class="col-md-1">
                        <?php if($filmyMain->sprawdzUprawnienie('podcasty_edytuj_wszystkie')){ ?>
                            <i class="fa fa-pencil float_r edytujPodcast" data-element_id="<?php echo $podcast_tmp->id; ?>" aria-hidden="true"></i>
                        <?php } ?>
                        <?php if($filmyMain->sprawdzUprawnienie('podcasty_edytuj_wszystkie')){ ?>
                            <i class="fa fa-calendar historiaWyswietl float_r margin_r_5" data-element_id="<?php echo $podcast_tmp->id; ?>" data-tabela="podcasty_historia_zmian" aria-hidden="true"></i>
                        <?php } ?>
                        <a href="pobierz_podcast?id=<?php echo $podcast_tmp->id; ?>&nazwa=<?php echo $podcast_tmp->plik; ?>&pobierz=true"><i class="fa fa-download float_r margin_r_5" data-element_id="<?php echo $podcast_tmp->id; ?>" aria-hidden="true"></i></a>
                        <i class="fa fa-music float_r margin_r_5 wyswietlPodcast" data-tytul_podcast="<?php echo $podcast_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $podcast_tmp->plik; ?>" data-element_id="<?php echo $podcast_tmp->id; ?>" aria-hidden="true"></i>
                    </td>
                </tr>

                <?php
            }
        }
    ?>

    </tbody>
</table>