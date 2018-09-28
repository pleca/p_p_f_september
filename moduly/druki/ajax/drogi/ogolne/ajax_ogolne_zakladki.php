<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $strona = (isset($_POST['strona'])) ? htmlspecialchars($_POST['strona']) : '';
    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

    $element_id_tmp = explode('-', $element_id);

    $umowa_dane = $bazaDanych->pobierzDane('*', 'umowaRzeczowa', 'Id = ' . $element_id_tmp[2]);
    if ($umowa_dane) {
        $umowa_dane = $umowa_dane->fetch_object();
    }

    $umowa_osobowa_dane = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = ' . $element_id_tmp[2]);
    if ($umowa_osobowa_dane) {
        $umowa_osobowa_dane = $umowa_osobowa_dane->fetch_object();
    }
?>

<div class="drukDoWypelnieniaPopUp">
    <ul class="nav nav-tabs" role="tablist">

        <?php if(($akcja == 'edytuj' && $droga == 'ofe') || ($akcja == 'edytuj' && $droga == 'bankowa')){ ?>
            <li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="<?php echo $droga; ?>" data-strona="dodaj_klienta" data-element_id="<?php echo $element_id; ?>" data-akcja="edytuj" class="active wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Dane klienta</a></li>
        <?php } ?>

        <?php if($akcja == 'edytuj' && $droga == 'rzeczowa'){ ?>
            <li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="<?php echo $droga; ?>" data-strona="dodaj_firme" data-element_id="<?php echo $element_id; ?>" data-akcja="edytuj" class="active wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Dane klienta</a></li>
            <?php
            if($umowa_dane->UmowaTypKlientaId != '1') {
            echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' . $droga . '" data-strona="rzeczowe_pelnomocnik" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Pełnomocnik</a></li>';
            }
            echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' . $droga . '" data-strona="rzeczowe_wspolwlasciciel" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Współwłaściciel</a></li>';

        } ?>

        <?php if($akcja == 'edytuj' && $droga == 'ofe'){ ?>
            <li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="<?php echo $droga; ?>" data-strona="dzialajacy_w_imieniu" data-element_id="<?php echo $element_id; ?>" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">W imieniu</a></li>
        <?php } ?>

        <?php
        if($akcja == 'edytuj' && $droga != 'osobowa') {

            $ile_plikow = (count(glob('/var/www/html/moduly/druki/ajax/drogi/' . $droga . '/*.*')));
            for ($i = 1; $i < ($ile_plikow); $i++) {

                echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="0" data-droga="' . $droga . '" data-strona="' . $i . '" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">' . $i . '</a></li>';
            };
        }
        ?>

        <?php
            if($akcja == 'edytuj' && $droga == 'osobowa') {
                    $ile_plikow = (count(glob('/var/www/html/moduly/druki/ajax/drogi/' . $droga . '/*.*')));

                    if (empty($element_id_tmp[1])) {
                        echo '<li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' .$droga.'" data-strona="osobowe_szkoda" data-element_id="'.$element_id.'" data-akcja="edytuj" class="active wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Szkoda</a></li>';
                        echo '<li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' .$droga.'" data-strona="osobowe_dodaj_klienta" data-element_id="'.$element_id.'" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Klient</a></li>';
                    } else {
                        echo '<li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' . $droga . '" data-strona="osobowe_szkoda" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Szkoda</a></li>';
                        echo '<li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' . $droga . '" data-strona="osobowe_dodaj_klienta" data-element_id="' . $element_id . '" data-akcja="edytuj" class="active wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Klient</a></li>';
                    }

                    if ($umowa_osobowa_dane->TypSzkodyId == '2') {
                        echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' . $droga . '" data-strona="osobowe_zmarly" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Zmarły</a></li>';
                    }


                    for ($i = 1; $i < ($ile_plikow); $i++) {
                        echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="0" data-droga="' . $droga . '" data-strona="' . $i . '" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">' . $i . '</a></li>';
                    };

                    echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="'.$droga.'" data-strona="dodatkowe_informacje" data-element_id="'.$element_id.'" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Umowa</a></li>';
                    echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="'.$droga.'" data-strona="osobowe_zgody" data-element_id="'.$element_id.'" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Zgody</a></li>';
                    echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' .$droga . '" data-strona="osobowe_oswiadczenie" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Oświadczenie</a></li>';

                    //if ($umowa_osobowa_dane->TypSzkodyId == '1') {
                        echo '<li role="presentation" data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="' . $droga . '" data-strona="osobowe_wniosek_do_fundacji" data-element_id="' . $element_id . '" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Wniosek</a></li>';
                    //}

            } else if ($akcja == 'edytuj') {
                echo '<li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="'.$droga.'" data-strona="wynagrodzenie" data-element_id="'.$element_id.'" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Wynagrodzenie</a></li>';
            }
        ?>
        <?php if(($akcja == 'edytuj' && $droga == 'ofe') || ($akcja == 'edytuj' && $droga == 'bankowa') || ($akcja == 'edytuj' && $droga == 'rzeczowa')){ ?>
            <li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="<?php echo $droga; ?>" data-strona="zgody" data-element_id="<?php echo $element_id; ?>" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Zgody</a></li>
        <?php } ?>
        <?php if(($akcja == 'edytuj' && $droga == 'bankowa') || ($akcja == 'edytuj' && $droga == 'ofe')){ ?>
            <li role="presentation"  data-reakcja="przeladuj_widok" data-ogolne="1" data-droga="<?php echo $droga; ?>" data-strona="dodatkowe_informacje" data-element_id="<?php echo $element_id; ?>" data-akcja="edytuj" class="wczytajStroneDrogiUmowyDoPopUp"><a href="#popUpStronaUmowy" aria-controls="popUpStronaUmowy" role="tab" data-toggle="tab">Inne</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="popUpStronaUmowy">
            <?php
            if ($droga == 'ofe' || $droga == 'bankowa') {
                require_once 'ajax_ogolne_dodaj_klienta.php';
            } else if ($droga == 'rzeczowa') {
                require_once 'ajax_ogolne_dodaj_firme.php';
            } else if ($droga == 'osobowa' && empty($element_id_tmp[1])) {
                require_once 'ajax_ogolne_osobowe_szkoda.php';
            } else if ($droga == 'osobowa' && !empty($element_id_tmp[1])) {
                require_once 'ajax_ogolne_osobowe_dodaj_klienta.php';
            }
            ?>
        </div>
    </div>
</div>