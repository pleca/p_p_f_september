<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $filmyMain = new FilmyMain($bazaDanych);

    if($filmyMain->sprawdzUprawnienie('filmy_dodaj')) {
        echo '<div class="panel panel-default margin_b_10">
                <div class="panel_naglowek">
                    <i data-toggle="tooltip" data-placement="left" title="Dodaj film" class="float_r fa fa-film dodaj_film" aria-hidden="true"></i>
                    <i data-toggle="tooltip" data-placement="left" title="Dodaj kategorie filmu" class="float_r margin_r_5 fa fa-plus dodaj_kategorieFilmu" aria-hidden="true"></i>
                    <div class="clear_b"></div>
                </div>
            </div>';
    }

    $listaKategori = $filmyMain->wygenerujListeKategori($_SESSION['uzytkownik_id'],$_SESSION['uzytkownik_grupa_id']);
    $listaKategori_count = count($listaKategori);

    if($listaKategori_count === 0){
        echo '<div class="alert alert-danger" role="alert">'.ERROR_EMPTY_DATA.'</div>';
    }

    for($i=0;$i<$listaKategori_count;$i++){
        $listaFilmowKategori = $filmyMain->wygenerujListeFilmow($_SESSION['uzytkownik_id'],$_SESSION['uzytkownik_grupa_id'], $listaKategori[$i]);

        $listaFilmowKategori_count = count($listaFilmowKategori);

        if($listaFilmowKategori_count !== 0 || $filmyMain->sprawdzUprawnienie('filmy_edytuj_kategorie') || $_SESSION['uzytkownik_grupa_id'] == 1){
            $kategoria_tmp = $bazaDanych->pobierzDane('wartosc','film_kategoria','id = '.$listaKategori[$i]);
            $kategoria_tmp = $kategoria_tmp->fetch_object();
            ?>
                <div class="panel panel-default margin_b_10">
                    <div class="panel-heading">
                        <?php if($filmyMain->sprawdzUprawnienie('filmy_kategoria_historia')){ ?>
                            <i class="float_r fa fa-calendar historiaWyswietl" data-element_id="<?php echo $listaKategori[$i]; ?>" data-tabela="film_kategoria_historia_zmian" aria-hidden="true"></i>
                        <?php } ?>
                        <?php if($filmyMain->sprawdzUprawnienie('filmy_edytuj_kategorie')){ ?>
                            <i data-element_id="<?php echo $listaKategori[$i]; ?>" data-toggle="tooltip" data-placement="left" title="Edytuj kategorie" class="margin_r_5 fa fa-pencil float_r edytuj_kategorieFilmu" aria-hidden="true"></i>
                        <?php } ?>
                        <?php echo $kategoria_tmp->wartosc; ?>
                    </div>
                    <div class="panel-body">
                        <?php
                            for($j=0;$j<$listaFilmowKategori_count;$j++){
                                $film_tmp = $bazaDanych->pobierzDane('*','film','id = '.$listaFilmowKategori[$j]);
                                $film_tmp = $film_tmp->fetch_object();
                                ?>
                                    <div id="film_<?php echo $listaFilmowKategori[$j]; ?>" class="cursor_pointer col-lg-3 col-md-4 col-sm-6 col-sx-12 film padding_r_10 padding_l_10" >
                                        <div class="filmOpcje position_absolute">
                                            <?php if($filmyMain->sprawdzUprawnienie('film_edytuj_wszystkie')){ ?>
                                                <i data-element_id="<?php echo $film_tmp->id; ?>" class="fa fa-pencil edytujFilm" aria-hidden="true"></i>
                                            <?php }else{
                                                if($filmyMain->sprawdzUprawnienie('film_edytuj_swoje')){
                                                    if($film_tmp->uzytkownik_id == $_SESSION['uzytkownik_id']){ ?>
                                                        <i data-element_id="<?php echo $film_tmp->id; ?>" class="fa fa-pencil edytujFilm" aria-hidden="true"></i>
                                                    <?php }
                                                }
                                            }
                                            if($filmyMain->sprawdzUprawnienie('film_historia')){
                                                ?><i class="fa fa-calendar historiaWyswietl" data-element_id="<?php echo $film_tmp->id; ?>" data-tabela="film_historia_zmian" aria-hidden="true"></i>
                                            <?php } ?>

                                        </div>
                                        <div class="panel panel-default wyswietlFilm" data-nazwa_filmu="<?php echo $film_tmp->tytul; ?>" data-nazwa_pliku="<?php echo $film_tmp->r360; ?>"  data-element_id="<?php echo $film_tmp->id; ?>">
                                            <div class="panel-heading">
                                                <?php
                                                    $filmDlugosc = strlen($film_tmp->tytul);
                                                    if($filmDlugosc > 20){
                                                        echo mb_substr($film_tmp->tytul, 0, 20).' [...]';
                                                    }else{
                                                        echo $film_tmp->tytul;
                                                    }

                                                ?>
                                            </div>
                                            <div class="panel-body">
                                                <div class="miniaturaFilm">
                                                    <?php
                                                        echo $filmyMain->pobierzZdjecie($film_tmp->id, $film_tmp->miniatura, '');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                   </div>
                </div>
            <?php
        }
    }